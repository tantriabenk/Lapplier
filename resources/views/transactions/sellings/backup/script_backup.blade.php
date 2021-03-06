@section('script')
<script type="text/javascript">

    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name=_token]').val()
        }
    });
    
    //  Change Product on transactions
    function change_product(){
        $(".select-product").unbind('change')
        $('.select-product').on("change", function(){
            const productUrl = $('[name=url_get_product]').val();
            const product_id = $(this).val();
            const parent_tr = $(this).parents('tr');
            const qty = $(parent_tr).find('.qty').val();
            const discount = $(parent_tr).find('.discount').val();
            const row_number = $(parent_tr).find('.row_number').val();

            if(product_id != ""){
                jQuery.ajax({
                    method: "post",
                    url: productUrl,
                    data: {
                        product_id: product_id,
                        qty: qty,
                        row_number: row_number
                    },
                    success: function (result) {
                        var res = JSON.parse(result);
                        var sub_total = (res.qty*res.price_sell)-discount;
                        jQuery(parent_tr).find('.sub_total_input').val(sub_total);
                        jQuery(parent_tr).find('.product_price_sell').val(res.price_sell);
                        jQuery(parent_tr).find('.product_price').text(addCommas(res.price_sell));
                        jQuery(parent_tr).find('.stock').text(res.stock);
                        jQuery(parent_tr).find('.sub_total').text(addCommas(sub_total));
                        jQuery(parent_tr).find('.field-qty').html(res.field_qty);
                        get_grand_total();
                        change_qty();
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
        jQuery('[name=total_trans]').val(grand_total);
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
            $('#response').hide();
            $(this).find('.form-control').removeClass('is-invalid');
            $('#response').find("p").remove();

            const token = $('[name="_token"]').val();
            const thaUrl = $('[name=url_store_transaksi]').val();
            const url_index = $('[name=url_index]').val();
            const form_data = $(this).serialize();

            jQuery.ajax({
                url: thaUrl,
                method: 'post',
                data: form_data,
                beforeSend: function () {
                    $('.loader').fadeIn("300");
                },
                success: function(data){
                    $('.loader').fadeOut(300, function(){
                        const res = JSON.parse(data);
                        if(res.status == "error"){
                            $('#response').removeClass("alert-success").addClass("alert-danger").show().find(".box").html("<p>"+res.message+"</p>");
                        }else{
                            $('#response').find('.alert-heading').text(res.title);
                            $('#response').removeClass('alert-danger').addClass("alert-success").show().find(".box").html("<p>"+res.message+"</p>");
                        }

                        $(".transactions-data .form-control").val("");
                        $(".customer").prop('selectedIndex',0);
                        $('.table-transactions > tbody > tr').remove();
                        $('.total_transaction').text("0");
                        $("[name=total_trans]").val("0");
                    });
                    return false;
                },
                error: function(e){
                    $('.loader').fadeOut(300, function(){
                        if( e.status === 422 ) {
                            var errors = $.parseJSON(e.responseText);
                            // console.log(errors);
                            $.each(errors, function (key, value) {
                                // console.log(key+ " " +value);
                                $('#response').addClass("alert-danger").find('.alert-heading').text("Terjadi Kesalahan!");
                                if($.isPlainObject(value)) {
                                    $.each(value, function (key, value) {
                                        var new_key = key.replace('.', '-');
                                        $('.'+new_key).addClass('is-invalid');
                                        $('#response').show().find(".box").append("<p>"+value+"</p>");
                                    });
                                    scroll_to_response();
                                }
                            });
                        }
                    });
                    return false;
                }
            });
        });
    }

    function scroll_to_response(){
        jQuery('html, body').animate({
            scrollTop: jQuery('#response').offset().top
        }, 700);
    }

    function add_to_order(){
        jQuery('.btn-add-order').on("click", function(e){
            $('#response').hide().find(".box").html("");
            $('.form-control').removeClass('is-invalid');
            $('.detail-transaksi .form-control').removeClass("is-invalid");

            const token = $('[name=_token]').val();
            const product = jQuery("[name=select_product]").val();
            const qty = jQuery("[name=select_qty]").val();
            const discount = jQuery("[name=select_discount]").val();
            const urlPost = jQuery("[name=url_add_order]").val();
            const total = $("[name=total_trans]").val();
            
            jQuery.ajax({
                url: urlPost,
                method: 'post',
                data: {
                    _token: token,
                    product: product,
                    qty: qty,
                    discount: discount,
                },
                beforeSend: function () {
                    $('.loader').fadeIn("300");
                },
                success: function(data){
                    e.stopPropagation();
                    const res = JSON.parse(data);
                    const sub_total = res.sub_total;
                    $('.table-transactions > tbody tr.first_row').remove();


                    $('.loader').fadeOut(300, function(){
                        $('.table-transactions > tbody').append(res.html).ready(function () {
                            const total_trans = parseInt(total)+parseInt(sub_total);
                            $("[name=total_trans]").val(total_trans);

                            // Reset Form order
                            $("[name=select_product]").prop('selectedIndex',0);
                            $("[name=select_qty]").val("0");
                            $("[name=select_discount]").val("0");
                            $('.total_transaction').text(addCommas(total_trans));
                        });

                        delete_row_order();
                    });
                    
                    return false;
                },
                error: function(e){
                    $('.loader').fadeOut(300, function(){
                        if( e.status === 422 ) {
                            var errors = $.parseJSON(e.responseText);
                            // console.log(errors);
                            $.each(errors, function (key, value) {
                                // console.log(key+ " " +value);
                                $('#response').addClass("alert-danger").find('.alert-heading').text("Terjadi Kesalahan!");
                                if($.isPlainObject(value)) {
                                    $.each(value, function (key, value) {
                                        var new_key = key.replace('.', '-');
                                        $('.'+new_key).addClass('is-invalid');
                                        $('#response').show().find(".box").append("<p>"+value+"</p>");
                                    });
                                }
                            });
                        }
                    });
                    return false;
                }
            });
        });
    }


    function delete_row_order(){
        jQuery('.delete_row_order').unbind("click").click(function(){
            const row = $(this).parents('tr');
            const current_total = $("[name=total_trans]").val();
            const sub_total = $(row).find("[name=sub_total]").val();
            const total_trans = current_total - sub_total;

            $('.total_transaction').text(addCommas(total_trans));
            $("[name=total_trans]").val(total_trans);
            $(row).remove(); 
        });
    }

    jQuery(document).ready(function(){
        form_transactions();
        add_to_order();
        change_qty();
    });
</script>
@endsection