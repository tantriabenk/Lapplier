@extends("layouts.global")

@section("title") Transaksi Penjualan @endsection

@section("content")

<div class="row">
    <div class="col-md-12">

        @if( session( 'status' ) )
            <div class="alert alert-success">
                {{ session( 'status' ) }}
            </div>
        @endif
        
        <div class="bg-white shadow-sm p-3">
            <h1 class="m-b-20">Transaksi Penjualan</h1>

            <form enctype="multipart/form-data" method="POST">
                @csrf

                <div class="row m-b-20">
                    <div class="col-md-2">
                        <label for="no_nota">Nomor Nota</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text" name="nota_no" value="" placeholder="Masukkan nomor nota" class="form-control">
                    </div>
                </div>

                <div class="row m-b-20">
                    <div class="col-md-2">
                        <label for="no_nota">Tanggal</label>
                    </div>
                    <div class="col-md-4">
                        <input type="date" name="date" value="" class="form-control">
                    </div>
                </div>

                <div class="row m-b-20">
                    <div class="col-md-2">
                        <label for="no_nota">Pelanggan</label>
                    </div>
                    <div class="col-md-4">
                        <select name="customer" id="customer" class="form-control">
                            <option value="">Pilih Pelanggan</option>
                            @foreach( $customers as $customer )
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row m-b-20">
                    <div class="col-md-12">
                        <table class="table table-bordered table-transactions">
                            <thead>
                                <tr>
                                    <th width="25%">Produk</th>
                                    <th width="15%">Harga Produk</th>
                                    <th width="10%">Jumlah</th>
                                    <th>Potongan Harga</th>
                                    <th width="15%">Sub Total</th>
                                    <th>Tindakan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('transactions.sellings.row_transaction')
                            </tbody>
                        </table>
                    </div>
                    <div class="col-md-2 offset-md-10">
                        <input type="hidden" name="url_add_row" value="{{ route( 'sellings.add_row' ) }}">
                        <input type="hidden" name="url_get_product" value="{{ route( 'product.get_detail' ) }}">
                        <input type="hidden" name="row_number" value="{{ $row_number }}" />
                        <button class="btn btn-success btn-block btn-add-row" type="button">Tambah Baris</button>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <input class="btn btn-primary btn-block" type="button" value="Simpan Transaksi" />
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('script')
<script type="text/javascript">

    //  Change Product on transactions
    function change_product(){
        $('.select-product').on("change", function(){
            const productUrl = $('[name=url_get_product]').val();
            const token = $('[name=_token]').val();
            const product_id = $(this).val();
            const parent_tr = $(this).parents('tr');

            if(product_id != ""){
                $.ajax({
                    type: "post",
                    url: productUrl,
                    data: {
                        _token: token,
                        product_id: product_id,
                    },
                    success: function (result) {
                        jQuery(parent_tr).find('.qty').val(1);
                        var qty = jQuery(parent_tr).find('.qty').val();
                        var discount = jQuery(parent_tr).find('.discount').val();
                        var res = JSON.parse(result);
                        var sub_total = ((qty*res.price_sell) - discount);
                        jQuery(parent_tr).find('.product_price').text(res.price_sell);
                        jQuery(parent_tr).find('.sub_total').text(sub_total);
                    }
                });
            }
        });
    }

    //  Change Qty on transactions
    function change_qty(){
        $('.qty').on("keyup", function(){
            const parent_tr = $(this).parents('tr');
            var product_sell = parseInt(jQuery(parent_tr).find('.product_price').text());
            var qty = $(this).val();
            var discount = $(parent_tr).find('.discount').val();
            var sub_total = (qty*product_sell)-discount;
            jQuery(parent_tr).find('.sub_total').text(sub_total);
        });
    }

    //  Change discount on transactions
    function change_discount(){
        $('.discount').on("keyup", function(){
            const parent_tr = $(this).parents('tr');
            var product_sell = parseInt(jQuery(parent_tr).find('.product_price').text());
            var discount = $(this).val();
            var qty = $(parent_tr).find('.qty').val();
            var sub_total = (qty*product_sell)-discount;
            jQuery(parent_tr).find('.sub_total').text(sub_total);
        });
    }

    jQuery(document).ready(function(){
        change_product();
        change_qty();
        change_discount();

        // Add Row
        jQuery('.btn-add-row').on("click", function(){
            const thaUrl = $('[name=url_add_row]').val();
            const parent_table = $('.table-transactions');
            const token = $('[name=_token]').val();
            const row_number = $('[name=row_number]').val();

            $.ajax({
                type: "post",
                url: thaUrl,
                data: {
                    _token: token,
                    row_number: row_number,
                },
                success: function (result) {
                    var res = JSON.parse(result);
                    $('.table-transactions > tbody').append(res.html).ready(function () {
                        $('[name=row_number]').val(res.row_number);
                        change_product();
                        change_qty();
                    });
                }
            });
        });

        // Delete Row
        jQuery('.btn-delete-row').on("click", function(){
            const row = $(this).parents('tr');
            $(row).remove();
        });

    });
</script>
@endsection