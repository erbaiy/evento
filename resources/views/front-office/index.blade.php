@extends('front-office.app.layout')



@section('content')
    <div>

        {{-- <form id="searchForm" action="/events/search" method="POST">
            @csrf --}}
        <input type="text" id="search" name="search" placeholder="Search events">
        <button type="submit">Search</button>
        {{-- </form> --}}

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
            <div class="row" id="events-container" class="events-container">
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
@endsection

@section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('keyup', function(e) {
            e.preventDefault();
            let search_string = $('#search').val();
            console.log(search_string);

            // Perform search using AJAX
            // $.ajax({
            //     url: {{ route('search.event') }},
            //     method: 'GET',
            //     data: {
            //         search_string: search_string
            //     },
            //     success: function(res) {
            //         console.log(res);
            //         $('.events-container').html(res);
            //     }
            // });
        });
    </script>
@endsection
