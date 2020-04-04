@extends( 'layouts.global' )
@section( 'title' ) Trashed Merks @endsection
@section( 'content' )

@include( 'master.merks.filter' )

<br/>

<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th width="60px"><b>No</b></th>
                    <th><b>Nama Merk</b></th>
                    <th><b>Slug</b></th>
                    <th><b>Tindakan</b></th>
                </tr>
            </thead>
            <tbody>
                @foreach( $merks as $index => $merk )
                <tr>
                    <td>{{ $index+1 }}</td>
                    <td>{{ $merk->merk_name }}</td>
                    <td>{{ $merk->slug }}</td>
                    <td>
                        <a href="{{ route( 'merks.restore', [$merk->id] ) }}" class="btn btn-success">Restore</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colSpan="10">
                        {{ $merks->appends( Request::all() )->links() }}
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection
