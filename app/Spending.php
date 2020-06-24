<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spending extends Model
{
    public function spending_details(){
        return $this->hasMany( 'App\SpendingDetail' );
    }
}
