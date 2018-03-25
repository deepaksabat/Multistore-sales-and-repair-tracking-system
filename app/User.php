<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];
    protected $dates = ['trial_ends_at', 'subscription_ends_at'];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function get_gravatar( $s = 40, $d = 'mm', $r = 'g', $img = false, $atts = array() ) {

        $email = $this->email;
        $url = 'http://www.gravatar.com/avatar/';
        $url .= md5( strtolower( trim( $email ) ) );
        $url .= "?s=$s&d=$d&r=$r";


        if( ! empty($this->photo))
        {
            $url = asset('uploads/photo/'.$this->photo);
        }

        if ( $img ) {
            $url = '<img src="' . $url . '"';
            foreach ( $atts as $key => $val )
                $url .= ' ' . $key . '="' . $val . '"';
            $url .= ' />';
        }

        return $url;
    }

    public function get_fullname()
    {
        return $this->first_name .' '.$this->last_name;
    }

    //Has shops created by this user
/*    public function shops()
    {
        return $this->belongsToMany('App\Shop');
    }*/

    //My all shop that i joined their referral program
    public function joinedShops()
    {
        return $this->belongsToMany('App\Shop');
    }

    public function shop()
    {
        return $this->belongsTo('App\Shop');
    }

    public function isSuperAdmin()
    {
        if($this->user_type == 'super_admin') return true;
        return false;
    }

    public function isSubAdmin()
    {
        if($this->user_type == 'sub_admin') return true;
        return false;
    }
    public function isShopAdmin()
    {
        if($this->user_type == 'shop_admin') return true;
        return false;
    }
    public function isUser()
    {
        if($this->user_type == 'user') return true;
        return false;
    }

    public function scopeUser($query)
    {
        return $query->where('user_type', 'user');
    }

    public function messages()
    {
        return $this->hasMany('App\Message');
    }

    public function messages_unread_count()
    {
        if($this->isSuperAdmin())
        {
            $unread = Message::where('user_id', 0)->where('parent_id', 0)->where('is_read', 0)->count();
        } else{
            $unread = $this->hasMany('App\Message')->where('parent_id', 0)->where('is_read', 0)->count();
        }
        return $unread;
    }

}
