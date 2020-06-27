@section('script')
<script type="text/javascript">
    jQuery.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('[name=_token]').val()
        }
    });

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


    // Change price buy on transactions
    function change_price(){
        $('.product_price_buy').on("keyup", function(){
            const parent_tr = $(this).parents('tr');
            const qty = jQuery(parent_tr).find('.qty_detil').val();
            const price = $(this).val();
            const sub_total = (qty*price);
            jQuery(parent_tr).find('.sub_total').text(addCommas(sub_total));
            jQuery(parent_tr).find('.sub_total_input').val(sub_total);
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

    // Add Form Detail Order to Table Detil order
    function add_to_order(){
        jQuery('.btn-add-order').on("click", function(e){
            $('#response').hide().find(".box").html("");
            $('.form-control').removeClass('is-invalid');
            $('.detail-transaksi .form-control').removeClass("is-invalid");

            const token = $('[name=_token]').val();
            const description_order = jQuery("[name=description_order]").val();
            const amount_order = jQuery("[name=amount_order]").val();
            const urlPost = jQuery("[name=url_add_order]").val();
            const total = $("[name=total_trans]").val();
            
            jQuery.ajax({
                url: urlPost,
                method: 'post',
                data: {
                    description_order: description_order,
                    amount_order: amount_order,
                },
                beforeSend: function () {
                    $('.loader').fadeIn("300");
                },
                success: function(data){
                    e.stopPropagation();
                    const res = JSON.parse(data);
                    const amount = res.amount;
                    $('.table-transactions > tbody tr.first_row').remove();

                    $('.loader').fadeOut(300, function(){
                        $('.table-transactions > tbody').append(res.html).ready(function () {
                            const total_trans = parseInt(total)+parseInt(amount);
                            $("[name=total_trans]").val(total_trans);

                            // Reset Form order
                            $("[name=description_order]").val("");
                            $("[name=amount_order]").val("0");
                            $('.total_transaction').text(addCommas(total_trans));
                        });

                        delete_row_order();
                        change_price();
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

    // Delete Row Detail order
    function delete_row_order(){
        jQuery('.delete_row_order').unbind("click").click(function(){
            const row = $(this).parents('tr');
            const current_total = $("[name=total_trans]").val();
            const amount_order = $(row).find(".amount_order").val();
            const total_trans = current_total - amount_order;

            $('.total_transaction').text(addCommas(total_trans));
            $("[name=total_trans]").val(total_trans);
            $(row).remove(); 
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
                        $(".officer").val("");
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

    jQuery(document).ready(function(){
        form_transactions();
        add_to_order();
    });
</script>
@endsection