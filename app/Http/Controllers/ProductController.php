<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = \App\Product::paginate( 10 );

        $filterKeyword = $request->get( 'keyword' );
        $status = $request->get( 'status' );

        if( $filterKeyword ):
            if( $status ):
                $products = \App\Product::where( 'product_name', 'LIKE', "%$filterKeyword%" )
                    ->where( 'status', $status )
                    ->paginate( 10 );
            else:
                $products = \App\Product::where( 'product_name', 'LIKE', "%$filterKeyword%" )->paginate( 10 );
            endif;
        elseif( $status ):
            $products = \App\Product::where( 'status', $status )->paginate( 10 );
        endif;

        return view( 'master.products.index', [ 'products' => $products ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'master.products.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $new_product = new \App\Product;
        $new_product->product_name = $request->get( 'product_name' );
        $new_product->stock = $request->get( 'stock' );
        $new_product->status = $request->get( 'status' );
        $new_product->price_buy = $request->get( 'price_buy' );
        $new_product->price_sell = $request->get( 'price_sell' );
        $new_product->created_by = \Auth::user()->id;

        $new_product->save();

        return redirect()->route( 'products.index' )->with( 'status', 'Data produk berhasil disimpan' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = \App\Product::findOrFail( $id );

        return view( 'master.products.edit', ['product' => $product] );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $product = \App\Product::findOrFail( $id );
        $product->product_name = $request->get( 'product_name' );
        $product->stock = $request->get( 'stock' );
        $product->status = $request->get( 'status' );
        $product->price_buy = $request->get( 'price_buy' );
        $product->price_sell = $request->get( 'price_sell' );
        $product->updated_by = \Auth::user()->id;

        $product->save();

        return redirect()->route( 'products.edit', [$id] )->with( 'status', 'Data produk berhasil diubah' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = \App\Product::findOrFail( $id );
        $product->delete();

        return redirect()->route( 'products.index' )->with( 'status', 'Data produk berhasil dihapus' );
    }

    public function trash()
    {
        $deleted_products = \App\Product::onlyTrashed()->paginate( 10 );

        return view( 'master.products.trash', ['products' => $deleted_products] );
    }

    public function restore($id)
    {
        $product = \App\Product::withTrashed()->findOrFail( $id );

        if( $product->trashed() ):
            $product->restore();
        else:
            return redirect()->route( 'products.index' )->with( 'status', 'Data produk tidak ada pada tabel hapus sementara' );
        endif;

        return redirect()->route( 'products.index' )->with( 'status', 'Data produk berhasil di restore' );
    }

    public function get_detail(Request $request)
    {
        $product_id = $request->get( 'product_id' );
        $qty = ($request->get( 'qty' ) == 0) ? 1 : $request->get( 'qty' );
        $row_number = $request->get( 'row_number' );

        $products = \App\Product::all()->where( 'id', $product_id )->first();

        $result['price_sell'] = 0;
        $result['stock'] = 0;

        if( !empty( $products ) ):
            $result['price_sell'] = $products->price_sell;
            $result['stock'] = $products->stock;
        endif;

        $result['qty'] = $qty;

        // $result['field_qty'] = '<input type="text" name="qty['. $row_number .']['. $product_id .']" class="form-control qty only_number" value="'. $qty .'">';
        $result['field_qty'] = '<input type="text" name="qty['. $row_number .']" class="form-control qty only_number" value="'. $qty .'">';

        return json_encode($result);
    }
}
