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
                                <select name="customer" class="form-control .select2">
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
                            <label>Produk</label>
                            <select name="product_id[]" class="form-control product" required="">
                                @foreach (App\Product::get() as $row)
                                    <option value="{{$row->id}}">{{title_case($row->name)}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <label>Jumlah</label>
                            <input type="text" name="qty[]" class="form-control harga" required="">
                        </div>
                    </div>
                </div>
                <div class="add_product"></div>
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <button class="btn btn-block btn-primary" id="add_product"><i class="fa fa-plus"></i></button>
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
                        text: data.name + ' ('+data.phone_number+')' + ' ('+data.email+')'
                    });
                });

                return {
                    results: results
                };
            },
        }
        });
    }

    function bootstrap_select_product(selector,parent){
        $(selector).select2({
            dropdownParent: $(parent),
            theme: 'bootstrap'
        })
    }

    bootstrap_select2_customer('.customer','body','{!! route('customer.getCustomer') !!}');
    bootstrap_select_product('.product','body');

    $("#add_product").click( function (e) {
        e.preventDefault();

        $('<div class="row" id="add_produk">'+
            '<div class="col-lg-6">'+
                '<div class="form-group">'+
                    '<label>Produk</label>'+
                    '<select name="product_id[]" class="form-control product" required="">'+
                        @foreach (App\Product::get() as $row)
                            '<option value="{{$row->id}}">{{title_case($row->name)}}</option>'+
                        @endforeach
                    '</select>'+
                '</div>'+
            '</div>'+
            '<div class="col-lg-6">'+
                '<div class="form-group row">'+
                    '<label class="col-lg-12">Jumlah</label>'+
                        '<div class="col-lg-10">'+
                            '<input type="text" name="qty[]" class="form-control harga" required="">'+
                        '</div>'+
                        '<div class="col-lg-2">'+
                            '<a href="#" class="btn btn-danger" id="remove_form"><i class="fa fa-times"></i></a>'+
                        '</div>'+
                '</div>'+
            '</div>'+
        '</div>').appendTo('.add_product');
        bootstrap_select_product('.product','body');
        $('.harga').mask('9999999999',{placeholder: 'Harus Angka'});
    });

    $('body').on('click','#remove_form',function(e){
        e.preventDefault();
        $(this).parents('#add_produk').remove();
    });


    $('select[name="customer"]').on('change',function(){
        var pilihan = $('select[name="customer"] option:selected').val();
        if(pilihan == 'new'){
            $('.new_customer').append(
            '<div class="form-group">'+
                '<label>Nama</label>'+
                '<input type="text" class="form-control" name="name" required="">'+
            '</div>'+
            '<div class="form-group">'+
                '<label>No Telepon</label>'+
                '<input type="text" class="form-control" name="phone_number" required="">'+
            '</div>'+
            '<div class="form-group">'+
                '<label>Email</label>'+
                '<input type="text" class="form-control" name="email" required="">'+
            '</div>');

            $('select[name="customer_id"]').attr('disabled','disabled');
        }else{
            $('.new_customer').empty();
            $('select[name="customer_id"]').removeAttr('disabled');
        }
    });

    $('.harga').mask('9999999999',{placeholder: 'Harus Angka'});

});
</script>
@endpush
