<tr>
    <td>
        {{ $products->product_name }}
        <input type="hidden" name="product[]" value="{{ $products->id }}">
    </td>
    <td>
        @currency( $products->price_sell )
        <input type="hidden" name="price_sell" class="product_price_sell" value="{{ $products->price_sell }}">
    </td>
    <td>{{ ProductHelp::get_product_stock_recent( $products->id ) }}</td>
    <td>
        <input type="text" name="qty[]" class="qty_detil only_number" value="{{ $qty }}" style="width: 80px;" min="1">
    </td>
    <td>
        <input type="text" name="discount[]" class="discount only_number" value="{{ $discount }}" style="width: 130px;">
    </td>
    <td>
        Rp <label class="sub_total">{{ number_format($sub_total, 0 ) }}</label>
        <input type="hidden" name="sub_total[]" value="{{ $sub_total }}" class="sub_total_input">
    </td>
    <td>
        <button type="button" class="btn btn-danger delete_row_order">Hapus</button>
    </td>
</tr>