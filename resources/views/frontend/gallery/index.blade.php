@extends('frontend.layouts')
@section('title',title_case($menu->first()->name))
@section('content')
<!-- PROMO -->
<section class="mosh-portofolio-area section_padding_100 clearfix">
    <div class="container">
        <div class="row">
            @foreach ($data->get() as $row)
            <div class="col-lg-4">
                <div class="gallery">
                    @php
                    $image = App\GalleryImage::where('gallery_id',$row->id)->get()->first();
                    @endphp
                    <a href="{{asset($image->image)}}" class="promo-card">
                        <div class="card">
                            <img src="{{asset($image->image)}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title text-red">{{title_case($row->name)}}</h5>
                            </div>
                        </div>
                    </a>
                    @foreach (App\GalleryImage::where('gallery_id',$row->id)->where('id','!=',$image->id)->get() as $item)
                    <a href="{{asset($item->image)}}"></a>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
<!-- PROMO END -->
@endsection
