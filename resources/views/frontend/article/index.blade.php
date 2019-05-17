@extends('layouts/frontend')
@section('title','Berita')
@section('mini-title','Berita')
@section('mini-text','Berita adalah jendela wawasan')
@section('breadcrumb')
    <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a class="text-red" href="{{route('index.index')}}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Berita</li>
    </ol>
@endsection
@section('content')
<section class="features2 cid-rn3z2VUjmr" id="features2-1h">
    <div class="container">
        <div class="media-container-row row">
            @foreach (App\Article::orderBy('created_at','desc')->get() as $row)
            <div class="card p-3 col-12 col-md-6 col-lg-3">
                <div class="card-wrapper">
                    <div class="card-img">
                        @php
                        $image = App\ArticleImage::where('article_id',$row->id)->get()->first()->image;
                        @endphp
                        <img src="{{asset($image)}}" alt="">
                    </div>
                    <div class="card-box">
                        <h4 class="card-title pb-3 mbr-fonts-style display-7"><a href="{{route('index.showArticle',$row->slug)}}">
                            {{title_case($row->title)}}
                        </a></h4>
                        <p>
                            <i class="fa fa-user text-green"></i> Admin
                            <i class="fa fa-calendar text-green"></i> {{Carbon\Carbon::parse($row->date)->format('d-m-Y')}}
                        </p>
                        <p class="mbr-text mbr-fonts-style display-7">
                            {!! str_limit($row->description,100) !!}
                        </p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
