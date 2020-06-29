<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class PurchaseReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'reports.purchases.index' );
    }

    public function export(Request $request)
    {
        $supplier_id = $request->input( 'supplier_id' );
        $periode = $request->input( 'peiode' );
        $explode_periode = explode( " ", $periode );
        $start = date( "Y-m-d", strtotime( $explode_periode[0] ) );
        $end = date( "Y-m-d", strtotime( $explode_periode[2] ) );

        $file_name = "Laporan_Penbelian_Periode_" . $start . " s/d " . $end;

        return $this->export_view( $supplier_id, $start, $end, $periode );
    }

    public function export_view( $supplier_id, $start, $end, $periode )
    {
        $purchases = \App\Purchase::with( 'products' )
            ->with( 'suppliers' )
            ->whereBetween( 'date', [ $start, $end ] );
        
        if( !empty( $supplier_id ) ):
            $purchases = $purchases->where( 'supplier_id', $supplier_id );
        endif;

        $purchases = $purchases->get();

        return view( 'reports.purchases.detail', [ 
            'purchases' => $purchases,
            'purchase_count' => $purchases->count(),
            'supplier_id' =>  $supplier_id,
            'periode' => $periode,
            'start' => date( "l jS \of F Y", strtotime( $start ) ),
            'end' => date( "l jS \of F Y", strtotime( $end ) ),
        ] );
    }

    public function export_to_pdf( Request $request )
    {
        $supplier_id = $request->input( 'supplier_id' );
        $periode = $request->input( 'peiode' );
        $explode_periode = explode( " ", $periode );
        $start = date( "Y-m-d", strtotime( $explode_periode[0] ) );
        $end = date( "Y-m-d", strtotime( $explode_periode[2] ) );

        $purchases = \App\Purchase::with( 'products' )
            ->with( 'suppliers' )
            ->whereBetween( 'date', [ $start, $end ] );
        
        if( !empty( $supplier_id ) ):
            $purchases = $purchases->where( 'supplier_id', $supplier_id );
        endif;

        $purchases = $purchases->get();

        $pdf = PDF::loadView('reports.purchases.pdf', [ 
            'purchases' => $purchases,
            'start' => date( "l jS \of F Y", strtotime( $start ) ),
            'end' => date( "l jS \of F Y", strtotime( $end ) )
        ] );
        
        return $pdf->download('laporan_pembelian.pdf');
    }
}
