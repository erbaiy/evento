@extends('front-office.app.layout')
@section('content')
    <!-- Gallery Products Start -->
    <div class="gallery-area fix">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                @foreach ($images as $image)
                    <div class="col-lg-3 col-md-3 col-sm-6">
                        <div class="gallery-box">
                            <div class="single-gallery">
                                <div class="gallery-img" style="background-image: url({{ $image->image }});">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- Gallery Products End -->
@endsection
