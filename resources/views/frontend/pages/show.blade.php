@extends('layouts/frontend')
@section('title','Project')
@section('mini-title','Project')
@section('mini-text',title_case($data->name))
@section('content')
<section class="mbr-section article content1 cid-rmSfb1b8Sh" id="content1-13">
    <div class="container">
        <div class="media-container-row">
            <div class="mbr-text col-12 mbr-fonts-style display-7 col-md-8">
                <h2 class="pb-5">{{title_case($data->name)}}</h2>
                {!!$data->description!!}
            </div>
        </div>
    </div>
</section>
@endsection
