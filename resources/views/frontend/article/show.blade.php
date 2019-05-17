@extends('layouts/frontend')
@section('title','Berita')
@section('mini-title','Berita')
@section('mini-text',title_case($data->title))
@section('breadcrumb')
    <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a class="text-red" href="{{route('index.index')}}">Beranda</a></li>
        <li class="breadcrumb-item"><a class="text-red" href="{{route('index.article')}}">Berita</a></li>
        <li class="breadcrumb-item active" aria-current="page">{{title_case($data->title)}}</li>
    </ol>
@endsection
@section('content')
<section class="carousel slide cid-rn5OFEKtwM" data-interval="false" id="slider2-1w">
    <div class="container content-slider">
        <div class="content-slider-wrap">
            <div>
                <div class="mbr-slider slide carousel" data-pause="true" data-keyboard="false" data-ride="false" data-interval="false">
                    @php
                        $indicator=0;
                        $no=0;
                    @endphp
                    <ol class="carousel-indicators">
                        @foreach (App\ArticleImage::where('article_id',$data->id)->get() as $row)
                        <li data-app-prevent-settings="" data-target="#slider2-1w" class="{{$indicator == 0 ? 'active':''}}" data-slide-to="{{$indicator++}}"></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach (App\ArticleImage::where('article_id',$data->id)->get() as $row)

                    <div class="carousel-item slider-fullscreen-image {{$no == 0 ? 'active':''}}" data-bg-video-slide="false" style="background-image: {{asset($row->image)}};">
                            <div class="container container-slide">
                                <div class="image_wrapper">
                                    {{-- <div class="mbr-overlay"></div> --}}
                                    <img src="{{asset($row->image)}}">
                                    <div class="carousel-caption justify-content-center">
                                        <div class="col-10 align-center"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php
                            $no++
                        @endphp
                        @endforeach
                    </div>
                    <a data-app-prevent-settings="" class="carousel-control carousel-control-prev" role="button" data-slide="prev"
                        href="#slider2-1w"><span aria-hidden="true" class="mbri-left mbr-iconfont"></span><span class="sr-only">Previous</span>
                    </a>
                    <a data-app-prevent-settings="" class="carousel-control carousel-control-next" role="button" data-slide="next"
                        href="#slider2-1w"><span aria-hidden="true" class="mbri-right mbr-iconfont"></span><span class="sr-only">Next</span></a>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="mbr-section article content1 cid-rn5OHz2vIb" id="content1-1x">
    <div class="container">
        <div class="media-container-row">
            <div class="mbr-text col-12 mbr-fonts-style display-7 col-md-8">

                <h2 class="pb-5">{{title_case($data->title)}}</h2>
                <p>
                    <i class="fa fa-user text-green"></i> Admin
                    <i class="fa fa-calendar text-green"></i> {{Carbon\Carbon::parse($row->date)->format('d-m-Y')}}
                </p>
                {!!$data->description!!}
            </div>
        </div>
    </div>
</section>
@endsection
