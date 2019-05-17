<!-- PROMO -->
<section class="mosh-service-area section_padding_100 clearfix">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="section-heading text-center">
                    <h2>Promo</h2>
                    <p class="text-red pt-3">Jangan sampai ketinggalan promo-promo menarik dari kami</p>
                </div>
                <div class="mosh-service-slides owl-carousel">
                    @foreach (App\Promo::get() as $row)
                    <a href="{{route('index.menu',[$row->menu->slug,$row->slug])}}" class="promo-card">
                        <div class="card">
                            <img src="{{asset($row->images)}}" class="card-img-top" alt="...">
                            <div class="card-body">
                                <h5 class="card-title">{{title_case($row->name)}}</h5>
                                <p class="card-text">{{str_limit(strip_tags($row->description),150)}}</p>
                            </div>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
<!-- PROMO END -->
