@extends('backend.layouts')
@section('title','Galeri')
@section('content')
<div class="col-lg-12">
    <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" id="gallery-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Gambar</th>
                        <th>Nama</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{ asset('backend/js/sweet-alert.min.js') }}"></script>
<script>
$(document).ready(function () {

    $.fn.dataTable.ext.errMode = 'throw';
    var $table = $('#gallery-table').DataTable({
         processing: true,
         serverSide: true,
         responsive: true,
         stateSave: true,
         dom: '<"toolbar">rtp',
         ajax: '{!! route('gallery.source',$menu_id) !!}',
         columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',width:"2%", orderable : false},
            // {data: 'code', name: 'code',width:"5%", orderable : false},
            {data: 'image', name: 'image',width:"5%", orderable : true},
            {data: 'name', name: 'name',width:"15%", orderable : false},
            {data: 'action', name: 'action',width:"5%", orderable : false}
         ]
     });

      $('#gallery-table_wrapper > div.toolbar').html('<div class="row">' +
                '<div class="col-lg-10">'+
                    '<div class="input-group mb-3"> ' +
                        '<input type="text" class="form-control border-0 bg-light" id="search-box" placeholder="Masukkan Kata Kunci"> ' +
                        '<div class="input-group-append">' +
                        '<span class="btn btn-primary"><i class="fas fa-search"></i></span>' +
                        '</div>' +
                    '</div>' +
                '</div>'+
                '<div class="col-lg-2">'+
                    '<a href="{{ route("gallery.create",$menu_id) }}" class="btn btn-primary float-right" data-toggle="tooltip" title="Tambah Data"><i class="fas fa-plus"></i></a>'+
                '</div>' +
                '</div>');

     $(document).on('keyup','#search-box',function (e) {
         e.preventDefault();
         $table.search($(this).val()).draw() ;
     });


    $('#gallery-table').on('click','a.delete-data',function(e) {
        e.preventDefault();
        var delete_link = $(this).attr('href');
        swal({
            title: "Hapus Data ini?",
            text: "",
            icon: "error",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
                if (willDelete) {
                    swal("Data anda terhapus");
                    window.location.replace(delete_link);
                } else {
                    swal("Data anda aman");
                }
            });
    });

    $('body').tooltip({selector: '[data-toggle="tooltip"]'});
});
</script>
@endpush
