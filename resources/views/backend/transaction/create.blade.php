@extends('backend.layouts')
@section('title','Transaksi')
@section('content')
<div class="col-lg-8">
    <div class="card mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <form action="{{route('transaction.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group row">
                            <label class="col-lg-12">Customer</label>
                            <div class="col-lg-10">
                                <select name="customer_id" class="form-control customer" required=""></select>
                            </div>
                            <div class="col-lg-2">
                            <div class="form-check form-check-inline">
                                <select name="customer" class="custom-select">
                                    <option value="old" selected>Lama</option>
                                    <option value="new">Baru</option>
                                </select>
                            </div>
                            </div>
                        </div>
                        <div class="new_customer"></div>
                    </div>
                </div>
                <div class="row" id="product">
                    <div class="col">
                        <div class="form-group">
                            <label>Mobil</label>
                            <select name="car_id" class="form-control car" required="">
                                @foreach (App\Car::where('status','tersedia')->get() as $row)
                                <option value="{{$row->id}}">{{title_case($row->name).' ('.$row->license_number.') ('.$row->year.')'}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                          <label>Tanggal Sewa</label>
                          <input type="text" name="rent_date" class="form-control datepicker" required="">
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                          <label>Tanggal Kembali</label>
                          <input type="text" name="back_date" class="form-control datepicker" required="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-gorup">
                            <button type="submit" class="btn btn-primary shadow-sm">Simpan</button>
                            <a class="btn btn-light shadow-sm" href="{{route('transaction.index')}}">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script src="{{asset('backend/js/jquery.mask.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('backend/js/sweet-alert.min.js') }}"></script>
<script>
$(document).ready(function () {

    function bootstrap_select2_customer(selector,parent,url){
        $(selector).select2({
            minimumInputLength: 1,
            allowClear: true,
            placeholder: 'Masukkan Nama Customer',
            theme: "bootstrap",
            dropdownParent: $(parent),
            ajax: {
            dataType: 'json',
            url: url,
            delay: 200,
            data: function(params) {
                return {
                search: params.term
                }
            },
            processResults: function (response) {
                var results = [];
                $.each(response, function (index, data) {
                    results.push({
                        id: data.id,
                        text: data.name + ' ('+data.nik+')' + ' ('+data.phone_number+')'
                    });
                });

                return {
                    results: results
                };
            },
        }
        });
    }

    function bootstrap_select(selector,parent){
        $(selector).select2({
            dropdownParent: $(parent),
            theme: 'bootstrap'
        })
    }

    bootstrap_select2_customer('.customer','body','{!! route('customer.getCustomer') !!}');
    bootstrap_select('.car','body');
    // bootstrap_select('.select2','body');


    $('select[name="customer"]').on('change',function(){
        var pilihan = $('select[name="customer"] option:selected').val();
        if(pilihan == 'new'){
            $('.new_customer').append(
                '<div class="row">'+
                    '<div class="col">'+
                        '<div class="form-group">'+
                          '<label>NIK</label>'+
                          '<input type="text" name="nik" id="" class="form-control border-dark-50" required="">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col">'+
                        '<div class="form-group">'+
                          '<label>Nama</label>'+
                          '<input type="text" name="name" id="" class="form-control border-dark-50" required="">'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="row">'+
                    '<div class="col">'+
                        '<div class="form-group">'+
                          '<label>Alamat</label>'+
                          '<input type="text" name="address" id="" class="form-control border-dark-50" required="">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col">'+
                        '<div class="form-group">'+
                          '<label>Jenis Kelamin</label>'+
                          '<select name="sex" class="form-control">'+
                              '<option value="laki-laki">Laki-Laki</option>'+
                              '<option value="perempuan">Perempuan</option>'+
                          '</select>'+
                        '</div>'+
                    '</div>'+
                '</div>'+
                '<div class="row">'+
                    '<div class="col">'+
                        '<div class="form-group">'+
                          '<label>No Telp</label>'+
                          '<input type="text" name="phone_number" id="" class="form-control border-dark-50" required="">'+
                        '</div>'+
                    '</div>'+
                    '<div class="col">'+
                        '<div class="form-group">'+
                          '<label>Email</label>'+
                          '<input type="email" name="email" id="" class="form-control border-dark-50" required="">'+
                        '</div>'+
                    '</div>'+
                '</div>');

            $('select[name="customer_id"]').attr('disabled','disabled');
        }else{
            $('.new_customer').empty();
            $('select[name="customer_id"]').removeAttr('disabled');
        }
    });

    $('.datepicker').datepicker({
        format : 'yyyy-mm-dd',
        autoclose: true,
        todayHighlight:true
    });


});
</script>
@endpush
