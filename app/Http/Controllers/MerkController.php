<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MerkRequest;

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
                $merks = \App\Merk::where( 'merk_name', 'LIKE', "%$filterKeyword%" )
                    ->where( 'status', $status )
                    ->paginate( 10 );
            else:
                $merks = \App\Merk::where( 'merk_name', 'LIKE', "%$filterKeyword%" )->paginate( 10 );
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
    public function store(MerkRequest $request)
    {
        $nama_merk = $request->get( 'merk_name' );

        $new_merk = new \App\Merk;
        $new_merk->merk_name = $nama_merk;
        $new_merk->slug = \Str::slug($nama_merk, '-');
        $new_merk->created_by = \Auth::user()->id;

        $new_merk->save();

        return redirect()->route( 'merks.index' )->with( 'status', 'Merk berhasil disimpan' );
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
    public function update(MerkRequest $request, $id)
    {
        $nama_merk = $request->get( 'merk_name' );
        $merk = \App\Merk::findOrFail( $id );
        $merk->merk_name = $nama_merk;
        $merk->slug = \Str::slug($nama_merk, '-');
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

        return redirect()->route( 'merks.index' )->with( 'status', 'Merk berhasil di pindahkan ke tong sampah' );
    }

    public function trash(){
        $deleted_merk = \App\Merk::onlyTrashed()->paginate( 10 );

        return view( 'merks.trash', ['merks' => $deleted_merk] );
    }

    public function restore($id){
        $merk = \App\Merk::withTrashed()->findOrFail($id);

        if( $merk->trashed() ):
            $merk->restore();
        else:
            return redirect()->route( 'merks.index' )->with( 'status', 'Merk tidak ada di tong sampah' );
        endif;

        return redirect()->route( 'merks.index' )->with( 'status', 'Merk berhasil di restore' );
    }
}
