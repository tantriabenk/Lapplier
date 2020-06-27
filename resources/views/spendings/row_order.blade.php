<tr>
    <td>
        {{ $description_order }}
        <input type="hidden" name="description[]" value="{{ $description_order }}">
    </td>
    <td>
        @currency( $amount_order )
        <input type="hidden" name="amount[]" class="amount_order" value="{{ $amount_order }}">
    </td>
    <td>
        <button type="button" class="btn btn-danger delete_row_order">Hapus</button>
    </td>
</tr>