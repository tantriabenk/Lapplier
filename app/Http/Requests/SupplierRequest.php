<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SupplierRequest extends FormRequest
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
                    'id' => 'required|exists:suppliers,id'
                ];
            }

            case 'POST': {
                return [
                    'name' => 'required',
                    'phone_number' => 'required|numeric',
                    'status' => 'required|in:Active,Inactive'
                ];
            }

            case 'PUT':

            case 'PATCH': {
                return [
                    'id' => 'required|exists:suppliers,id',
                    'name' => 'required',
                    'phone_number' => 'numeric',
                    'status' => 'required|in:Active,Inactive'
                ];
            }

            default: 
                break;
        }
    }


    public function messages()
    {
        return [
            'name.required' => 'Form nama tidak boleh kosong',
            'phone_number.required' => 'Form nomor handphone tidak boleh kosong',
            'phone_number.numeric' => 'Nomor handphone harus berupa angka',
        ];
    }
}
