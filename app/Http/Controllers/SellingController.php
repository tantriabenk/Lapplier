<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SellingRequest;
use App\Http\Requests\SellingOrderRequest;
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
        $error = 0;

        $selling = new \App\Selling;
        $selling->nota_number = $request->get( 'nota_no' );
        $selling->date = $request->get( 'date' );
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
                    $product_data = \App\Product::find( $product_id );
                    $price_sell = $product_data->price_sell;
                    $sub_total = $qty[ $key ] * $price_sell;

                    $product_data->sellings()->attach( $selling->id, array(
                        'price_sell' => $price_sell,
                        'qty' => $qty[ $key ],
                        'total' => $sub_total,
                        'discount' => $discount[ $key ]
                     ) );
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
        $sellings = \App\Selling::with( 'customers' )->findOrFail( $id );

        $product_selling = \App\Selling::with( 'products' )->findOrFail( $id );

        return view( 'transactions.sellings.detail', [ 
            'sellings' => $product_selling,
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
        $sellings = \App\Selling::findOrFail( $id );
        $customers = \App\Customer::all()->where('deleted_at', '');
        $products = \App\Product::all()->where('deleted_at', '');
        $row_number = 0;
        
        return view( 
            'transactions.sellings.create', 
            [ 
                'customers' => $customers,
                'products' => $products,
                'sellings' => $sellings,
                'row_number' => $row_number
            ]
        );
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

    public function add_order(SellingOrderRequest $request){
        $product_id = $request->product;
        $qty = $request->qty;
        $discount = $request->discount;

        $products = \App\Product::findOrFail( $product_id );

        $sub_total = ($products->price_sell*$qty) - $discount;

        $datas['products'] = $products;
        $datas['qty'] = $qty;
        $datas['discount'] = $discount;
        $datas['sub_total'] = $sub_total;

        $returnHTML = view( 'transactions.sellings.row_order', $datas )->render();

        $result['html'] = $returnHTML;
        $result['sub_total'] = $sub_total;

        return json_encode($result);
    }
}
