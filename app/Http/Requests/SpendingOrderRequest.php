<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpendingOrderRequest extends FormRequest
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
                    'description_order' => 'required',
                    'amount_order' => 'required|numeric|min:1',
                ];
            }
            
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'description_order.required' => 'Form <b>deskripsi</b> tidak boleh kosong',
            'amount_order.required' => 'Form <b>biaya</b> tidak boleh kosong',
            'amount_order.numeric' => 'Form <b>biaya</b> hanya boleh berupa angka',
            'amount_order.min' => 'Form <b>biaya</b> minimal 1',
        ];

        return $messages;
    }
}
