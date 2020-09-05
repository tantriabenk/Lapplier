<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PurchaseRequest;
use App\Http\Requests\PurchaseOrderRequest;
use ProductHelp;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $purchases = \App\Purchase::with('suppliers')->paginate(10);

        return view( 'transactions.purchases.index', [ 'purchases' => $purchases ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = \App\Supplier::all()->where('deleted_at', '');
        $products = \App\Product::all()->where('deleted_at', '');
        
        return view( 
            'transactions.purchases.create', 
            [ 
                'suppliers' => $suppliers,
                'products' => $products,
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PurchaseRequest $request)
    {
        $error = 0;

        $purchase = new \App\Purchase;
        $purchase->no_faktur = $request->get( 'no_faktur' );
        $purchase->date = $request->get( 'date' );
        $purchase->total_purchase = $request->get( 'total_trans' );
        $purchase->supplier_id = $request->get( 'supplier' );
        
        if( $purchase->save() ):
            $this->add_data_to_detail_transactions( $request, $purchase );
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
        $purchases = \App\Purchase::with( 'suppliers' )->findOrFail( $id );

        $product_purchase = \App\Purchase::with( 'products' )->findOrFail( $id );

        return view( 'transactions.purchases.detail', [ 
            'purchases' => $product_purchase,
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
        $purchases = \App\Purchase::findOrFail( $id );
        $suppliers = \App\Supplier::all()->where('deleted_at', '');
        $products = \App\Product::all()->where('deleted_at', '');
        $row_number = 0;
        
        return view( 
            'transactions.purchases.edit', 
            [ 
                'suppliers' => $suppliers,
                'products' => $products,
                'purchases' => $purchases,
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
    public function update(PurchaseRequest $request, $id)
    {
        $error = 0;

        $purchase = \App\Purchase::findOrFail( $id );
        $purchase->no_faktur = $request->get( 'no_faktur' );
        $purchase->date = $request->get( 'date' );
        $purchase->total_purchase = $request->get( 'total_trans' );
        $purchase->supplier_id = $request->get( 'supplier' );

        if( $purchase->save() ):
            $purchase->products()->detach();
            $this->add_data_to_detail_transactions( $request, $purchase );
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function add_order(PurchaseOrderRequest $request){
        $product_id = $request->product;
        $qty = $request->qty;
        $price_buy = $request->price_buy;

        $products = \App\Product::findOrFail( $product_id );

        $sub_total = ($price_buy*$qty);

        $datas['products'] = $products;
        $datas['qty'] = $qty;
        $datas['sub_total'] = $sub_total;
        $datas['price_buy'] = $price_buy;

        $returnHTML = view( 'transactions.purchases.row_order', $datas )->render();

        $result['html'] = $returnHTML;
        $result['sub_total'] = $sub_total;

        return json_encode($result);
    }

    private function add_data_to_detail_transactions( $request, $purchase ){
        // purchase Detail Request
        $product = $request->get( 'product' );
        $qty = $request->get( 'qty' );
        $price = $request->get( 'price_buy' );

        if( !empty( $product ) ):
            foreach( $product as $key => $value ):
                $product_id = $product[$key];
                $product_data = \App\Product::find( $product_id );
                $price_buy = $price[ $key ];
                $sub_total = $qty[ $key ] * $price_buy;

                $product_data->purchases()->attach( $purchase->id, array(
                    'price' => $price_buy,
                    'qty' => $qty[ $key ],
                    'total' => $sub_total,
                ) );
            endforeach;
        endif;
    }
}
