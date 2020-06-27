<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SpendingRequest;
use App\Http\Requests\SpendingOrderRequest;

class SpendingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $spendings = \App\Spending::paginate(10);

        return view( 'spendings.index', [ 'spendings' => $spendings ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view( 'spendings.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SpendingRequest $request)
    {
        $error = 0;

        $spending = new \App\Spending;
        $spending->officer = $request->get( 'officer' );
        $spending->date = $request->get( 'date' );
        $spending->total_amount = $request->get( 'total_trans' );
        
        if( $spending->save() ):

            // purchase Detail Request
            $description = $request->get( 'description' );
            $amount = $request->get( 'amount' );

            if( !empty( $description ) ):
                foreach( $description as $key => $value ):
                    $des_val = $value;
                    $amount_val = $amount[ $key ];

                    $spending_detail = new \App\SpendingDetail;
                    $spending_detail->spending_id = $spending->id;
                    $spending_detail->description = $des_val;
                    $spending_detail->amount = $amount_val;
                    $spending_detail->save();
                endforeach;
            endif;
        
        else:
            $error++;
        endif;

        $result['status'] = "error";
        $result['message'] = "Terjadi kesalahan! Silahkan coba lagi nanti atau kontak administrator";

        if( $error == 0 ):
            $result['status'] = "success";
            $result['title'] = "Sukses!";
            $result['message'] = "Transaksi berhasil disimpan";
        endif;

        return json_encode($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $spendings = \App\Spending::with( 'spending_details' )->findOrFail( $id );

        return view( 'spendings.detail', [ 
            'spendings' => $spendings,
        ] );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function add_order(SpendingOrderRequest $request){
        $description_order = $request->description_order;
        $amount_order = $request->amount_order;

        $datas['description_order'] = $description_order;
        $datas['amount_order'] = $amount_order;

        $returnHTML = view( 'spendings.row_order', $datas )->render();

        $result['html'] = $returnHTML;
        $result['amount'] = $amount_order;

        return json_encode($result);
    }
}
