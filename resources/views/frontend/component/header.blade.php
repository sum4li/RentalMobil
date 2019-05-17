<!-- HEADER -->
<header class="header_area clearfix">
    <div class="container-fluid h-100">
        <div class="row h-100">
            <!-- Menu Area Start -->
            <div class="col-12 h-100">
                <div class="menu_area h-100">
                    <nav class="navbar h-100 navbar-expand-lg align-items-center">
                        <!-- Logo -->
                        <a class="navbar-brand" href="{{route('index.index')}}"><img src="{{asset('frontend/img/brand/white-name.png')}}" alt="Digsa.id" width="100px" height="100px"></a>

                        <!-- Menu Area -->
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mosh-navbar" aria-controls="mosh-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>

                        <div class="collapse navbar-collapse justify-content-end" id="mosh-navbar">
                            <ul class="navbar-nav animated" id="nav">
                            <li class="nav-item {{url()->current() == route('index.index') ? 'active':''}}"><a class="nav-link" href="{{route('index.index')}}">Home</a></li>
                                @foreach (App\Menu::orderBy('order','asc')->get() as $row)
                                <li class="nav-item {{ route('index.menu',[$row->slug,'']) == url()->current() ? 'active':''}}"><a class="nav-link" href="{{route('index.menu',[$row->slug])}}">{{title_case($row->name)}}</a></li>
                                @endforeach
                            </ul>


                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- HEADER END -->
