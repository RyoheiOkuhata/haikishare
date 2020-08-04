<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Rules\Hankaku;
use App\Http\Controllers\Controller;
use App\Shop;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\UserRegisterRequest;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    public function showRegistrationForm (){
        $prefs = config('prefectures');
        return view('auth.register', 
        [
            'prefs' => $prefs,
            ]);
    }

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'shop_name' => 'required|string|max:20|',
            'branch_name' => 'required|string||max:20|',
            'prefecture' => 'required|string||max:255|',
            'address' => 'required|string||max:255|',
            'email' => ['required','string','email','max:255','unique:users'],
            'password' => ['required','string',new Hankaku,'min:8','confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */

    protected function create(array $data)
    {
        return User::create([
            'shop_name' => $data['shop_name'],
            'branch_name' => $data['branch_name'],
            'prefecture' => $data['prefecture'],
            'address' => $data['address'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

}
