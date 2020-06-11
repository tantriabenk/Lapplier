<?php

namespace App\Helpers;

class ProductHelper
{
    public static function get_product_data($id, $field)
    {
        $product = \App\Product::select($field)->where('id', $id)->first();

        return $product->$field;
    }
}