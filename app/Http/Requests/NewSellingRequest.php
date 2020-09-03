<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewSellingRequest extends FormRequest
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
                    'customer' => 'required',
                    'date' => 'required',
                ];

                foreach( $this->get( 'product' ) as $key => $val ):
                    $rules[ 'product.' . $key ] = [ 'required' ];
                endforeach;
            }
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'customer.required' => 'Form <b>pelanggan</b> tidak boleh kosong',
            'date.required' => 'Form <b>tanggal</b> tidak boleh kosong',
        ];

        foreach( $this->get( 'product' ) as $key => $val ):
            $row = $key+1;
            $messages[ 'product.' . $key . '.required' ] = '<b>Detail Order</b> belum terisi';
        endforeach;
        
        return $messages;
    }
}
