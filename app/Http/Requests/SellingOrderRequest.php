<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SellingOrderRequest extends FormRequest
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
                    'discount' => 'numeric'
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
            'discount.min' => 'Form <b>potongan harga</b> hanya boleh berupa angka',
        ];

        return $messages;
    }
}
