<!-- SLIDESHOW -->
<section class="welcome_area clearfix section_padding_100_0" id="home" style="background-image: url({{asset('frontend/img/bg/welcome-bg.png')}})">
    <div class="hero-slides owl-carousel">
        @foreach (App\Slideshow::orderBy('created_at','desc')->get() as $row)
        <!-- Single Hero Slides -->
        <div class="single-hero-slide">
            <div class="hero-slide-content text-center">
                <img class="slide-img" src="{{asset($row->images)}}" alt="">
            </div>
        </div>
        @endforeach
    </div>
</section>
<!-- SLIDESHOW END -->
