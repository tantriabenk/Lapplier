@extends("layouts.global")

@section("title") Laporan Laba Rugi @endsection

@section("content")

    <div class="row m-b-40">
        <div class="col-md-9">
            <h3 class="m-b-20">Laporan Laba Rugi</h3>
            <h6>Periode {{ $start }} - {{ $end }} </h6>
        </div>
        <div class="col-md-3 text-right">
            {!! Form::open( ['url' => route( 'reports.sellings.export_to_pdf' ), 'method' => 'post', 'target' => '_blank', 'class'  => 'form-basic', 'files' => 'true', 'name' => 'reports'] ) !!}
                {!! Form::hidden( 'peiode', $periode ) !!}
                {!! Form::submit('Export Ke PDF', [ 'class' => 'btn btn-success' ]) !!}
            {!! Form::close() !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-3">
            <h5>Total Penjualan</h5>
        </div>
        <div class="col-md-3">
            <h5>@currency( $total_selling )</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <h5>Total Pembelian</h5>
        </div>
        <div class="col-md-3">
            <h5>@currency( $total_purchase )</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <h5>{{ $text_laba_rugi_kotor }}</h5>
        </div>
        <div class="col-md-3">
            <h5>@currency( $laba_rugi_kotor )</h5>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <h5>Biaya - Biaya Pengeluaran</h5>
        </div>
    </div>

@endsection