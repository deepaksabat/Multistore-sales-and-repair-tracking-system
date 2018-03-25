<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class userAdminAuth
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
        if( ! Auth::check())
        {
            return redirect(route('sign_in'))->with('login_error', 'Unauthorized Access');
        }

        return $next($request);
    }
}
