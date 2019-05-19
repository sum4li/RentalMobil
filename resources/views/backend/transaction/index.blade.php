@extends('backend.layouts')
@section('title','Transaksi')
@section('content')
<div class="col-lg-12">
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <table class="table table-sm table-bordered" id="transaction-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>No Invoice</th>
                        <th>Date Sewa</th>
                        <th>Date Kembali</th>
                        <th>Customer</th>
                        <th>Mobil</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
</div>
@include('backend.transaction.modal-export')
@include('backend.transaction.modal-complete')
@endsection
@push('scripts')
<script src="{{ asset('backend/js/sweet-alert.min.js') }}"></script>
<script>
$(document).ready(function () {

    $.fn.dataTable.ext.errMode = 'throw';
    var $table = $('#transaction-table').DataTable({
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
         ajax: '{!! route("transaction.source","proses") !!}',
         columns: [
            {data: 'DT_RowIndex', name: 'DT_RowIndex',width:"2%", orderable : false},
            // {data: 'code', name: 'code',width:"5%", orderable : false},
            {data: 'invoice_no', name: 'invoice_no',width:"5%", orderable : false},
            {data: 'rent_date', name: 'rent_date',width:"5%", orderable : false},
            {data: 'back_date', name: 'back_date',width:"5%", orderable : false},
            {data: 'customer', name: 'customer',width:"15%", orderable : false},
            {data: 'car', name: 'car',width:"5%", orderable : false},
            {data: 'status', name: 'status',width:"5%", orderable : false},
            {data: 'action', name: 'action',width:"5%", orderable : false}
         ]
     });

      $('#transaction-table_wrapper > div.toolbar').html('<div class="row">' +
                '<div class="col-lg-10">'+
                    '<div class="input-group mb-3"> ' +
                        '<input type="text" class="form-control form-control-sm border-0 bg-light" id="search-box" placeholder="Masukkan Kata Kunci"> ' +
                        '<div class="input-group-append">' +
                        '<span class="btn btn-sm btn-primary"><i class="fas fa-search"></i></span>' +
                        '</div>' +
                    '</div>' +
                '</div>'+
                '<div class="col-lg-2">'+
                    // '<span data-toggle="modal" data-target="#export">'+
                    // '<a href="#export" class="btn btn-sm btn-success float-right" data-toggle="tooltip" title="Export ke Excel"><i class="fas fa-file-excel"></i></a>'+
                    // '</span>'+
                '</div>' +
                '</div>');

     $(document).on('keyup','#search-box',function (e) {
         e.preventDefault();
         $table.search($(this).val()).draw() ;
     });


    $('#transaction-table').on('click','a.delete-data',function(e) {
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

    $('.datepicker').datepicker({
        format : 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight:true
    });

    $('#complete').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget); // Button that triggered the modal

        var invoice_no = button.data('invoice_no'); // Extract info from data-* attributes
        var form = button.data('form'); // Extract info from data-* attributes

        var modal = $(this)
        console.log(invoice_no);

        modal.find('input[name="invoice_no"]').val(invoice_no);
        modal.find('#form').attr('action',form);


    });
});
</script>
@endpush
