<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th colspan="2">Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($invoices as $invoice)
            <tr>
                <td>
                    {{$invoice->id}}
                </td>
                <td>
                    {{$invoice->invoice_date}}
                </td>
                <td>
                    ${{$invoice->total}}
                </td>
                <td>
                    <a href="#">
                        Details
                    </a>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
