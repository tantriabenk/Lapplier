<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SupplierRequest;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = \App\Supplier::orderBy( 'id', 'DESC' )->get();
        
        return view( 'master.suppliers.index', [ 'suppliers' => $suppliers ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'master.suppliers.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SupplierRequest $request)
    {
        $name = $request->get( 'name' );
        $phone_number = $request->get( 'phone_number' );
        $status = $request->get( 'status' );
        $address = $request->get( 'address' );

        $new_supplier = new \App\Supplier;
        $new_supplier->name = $name;
        $new_supplier->phone_number = $phone_number;
        $new_supplier->status = $status;
        $new_supplier->address = $address;
        $new_supplier->created_by = \Auth::user()->id;

        $new_supplier->save();

        return redirect()->route( 'suppliers.index' )->with( 'status', 'Data supplier berhasil disimpan' );
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
        $supplier = \App\Supplier::findOrFail( $id );

        return view( 'master.suppliers.edit', ['supplier' => $supplier] );
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
        $supplier = \App\Supplier::findOrFail( $id );
        $supplier->name = $request->get( 'name' );
        $supplier->phone_number = $request->get( 'phone_number' );
        $supplier->status = $request->get( 'status' );
        $supplier->address = $request->get( 'address' );
        $supplier->updated_by = \Auth::user()->id;

        $supplier->save();

        return redirect()->route( 'suppliers.edit', [$id] )->with( 'status', 'Data supplier berhasil diubah' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $supplier = \App\Supplier::findOrFail( $id );
        $supplier->delete();

        return redirect()->route( 'suppliers.index' )->with( 'status', 'Data supplier berhasil di pindahkan ke tong sampah' );
    }

    public function trash(){
        $deleted_suppliers = \App\Supplier::onlyTrashed()->get();

        return view( 'master.suppliers.trash', ['suppliers' => $deleted_suppliers] );
    }

    public function restore($id){
        $supplier = \App\Supplier::withTrashed()->findOrFail($id);

        if( $supplier->trashed() ):
            $supplier->restore();
        else:
            return redirect()->route( 'suppliers.index' )->with( 'status', 'Data supplier tidak ada di tong sampah' );
        endif;

        return redirect()->route( 'suppliers.index' )->with( 'status', 'Data supplier berhasil di restore' );
    }
}
