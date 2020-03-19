<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $customers = \App\Customer::paginate( 10 );
        $filterKeyword = $request->get( 'keyword' );

        if( $filterKeyword ):
            $customers = \App\Merk::where( 'nama_merk', 'LIKE', "%$filterKeyword%" )->paginate( 10 );
        endif;

        return view( 'customers.index', [ 'customers' => $customers ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'customers.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $name = $request->get( 'name' );
        $store_name = $request->get( 'store_name' );
        $phone_number = $request->get( 'phone_number' );
        $status = $request->get( 'status' );

        $new_customer = new \App\Customer;
        $new_customer->name = $name;
        $new_customer->store_name = $store_name;
        $new_customer->phone_number = $phone_number;
        $new_customer->status = $status;
        $new_customer->created_by = \Auth::user()->id;

        $new_customer->save();

        return redirect()->route( 'customers.create' )->with( 'status', 'Pelanggan berhasil disimpan' );
    }

    /**
     * Display the specified resource.z
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
        $customer = \App\Customer::findOrFail( $id );

        return view( 'customers.edit', ['customer' => $customer] );
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
        $customer = \App\Customer::findOrFail( $id );
        $customer->name = $request->get( 'name' );
        $customer->store_name = $request->get( 'store_name' );
        $customer->phone_number = $request->get( 'phone_number' );
        $customer->status = $request->get( 'status' );
        $customer->updated_by = \Auth::user()->id;

        $customer->save();

        return redirect()->route( 'customers.edit', [$id] )->with( 'status', 'Pelanggan berhasil diubah' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = \App\Customer::findOrFail( $id );
        $customer->delete();

        return redirect()->route( 'customers.index' )->with( 'status', 'Data pelanggan berhasil di pindahkan ke tong sampah' );
    }
}
