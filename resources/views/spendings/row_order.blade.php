<tr>
    <td>
        {{ $products->product_name }}
        <input type="hidden" name="product[]" value="{{ $products->id }}">
    </td>
    <td>
        Rp <input type="text" name="price_buy[]" class="product_price_buy only_number" value="{{ $price_buy }}" style="width: 80px;" min="1">
    </td>>
    <td>
        <input type="text" name="qty[]" class="qty_detil only_number" value="{{ $qty }}" style="width: 80px;" min="1">
    </td>
    <td>
        Rp <label class="sub_total">@currency($sub_total)</label>
        <input type="hidden" name="sub_total[]" value="{{ $sub_total }}" class="sub_total_input">
    </td>
    <td>
        <button type="button" class="btn btn-danger delete_row_order">Hapus</button>
    </td>
</tr>