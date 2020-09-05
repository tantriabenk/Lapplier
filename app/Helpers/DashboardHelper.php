<?php

namespace App\Helpers;
use DB;

class DashboardHelper
{
    public static function get_count_data( $table )
    {
        $data = DB::table( $table )
            ->whereNull( 'deleted_at' )
            ->count();
            
        return $data;
    }
}