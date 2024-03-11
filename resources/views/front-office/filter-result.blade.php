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
                <div
                    style="display: flex;
                justify-content: space-between;
                align-items: center;
                gap: 10px;
            ">
                    <form action="{{ route('reserveTicket') }}" method="post">
                        @csrf
                        <input type="hidden" name="user_id" value="{{ session('id') }}">
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <button type="submit" class="btn btn-success btn-get-ticket"
                            style="    border-radius: 10px;
                        width: fit-content;
                        margin: 2px;">Get
                            Ticket</button>
                    </form>
                    <form action="{{ route('front-office.detail') }}" method="GET">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event->id }}">
                        <button type="submit" class=" btn-primary btn-details "
                            style="    border-radius: 10px;
                    width: fit-content;
                    margin: 2px;">
                            Details</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endforeach
