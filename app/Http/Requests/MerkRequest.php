<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MerkRequest extends FormRequest
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
                    'id' => 'required|exists:merks,id'
                ];
            }

            case 'POST': {
                return [
                    'merk_name' => 'required'
                ];
            }

            case 'PUT':
            
            case 'PATCH': {
                return [
                    'merk_name' => 'required',
                ];
            }

            default:
                break;
        }
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'merk_name.required' => 'Form nama merek tidak boleh kosong',
        ];
    }
}
