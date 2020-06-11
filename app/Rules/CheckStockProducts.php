<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use ProductHelp;

class CheckStockProducts implements Rule
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
        // print_r($value);
        if( !empty( $value ) ):
            foreach( $value as $row_number => $products ):
                if( !empty( $products ) ):
                    foreach( $products as $product_id => $value ):
                        $product_stock = ProductHelp::get_product_data( $product_id, 'stock' );
                        if( $value > $product_stock ):
                            $this->product_id_array[] = $product_id;
                        endif;
                    endforeach;
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
                $message .= '<p>Jumlah produk <b>' . ProductHelp::get_product_data( $product, 'product_name' ) . '</b> yang di masukkan melebihi stok yang ada</p>';       
            endforeach;
        endif;

        return $message;
    }
}
