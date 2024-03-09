@foreach ($events as $event)
    <div class="col-xl-6 col-lg-6 col-md-6">
        <div class="home-blog-single mb-30">
            <div class="blog-img-cap">
                <div class="blog-img">
                    <img src="{{ $event->image }}" alt="">
                    <div class="blog-date text-center">
                        <span>{{ $event->places }}</span>
                        <p>places</p>
                    </div>
                </div>
                <div class="blog-cap">
                    <h3><a href="blog_details.html">{{ $event->title }}</a></h3>
                </div>
                <form action="{{ route('reserveTicket') }}" method="post">
                    @csrf
                    <input type="hidden" name="user_id" value="{{ session('id') }}">
                    <input type="hidden" name="event_id" value="{{ $event->id }}">
                    <button type="submit" class="btn btn-success">Get Ticket</button>
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
