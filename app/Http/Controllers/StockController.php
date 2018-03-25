<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Product;
use App\Shop;
use App\Stock;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;

class StockController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Stock List';
        return view($this->logged_user_view.'stock_index', compact('pageTitle'));
    }


    public function indexData()
    {
        $stocks = Stock::orderBy('id', 'desc')->select('id', 'product_id', 'shop_id', 'total_product','unite_price','created_at')->with('product', 'shop');


        $user = Auth::user();
        $shop = $user->shop;
        if ($user->isSuperAdmin()){
            $stocks = Stock::orderBy('id', 'desc')->select('id', 'product_id', 'shop_id', 'total_product','unite_price','created_at')->with('product', 'shop');
        }else{
            if ($shop) {
                $shop_id = $shop->id;
                $stocks = Stock::orderBy('id', 'desc')->select('id', 'product_id', 'shop_id', 'total_product', 'unite_price', 'created_at')->where('shop_id', $shop_id)->with('product', 'shop');
            }
        }

        return Datatables::of($stocks)

            ->editColumn('product_id', function($stock){
                return $stock->product->product_name;
            })
            ->editColumn('shop_id', function($stock){
                if($stock->shop_id == 0)
                {
                    return '<label class="label label-success">In House</label>';
                }
                return '<span class="text-success"> '.$stock->shop->name.' </span>';
            })
            ->editColumn('created_at', function($stock){
                return '<span title="'.$stock->created_at->format('F d, Y').'" data-toggle="tooltip" data-placement="top"> '.$stock->created_at->diffForHumans().' </span>';
            })
            ->addColumn('actions', function($stock) use($user){
                $button = '';

                if ($user->isSuperAdmin()) {
                    $button .= '<a href="' . route('view_stock', $stock->id) . '" class="btn btn-success" title="View" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> </a>';
                    $button .= '<a href="' . route('edit_stock', $stock->id) . '" class="btn btn-info" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-pencil"></i> </a>';
                    $button .= '<a href="javascript:;" class="btn btn-danger deleteStock" title="Delete" data-toggle="tooltip" data-placement="top" data-id="' . $stock->id . '"><i class="fa fa-trash-o"></i> </a>';
                }
                return $button;
            })
            ->removeColumn('id')
            ->removeColumn('product')
            ->removeColumn('shop')
            ->make();
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Add Stock';
        $products = Product::all();
        return view('admin.stock_create', compact('pageTitle', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'product'       => 'required',
            'unite_price'   => 'required',
            'total_product' => 'required',
        ];

        //determine if stock transfer to shop

        $shop_id = 0;
        $shop_base_activity = '';
        $unit_price = $request->input('unite_price');

        if(array_has($request->input(), 'shop')){
            $rules['shop'] = 'required';
            unset($rules['unite_price']);
            $shop_id = $request->input('shop');
            $unit_price = 0;

            if( ! empty($shop_id)){
                $shop_detail = Shop::find($shop_id);
                $shop_base_activity = ' to '.$shop_detail->name;
            }
        }

        $this->validate($request, $rules);

        $user = Auth::user();
        $product_id = $request->input('product');

        $stockData = [
            'shop_id'       => $shop_id,
            'product_id'    => $product_id,
            'unite_price'   => $unit_price,
            'total_product' => $request->input('total_product'),
            'user_id'       => $user->id,
        ];

        $create = Stock::create($stockData);

        if($create){
            $product = Product::find($product_id);
                //Add Activity
                Activity::create(['user_id' => $user->id, 'activity' => 'You have added '.$stockData['total_product']. '  '.$product->product_name. $shop_base_activity ]);
                return redirect()->back()->with('success', 'Stock Added success');
        }
        return redirect()->back()->with('error', 'Something went wrong, please try again');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $pageTitle = 'Add Stock';
        $stock = Stock::find($id);
        return view('admin.stock_show', compact('pageTitle', 'stock'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = 'Edit Stock';
        $products = Product::all();
        $stock = Stock::find($id);
        return view('admin.stock_edit', compact('pageTitle', 'products', 'stock'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $stock = Stock::find($id);

        $rules = [
            'product'       => 'required',
            'total_product' => 'required',
        ];

        if($stock->shop_id == 0){
            $rules['unite_price']   = 'required';
            $stock->unite_price =  $request->input('unite_price');
        }

        $this->validate($request, $rules);

        $user = Auth::user();
        $product_id = $request->input('product');
        $total_product = $request->input('total_product');

        $stock->product_id = $product_id;
        if($stock->shop_id == 0){
            $stock->unite_price =  $request->input('unite_price');
        }
        $stock->total_product = $total_product;
        $update = $stock->save();

        if($update){
            $product = Product::find($product_id);
            //Add Activity
            Activity::create(['user_id' => $user->id, 'activity' => 'You have updated stock '.$total_product. ' products  '.$product->product_name ]);
            return redirect()->back()->with('success', 'Stock updated success');
        }
        return redirect()->back()->with('error', 'Something went wrong, please try again');

    }

    public function transferToShop()
    {
        $pageTitle = 'Product transfer to shop';
        $shops = Shop::where('status', 1)->get();
        $products = Product::all();

        return view('admin.transfer_stock', compact('pageTitle','shops', 'products'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $stock_id = $request->input('stock_id');
        Stock::destroy($stock_id);
        return ['status' => 1];
    }
}
