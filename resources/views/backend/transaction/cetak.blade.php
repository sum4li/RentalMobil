@extends('backend.print')
@section('content')
<div class="header">
    <table class="table table-borderless">
        <tbody>
            <tr>
                <td>
                    {{App\Setting::where('slug','nama-toko')->get()->first()->description}}
                    <br>
                    {{App\Setting::where('slug','alamat')->get()->first()->description}}
                    <br>
                    {{App\Setting::where('slug','nomer-telepon')->get()->first()->description}} -
                    {{App\Setting::where('slug','email')->get()->first()->description}}
                    <br>

                </td>
                <td style="text-align:left;">
                    Invoice &nbsp;: {{$data->invoice_no}}
                    <br>
                    Tanggal : {{$data->date}}
                    <br>
                    Kepada &nbsp;: {{title_case($data->customer->name)}}

                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="main">
    <table class="table">
        <thead>
            <tr>
                <th>No</th>
                <th>Transaki</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach (App\TransactionDetail::where('transaction_id',$data->id)->get() as $row)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$row->product->name}}</td>
                <td>{{$row->qty}}</td>
                <td>{{number_format($row->price,0,',','.')}}</td>
                <td>{{number_format($row->total,0,',','.')}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4">
                    <strong>
                        Grand Total
                    </strong>
                </td>
                <td>
                    <strong>
                        {{number_format($data->amount,0,',','.')}}
                    </strong>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<div class="footer">
    <em>
        Terimakasi Atas Kunjungannya
    </em>
</div>
@endsection



