<?php

namespace App\Helpers;
use DB;

class ProductHelper
{
    public static function get_product_data( $id, $field )
    {
        $product = \App\Product::select( $field )->where( 'id', $id )->first();
        return $product->$field;
    }

    public static function get_product_stock( $product_id )
    {
        $stock = (new static)->get_product_data( $product_id, 'stock' );
        return $stock;
    }

    public static function get_sum_product_selling( $product_id )
    {
        $stock = DB::table('product_selling')->where('product_id', '=', $product_id)->sum('qty');
        return $stock;
    }

    public static function get_sum_product_purchase( $product_id )
    {
        $stock = DB::table('product_purchase')->where('product_id', '=', $product_id)->sum('qty');
        return $stock;
    }

    public static function get_product_stock_recent( $product )
    {
        $first_stock = (new static)->get_product_stock( $product );
        $product_sum_selling = (new static)->get_sum_product_selling( $product );
        $product_sum_purchase = (new static)->get_sum_product_purchase( $product );

        $recent_stock = $first_stock + $product_sum_purchase - $product_sum_selling;
        return $recent_stock;
    }

    // Function for create label chart
    public static function get_chart_product_stock()
    {
        $label_chart = array();
        $product_stock = array();
        $products = \App\Product::select( 'id', 'product_name' )->orderBy( 'product_name', 'ASC' )->get();

        if( $products ):
            foreach( $products as $product ):
                $label_chart[] = $product->product_name;
                $product_stock[] = (new static)->get_product_stock_recent( $product->id );
            endforeach;
        endif;

        $result = [
            'label_chart' => $label_chart,
            'product_stock' => $product_stock,
        ];

        // return collect($product_stock)->sortDesc();
        return $result;
    }
}