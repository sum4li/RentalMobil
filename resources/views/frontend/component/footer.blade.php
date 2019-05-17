<!-- FOOOTER -->
<footer class="footer-area clearfix" style="background-image: url({{asset('frontend/img/bg/footer.png')}})">
    <!-- Top Fotter Area -->
    <div class="top-footer-area section_padding_100_0">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 justify-content-center">
                    <div class="section-heading text-center">
                        <h2 class="text-white">Kantor & Kontak</h2>
                    </div>
                </div>
                <div class="col-12 col-sm-6 col-lg-6">
                    <h6>( Kantor Utama )</h6>
                    {{setting('address_1')}}
                    <br>
                    <h6>( Kantor Cabang )</h6>
                    {{setting('address_2')}}
                </div>
                <div class="col-12 col-sm-6 col-lg-6">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3955.2115595949213!2d110.67469981428154!3d-7.551895294553633!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e7a6b97e17a2b89%3A0xc718b9ae495800c9!2sPengging+Koi+Farm+(PKF)!5e0!3m2!1sid!2sid!4v1557481274265!5m2!1sid!2sid" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom-area">
        <p class="pt-3 text-center">Copyright &copy; {{date('Y')}} {{setting('title')}}. All Right Reserved</p>
    </div>
</footer>
<!-- FOOTER END -->


<div class="sosmed">
    <ul>
        @foreach (App\Socmed::get() as $row)
        @php
            if($row->name == 'facebook'){
                $bg = 'bg-primary';
            }elseif($row->name == 'instagram' || $row->name == 'youtube'){
                $bg = 'bg-danger';
            }else{
                $bg = 'bg-info';
            }
        @endphp
        <li>
            <a href="{{$row->url}}" target="_blank">
                <i class="fab fa-{{$row->name}} {{$bg}}"></i>
            </a>
        </li>
        @endforeach
        <li>
            <a href="http://wa.me/{{setting('wa_number')}}?text={{setting('wa_text')}}">
                <i class="fab fa-whatsapp bg-success"></i>
            </a>
        </li>
    </ul>
</div>
