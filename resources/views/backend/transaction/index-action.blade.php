{{-- <a href="{{route('transaction.edit',[$id])}}"
    class="btn btn-success btn-sm shadow-sm"
    data-toggle="tooltip"
    data-placement="top"
    title="Edit">
    <i class="fa fa-pen"></i>
</a> --}}
<a href="{{route('transaction.destroy',[$id])}}"
    class="btn btn-danger btn-sm shadow-sm delete-data"
    data-toggle="tooltip"
    data-placement="top"
    title="Delete">
    <i class="fa fa-times"></i>
</a>
<a href="{{route('transaction.print',[$id])}}"
    target="_blank"
    class="btn btn-light btn-sm shadow-sm"
    data-toggle="tooltip"
    data-placement="top"
    title="Cetak">
    <i class="fa fa-print"></i>
</a>
