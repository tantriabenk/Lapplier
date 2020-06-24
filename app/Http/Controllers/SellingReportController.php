<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class SellingReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'reports.sellings.index' );
    }

    public function export(Request $request)
    {
        $customer_id = $request->input( 'customer_id' );
        $periode = $request->input( 'peiode' );
        $explode_periode = explode( " ", $periode );
        $start = date( "Y-m-d", strtotime( $explode_periode[0] ) );
        $end = date( "Y-m-d", strtotime( $explode_periode[2] ) );

        $file_name = "Laporan_Penjualan_Periode_" . $start . " s/d " . $end;

        return $this->export_view( $customer_id, $start, $end, $periode );
    }

    public function export_view( $customer_id, $start, $end, $periode )
    {
        $sellings = \App\Selling::with( 'products' )
            ->with( 'customers' )
            ->whereBetween( 'date', [ $start, $end ] );
        
        if( !empty( $customer_id ) ):
            $sellings = $sellings->where( 'customer_id', $customer_id );
        endif;

        $sellings = $sellings->get();

        return view( 'reports.sellings.detail', [ 
            'sellings' => $sellings,
            'selling_count' => $sellings->count(),
            'customer_id' =>  $customer_id,
            'periode' => $periode,
            'start' => date( "l jS \of F Y", strtotime( $start ) ),
            'end' => date( "l jS \of F Y", strtotime( $end ) ),
        ] );
    }

    public function export_to_pdf( Request $request )
    {
        $customer_id = $request->input( 'customer_id' );
        $periode = $request->input( 'peiode' );
        $explode_periode = explode( " ", $periode );
        $start = date( "Y-m-d", strtotime( $explode_periode[0] ) );
        $end = date( "Y-m-d", strtotime( $explode_periode[2] ) );

        $sellings = \App\Selling::with( 'products' )
            ->with( 'customers' )
            ->whereBetween( 'date', [ $start, $end ] );
        
        if( !empty( $customer_id ) ):
            $sellings = $sellings->where( 'customer_id', $customer_id );
        endif;

        $sellings = $sellings->get();

        $pdf = PDF::loadView('reports.sellings.pdf', [ 
            'sellings' => $sellings,
            'start' => date( "l jS \of F Y", strtotime( $start ) ),
            'end' => date( "l jS \of F Y", strtotime( $end ) )
        ] );
        
        return $pdf->download('laporan_penjualan.pdf');
    }
}
