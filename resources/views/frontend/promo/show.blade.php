@extends('frontend.layouts')
@section('title',title_case($data->get()->first()->name))
@section('content')
<section class="mosh-portfolio-area section_padding_100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 mx-auto">
                <div id="carouselId" class="carousel slide" data-ride="carousel">
                    {{-- <ol class="carousel-indicators">
                        @foreach ($data->get() as $row)
                        <li data-target="#carouselId" data-slide-to="{{$loop->index}}" class="{{$loop->index == 0 ? 'active':''}}"></li>
                        @endforeach
                    </ol> --}}
                    <div class="carousel-inner" role="listbox">
                        @foreach ($data->get() as $row)
                        <div class="carousel-item {{$loop->index == 0 ? 'active':''}}">
                            <img src="{{asset($row->images)}}" alt="{{asset('frontend/img/brand/digsa-color.png')}}">
                        </div>
                        @endforeach

                    </div>
                    {{-- <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a> --}}
                </div>
            </div>
            <div class="col-lg-8 mt-5 mx-auto">
                {!! $data->get()->first()->description !!}
            </div>
        </div>
    </div>
</section>
@endsection
