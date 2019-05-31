@extends('backend.layouts')
@section('title','Mobil')
@section('content')
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered table-striped" id="car-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nama</th>
                        <th>Merk</th>
                        <th>Tahun</th>
                        <th>Harga Sewa</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@include('backend.car.modal-show')
@endsection
@push('scripts')
<script src="{{ asset('backend/js/sweet-alert.min.js') }}"></script>
<script>
$(document).ready(function () {

    $.fn.dataTable.ext.errMode = 'throw';
    var $table = $('#car-table').DataTable({
         processing: true,
         serverSide: true,
         responsive: true,
         language: {
            paginate: {
                next: '<i class="fa fa-angle-right"></i>',
                previous: '<i class="fa fa-angle-left"></i>'
            },
            processing: 'Loading . . .',
            emptyTable: 'Tidak Ada Data',
            zeroRecords: 'Tidak Ada Data'
         },
         stateSave: true,
         dom: '<"toolbar">rtp',
         ajax: '{!! route('car.source') !!}',
         columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',width:"2%", orderable : false},
            // {data: 'code', name: 'code',width:"5%", orderable : false},
            {data: 'name', name: 'name',width:"5%", orderable : false},
            {data: 'manufacture', name: 'manufacture',width:"5%", orderable : false},
            {data: 'year', name: 'year',width:"5%", orderable : false},
            {data: 'price', name: 'price',width:"5%", orderable : false},
            {data: 'status', name: 'status',width:"5%", orderable : true},
            {data: 'action', name: 'action',width:"5%", orderable : false}
         ]
     });

      $('#car-table_wrapper > div.toolbar').html('<div class="row">' +
                '<div class="col-lg-10">'+
                    '<div class="input-group mb-3"> ' +
                        '<input type="text" class="form-control form-control-sm border-0 bg-light" id="search-box" placeholder="Masukkan Kata Kunci"> ' +
                        '<div class="input-group-append">' +
                        '<span class="btn btn-primary btn-sm"><i class="fas fa-search"></i></span>' +
                        '</div>' +
                    '</div>' +
                '</div>'+
                '<div class="col-lg-2">'+
                    '<a href="{{ route("car.create") }}" class="btn btn-primary btn-sm shadow-sm float-right" data-toggle="tooltip" title="Tambah Data"><i class="fas fa-plus"></i></a>'+
                '</div>' +
                '</div>');

     $(document).on('keypress','#search-box',function (e) {
            if(e.which == '13'){
                $table.search($(this).val()).draw();
            }
        //  e.preventDefault();
     });


    $('#car-table').on('click','a.delete-data',function(e) {
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

    $('#show').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var name = button.data('name'); // Extract info from data-* attributes
        var year = button.data('year'); // Extract info from data-* attributes
        var color = button.data('color'); // Extract info from data-* attributes
        var license_number = button.data('license_number'); // Extract info from data-* attributes
        var price = button.data('price'); // Extract info from data-* attributes
        var penalty = button.data('penalty'); // Extract info from data-* attributes

        var url = "{!! route('manufacture.find',':id') !!}";
        url = url.replace(':id',button.data('manufacture_id'));
        $.getJSON(url, function(data){
            var manufacture = data.name;
            modal.find('input[name="manufacture"]').val(manufacture);
        });

        var url_image = "{!! route('car.getImage',':id_car') !!}";
        url_image = url_image.replace(':id_car',button.data('id'));
        $.getJSON(url_image, function(data){
            $.each(data, function(index,value){
                if(index == 0){
                    var active = 'active';
                }
                var image = "{!! asset('image') !!}";
                image = image.replace('image',value.image);
                $('.gambar').append(
                    '<div class="carousel-item '+active+'">'+
                        '<img src="'+image+'" alt="{{asset("backend/img/logo.png")}}" class="d-block w-100">'+
                '</div>');
            });
        });

        var modal = $(this)

        modal.find('input[name="name"]').val(name);
        modal.find('input[name="year"]').val(year);
        modal.find('input[name="license_number"]').val(license_number);
        modal.find('input[name="color"]').val(color);
        modal.find('input[name="price"]').val(price);
        modal.find('input[name="penalty"]').val(penalty);

    });

    $('#show').on('hidden.bs.modal', function (event){
        $('.gambar').empty();
    });
});
</script>
@endpush
