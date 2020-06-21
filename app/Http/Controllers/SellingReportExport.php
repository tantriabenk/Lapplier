<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class SellingReportExport implements FromView, ShouldAutoSize
{
    public function __construct( $request, $start, $end )
    {
        $customer_id = $request->input( 'customer_id' );
        
        $this->customer_id = $customer_id;
        $this->start = $start;
        $this->end = $end;
    }

    public function view()
    {
        return $this->report_export();
    }

    public function report_export()
    {
        $customer_id = $this->customer_id;
        $start = $this->start;
        $end = $this->end;

        $sellings = \App\Selling::with( 'products' )->with( 'customers' )->get();

        $datas[ 'sellings' ] = $sellings;

        var_dump( $datas );
        // return view( 'reports.sellings.export', compact( 'sellings' ) );
    }
}
