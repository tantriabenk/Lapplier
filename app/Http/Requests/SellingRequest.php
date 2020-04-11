<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckStockProducts;
use App\Rules\CustomTransProductRule;

class SellingRequest extends FormRequest
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
        switch( $this->method() ) {
            case 'POST': {
                return [
                    'customer' => 'required',
                    'date' => 'required',
                    'product' => new CustomTransProductRule,
                    'qty' => new CheckStockProducts,
                ];
            }
        }
    }

    public function messages()
    {
        return [
            'customer.required' => 'Form <b>pelanggan</b> tidak boleh kosong',
            'date.required' => 'Form <b>tanggal</b> tidak boleh kosong',
        ];
    }
}
