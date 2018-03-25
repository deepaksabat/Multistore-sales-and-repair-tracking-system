<?php
namespace App\Http\Helpers;

use App\Option;

class Helpers{

    public static function get_option($option_key = '')
    {
        $get = Option::where('option_key', $option_key)->first();
        if($get)
        {
            return $get->option_value;
        }
        return $option_key;
    }
}