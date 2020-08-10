<?php

namespace App\Http\Controllers\AuthBuyer;


use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LoginController extends Controller
{
   /*
   |--------------------------------------------------------------------------
   | Login Controller
   |--------------------------------------------------------------------------
   |
   | This controller handles authenticating users for the application and
   | redirecting them to your home screen. The controller uses a trait
   | to conveniently provide its functionality to your applications.
   |
   */
   use AuthenticatesUsers;
   /**
    * Where to redirect users after login.
    *
    * @var string
    */


   protected function redirectTo() {
    session()->flash('flash_message', 'ログインしました');
    return '/';
}


protected function loggedOut(Request $request)
{
    session()->flash('flash_message', 'ログアウトしました');
    return '/';
}



   /**
    * Create a new controller instance.
    *
    * @return void
    */


   public function showLoginForm()
   {
       return view('authBuyer.login');
   }


   /**
    *
    * @param  \Illuminate\Http\Request $request
    *
    * @return Response
    */
   public function authenticate(Request $request){

       $request->validate([
        'email' => 'required|string|email|',
        'password' =>'required|string|',
       ]);

       if( Auth::guard('buyers')::attempt(['email'=>$request->input('email'),'password'=>$request->input('password')])){
        return;
       }else{
           return redirect()->back()->with('flash_message', 'ログインに失敗しました');
       }
   }

   protected function guard()
   {
       return Auth::guard('buyers');
   }
   
   public function logout(Request $request)
   {
       Auth::guard('buyers')->logout();
       $request->session()->flush();
       $request->session()->regenerate();

       return redirect()->route('products.index')->with('flash_message', 'ログアウトしました');
   }
    
}