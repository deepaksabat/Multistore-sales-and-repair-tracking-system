<?php

namespace App\Http\Controllers;

use App\Activity;
use App\Shop;
use App\Shop_rating;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function postShopRating(Request $request)
    {
        $rateValue = $request->input('rateValue');
        $shopID = $request->input('shopID');
        $user_id = Auth::user()->id;

        $response = [
            'status'    => 0,
            'msg'    => '',
        ];

        $previous_rating = Shop_rating::where('user_id', $user_id)->where('shop_id', $shopID)->first();
        if($previous_rating)
        {
            $response['msg']   = '<p class="text-red">You already rate this merchant</p>';
            return $response;
        }

        $rateData = [
            'shop_id'   => $shopID,
            'user_id'   => $user_id,
            'rating'    => $rateValue,
        ];

        $rate = Shop_rating::create($rateData);
        if($rate)
        {
            $response = [
                'status'    => 1,
                'msg'    => '<p class="text-green">Successfully rate this merchant</p>',
            ];
            $shopName = Shop::find($shopID)->name;
            Activity::create(['user_id' => $user_id, 'activity' => 'you have rate '.$rateValue.' to'. $shopName]);

            return $response;
        }

        $response['msg']   = '<p class="text-red">Something went wrong, try again</p>';
        return $response;
    }


    public function getShopPaymentMethod(Request $request)
    {
        $shop_id = $request->input('shop_id');
        if( ! $shop_id) return '';
        $shop = Shop::find($shop_id);
        $html = '';

        if($shop->payment_method == 'bank_transfer') {
            $html .= '<label > <input type = "radio" name = "payment_way" value = "bank_transfer" checked /> Bank Transfer </label >';
        }
    elseif($shop->payment_method == 'store_credit') {
        $html .= '<label > <input type = "radio" name = "payment_way" value = "store_credit" checked /> Store Credit </label >';
        }
        elseif($shop->payment_method == 'both'){
            $html .= '<label> <input type="radio" name="payment_way" value="bank_transfer" /> Bank Transfer </label> <label> <input type="radio" name="payment_way" value="store_credit" /> Store Credit </label>';
        }

        echo $html;
    }
}
