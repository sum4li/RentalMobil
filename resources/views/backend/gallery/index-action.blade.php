<a href="{{route('gallery.edit',[$id,$menu_id])}}"
    class="btn btn-success btn-sm"
    data-toggle="tooltip"
    data-placement="top"
    title="Edit">
    <i class="fa fa-pen"></i>
</a>
<a href="{{route('gallery.destroy',[$id,$menu_id])}}"
    class="btn btn-danger btn-sm delete-data"
    data-toggle="tooltip"
    data-placement="top"
    title="Delete">
    <i class="fa fa-times"></i>
</a>
