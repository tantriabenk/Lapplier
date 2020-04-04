<div class="row">
    <div class="col-md-11">
        <h2>Master Produk</h2>
    </div>
    @if( request()->segment(3) == "create" || request()->segment(4) == "edit"  )
        <div class="col-md-1">
            <a href="{{ route( 'products.index' ) }}" class="btn btn-danger btn-block">Kembali</a>
        </div>
    @endif
</div>

@if( request()->segment(3) != "create" && request()->segment(4) != "edit" )
    <form action="{{ route( 'products.index' ) }}">
        <div class="row">
            <div class="col-md-3">
                <input value="{{ Request::get( 'keyword' ) }}" name="keyword" class="form-control" type="text" placeholder="Masukan nama merk untuk filter..." />
            </div>
            <div class="col-md-1">
                <input type="submit" value="Filter" class="btn btn-info btn-block">
            </div>
            <div class="col-md-6">
                <ul class="nav nav-pills card-header-pills">
                    <li class="nav-item">
                        <a class="nav-link @if( request()->segment(2) == 'products' && request()->segment(3) == '' ) active @endif" href="{{ route( 'products.index' ) }}">Published</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if( request()->segment(3) == 'trash' ) active @endif" href="{{ route( 'products.trash' ) }}">Trash</a>
                    </li>
                </ul>
            </div>
        </div>
    </form>
@endif