<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SpendingRequest extends FormRequest
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
                    'officer' => 'required',
                    'date' => 'required',
                ];

                foreach( $this->get( 'description' ) as $key => $val ):
                    $rules[ 'description.' . $key ] = [ 'required' ];
                endforeach;
            }
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'officer.required' => 'Form <b>petugas</b> tidak boleh kosong',
            'date.required' => 'Form <b>tanggal</b> tidak boleh kosong',
        ];

        foreach( $this->get( 'description' ) as $key => $val ):
            $row = $key+1;
            $messages[ 'description.' . $key . '.required' ] = '<b>Detail Order</b> belum terisi';
        endforeach;
        
        return $messages;
    }
}
