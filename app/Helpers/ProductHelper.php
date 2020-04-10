<?php

namespace App\Helpers;

class ProductHelper
{
    /**
     * Get Product Name By Product Id
     */
    public static function get_product_name($id)
    {
        $product = \App\Product::select('product_name')->where('id', $id)->first();

        return $product->product_name;
    }
}