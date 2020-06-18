<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    public function products(){
        return $this->belongsToMany( 'App\Product' )->withPivot( 'qty', 'total', 'price' );
    }

    public function suppliers(){
        return $this->belongsTo( 'App\Supplier', 'supplier_id' );
    }
}
