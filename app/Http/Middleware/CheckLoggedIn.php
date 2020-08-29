<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class CheckLoggedIn
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
        if (! Auth::guard('buyers')->user()) {
            return redirect('buyers/login');
        }else{
            if( Auth::guard('buyers')->user()->id === (int)$request->route()->parameter("id") ){
                 return $next($request);
             }else{
                 // ログインしているがユーザーが違う場合のリダイレクト
                 return redirect('buyers/login');
             }
        }
    }


}


