@extends('backend.layouts')
@section('title','Ganti Password')
@section('content')
<div class="col-lg-6">
    {{-- <div class="card border-left-primary"> --}}
    <div class="card shadow-sm mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">@yield('title')</h6>
        </div>
        <div class="card-body">
            <form action="{{route('user.updatePassword')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                          <label>Password Lama</label>
                          <input type="password" name="old_password" id="" class="form-control border-dark-50" required="">
                        </div>
                        <div class="form-group">
                          <label>Password Baru</label>
                          <input type="password" name="new_password" id="" class="form-control border-dark-50" required="">
                        </div>
                        <div class="form-group">
                          <label>Konfirmasi Password Baru</label>
                          <input type="password" name="confirm_password" id="" class="form-control border-dark-50" required="">
                        </div>
                    </div>
                </div>

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
@endsection
