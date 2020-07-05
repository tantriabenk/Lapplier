<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;

class IncomeStatementController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view( 'reports.income_statements.index' );
    }

    public function export(Request $request)
    {
        $periode = $request->input( 'peiode' );
        $explode_periode = explode( " ", $periode );
        $start = date( "Y-m-d", strtotime( $explode_periode[0] ) );
        $end = date( "Y-m-d", strtotime( $explode_periode[2] ) );

        return $this->export_view( $start, $end, $periode );
    }

    public function export_view( $start, $end, $periode )
    {
        $total_selling = \App\Selling::whereBetween( 'date', [ $start, $end ] )->sum( 'total_selling' );
        $total_purchase = \App\Purchase::whereBetween( 'date', [ $start, $end ] )->sum( 'total_purchase' );

        $laba_rugi_kotor = $total_selling - $total_purchase;
        $text_laba_rugi_kotor = ( $laba_rugi_kotor < 0 ) ? 'Rugi Kotor' : 'Laba Kotor';

        $spendings = \App\Spending::with( 'spending_details' )
            ->whereBetween( 'date', [ $start, $end ] )
            ->get();

        return view( 'reports.income_statements.detail', [ 
            'total_selling' => $total_selling,
            'total_purchase' => $total_purchase,
            'periode' => $periode,
            'start' => date( "l jS \of F Y", strtotime( $start ) ),
            'end' => date( "l jS \of F Y", strtotime( $end ) ),
            'laba_rugi_kotor' => $laba_rugi_kotor,
            'text_laba_rugi_kotor' => $text_laba_rugi_kotor,
            'spendings' => $spendings,
        ] );
    }

    public function export_to_pdf( Request $request )
    {
        $periode = $request->input( 'peiode' );
        $explode_periode = explode( " ", $periode );
        $start = date( "Y-m-d", strtotime( $explode_periode[0] ) );
        $end = date( "Y-m-d", strtotime( $explode_periode[2] ) );

        $total_selling = \App\Selling::whereBetween( 'date', [ $start, $end ] )->sum( 'total_selling' );
        $total_purchase = \App\Purchase::whereBetween( 'date', [ $start, $end ] )->sum( 'total_purchase' );

        $laba_rugi_kotor = $total_selling - $total_purchase;
        $text_laba_rugi_kotor = ( $laba_rugi_kotor < 0 ) ? 'Rugi Kotor' : 'Laba Kotor';

        $spendings = \App\Spending::with( 'spending_details' )
            ->whereBetween( 'date', [ $start, $end ] )
            ->get();

        $pdf = PDF::loadView('reports.income_statements.pdf', [ 
            'total_selling' => $total_selling,
            'total_purchase' => $total_purchase,
            'periode' => $periode,
            'start' => date( "l jS \of F Y", strtotime( $start ) ),
            'end' => date( "l jS \of F Y", strtotime( $end ) ),
            'laba_rugi_kotor' => $laba_rugi_kotor,
            'text_laba_rugi_kotor' => $text_laba_rugi_kotor,
            'spendings' => $spendings,
        ] );
        
        return $pdf->download('laporan_laba_rugi.pdf');
    }
}
