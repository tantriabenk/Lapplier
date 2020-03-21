<div class="row">
    <div class="col-md-11">
        <h2>Master Merk</h2>
    </div>
    @if( request()->segment(2) == "create" || request()->segment(3) == "edit"  )
        <div class="col-md-1">
            <a href="{{ route( 'merks.index' ) }}" class="btn btn-danger btn-block">Kembali</a>
        </div>
    @endif
</div>

@if( request()->segment(2) != "create" && request()->segment(3) != "edit" )
    <!-- Filter -->
    <form action="{{ route( 'merks.index' ) }}">
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
                        <a class="nav-link @if( request()->segment(1) == 'merks' && request()->segment(2) == '' ) active @endif" href="{{ route( 'merks.index' ) }}">Published</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link @if( request()->segment(2) == 'trash' ) active @endif" href="{{ route( 'merks.trash' ) }}">Trash</a>
                    </li>
                </ul>
            </div>
        </div>
    </form>
@endif