<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SellingRequest;
use ProductHelp;

class SellingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sellings = \App\Selling::with('customers')->paginate(10);

        return view( 'transactions.sellings.index', [ 'sellings' => $sellings ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = \App\Customer::all()->where('deleted_at', '');
        $products = \App\Product::all()->where('deleted_at', '');
        $row_number = 0;
        
        return view( 
            'transactions.sellings.create', 
            [ 
                'customers' => $customers,
                'products' => $products,
                'row_number' => $row_number
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SellingRequest $request)
    {
        $selling = new \App\Selling;
        $selling->nota_number = $request->get( 'nota_no' );
        $selling->date = date( "Y-m-d" );
        $selling->total_selling = $request->get( 'total_trans' );
        $selling->customer_id = $request->get( 'customer' );
        
        if( $selling->save() ):

            // Selling Detail Request
            $product = $request->get( 'product' );
            $qty = $request->get( 'qty' );
            $discount = $request->get( 'discount' );

            if( !empty( $product ) ):

                foreach( $product as $key => $value ):

                    $product_id = $product[$key];
                    $price_sell = ProductHelp::get_product_data( $product_id, 'price_sell' );
                    $sub_total = $qty[ $key ] * $price_sell;

                    $selling_detail = new \App\SellingDetail;
                    $selling_detail->selling_id = $selling->id;
                    $selling_detail->product_id = $product_id;
                    $selling_detail->price_sell = $price_sell;
                    $selling_detail->qty = $qty[ $key ];
                    $selling_detail->total = $sub_total;
                    $selling_detail->discount = $discount[ $key ];

                    $selling_detail->save();

                endforeach;

            endif;

        endif;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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

    public function add_row(Request $request)
    {
        $products = \App\Product::all()->where( 'deleted_at', '' );
        $row_number = $request->row_number;
        $from = $request->from;

        $datas['products'] = $products;
        $datas['row_number'] = $row_number+1;

        $returnHTML = view( 'transactions.sellings.row_transaction', $datas )->render();

        $result['html'] = $returnHTML;
        $result['row_number'] = $row_number+1;

        return json_encode($result);
    }
}
