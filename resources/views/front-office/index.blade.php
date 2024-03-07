@extends('front-office.app.layout')
@section('content')
    <div class="container">
        <form action=""></form>
    </div>


    <!--? Blog Area Start -->
    <section class="home-blog-area section-padding30">
        <div class="container">
            <!-- Section Tittle -->
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <div class="section-tittle text-center mb-50">
                        <h2>News From Blog</h2>
                        <p>There arge many variations ohf passages of sorem gp ilable, but the majority have ssorem
                            gp iluffe.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach ($events as $event)
                    <div class="col-xl-6 col-lg-6 col-md-6">
                        <div class="home-blog-single mb-30">
                            <div class="blog-img-cap">
                                <div class="blog-img">

                                    <img src="{{ $event->image }}" alt="">
                                    <!-- Blog date -->
                                    <div class="blog-date text-center">
                                        <span>{{ $event->places }}</span>
                                        <p>places</p>
                                    </div>
                                </div>
                                <div class="blog-cap">

                                    <h3><a href="blog_details.html">
                                            {{ $event->title }}
                                        </a></h3>
                                </div>

                                <form action="{{ route('reserveTicket') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value="{{ session('id') }}">
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    <button type="submit" class="btn btn-seccess">get ticket </button>
                                </form>
                                <form action="{{ route('front-office.detail') }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                                    <input type="submit" value="View Details">
                                </form>

                            </div>
                        </div>
                    </div>
                @endforeach


            </div>

        </div>
    </section>
    <!-- Blog Area End -->

    <!--? gallery Products Start  -->
    <div class="gallery-area fix">
        <div class="container-fluid p-0">
            <div class="row no-gutters">
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="gallery-box">
                        <div class="single-gallery">
                            <div class="gallery-img "
                                style="background-image: url(front-office/assets/img/gallery/gallery1.png);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="gallery-box">
                        <div class="single-gallery">
                            <div class="gallery-img "
                                style="background-image: url(front-office/assets/img/gallery/gallery2.png);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="gallery-box">
                        <div class="single-gallery">
                            <div class="gallery-img "
                                style="background-image: url(front-office/assets/img/gallery/gallery3.png);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-6">
                    <div class="gallery-box">
                        <div class="single-gallery">
                            <div class="gallery-img "
                                style="background-image: url(front-office/assets/img/gallery/gallery4.png);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="gallery-box">
                        <div class="single-gallery">
                            <div class="gallery-img "
                                style="background-image: url(front-office/assets/img/gallery/gallery5.png);">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6">
                    <div class="gallery-box">
                        <div class="single-gallery">
                            <div class="gallery-img "
                                style="background-image: url(front-office/assets/img/gallery/gallery6.png);">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- gallery Products End -->
@endsection
