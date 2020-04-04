<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SellingDetail extends Model
{
    public function products(){
        return $this->belongsTo( 'App\Product' );
    }

    public function sellings(){
        return $this->belongsTo( 'App\Selling' );
    }
}
