@extends("layouts.global")

@section("title") Laporan Laba Rugi @endsection

@section("content")

    <div class="row m-b-40">
        <div class="col-md-9">
            <h3 class="m-b-20">Laporan Laba Rugi</h3>
            <h6>Periode {{ $start }} - {{ $end }} </h6>
        </div>
        <div class="col-md-3 text-right">
            {!! Form::open( ['url' => route( 'reports.income.export_to_pdf' ), 'method' => 'post', 'target' => '_blank', 'class'  => 'form-basic', 'files' => 'true', 'name' => 'reports'] ) !!}
                {!! Form::hidden( 'peiode', $periode ) !!}
                {!! Form::submit('Export Ke PDF', [ 'class' => 'btn btn-success' ]) !!}
            {!! Form::close() !!}
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <table width="100%">
                <tr>
                    <td width="60%"><h5>Total Penjualan</h5></td>
                    <td><h5>@currency( $total_selling )</h5></td>
                </tr>
                <tr>
                    <td><h5>Total Pembelian</h5></td>
                    <td><h5>@currency( $total_purchase )</h5></td>
                </tr>
                <tr>
                    <td><h5>{{ $text_laba_rugi_kotor }}</h5></td>
                    <td><h5>@currency( $laba_rugi_kotor )</h5></td>
                </tr>
                <tr>
                    <td coslpan="2"><h5>Biaya - Biaya Pengeluaran</h5></td>
                    <td></td>
                </tr>
            </table>
        </div>
    </div>
    <div class="row m-b-20">
        <div class="col-md-5">
            <table width="100%" border="1" cellpadding="5">
                <tr style="font-weight: bold;">
                    <td width="20%">Tanggal</td>
                    <td>Deskripsi</td>
                    <td width="30%">Biaya</td>
                </tr>
                @php
                    $total_pengeluaran = 0;
                @endphp
                @foreach( $spendings as $spending )
                    @foreach( $spending->spending_details as $spending_detail )
                        <tr>
                            <td>{{ $spending->date }}</td>
                            <td>{{ $spending_detail->description }}</td>
                            <td>@currency( $spending_detail->amount )</td>
                        </tr>
                        @php
                            $total_pengeluaran += $spending_detail->amount;
                        @endphp
                    @endforeach
                @endforeach
                <tr style="font-weight: bold;">
                    <td colspan="2" class="text-right">Total Pengeluaran: </td>
                    <td>@currency( $total_pengeluaran )</td>
                </tr>
            </table>
        </div>
    </div>

    <!-- Laba Bersih -->
    @php
        $laba_bersih = $laba_rugi_kotor - $total_pengeluaran;
        $text_laba_bersih = ($laba_bersih < 0) ? 'Rugi Bersih' : 'Laba Bersih';
    @endphp
    <div class="row">
        <div class="col-md-6">
            <table width="100%">
                <tr>
                    <td width="60%"><h5>{{ $text_laba_bersih }}</h5></td>
                    <td><h5>@currency( $laba_bersih )</h5></td>
                </tr>
            </table>
        </div>
    </div>

@endsection