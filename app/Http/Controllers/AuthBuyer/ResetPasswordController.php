<?php

namespace App\Http\Controllers\AuthBuyer;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class ResetPasswordController extends Controller
{

    use ResetsPasswords;

    protected function reset()
     {

        return redirect('TopPage')->with('flash_message', 'パスワード変更');
    }

    public function __construct()
    {
       $this->middleware('guest:buyers');
    }

   public function showResetForm(Request $request, $token = null)
   {
       return view('authBuyer.passwords.reset')->with(['token' => $token, 'email' => $request->email])
       ;
    }

    protected function guard()
    {
        return Auth::guard('buyers');
    }

    public function broker()
    {
        return Password::broker('buyers');
    }

}