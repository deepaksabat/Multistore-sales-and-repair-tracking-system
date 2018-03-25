<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Product extends Model
{
    protected $guarded = [];


    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function brand()
    {
        return $this->belongsTo('App\Brand');
    }

    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function attributes()
    {
        return $this->hasMany('App\Product_attribute');
    }


    public function stock_available($method_shop_id = 0)
    {
        
        $shop_id = $method_shop_id;
        if ($method_shop_id == 0) {
            $user = Auth::user();
            $shop = $user->shop;

            if ($shop) {
                $shop_id = $shop->id;
            }
        }
        $total_stock = $this->hasMany('App\Stock')->where('shop_id', $shop_id)->sum('total_product');
        $total_sales = $this->hasMany('App\Invoice_items')->sum('qty');


        return ($total_stock - $total_sales);
    }
}
