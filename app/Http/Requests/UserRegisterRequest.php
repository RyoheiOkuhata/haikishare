<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\Hankaku;
use Illuminate\Validation\Rule;

class UserRegisterRequest  extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'shop_name' =>  ['required','string','max:255'],
            'branch_name' =>  ['required','string','max:255'],
            'prefecture' => ['required','string','max:255'],
            'img' => ['file','image','mimes:jpeg,png,jpg,gif','max:2500'],
            'address' => ['required','string','max:255'],
            'email' => ['required','string','email','max:255','deleted_at,NULL'],
            'password' => ['required','string',new Hankaku,'min:8','max:12','confirmed'],
        ];
    }
    public function attributes()
{
    return [
        'shop_name' => 'お店の名前',
        'branch_name' => '店舗名',
        'prefecture' => '都道府県',
        'img' => 'プロフィール',
        'address' => '住所',
        'email' => '',
    ];
}


}









