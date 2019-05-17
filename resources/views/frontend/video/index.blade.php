@extends('layouts/frontend')
@section('title','Video')
@section('mini-title','Video')
@section('mini-text','Satu menit dalam video mempunyai berjuta arti')
@section('breadcrumb')
    <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a class="text-red" href="{{route('index.index')}}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Video</li>
    </ol>
@endsection
@section('content')
@php
    //youtube by link
function embed_youtube($link){
    $link = explode('=',$link);
    $embed_link = "https://www.youtube.com/embed/".$link[1];

    return $embed_link;
}


//youtube thumbnail
function thumbnail_youtube($link){
    $link = explode('=',$link);
    $thumbnail_link = "https://img.youtube.com/vi/".$link[1]."/maxresdefault.jpg";

    return $thumbnail_link;
}
@endphp
<section class="mbr-gallery mbr-slider-carousel cid-rn5MnCz0N6" id="gallery1-1l">
    <div class="container">
        <div>
            <div class="mbr-gallery-row row">
                <div class="mbr-gallery-layout-default">
                    @foreach (App\Video::orderBy('created_at','desc')->get() as $row)
                    <div class="mbr-gallery-item mbr-gallery-item--p1">
                        <div href="#lb-gallery1-r">
                            <div class="gallery">
                                <a href="{{$row->url}}" class="popup-youtube">
                                    <img src="{{thumbnail_youtube($row->url)}}" alt="" title="">
                                    <span class="icon-focus"></span>
                                    <span class="mbr-gallery-title mbr-fonts-style display-7">
                                        {{$row->name}}
                                    </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
