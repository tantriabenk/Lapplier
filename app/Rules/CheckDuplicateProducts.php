<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ProductHelp;

class CheckDuplicateProducts implements Rule
{
    private $product_id_array;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $this->product_id_array = array();
        if( !empty( $value[0] ) ):
            $count_val = array_count_values( $value );

            foreach( $count_val as $product_id => $val ):
                if( $val > 1 ):
                    $this->product_id_array[] = $product_id;
                endif;
            endforeach;

            if( !empty( $this->product_id_array ) ):
                return false;
            endif;
        else:
            return true;
        endif;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {   
        $message = " ";

        if( !empty( $this->product_id_array ) ):
            foreach( $this->product_id_array as $product ):
                $message .= '<p>Nama Produk: <b>' . ProductHelp::get_product_name( $product ) . '</b> duplikat pada tabel transaksi</p>';       
            endforeach;
        endif;

        return $message;
    }
}
