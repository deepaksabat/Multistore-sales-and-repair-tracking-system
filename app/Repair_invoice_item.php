<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Repair_invoice_item extends Model
{
    protected $guarded = [];

    public function product()
    {
        return $this->belongsTo('App\Product');
    }
}
