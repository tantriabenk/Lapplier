<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Selling extends Model
{
    public function selling_details(){
        return $this->hasMany( 'App\SellingDetail' );
    }

    public function customers(){
        return $this->belongsTo( 'App\Customer', 'customer_id' );
    }
}
