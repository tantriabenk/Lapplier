<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseOrderRequest extends FormRequest
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
    public function rules()
    {
        $rules = array();
        switch( $this->method() ) {

            case 'POST': {
                $rules = [
                    'product' => 'required',
                    'qty' => 'required|numeric|min:1',
                    'price_buy' => 'required|numeric|min:100',
                ];
            }
            
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'product.required' => 'Form <b>produk</b> tidak boleh kosong',
            'qty.required' => 'Form <b>jumlah</b> tidak boleh kosong',
            'qty.numeric' => 'Form <b>jumlah</b> hanya boleh berupa angka',
            'qty.min' => 'Form <b>jumlah</b> minimal 1',
            'price_buy.required' => 'Form <b>harga beli</b> tidak boleh kosong',
            'price_buy.numeric' => 'Form <b>harga beli</b> hanya boleh berupa angka',
            'price_buy.min' => 'Form <b>harga beli</b> minimal Rp 100',
        ];

        return $messages;
    }
}
