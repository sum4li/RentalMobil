@extends('frontend.layouts')
@section('title',title_case($menu->first()->name))
@section('content')
<!-- PROMO -->
<section class="mosh-portofolio-area section_padding_100 clearfix">
    <div class="container">
        <div class="row">
            @foreach ($data->get() as $row)
            <div class="col-lg-4">
                <a href="{{route('index.menu',[$row->menu->name,$row->slug])}}" class="promo-card">
                    <div class="card">
                        <img src="{{asset($row->images)}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-red">{{title_case($row->name)}}</h5>
                            <p class="card-text text-dark">{{str_limit(strip_tags($row->description),70)}}</p>
                        </div>
                    </div>
                </a>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- PROMO END -->
@endsection
