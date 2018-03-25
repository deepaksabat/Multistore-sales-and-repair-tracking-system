<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $guarded = [];

    public function merchant()
    {
        return $this->belongsTo('App\Shop', 'shop_id');
    }

    public function agent()
    {
        return $this->belongsTo('App\User', 'user_id');
    }

    public function is_read()
    {
        return ($this->is_read == 1) ? 'Seen' : 'Unseen';
    }

    public function sender()
    {
        $sender = '';
        if($this->from == 'admin')
        {
            $sender = 'Admin';
        } else {
            $user = $this->belongsTo('App\User', 'sender_id')->first();
            $sender = $user->get_fullname();
        }
        return $sender;
    }


    public function to()
    {
        $to = '';
        if($this->user_id == 0)
        {
            $to = 'Admin';
        } else {
            $user = $this->belongsTo('App\User', 'user_id')->first();
            $to = $user->get_fullname();
        }
        return $to;
    }

    public function replied()
    {
        return $this->hasMany('App\Message', 'parent_id');
    }

}
