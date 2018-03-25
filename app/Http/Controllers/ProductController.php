<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Brand;
use App\Category;
use App\Product;
use App\Product_attribute;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Products';
        return view('admin.product_index', compact('pageTitle'));
    }

    public function indexData()
    {
        $products = Product::orderBy('id', 'desc')->select('id', 'product_name', 'product_model', 'brand_id','category_id', 'unite_price', 'created_at')->with('category', 'brand');
        return Datatables::of($products)
            ->editColumn('brand_id', function($product){
                return $product->brand->brand_name;
            })
            ->editColumn('category_id', function($product){
                return $product->category->category_name;
            })
            ->editColumn('created_at', function($product){
                return '<span title="'.$product->created_at->format('F d, Y').'" data-toggle="tooltip" data-placement="top"> '.$product->created_at->diffForHumans().' </span>';
            })
            ->addColumn('stock', function($product){
                return $product->stock_available();
            })
            ->addColumn('actions', function($product){
                $button = '<a href="'.route('view_product', $product->id).'" class="btn btn-success" title="View" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> </a>';
                $button .= '<a href="'.route('edit_product', $product->id).'" class="btn btn-info" title="Edit" data-toggle="tooltip" data-placement="top"><i class="fa fa-pencil"></i> </a>';
                $button .= '<a href="javascript:;" class="btn btn-danger deleteBrands" title="Delete" data-toggle="tooltip" data-placement="top" data-id="'.$product->id.'"><i class="fa fa-trash-o"></i> </a>';
                return $button;
            })
            ->removeColumn('id')
            ->removeColumn('brand')
            ->removeColumn('category')
            ->make();
    }

    public function indexShop()
    {
        $pageTitle = 'Products';
        return view('user_admin.product_index', compact('pageTitle'));
    }

    public function indexShopData()
    {
        $products = Product::orderBy('id', 'desc')->select('id', 'product_name', 'product_model', 'brand_id','category_id', 'unite_price')->with('category', 'brand');
        return Datatables::of($products)
            ->editColumn('brand_id', function($product){
                return $product->brand->brand_name;
            })
            ->editColumn('category_id', function($product){
                return $product->category->category_name;
            })
            ->addColumn('stock', function($product){
                return $product->stock_available();
            })
            ->removeColumn('id')
            ->removeColumn('brand')
            ->removeColumn('category')
            ->make();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Create Product';
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.product_create', compact('pageTitle', 'categories', 'brands'));
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
            'category'  => 'required',
            'brand'  => 'required',
            'product_name'  => 'required',
            'unite_price'  => 'required',
        ];

        //Dynamic Product Attribute Save into session
        $attribute_names = $request->input('attribute_name');
        $attribute_values = $request->input('attribute_value');

        $old_product_attribute['attribute_name'] = $attribute_names;
        $old_product_attribute['attribute_value'] = $attribute_values;

        session(['old_product_attribute' => $old_product_attribute]);

        //Now validate all
        $this->validate($request, $rules);

        $user = Auth::user();



        $category       = $request->input('category');
        $brand          = $request->input('brand');
        $product_name   = $request->input('product_name');
        $unite_price    = $request->input('unite_price');
        $product_model  = $request->input('product_model');
        $description    = $request->input('description');

        $data = [
            'user_id'       => $user->id,
            'category_id'   => $category,
            'brand_id'      => $brand,
            'product_name'  => $product_name,
            'unite_price'   => $unite_price,
            'product_model' => $product_model,
            'description'   => $description,
        ];

        $create = Product::create($data);
        if($create)
        {
            //Now Additional Save Attribute
            $count_attribute_names = count($attribute_names);
            $product_attributes = [];
            for($i = 0; $i < $count_attribute_names; $i++)
            {
                $attribute_name = trim($attribute_names[$i]);
                if($attribute_name != '')
                {
                    $attributeData = [
                        'product_id'    => $create->id,
                        'attribute_name'=> $attribute_name,
                        'attribute_value'=> $attribute_values[$i]
                    ];
                    $createAttribute = Product_attribute::create($attributeData);
                    if($createAttribute)
                    {
                        $createAttribute -> c_order = $createAttribute->id;
                        $createAttribute->save();
                    }
                }
            }
            $request->session()->forget('old_product_attribute');

            //Add Activity
            Activity::create(['user_id' => $user->id, 'activity' => 'You have added '.$product_name. '  product']);

            return redirect()->back()->with('success', 'Product create success');
        }
        return redirect()->back()->with('error', 'Something went wrong, please try again');

    }


    public function addProductAttribute()
    {
        return view('ajax.product_attribute');
    }

    public function deleteProductAttribute(Request $request)
    {
        $attrID = $request->input('attrID');
        Product_attribute::destroy($attrID);
        return ['status' => 1];
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageTitle = 'Show Product';
        $product = Product::find($id);
        return view('admin.product_show', compact('product', 'pageTitle'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageTitle = 'Edit Product';
        $categories = Category::all();
        $brands = Brand::all();
        $product = Product::find($id);
        return view('admin.product_edit', compact('pageTitle', 'categories', 'brands', 'product'));

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

        $rules = [
            'category'  => 'required',
            'brand'  => 'required',
            'product_name'  => 'required',
            'unite_price'  => 'required',
        ];

        //Dynamic Product Attribute Save into session
        $attribute_names = $request->input('attribute_name');
        $attribute_values = $request->input('attribute_value');

        $attribute_name_edit = $request->input('attribute_name_edit');
        $attribute_values_edit = $request->input('attribute_value_edit');
        $attr_ids = $request->input('attr_ids');

        $old_product_attribute['attribute_name'] = $attribute_names;
        $old_product_attribute['attribute_value'] = $attribute_values;

        session(['old_product_attribute' => $old_product_attribute]);

        //Now validate all
        $this->validate($request, $rules);

        $user = Auth::user();



        $category       = $request->input('category');
        $brand          = $request->input('brand');
        $product_name   = $request->input('product_name');
        $unite_price    = $request->input('unite_price');
        $product_model  = $request->input('product_model');
        $description    = $request->input('description');

        $data = [
            'user_id'       => $user->id,
            'category_id'   => $category,
            'brand_id'      => $brand,
            'product_name'  => $product_name,
            'unite_price'   => $unite_price,
            'product_model' => $product_model,
            'description'   => $description,
        ];

        $create = Product::where('id', $id)->update($data);
        if($create)
        {
            //Now Additional Save Attribute
            $count_attribute_names = count($attribute_names);

            //First update previous attributes belongs with this product
            if(count($attribute_name_edit) > 0)
            {
                for($i = 0; $i < count($attribute_name_edit); $i++)
                {
                    $attributeData = [
                        'attribute_name'    => $attribute_name_edit[$i],
                        'attribute_value'   => $attribute_values_edit[$i],
                        'c_order'           => $attr_ids[$i]
                    ];
                    Product_attribute::where('id', $attr_ids[$i])->update($attributeData);
                }
            }

            //Save new attributes
            if($count_attribute_names > 0){
                $product_attributes = [];
                for($i = 0; $i < $count_attribute_names; $i++)
                {
                    $attribute_name = trim($attribute_names[$i]);
                    if($attribute_name != '')
                    {
                        $attributeData = [
                            'product_id'    => $id,
                            'attribute_name'=> $attribute_name,
                            'attribute_value'=> $attribute_values[$i]
                        ];
                        $createAttribute = Product_attribute::create($attributeData);
                        if($createAttribute)
                        {
                            $createAttribute -> c_order = $createAttribute->id;
                            $createAttribute->save();
                        }
                    }
                }
                $request->session()->forget('old_product_attribute');
            }

            //Add Activity
            Activity::create(['user_id' => $user->id, 'activity' => 'You have updated '.$product_name. '  product']);

            return redirect()->back()->with('success', 'Product update success');
        }
        return redirect()->back()->with('error', 'Something went wrong, please try again');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
