<?php

namespace App\Http\Controllers\AuthBuyer;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Auth;

class ForgotPasswordController extends Controller
{
    use SendsPasswordResetEmails;

    public function __construct()
    {
       $this->middleware('guest:buyers');
    }

    //パスワードリセット用メール送信画面
    public function showLinkRequestForm()
    {
        return view('authBuyer.passwords.email');
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