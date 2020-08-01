<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use App\Rules\Hankaku;
class ProductRequest extends FormRequest {
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



    public function rules()
    {
        return [
            'product_name' => ['required','max:20'],
            'expiration_date' => 'required|date_format:"Y-m-d"|',
            'price' => 'required|numeric|',
            'img' => 'required|file|image|mimes:jpeg,png,jpg,gif|max:2500'
        ];
    }

    public function attributes()
{
    return [
        'email' => 'メールアドレス',
        'img' => '商品画像',
        'price' => '価格',
        'expiration_date' => '賞味期限',
        'product_name' => '商品の名前',
    ];
}

public function messages()
{
    return [
        'img.mimes:jpeg,png,jpg,gif'=> '商品画像 は「jpg」「png」「bmp」「gif」「svg」のみ有効です',
    ];
}




        }





