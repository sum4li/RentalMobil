<!-- SERVICE -->
<section class="mosh--services-area section_padding_100">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-heading text-center">
                    <h2>Layanan</h2>
                    <p class="pt-3 text-red">Kami berikan layanan terbaik kepada anda</p>
                </div>
            </div>
            @foreach (App\Service::get() as $row)
            <!-- Single Feature Area -->
            <div class="col-12 col-sm-6 col-md-4">
                <div class="single-feature-area d-flex mb-100">
                    <div class="feature-icon mr-30">
                        {{-- <i class="fas fa-5x text-red"></i> --}}
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
