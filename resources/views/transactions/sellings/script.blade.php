@section('script')
<script type="text/javascript">

    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name=_token]').val()
        }
    });
    
    //  Change Product on transactions
    function change_product(){
        $('.select-product').on("change", function(){
            const productUrl = $('[name=url_get_product]').val();
            const product_id = $(this).val();
            const parent_tr = $(this).parents('tr');

            if(product_id != ""){
                jQuery.ajax({
                    method: "post",
                    url: productUrl,
                    data: {
                        product_id: product_id,
                    },
                    success: function (result) {
                        jQuery(parent_tr).find('.qty').val(1);
                        var qty = jQuery(parent_tr).find('.qty').val();
                        var discount = jQuery(parent_tr).find('.discount').val();
                        var res = JSON.parse(result);
                        var sub_total = ((qty*res.price_sell) - discount);
                        jQuery(parent_tr).find('.sub_total_input').val(sub_total);
                        jQuery(parent_tr).find('.product_price_sell').val(res.price_sell);
                        jQuery(parent_tr).find('.product_price').text(addCommas(res.price_sell));
                        jQuery(parent_tr).find('.sub_total').text(addCommas(sub_total));
                        get_grand_total();
                    }
                });
            }
        });
    }

    //  Change Qty on transactions
    function change_qty(){
        $('.qty').on("keyup", function(){
            const parent_tr = $(this).parents('tr');
            var product_sell = jQuery(parent_tr).find('.product_price_sell').val();
            var qty = $(this).val();
            var discount = $(parent_tr).find('.discount').val();
            var sub_total = (qty*product_sell)-discount;
            jQuery(parent_tr).find('.sub_total').text(addCommas(sub_total));
            jQuery(parent_tr).find('.sub_total_input').val(sub_total);
            get_grand_total();
        });
    }

    //  Change discount on transactions
    function change_discount(){
        $('.discount').on("keyup", function(){
            const parent_tr = $(this).parents('tr');
            var product_sell = jQuery(parent_tr).find('.product_price_sell').val();
            var discount = $(this).val();
            var qty = $(parent_tr).find('.qty').val();
            var sub_total = (qty*product_sell)-discount;
            jQuery(parent_tr).find('.sub_total').text(addCommas(sub_total));
            jQuery(parent_tr).find('.sub_total_input').val(sub_total);
            get_grand_total();
        });
    }

    // Add Commas to number
    function addCommas(nStr){
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }

    // Delete Row Transactions
    function delete_row(){
        // Delete Row
        jQuery('.btn-delete-row').on("click", function(){
            const row = $(this).parents('tr');
            $(row).remove();
            get_grand_total();
        });
    }

    // Get Grand Total
    function get_grand_total(){
        var values = $("input[name='sub_total[]']").map(function(){return $(this).val();}).get();
        var grand_total = 0;
        for(var i=0; i<values.length; i++){
            var val = parseInt(values[i]);
            grand_total+=val;
        }

        jQuery('.total_transaction').text(addCommas(grand_total));
    }

    // Add Row
    function add_row(){
        jQuery('.btn-add-row').on("click", function(){
            const thaUrl = $('[name=url_add_row]').val();
            const parent_table = $('.table-transactions');
            const row_number = $('[name=row_number]').val();

            jQuery.ajax({
                method: "post",
                url: thaUrl,
                data: {
                    row_number: row_number,
                },
                success: function (result) {
                    var res = JSON.parse(result);
                    $('.table-transactions > tbody').append(res.html).ready(function () {
                        $('[name=row_number]').val(res.row_number);
                        change_product();
                        change_qty();
                        change_discount();
                        delete_row();
                    });
                }
            });
        });
    }

    // Store Transactions
    function form_transactions(){
        jQuery('[name=transactions]').submit(function(e){
            
            e.preventDefault();
            
            $(this).find('.form-control').removeClass('is-invalid');
            $('#response').find("p").remove();
            const token = $('[name="_token"]').val();
            const thaUrl = $('[name=url_store_transaksi]').val();
            const url_index = $('[name=url_index]').val();
            var form_data = $(this).serialize();

            jQuery.ajax({
                url: thaUrl,
                method: 'post',
                data: form_data,
                beforeSend: function () {

                },
                success: function(data){
                    console.log(data);
                    return false;
                },
                error: function(e){
                    if( e.status === 422 ) {
                        var errors = $.parseJSON(e.responseText);
                        $.each(errors, function (key, value) {
                            // console.log(key+ " " +value);
                            $('#response').addClass("alert-danger");

                            if($.isPlainObject(value)) {
                                $.each(value, function (key, value) {
                                    $('[name='+key+']').addClass('is-invalid');
                                    $('#response').show().find(".box").append("<p>"+value+"</p>");
                                });
                                scroll_to_response();
                            }
                        });
                    }
                }
            });
        });
    }

    function scroll_to_response(){
        jQuery('html, body').animate({
            scrollTop: jQuery('#response').offset().top
        }, 700);
    }

    jQuery(document).ready(function(){
        change_product();
        change_qty();
        change_discount();
        delete_row();
        add_row();
        form_transactions();
    });
</script>
@endsection