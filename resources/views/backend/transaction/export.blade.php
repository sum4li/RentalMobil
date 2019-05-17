<table>
    <thead>
    <tr>
        <th>No</th>
        <th>Invoice</th>
        <th>Tanggal</th>
        <th>Waktu</th>
        <th>Pelanggan</th>
        <th>Total</th>
        <th>Status</th>
    </tr>
    </thead>
    <tbody>
    @foreach($transaction as $row)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $row->invoice_no }}</td>
            <td>{{ Carbon\Carbon::parse($row->tanggal)->format('Y-m-d') }}</td>
            <td>{{ Carbon\Carbon::parse($row->tanggal)->format('H:i:s') }}</td>
            <td>{{ title_case($row->customer->name) }}</td>
            <td>{{ $row->amount }}</td>
            <td>{{ $row->status }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
