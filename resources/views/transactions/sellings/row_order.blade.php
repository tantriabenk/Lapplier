<tr>
    <td>
        {{ $products->product_name }}
        <input type="hidden" name="product[]" value="{{ $products->id }}">
    </td>
    <td>Rp {{ number_format($products->price_sell, 0) }}</td>
    <td>{{ $products->stock }}</td>
    <td>
        {{ $qty }}
        <input type="hidden" name="qty[]" value="{{ $qty }}">
    </td>
    <td>
        Rp {{ number_format($discount,0) }}
        <input type="hidden" name="discount[]" value="{{ $discount }}">
    </td>
    <td>
        Rp {{ number_format($sub_total,0) }}
        <input type="hidden" name="sub_total" value="{{ $sub_total }}">
    </td>
    <td><button type="button" class="btn btn-danger delete_row_order">Hapus</button></td>
</tr>