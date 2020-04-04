<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;

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
        $status = $request->get( 'status' );

        if( $filterKeyword ):
            if( $status ):
                $customers = \App\Customer::where( 'name', 'LIKE', "%$filterKeyword%" )
                    ->where( 'status', $status )
                    ->paginate( 10 );
            else:
                $customers = \App\Customer::where( 'name', 'LIKE', "%$filterKeyword%" )->paginate( 10 );
            endif;
        elseif( $status ):
            $customers = \App\Customer::where( 'status', $status )->paginate( 10 );
        endif;


        return view( 'master.customers.index', [ 'customers' => $customers ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'master.customers.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $name = $request->get( 'name' );
        $store_name = $request->get( 'store_name' );
        $phone_number = $request->get( 'phone_number' );
        $status = $request->get( 'status' );
        $address = $request->get( 'address' );

        $new_customer = new \App\Customer;
        $new_customer->name = $name;
        $new_customer->store_name = $store_name;
        $new_customer->phone_number = $phone_number;
        $new_customer->status = $status;
        $new_customer->address = $address;
        $new_customer->created_by = \Auth::user()->id;

        $new_customer->save();

        return redirect()->route( 'customers.index' )->with( 'status', 'Data pelanggan berhasil disimpan' );
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

        return view( 'master.customers.edit', ['customer' => $customer] );
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
        $customer->address = $request->get( 'address' );
        $customer->updated_by = \Auth::user()->id;

        $customer->save();

        return redirect()->route( 'customers.edit', [$id] )->with( 'status', 'Data pelanggan berhasil diubah' );
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

    public function trash(){
        $deleted_customers = \App\Customer::onlyTrashed()->paginate( 10 );

        return view( 'master.customers.trash', ['customers' => $deleted_customers] );
    }

    public function restore($id){
        $customer = \App\Customer::withTrashed()->findOrFail($id);

        if( $customer->trashed() ):
            $customer->restore();
        else:
            return redirect()->route( 'customers.index' )->with( 'status', 'Data pelanggan tidak ada di tong sampah' );
        endif;

        return redirect()->route( 'customers.index' )->with( 'status', 'Data pelanggan berhasil di restore' );
    }
}
