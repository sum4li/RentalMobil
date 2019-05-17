@extends('layouts/frontend')
@section('title','Project')
@section('mini-title','Project')
@section('mini-text','Project yang sedang kami kerjakan')
@section('breadcrumb')
    <ol class="breadcrumb justify-content-center">
        <li class="breadcrumb-item"><a class="text-red" href="{{route('index.index')}}">Beranda</a></li>
        <li class="breadcrumb-item active" aria-current="page">Project</li>
    </ol>
@endsection
@section('content')
<section class="features18 popup-btn-cards cid-rn5WZVRyek" id="features18-2d">

    <div class="container">
        <div class="media-container-row row">
            @foreach (App\Project::get() as $row)
            <div class="card p-3 col-12 col-md-6 col-lg-3">
                    <div class="card-wrapper ">
                        <div class="card-img">
                            <div class="mbr-overlay"></div>
                            <div class="mbr-section-btn text-center">
                                <a href="{{route('index.showProject',$row->slug)}}" class="btn btn-primary display-4">Learn More</a>
                            </div>
                            @php
                            $image = App\ProjectImage::where('project_id',$row->id)->get()->first()->image;
                        @endphp
                        <img src="{{asset($image)}}" alt="Mobirise">
                        </div>
                        <div class="card-box">
                            <h4 class="card-title mbr-fonts-style display-7">
                                    {{title_case($row->name)}}
                            </h4>
                            <p class="mbr-text mbr-fonts-style align-left display-7">
                                    {{str_limit(strip_tags($row->description),134)}}
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
