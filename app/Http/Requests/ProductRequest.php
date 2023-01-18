<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProductRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules(Request $request)
    {
        // dd($id);
        return [
            'productName' =>  'required|unique:products,name,'.$request->productId,
            'productCategory' =>  'required',
            'productDescription' =>  'required|min:10',
            'productWaitingTime' =>  'required',
            'productPrice' =>  'required',
            'productImage' =>  $request->productId ? 'mimes:jpg,jpeg,png' : 'mimes:jpg,jpeg,png|required' ,
        ];
    }
}
