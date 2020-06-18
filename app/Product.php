<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public function sellings(){
        return $this->belongsToMany( 'App\Selling' );
    }

    public function purchases(){
        return $this->belongsToMany( 'App\Purchase' );
    }
}
