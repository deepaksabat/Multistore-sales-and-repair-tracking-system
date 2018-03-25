<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class superAdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        //check is user logged in

        if(Auth::check())
        {
            $user = Auth::user();

            //Check this is developer or not
            if($user->user_type != 'super_admin')
            {
                return redirect(route('login_page'))->with('error', 'Unauthorized Access');
            }
        }
        else
        {
            return redirect(route('login_page'))->with('error', 'Unauthorized Access');
        }

        return $next($request);
    }
}
