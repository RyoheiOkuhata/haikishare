<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;
use Closure;

class CheckUser
{
    public function handle($request, Closure $next)
    {
        if (! Auth::guard('web')->user()) {
            return redirect('login');
        }else{
            if( Auth::guard('web')->user()->id === (int)$request->route()->parameter("id") ){
                 return $next($request);
             }else{
                 // ログインしているがユーザーが違う場合のリダイレクト
                 return redirect('TopPage');
             }
        }
    }

}
