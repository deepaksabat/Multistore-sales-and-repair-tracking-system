<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Shop extends Model
{
    protected $guarded = [];

    public function statusText()
    {
        $text = '';
        switch($this->status)
        {
            case 0:
                $text = '<p class="text-muted">Pending</p>';
                break;
            case 1:
                $text = '<p class="text-green">Active</p>';
                break;
            case 2:
                $text = '<p class="text-red">Blocked</p>';
                break;
            case 3:
                $text = '<p class="text-yellow">Suspend</p>';
                break;
        }
        return $text;
    }

    public function get_logo()
    {
        if($this->logo != '')
        {
            return asset('uploads/thumb/'.$this->logo);
        }
        return asset('uploads/noImg.png');
    }

    public function scopeActive($query)
    {
        return $query->where('status', 1);
    }

    public function agents()
    {
        //return $this->belongsToMany('App\User')->withPivot('created_at')->wherePivot('user_type','=', 'agent');
        return $this->hasMany('App\User');
    }

    public function agent_single($agent_id = 0){
        return $this->agents()->where('users.id', $agent_id)->first();
    }

    public function loggedUserRating()
    {
        $rating = Shop_rating::where('user_id', Auth::user()->id)->where('shop_id', $this->id)->first();
        if($rating)
        {
            return $rating->rating;
        }
        return false;
    }

    public function avg_rating()
    {
        $ratings = $this->hasMany('App\Shop_rating');
        if($ratings->count() > 0)
        {
            $avg_rating =  $ratings->sum('rating') / $ratings->count();
            $response = (object) ['rating'  => $avg_rating, 'count' => $ratings->count()];
            return  $response;
        }
        return 0;
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function totalSales()
    {
        return $this->hasMany('App\Invoice')->sum('total_price');
    }
}
