@extends('backend.layouts')
@section('title','Ubah Data')
@section('content')
<div class="col-lg-12">
    <div class="card mb-4">
        <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <form action="{{route('car.update',$data->id)}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label>Gambar Lama</label>
                            <div id="loadImage" class="row"></div>
                        </div>
                        <div class="form-group">
                            <label>Gambar</label>
                            <input type="file" name="image[]" id="edit-file" multiple>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col">
                            <div class="form-group">
                              <label>Nama</label>
                              <input type="text" name="name" value="{{$data->name}}" class="form-control border-dark-50" required="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                              <label>Merk</label>
                                <select name="manufacture_id" class="form-control select2">
                                    @foreach (App\Manufacture::orderBy('name','asc')->get() as $row)
                                    <option value="{{$row->id}}" {{$data->manufacture_id == $row->id ? 'selected':'' }}>{{title_case($row->name)}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                              <label>Nomer Polisi</label>
                              <input type="text" name="license_number" value="{{$data->license_number}}" class="form-control border-dark-50" required="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                              <label>Tahun</label>
                              <input type="text" name="year" value="{{$data->year}}" class="form-control border-dark-50" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                              <label>Sewa Perhari</label>
                              <input type="text" name="price" value="{{$data->price}}" class="form-control border-dark-50" required="">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                              <label>Denda Perhari</label>
                              <input type="text" name="penalty" value="{{$data->penalty}}" class="form-control border-dark-50" required="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                              <label>Warna</label>
                              <input type="text" name="color" value="{{$data->color}}" class="form-control border-dark-50" required="">
                            </div>
                        </div>
                    </div>

                <div class="row">
                    <div class="col">
                        <div class="form-gorup">
                            <button type="submit" class="btn btn-primary shadow-sm">Simpan</button>
                            <a class="btn btn-light shadow-sm" href="{{route('car.index')}}">Batal</a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@push('scripts')
<script>
    // $(document).ready(function(){


        function loadImage(){
        $.getJSON("{{route('car.getImage',$data->id)}}", function(data){
            $.each(data, function(index,value){
                var url = "{!! route('car.destroyImage','id') !!}";
                var image = "{!! asset('image') !!}";

                url = url.replace('id',value.id);
                image = image.replace('image',value.image);
                $('#loadImage').append('<div class="col-md-3">'+
                    '<div class="form-group">'+
                        '<div class="card bg-dark text-white shadow-sm">'+
                            '<img class="card-img" src="'+image+'" alt="">'+
                            '<div class="card-img-overlay">'+
                                '<a class="card-text btn btn-danger shadow-sm delete-photo" data-href="'+url+'" href="#">'+
                                    '<i class="fa fa-times"></i>'+
                                '</a>'+
                            '</div>'+
                        '</div>'+
                    '</div>'+
                '</div>')
            });
        });
    }

    loadImage();

    $('#loadImage').on('click','a.delete-photo',function(e){
        e.preventDefault();
        $.get($(this).attr('data-href'),function(){
            $('#loadImage').empty();
            loadImage();
        });

    });

    $("#edit-file").fileinput({

        uploadUrl:'#',
        browseClass: "btn btn-primary btn-block",
        fileActionSettings:{
        showZoom:false,
        showUpload:false,
        removeClass: "btn btn-danger",
        removeIcon: "<i class='fa fa-trash'></i>"
        },
        showCaption: false,
        showRemove: false,
        showUpload: false,
        showCancel: false,
        dropZoneEnabled: false,
        allowedFileExtensions: ['jpg', 'png','jpeg'],
    });
    // })
</script>

@endpush
