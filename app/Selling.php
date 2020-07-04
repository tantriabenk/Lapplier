<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Selling extends Model
{
    public function products(){
        return $this->belongsToMany( 'App\Product' )->withPivot( 'qty', 'total', 'discount', 'price_sell', 'total_after_discount' );
    }

    public function customers(){
        return $this->belongsTo( 'App\Customer', 'customer_id' );
    }

    public function sum_total(){
        return $this->belongsToMany( 'App\Product' )->sum( 'total' );
    }
}
