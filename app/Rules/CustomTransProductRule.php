<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ProductHelp;
use App\Http\Requests\SellingRequest;

class CustomTransProductRule implements Rule
{
    private $product_id_array = array();
    private $trans_empty;
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
        print_r($attribute);
        exit;
        $empty_val = 0;
        foreach( $value as $val ):
            if( empty( $val ) ):
                $empty_val++;
            endif;
        endforeach;

        if( $empty_val == 0 ):
            $count_val = array_count_values( $value );

            foreach( $count_val as $product_id => $val ):
                if( $val > 1 ):
                    $this->product_id_array[] = $product_id;
                endif;
            endforeach;

            if( !empty( $this->product_id_array ) ):
                return false;
            else:
                $value = 1;
            endif;
        else:
            $this->trans_empty = 1;
            return false;
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

        // Message Duplikat Data
        if( !empty( $this->product_id_array ) ):
            foreach( $this->product_id_array as $product ):
                $message .= '<p>Nama Produk: <b>' . ProductHelp::get_product_data( $product, 'product_name' ) . '</b> duplikat pada tabel transaksi</p>';       
            endforeach;
        endif;

        // Pesan jika product belum terisi pada tabel transaksi
        if( $this->trans_empty ):
            $message = '<p>Masih ada produk yang belum di pilih pada tabel transaksi</p>';
        endif;

        return $message;
    }
}
