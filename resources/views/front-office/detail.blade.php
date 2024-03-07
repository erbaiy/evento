@extends('front-office.app.layout')
@section('content')
    <!-- About Law Start-->
    <section class="about-low-area section-padding2">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-12">
                    <div class="about-caption mb-50">
                        <!-- Section Tittle -->
                        <div class="section-tittle mb-35">

                            <h2>{{ $event->title }}</h2>
                        </div>
                        <p>{{ $event->description }}</p>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
                            <div class="single-caption mb-20">
                                <div class="caption-icon">
                                    <span class="flaticon-communications-1"></span>
                                </div>
                                <div class="caption">
                                    <h5>Where</h5>
                                    <p>{{ $event->location }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-10">
                            <div class="single-caption mb-20">
                                <div class="caption-icon">
                                    <span class="flaticon-education"></span>
                                </div>
                                <div class="caption">
                                    <h5>When</h5>
                                    <p>{{ $event->date }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <form action="{{ route('reserveTicket') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ session('id') }}">
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <button type="submit" class="btn btn-seccess">get ticket </button>
                    </form>
                </div>
                <div class="col-lg-6 col-md-12">
                    <!-- about-img -->
                    <div class="about-img ">
                        <div class="about-font-img d-none d-lg-block">
                            <img src="{{ $event->image }}" alt="" style="with: 200px; height: 200px;">
                        </div>
                        <div class="about-back-img ">
                            <img src="{{ $event->image }}" alt="" style="with: 250px; height: 340px;">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
