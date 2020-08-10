<?php

namespace App\Http\Controllers\AuthBuyer;

use App\Buyer;
use App\Rules\Hankaku;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use RegistersUsers;
    public function guard()
    {
    return Auth::guard('buyers');
    }


protected function redirectTo() {
    session()->flash('flash_message', '新規登録しました');
    return '/';
}


    public function showRegistrationForm (){
        return view('authBuyer.register');
    }
    public function __construct()
    {
        $this->middleware('guest:buyers');
    }

    protected function create(Request $request) {
      $validData = $this->validate($request, [  
        'buyer_name' => 'required|string|max:20|',
        'email' => ['required','string','email','max:255','unique:buyers'],
        'password' => ['required','string',new Hankaku,'min:8','confirmed'],
    ]);
      Buyer::create([
        'buyer_name' => $validData['buyer_name'],
        'email' => $validData['email'],
        'password' => Hash::make($validData['password']),
    ]);

    $buyer = Buyer::where('email', $request->email)->first();
    Log::debug(print_r( $buyer, true));
    Auth::guard('buyers')->login($buyer);

    return redirect()->route('products.index')->with('flash_message', 'アカウント登録が完了しました');
    }

}



