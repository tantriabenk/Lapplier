<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
                    'id' => 'required|exists:customers,id'
                ];
            }

            case 'POST': {
                return [
                    'name' => 'required',
                    'store_name' => 'required',
                    'phone_number' => 'numeric',
                    'status' => 'required|in:Active,Inactive'
                ];
            }

            case 'PUT':

            case 'PATCH': {
                return [
                    'id' => 'required|exists:customers,id',
                    'name' => 'required',
                    'store_name' => 'required',
                    'phone_number' => 'numeric',
                    'status' => 'required|in:Active,Inactive'
                ];
            }

            default: 
                break;
        }
    }
}
