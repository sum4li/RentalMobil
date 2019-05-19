<span data-toggle="modal" data-target="#show" data-name="{{$name}}"
    data-id="{{$id}}"
    data-manufacture_id="{{$manufacture_id}}"
    data-license_number="{{$license_number}}"
    data-color="{{$color}}"
    data-year="{{$year}}"
    data-price="{{number_format($price,0,'.','.')}}"
    data-penalty="{{number_format($penalty,0,'.','.')}}">
    <a href="#"
        class="btn btn-info btn-sm shadow-sm"
        data-toggle="tooltip"
        data-placement="top"
        title="Detail">
        <i class="fa fa-search"></i>
    </a>
</span>
<a href="{{route('car.edit',$id)}}"
    class="btn btn-success btn-sm shadow-sm"
    data-toggle="tooltip"
    data-placement="top"
    title="Edit">
    <i class="fa fa-pen"></i>
</a>
<a href="{{route('car.destroy',$id)}}"
    class="btn btn-danger btn-sm shadow-sm delete-data"
    data-toggle="tooltip"
    data-placement="top"
    title="Delete">
    <i class="fa fa-times"></i>
</a>
