@if(Cart::count() > 0)
    <table class="table table-striped">
        <thead>
        <tr>
            <th>Product</th>
            <th>Qty</th>
            <th>Item Price</th>
            <th>Subtotal</th>
            <th>#</th>
        </tr>
        </thead>

        <tbody>
        @foreach(Cart::content() as $row)

            <tr>
                <td>
                    <p><strong>{{ $row->name }}</strong></p>
                </td>
                <td> <input type="number" class="qty" min="1" value="{{ $row->qty }}" style="max-width: 100px;" /> </td>
                <td>{{ $row->price }}</td>
                <td>{{ $row->subtotal }}</td>
                <td>
                    <a href="javascript:;" class="btn btn-success updateProductBtn" data-id="{{ $row->rowid }}" data-toggle="tooltip" data-placement="top" title="Update"><i class="fa fa-refresh"></i> </a>
                    <a href="javascript:;" class="btn btn-danger removeProductBtn" data-id="{{ $row->rowid }}" data-toggle="tooltip" data-placement="top" title="Remove"><i class="fa fa-trash-o"></i> </a>
                </td>
            </tr>

        @endforeach

        <tr>
            <td></td>
            <td></td>
            <td>Total</td>
            <td> {{ Cart::total() }} </td>
            <td></td>
        </tr>

        </tbody>
    </table>
@else
    <p>There have no product,</p>
@endif
