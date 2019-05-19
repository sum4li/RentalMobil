@extends('backend.layouts')
@section('title','Customer')
@section('content')
<div class="col-lg-12">
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered" id="customer-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>NIK</th>
                        <th>Nama</th>
                        <th>No Telp</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@include('backend.customer.modal-show')
@endsection
@push('scripts')
<script src="{{ asset('backend/js/sweet-alert.min.js') }}"></script>
<script>
$(document).ready(function () {

    $.fn.dataTable.ext.errMode = 'throw';
    var $table = $('#customer-table').DataTable({
         processing: true,
         serverSide: true,
         responsive: true,
         stateSave: true,
         language: {
            paginate: {
                next: '<i class="fa fa-angle-right"></i>',
                previous: '<i class="fa fa-angle-left"></i>'
            },
            processing: 'Loading . . .',
            emptyTable: 'Tidak Ada Data',
            zeroRecords: 'Tidak Ada Data'
         },
         dom: '<"toolbar">rtp',
         ajax: '{!! route('customer.source') !!}',
         columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',width:"2%", orderable : false},
            {data: 'nik', name: 'nik',width:"5%", orderable : true},
            {data: 'name', name: 'name',width:"5%", orderable : true},
            {data: 'phone_number', name: 'phone_number',width:"5%", orderable : false},
            {data: 'action', name: 'action',width:"2%", orderable : false}
         ]
     });

      $('#customer-table_wrapper > div.toolbar').html('<div class="row">' +
                '<div class="col-lg-10">'+
                    '<div class="input-group mb-3"> ' +
                        '<input type="text" class="form-control form-control-sm border-0 bg-light" id="search-box" placeholder="Masukkan Kata Kunci"> ' +
                        '<div class="input-group-append">' +
                        '<span class="btn btn-sm btn-primary"><i class="fas fa-search"></i></span>' +
                        '</div>' +
                    '</div>' +
                '</div>'+
                '<div class="col-lg-2">'+
                    '<a href="{{ route("customer.create") }}" class="btn btn-sm btn-primary shadow-sm float-right" data-toggle="tooltip" title="Tambah Data"><i class="fas fa-plus"></i></a>'+
                '</div>' +
                '</div>');

     $(document).on('keyup','#search-box',function (e) {
         e.preventDefault();
         $table.search($(this).val()).draw() ;
     });


    $('#customer-table').on('click','a.delete-data',function(e) {
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
        var address = button.data('address'); // Extract info from data-* attributes
        var email = button.data('email'); // Extract info from data-* attributes
        var phone_number = button.data('phone_number'); // Extract info from data-* attributes
        var sex = button.data('sex'); // Extract info from data-* attributes
        var nik = button.data('nik'); // Extract info from data-* attributes
        var modal = $(this)

        modal.find('input[name="name"]').val(name);
        modal.find('input[name="address"]').val(address);
        modal.find('input[name="phone_number"]').val(phone_number);
        modal.find('input[name="email"]').val(email);
        modal.find('input[name="sex"]').val(sex);
        modal.find('input[name="nik"]').val(nik);

    });
});
</script>
@endpush
