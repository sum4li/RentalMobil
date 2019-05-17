@extends('backend.layouts')
@section('title','Tambah Data')
@section('content')
<div class="col-lg-12">
    <div class="card border-left-primary">
        <div class="card-body">
            <form action="{{route('gallery.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                          <label>Gambar</label>
                          <input type="file" name="image[]" id="fileinput" class="form-control border-dark-50" required="" multiple>
                        </div>
                        <div class="form-group">
                          <label>Nama</label>
                          <input type="text" name="name" id="" class="form-control border-dark-50" required="">
                          <input type="hidden" name="menu_id" value="{{$menu_id}}" class="form-control border-dark-50" required="">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-gorup">
                            <button type="submit" class="btn btn-primary">Simpan</button>
                            <a class="btn btn-light" href="{{route('gallery.index',$menu_id)}}">Batal</a>
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

    $('#fileinput').fileinput({
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
</script>

@endpush
