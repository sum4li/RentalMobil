<!-- ***** Breadcumb Area Start ***** -->
<div class="mosh-breadcumb-area" style="background-image: url({{asset('frontend/img/bg/breadcumb.png')}});">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-12">
                <div class="bradcumbContent">
                    <h2>@yield('title')</h2>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('index.index')}}">Home</a></li>
                            @php
                                $url = explode('/',url()->current());
                            @endphp
                            @if (count($url) > 4)
                            <li class="breadcrumb-item"><a href="{{route('index.menu',$url[3])}}">{{title_case($url[3])}}</a></li>
                            @endif
                            <li class="breadcrumb-item active" aria-current="page">@yield('title')</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- ***** Breadcumb Area End ***** -->
