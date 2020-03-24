<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
     * @return array
     */
    public function rules()
    {
        switch( $this->method() ) {
            case 'GET':
        
            case 'DELETE': {
                return [
                    'id' => 'required|exists:products,id'
                ];
            }

            case 'POST': {
                return [
                    'product_name' => 'required',
                    'stock' => 'numeric|required',
                    'status' => 'required|in:Active,Inactive',
                    'price_buy' => 'required|numeric',
                    'price_sell' => 'required|numeric'
                ];
            }

            case 'PUT':

            case 'PATCH': {
                return [
                    'id' => 'required|exists:products,id',
                    'product_name' => 'required',
                    'stock' => 'required|numeric',
                    'status' => 'required|in:Active,Inactive',
                    'price_buy' => 'required|numeric',
                    'price_sell' => 'required|numeric'
                ];
            }

            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'product_name.required' => 'Form nama produk tidak boleh kosong',
            'stock.stock' => 'Form stok tidak boleh kosong',
            'stock.numeric' => 'Form stok harus berupa angka',
            'status.required' => 'Form status tidak boleh kosong',
            'price_buy.required' => 'Form harga beli tidak boleh kosong',
            'price_buy.numeric' => 'Form harga beli harus berupa angka',
            'price_sell.required' => 'Form harga jual tidak boleh kosong',
            'price_sell.numeric' => 'Form harga jual harus berupa angka' 
        ];
    }
}