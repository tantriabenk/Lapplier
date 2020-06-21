@extends("layouts.global")
@section("title") Laporan Penjualan @endsection
@section("content")

@if( session( 'status' ) )
<div class="alert alert-success">
    {{ session( 'status' ) }}
</div>
@endif

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">Export Laporan Penjualan</div>
            <div class="card-body">
                {!! Form::open( ['url' => route( 'reports.sellings.export' ), 'method' => 'post', 'target' => '_blank', 'class'  => 'form-basic', 'files' => 'true', 'name' => 'reports'] ) !!}
                    @csrf

                    <div class="row m-b-20">
                        <div class="col-md-12">
                            {!! Form::label( 'customer_id', 'Pilih Pelanngan' ) !!}  
                            {!! Form::select( 'customer_id', [ '' => '']+App\Customer::pluck( 'store_name','id' )->all(), null, [ 'class' => 'selectize', 'placeholder' => 'Pilih Sales']) !!}
                        </div>
                    </div>
                    <div class="row m-b-20">
                        <div class="col-md-12">
                            {!! Form::label( 'peiode', 'Pilih Periode' ) !!}  
                            {!! Form::text( 'peiode', null, [ 'class' => 'form-control field-required select_dates', 'autocomplete' => 'off', 'placeholder' => 'Pilih Bulan & Tahun', 'required']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            {!! Form::submit('Export Laporan', [ 'class' => 'btn btn-success' ]) !!}
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>

@endsection
