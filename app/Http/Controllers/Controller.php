<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

abstract class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected $logged_user_view;
    protected $logged_user;

    public function __construct()
    {
        if (Auth::check ()){
            $user = Auth::user();
            $this->logged_user_view = $this->logged_user = 'user_admin.';

            if ($user->isSuperAdmin()){
                $this->logged_user_view = $this->logged_user  = 'admin.';
            }
        }


    }

}
