@extends('frontend.layouts')
@section('title',title_case($menu->first()->name))
@section('content')
<section class="mosh--services-area section_padding_100">
    <div class="container">
        <div class="row">
            <!-- Single Feature Area -->
            <div class="col-12 col-lg-12">
                {!! $data->first()->description !!}
            </div>
        </div>

    </div>
</section>
@endsection
