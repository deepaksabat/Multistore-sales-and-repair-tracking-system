<?php

namespace App\Http\Controllers;

use App\Product;
use App\Repair_invoice;
use App\Repair_invoice_item;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;

class RepairProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pageTitle = 'Repair product index';
        return view($this->logged_user_view.'repair_product_index', compact('pageTitle'));
    }


    public function repairInvoiceData()
    {
        $user = Auth::user();

        if($user->isSuperAdmin()) {
            $invoices = Repair_invoice::select('id', 'shop_id', 'user_id', 'invoice_id', 'total_price', 'customer_name', 'created_at')->orderBy('id', 'desc')->with('shop', 'user');

            return Datatables::of($invoices)
                ->addColumn('product', function($invoice){
                    $output = '';
                    foreach($invoice->invoice_items as $item){
                        $output .= $item->product_name.' <br />';
                    }
                    return $output;
                })
                ->editColumn('shop_id', function($invoice){
                    return $invoice->shop->name;
                })
                ->editColumn('user_id', function($invoice){
                    return $invoice->user->get_fullname();
                })
                ->addColumn('created_at', function($invoice){
                    return '<span title="'.$invoice->created_at->format('F d, Y').'" data-toggle="tooltip" data-placement="top"> '.$invoice->created_at->diffForHumans().' </span>';
                })
                ->addColumn('actions', function($invoice){
                    $button = '<a href="'.route('view_repair_invoice', $invoice->invoice_id).'" class="btn btn-success" title="View" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> </a>';

                    return $button;
                })
                ->removeColumn('id')
                ->removeColumn('shop')
                ->removeColumn('user')
                ->make();

        } else {
            $invoices = Repair_invoice::where('user_id', $user->id)->select('id', 'shop_id', 'user_id', 'invoice_id', 'total_price', 'customer_name', 'created_at')->orderBy('id', 'desc')->with('shop', 'user');


            return Datatables::of($invoices)
                ->addColumn('product', function ($invoice) {
                    $output = '';
                    foreach ($invoice->invoice_items as $item) {
                        $output .= $item->product_name . ' <br />';
                    }
                    return $output;
                })
                ->editColumn('shop_id', function ($invoice) {
                    return $invoice->shop->name;
                })
                ->editColumn('user_id', function ($invoice) {
                    return $invoice->user->get_fullname();
                })
                ->addColumn('created_at', function ($invoice) {
                    return '<span title="' . $invoice->created_at->format('F d, Y') . '" data-toggle="tooltip" data-placement="top"> ' . $invoice->created_at->diffForHumans() . ' </span>';
                })
                ->addColumn('actions', function ($invoice) {
                    $button = '<a href="' . route('view_repair_invoice', $invoice->invoice_id) . '" class="btn btn-success" title="View" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> </a>';

                    return $button;
                })
                ->removeColumn('id')
                ->removeColumn('shop')
                ->removeColumn('user')
                ->make();
        }
    }





    public function completedRepairProduct()
    {
        $pageTitle = 'Repair product index';
        return view($this->logged_user_view.'completed_repair_product_index', compact('pageTitle'));
    }


    public function completedRepairInvoiceData()
    {
        $user = Auth::user();

        if($user->isSuperAdmin()) {
            $invoices = Repair_invoice::select('id', 'shop_id', 'user_id', 'invoice_id', 'total_price', 'customer_name', 'created_at')->where('status','completed')->orderBy('id', 'desc')->with('shop', 'user');

            return Datatables::of($invoices)
                ->addColumn('product', function($invoice){
                    $output = '';
                    foreach($invoice->invoice_items as $item){
                        $output .= $item->product_name.' <br />';
                    }
                    return $output;
                })
                ->editColumn('shop_id', function($invoice){
                    return $invoice->shop->name;
                })
                ->editColumn('user_id', function($invoice){
                    return $invoice->user->get_fullname();
                })
                ->addColumn('created_at', function($invoice){
                    return '<span title="'.$invoice->created_at->format('F d, Y').'" data-toggle="tooltip" data-placement="top"> '.$invoice->created_at->diffForHumans().' </span>';
                })
                ->addColumn('actions', function($invoice){
                    $button = '<a href="'.route('view_repair_invoice', $invoice->invoice_id).'" class="btn btn-success" title="View" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> </a>';

                    return $button;
                })
                ->removeColumn('id')
                ->removeColumn('shop')
                ->removeColumn('user')
                ->make();

        } else {
            $invoices = Repair_invoice::where('user_id', $user->id)->select('id', 'shop_id', 'user_id', 'invoice_id', 'total_price', 'customer_name', 'created_at')->where('status','completed')->orderBy('id', 'desc')->with('shop', 'user');


            return Datatables::of($invoices)
                ->addColumn('product', function ($invoice) {
                    $output = '';
                    foreach ($invoice->invoice_items as $item) {
                        $output .= $item->product_name . ' <br />';
                    }
                    return $output;
                })
                ->editColumn('shop_id', function ($invoice) {
                    return $invoice->shop->name;
                })
                ->editColumn('user_id', function ($invoice) {
                    return $invoice->user->get_fullname();
                })
                ->addColumn('created_at', function ($invoice) {
                    return '<span title="' . $invoice->created_at->format('F d, Y') . '" data-toggle="tooltip" data-placement="top"> ' . $invoice->created_at->diffForHumans() . ' </span>';
                })
                ->addColumn('actions', function ($invoice) {
                    $button = '<a href="' . route('view_repair_invoice', $invoice->invoice_id) . '" class="btn btn-success" title="View" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> </a>';

                    return $button;
                })
                ->removeColumn('id')
                ->removeColumn('shop')
                ->removeColumn('user')
                ->make();
        }
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $pageTitle = 'Add new repair product';
        $products = Product::all();

        return view($this->logged_user_view.'new_repair_product', compact('pageTitle', 'products'));
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
            'customer_name' => 'required',
            'customer_phone' => 'required',
            'customer_address' => 'required',
            'delivery_date' => 'required',
        ];
        $this->validate($request, $rules);
        if(Cart::count() == 0)
        {
            return redirect()->back()->with('error', 'No product')->withInput($request->input());
        }

        $user = Auth::user();
        $shop_id = 1;
        $shop = $user->shop;
        if ($shop)
            $shop_id = $shop->id;

        //Generate invoice random id
        $invoice_id = str_random(12);
        // get unique REF ID id
        while ((Repair_invoice::where('invoice_id', $invoice_id)->count()) > 0) {
            $invoice_id = str_random(6);
        }
        $invoice_id = strtoupper($invoice_id);

        $total_price = Cart::total();

        $customer_name      = $request->input('customer_name');
        $customer_email     = $request->input('customer_email');
        $customer_phone     = $request->input('customer_phone');
        $customer_address   = $request->input('customer_address');
        $delivery_date      = $request->input('delivery_date');
        $special_note       = $request->input('special_note');


        $invoice_data = [
            'shop_id'           => $shop_id,
            'user_id'           => $user->id,
            'invoice_id'        => $invoice_id,
            'total_price'       => $total_price,
            'customer_name'     => $customer_name,
            'customer_email'    => $customer_email,
            'customer_phone'    => $customer_phone,
            'customer_address'  => $customer_address,
            'delivery_date'     => $delivery_date,
            'special_note'      => $special_note,
            'status'            => 'waiting'
        ];

        $invoice_create = Repair_invoice::create($invoice_data);

        //If invoice create success, then insert product items
        if($invoice_create)
        {
            foreach(Cart::content() as $row)
            {
                $invoice_item = [
                    'invoice_id'        => $invoice_create->id,
                    'product_id'        => $row->id,
                    'qty'               => $row->qty,
                    'unit_price'        => $row->price,
                    'unit_price_total'  => $row->subtotal,
                    'status'            => 'waiting'
                ];
                Repair_invoice_item::create($invoice_item);
            }
            //Now clear cart
            Cart::destroy();
            return redirect()->back()->with('success', 'Repair product added Success');
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
        $user = Auth::user();
        $pageTitle= 'Repair Invoice';
        $invoice = Repair_invoice::where('invoice_id', $id)->with('items.product')->first();

        if($user->isSuperAdmin()) {
            return view('admin.repair_invoice_show', compact('payment', 'invoice', 'pageTitle'));
        }
        return view('user_admin.repair_invoice_show', compact('payment', 'invoice', 'pageTitle'));
    }


    public function changeRepairInvoiceStatus(Request $request)
    {
        $repair_invoice_id  = $request->repair_invoice_id;
        $status             = $request->status;

        $repairInvoice = Repair_invoice::find($repair_invoice_id);
        $repairInvoice -> status = $status;
        $save = $repairInvoice -> save();
        if($save)
        {
            return ['status' => 1];
        }
        return ['status' => 0];
    }

    public function saveEngineerNoteInItem(Request $request){
        $item_id        = $request->item_id;
        $engineer_note  = $request->engineer_note;

        $invoiceItem  = Repair_invoice_item::find($item_id);
        $invoiceItem -> engineer_note = $engineer_note;
        $save = $invoiceItem -> save();
        if($save)
        {
            return ['status' => 1];
        }
        return ['status' => 0];
    }


    public function invoicePrint($id)
    {
        $invoice = Repair_invoice::where('invoice_id', $id)->with('items.product')->first();

        return view('invoice.repair_invoice', compact('payment', 'invoice'));
    }

    public function invoicePDF($id)
    {
        $invoice = Repair_invoice::where('invoice_id', $id)->with('items.product')->first();

        $pdf = \PDF::loadView('invoice.repair_invoice-pdf', compact('invoice'));
        return $pdf->download('invoice-'.$invoice->invoice_id.'.pdf');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
