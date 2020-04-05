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
    </td>
    <td>
        <input type="text" name="qty[{{ $row_number }}]" class="form-control qty">
    </td>
    <td>
        <input type="text" name="discount[{{ $row_number }}]" class="form-control discount">
    </td>
    <td>
        Rp <span class="sub_total">0</span>
    </td>
    <td>
        <button class="btn btn-danger btn-delete-row">Hapus</button>
    </td>
</tr>
