<tr>
    <td>
        {{ $products->product_name }}
        <input type="hidden" name="product[]" value="{{ $products->id }}">
    </td>
    <td>
        Rp {{ number_format($products->price_buy, 0) }}
        <input type="hidden" name="price_buy" class="product_price_buy" value="{{ $products->price_buy }}">
    </td>>
    <td>
        <input type="text" name="qty[]" class="qty_detil only_number" value="{{ $qty }}" style="width: 80px;" min="1">
    </td>
    <td>
        Rp <label class="sub_total">{{ number_format($sub_total,0) }}</label>
        <input type="hidden" name="sub_total[]" value="{{ $sub_total }}" class="sub_total_input">
    </td>
    <td>
        <button type="button" class="btn btn-danger delete_row_order">Hapus</button>
    </td>
</tr>