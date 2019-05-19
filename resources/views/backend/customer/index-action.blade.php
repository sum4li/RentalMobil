<span data-toggle="modal" data-target="#show" data-name="{{$name}}"
    data-nik="{{$nik}}"
    data-address="{{$address}}"
    data-sex="{{$sex}}"
    data-phone_number="{{$phone_number}}"
    data-email="{{$email}}">
    <a href="#"
        class="btn btn-info btn-sm shadow-sm"
        data-toggle="tooltip"
        data-placement="top"
        title="Detail">
        <i class="fa fa-search"></i>
    </a>
</span>
<a href="{{route('customer.edit',[$id])}}"
    class="btn btn-success btn-sm shadow-sm"
    data-toggle="tooltip"
    data-placement="top"
    title="Edit">
    <i class="fa fa-pen"></i>
</a>
<a href="{{route('customer.destroy',[$id])}}"
    class="btn btn-danger btn-sm shadow-sm delete-data"
    data-toggle="tooltip"
    data-placement="top"
    title="Delete">
    <i class="fa fa-times"></i>
</a>
