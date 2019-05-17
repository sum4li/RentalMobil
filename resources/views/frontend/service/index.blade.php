@extends('frontend.layouts')
@section('title',title_case($menu->first()->name))
@section('content')
<!-- SERVICE -->
<section class="mosh--services-area section_padding_100">
    <div class="container">
        <div class="row">
            @foreach ($data->get() as $row)
            <!-- Single Feature Area -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="single-feature-area d-flex mb-100">
                    <div class="feature-icon mr-30">
                        <i class="{{$row->icon}} fa-5x text-red"></i>
                    </div>
                    <div class="feature-content">
                        <h4>{{title_case($row->name)}}</h4>
                        <p>{{str_limit($row->description,70)}}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>

    </div>
</section>
<!-- SERVICE END -->

@endsection
