@extends('backend.layouts')
@section('title','Website Setting')
@section('content')
<div class="col-lg-12">
    <div class="card shadow-sm mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary float-left">@yield('title')</h6>
                <a href="#create" data-toggle="modal" class="btn btn-sm btn-primary float-right">
                    <i class="fa fa-plus"></i>
                </a>
            </div>
            <div class="card-body">
                <form action="{{route('setting.change')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    @foreach ($data as $row)
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                              <label>{{$row->name}}</label>
                              <input type="hidden" name="id[]" value="{{$row->id}}">
                              @if ($row->type == 'text')
                              <input type="text" name="description[]" value="{{$row->description}}" class="form-control border-dark-50" required="">
                              @else
                              <textarea name="description[]" class="form-control" required="">{{$row->description}}</textarea>

                              @endif
                            </div>
                        </div>
                    </div>
                    @endforeach

                    <div class="row">
                        <div class="col">
                            <div class="form-gorup">
                                <button type="submit" class="btn btn-primary">Simpan</button>
                                <a class="btn btn-light" href="{{route('dashboard')}}">Batal</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @include('backend.setting.create-modal')
@endsection
@push('scripts')

<script>
    $(document).ready(function(){
        $('.select2').select2({
            theme: 'bootstrap',
            dropdownParent: $('#create')
        });
    })
</script>

@endpush
