@extends('frontend.layouts')
@section('title',title_case('404 Not Found'))
@section('content')
<!-- HUBUNGI KAMI -->
<section class="mosh-call-to-action-area section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-12 col-lg-12">
                <div class="text-center wow fadeIn" data-wow-delay="0.5s">
                    <div class="section-heading">
                        <h2 class="text-dark">Maaf halaman tidak ada</h2>
                        <p class="text-red pt-3">Silahkan Kembali</p>
                    </div>
                    <a href="{{route('index.index')}}" class="btn mosh-btn shadow align-middle" style="font-size: 18px">
                        <i class="fa fa-angle-left"></i>
                        <span>Kembali</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- HUBUNGI KAMI END -->

@endsection
