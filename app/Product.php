<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    public function selling_details(){
        return $this->hasMany( 'App\SellingDetail' );
    }
}
