<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( Request $request )
    {
        $users = \App\User::all();
        
        return view( 'master.users.index', [ 'users' => $users ] );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view( 'master.users.create' );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_user = new \App\User;
        $new_user->name = $request->get( 'name' );
        $new_user->username = $request->get( 'username' );
        $new_user->roles = json_encode( $request->get( 'roles' ) );
        $new_user->name = $request->get( 'name' );
        $new_user->address = $request->get( 'address' );
        $new_user->phone = $request->get( 'phone' );
        $new_user->email = $request->get( 'email' );
        $new_user->status = $request->get( 'status' );
        $new_user->password = \Hash::make( $request->get( 'password' ) );

        if( $request->file( 'avatar' ) ):
            $file = $request->file( 'avatar' )->store( 'avatars', 'public' );
            $new_user->avatar = $file;
        endif;

        $new_user->save();

        return redirect()->route( 'users.create' )->with( 'status', 'Petugas berhasil disimpan' );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = \App\User::findOrFail($id);
        return view('master.users.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = \App\User::findOrFail( $id );

        return view( 'master.users.edit', ['user' => $user] );
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
        $user = \App\User::findOrFail( $id );
        $user->name = $request->get( 'name' );
        $user->roles = json_encode( $request->get( 'roles' ) );
        $user->address = $request->get( 'address' );
        $user->phone = $request->get( 'phone' );
        $user->status = $request->get( 'status' );

        if( $request->file( 'avatar' ) ):
            if( $user->avatar && file_exists( storage_path( 'app/public/' . $user->avatar ) ) ):
                \Storage::delete('public/'.$user->avatar);
            endif;
            $file = $request->file( 'avatar' )->store( 'avatars', 'public' );
            $user->avatar = $file;
        endif;

        $user->save();

        return redirect()->route( 'users.edit', [$id] )->with( 'status', 'Petugas berhasil diubah' );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = \App\User::findOrFail( $id );
        $user->delete();

        return redirect()->route( 'users.index' )->with( 'status', 'User berhasil dihapus' );
    }

    public function trash()
    {
        $deleted_users = \App\User::onlyTrashed()->get();

        return view( 'master.users.trash', ['users' => $deleted_users] );
    }

    public function restore($id){
        $user = \App\User::withTrashed()->findOrFail($id);

        if( $user->trashed() ):
            $user->restore();
        else:
            return redirect()->route( 'users.index' )->with( 'status', 'Data petugas tidak ada di tong sampah' );
        endif;

        return redirect()->route( 'users.index' )->with( 'status', 'Data petugas berhasil di restore' );
    }
}
