<?php

namespace App\Http\Controllers;

use App\Invoice;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class ExportController extends Controller
{

    /**
     * Generate CSV
     */

    public function agentsCSVByMerchant()
    {
        $shop = Auth::user()->shop;
        $sales = Invoice::all();

        $salesArray[] = ['Invoice ID', 'Item Name', 'Total Price', 'Customer Name', 'Customer Phone', 'Customer Email', 'Sales Date'];

        foreach ($sales as $item){

            $items_string = "";

            foreach($item->items as $sales_item){
                $items_string .= $sales_item->product->product_name;
            }

            $salesArray[] = [
                $item->invoice_id,
                $items_string,
                $item->total_price,
                $item->customer_name,
                $item->customer_phone,
                $item->customer_email,
                $item->created_at->format('F d, Y'),
            ];
        }

        //return $agents;

        $file_name = $shop->name.'-'.'Sales-'.date('d-m-Y-h-i');
        \Excel::create($file_name, function($excel) use($salesArray) {
            $excel->sheet('Sheet 1', function($sheet) use($salesArray) {
                $sheet->fromArray($salesArray);
            });
        })->export('csv');
    }

    /**
     * Generate excel format for 2003
     */

    public function agentsXlsByMerchant()
    {
        $shop = Auth::user()->joinedShops()->first();
        $agents = $shop->agents()->select(DB::raw('concat(first_name," ",last_name) as name'), 'mobile', 'email')->get();

        //return $agents;

        $file_name = $shop->name.'-'.'all-merchants-'.date('d-m-Y-h-i');
        \Excel::create($file_name, function($excel) use($agents) {
            $excel->sheet('Sheet 1', function($sheet) use($agents) {
                $sheet->fromArray($agents);
            });
        })->export('xls');
    }

    /**
     *
     * Generate excel format for 2007 or later
     */
    public function agentsXlsxByMerchant()
    {
        $shop = Auth::user()->joinedShops()->first();
        $agents = $shop->agents()->select(DB::raw('concat(first_name," ",last_name) as name'), 'mobile', 'email')->get();

        //return $agents;

        $file_name = $shop->name.'-'.'all-merchants-'.date('d-m-Y-h-i');
        \Excel::create($file_name, function($excel) use($agents) {
            $excel->sheet('Sheet 1', function($sheet) use($agents) {
                $sheet->fromArray($agents);
            });
        })->export('xlsx');
    }

    /**
     *
     * Generate PDF
     */
    public function agentsPdfByMerchant()
    {
        $shop = Auth::user()->joinedShops()->first();
        $agents = $shop->agents()->select(DB::raw('concat(first_name," ",last_name) as name'), 'mobile', 'email')->get();

        //return $agents;

        $file_name = $shop->name.'-'.'all-merchants-'.date('d-m-Y-h-i');
        \Excel::create($file_name, function($excel) use($agents) {
            $excel->sheet('Sheet 1', function($sheet) use($agents) {
                $sheet->fromArray($agents);
            });
        })->export('pdf');
    }



}
