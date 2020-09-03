@extends("layouts.global")
@section("title") Laporan Pembelian @endsection
@section("content")

@if( session( 'status' ) )
<div class="alert alert-success">
    {{ session( 'status' ) }}
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">Laporan Pembelian</div>
            <div class="card-body">
                {!! Form::open( ['url' => route( 'reports.purchases.export' ), 'method' => 'post', 'class'  => 'form-basic', 'files' => 'true', 'name' => 'reports'] ) !!}
                    <div class="row mb-1">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label( 'supplier_id', 'Pilih Pemasok' ) !!}  
                                {!! Form::select( 'supplier_id', [null => 'Semua Pemasok' ]+App\Supplier::pluck( 'name','id' )->all(), null, [ 'class' => 'selectize']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row mb-1">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label( 'peiode', 'Pilih Periode' ) !!}  
                                {!! Form::text( 'peiode', null, [ 'class' => 'form-control field-required select_dates', 'autocomplete' => 'off', 'placeholder' => 'Pilih Bulan & Tahun', 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <button type="submit" class="btn btn-success btn-block"><i class="fas fa-eye"></i> Lihat Laporan</button>
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
