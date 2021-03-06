@extends("layouts.global")
@section("title") Laporan Laba Rugi @endsection
@section("content")

@if( session( 'status' ) )
<div class="alert alert-success">
    {{ session( 'status' ) }}
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="card card-primary">
            <div class="card-header">Laporan Laba Rugi</div>
            <div class="card-body">
                {!! Form::open( ['url' => route( 'reports.income.export' ), 'method' => 'post', 'class'  => 'form-basic', 'files' => 'true', 'name' => 'reports'] ) !!}
                    <div class="row mb-1">
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! Form::label( 'peiode', 'Pilih Periode' ) !!}  
                                {!! Form::text( 'peiode', null, [ 'class' => 'form-control field-required select_dates', 'autocomplete' => 'off', 'placeholder' => 'Pilih Bulan & Tahun', 'required']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::submit('Lihat Laporan', [ 'class' => 'btn btn-success' ]) !!}
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
