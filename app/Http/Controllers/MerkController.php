<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MerkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $merks = \App\Merk::paginate( 10 );

        $filterKeyword = $request->get( 'keyword' );
        $status = $request->get( 'status' );

        if( $filterKeyword ):
            if( $status ):
                $merks = \App\Merk::where( 'nama_merk', 'LIKE', "%$filterKeyword%" )
                    ->where( 'status', $status )
                    ->paginate( 10 );
            else:
                $merks = \App\Merk::where( 'nama_merk', 'LIKE', "%$filterKeyword%" )->paginate( 10 );
            endif;
        elseif( $status ):
            $merks = \App\Merk::where( 'status', $status )->paginate( 10 );
        endif;

        return view( 'merks.index', [ 'merks' => $merks ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'merks.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_merk = new \App\Merk;
        $new_merk->nama_merk = $request->get( 'nama_merk' );
        $new_merk->status = $request->get( 'status' );
        $new_merk->created_by = \Auth::user()->id;

        $new_merk->save();

        return redirect()->route( 'merks.create' )->with( 'status', 'Merk berhasil disimpan' );
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
        $merk = \App\Merk::findOrFail( $id );

        return view( 'merks.edit', ['merk' => $merk] );
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
        $merk = \App\Merk::findOrFail( $id );
        $merk->nama_merk = $request->get( 'nama_merk' );
        $merk->status = $request->get( 'status' );
        $merk->updated_by = \Auth::user()->id;

        $merk->save();

        return redirect()->route( 'merks.edit', [$id] )->with( 'status', 'Merk berhasil diubah' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $merk = \App\Merk::findOrFail( $id );
        $merk->delete();

        return redirect()->route( 'merks.index' )->with( 'status', 'Merk berhasil dihapus' );
    }
}
