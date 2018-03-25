<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair_invoice extends Model
{
    protected $guarded = [];
    protected $dates = ['delivery_date'];

    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function items()
    {
        return $this->hasMany('App\Repair_invoice_item',  'invoice_id');
    }

    public function invoice_items()
    {
        return $this->belongsToMany('App\Product', 'repair_invoice_items', 'invoice_id');
    }
}
