<?php

namespace App\Http\Controllers;

use App\Invoice;
use App\Payment_request;
use App\Repair_invoice;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use yajra\Datatables\Datatables;

class InvoiceController extends Controller
{

    public function shopSales()
    {
        $user = Auth::user();

        $pageTitle = 'All Sales';

        if($user->isSuperAdmin()){
            return view('admin.sales_index', compact('pageTitle'));
        }
        return view('user_admin.sales_index', compact('pageTitle'));

    }

    public function shopSalesData()
    {
        $user = Auth::user();

        if($user->isSuperAdmin()) {
            $invoices = Invoice::orderBy('id', 'desc')->select('id', 'shop_id', 'user_id', 'invoice_id', 'total_price', 'customer_name', 'created_at')->with('shop', 'user');

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
                    $button = '<a href="'.route('admin_view_sales_invoice', $invoice->id).'" class="btn btn-success" title="View" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> </a>';

                    return $button;
                })
                ->removeColumn('id')
                ->removeColumn('shop')
                ->removeColumn('user')
                ->make();

        } else {
            $invoices = Invoice::where('user_id', $user->id)->select('id', 'shop_id', 'user_id', 'invoice_id', 'total_price', 'customer_name', 'created_at')->with('shop', 'user');


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
                    $button = '<a href="' . route('view_sales_invoice', $invoice->id) . '" class="btn btn-success" title="View" data-toggle="tooltip" data-placement="top"><i class="fa fa-eye"></i> </a>';

                    return $button;
                })
                ->removeColumn('id')
                ->removeColumn('shop')
                ->removeColumn('user')
                ->make();
        }
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
        $pageTitle= 'Sales Invoice';
        $invoice = Invoice::where('id', $id)->with('items.product')->first();
        
        return view($this->logged_user_view.'sales_invoice_show', compact('payment', 'invoice', 'pageTitle'));
    }

    public function invoicePrint($id)
    {
        $invoice = Invoice::where('id', $id)->with('items.product')->first();

        return view('invoice.sales_invoice', compact('payment', 'invoice'));
    }

    public function invoicePDF($id)
    {
        $invoice = Invoice::find($id);

        $pdf = \PDF::loadView('invoice.sales_invoice-pdf', compact('invoice'));
        return $pdf->download('invoice-'.$invoice->invoice_id.'.pdf');

    }
}
