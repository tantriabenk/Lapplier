<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SpendingDetail extends Model
{
    public function spendings(){
        return $this->belongsTo( 'App\Spending', 'spending_id' );
    }
}