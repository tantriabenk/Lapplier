<tr class="row-{{ $row_number }}">
    <td>
        <select name="product[{{ $row_number }}]" id="product" class="form-control select-product">
            <option value="">Pilih Produk</option>
            @foreach( $products as $product )
                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
            @endforeach
        </select>
    </td>
    <td>
        Rp <span class="product_price">0</span>
        <input type="hidden" name="product_price[]" class="product_price_sell" value="0">
    </td>
    <td>
        <input type="text" name="qty[{{ $row_number }}]" class="form-control qty">
    </td>
    <td>
        <input type="text" name="discount[{{ $row_number }}]" class="form-control discount">
    </td>
    <td>
        Rp <span class="sub_total">0</span>
        <input type="hidden" name="sub_total[]" class="sub_total_input" value="0">
    </td>
    <td>
        <button type="button" class="btn btn-danger btn-delete-row">Hapus</button>
    </td>
</tr>