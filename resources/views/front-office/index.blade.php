@extends('front-office.app.layout')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        {{-- <div class="wrap">
            <div class="search">
                <input type="text" id="search" name="search" class="searchTerm" placeholder="What are you looking for?">
                <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                </button>
            </div>
        </div>

        <div class="col-md-6">
            <form action="{{ route('events.filter') }}" method="GET">
                <select name="category">
                    <option value="">All Categories</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->title }}</option>
                    @endforeach
                </select>
                <button type="submit">Filter by Category</button>
            </form>
        </div> --}}
        <div>
            <div class="row">
                <div class="col-md-6">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="textsearch" placeholder="Search" aria-label="Search"
                            aria-describedby="basic-addon2">
                        <div class="input-group-append">
                            <span class="input-group-text" style="cursor: pointer"><i class="bi bi-search"></i></span>
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <select id="category-select" class="form-control" style="cursor: pointer">
                            <option value="0" selected>Select category</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>


    </div>

    <section class="home-blog-area section-padding30">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-5 col-md-8">
                    <div class="section-tittle text-center mb-50">
                        <h2>News From Blog</h2>
                        <p>There are many variations of passages of sorem gp ilable, but the majority have ssorem gp
                            iluffe.</p>
                    </div>
                </div>
            </div>
            <div class="row events-container" id="events-container">
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

            </div>
            <div class="pagination">
                {{ $events->links('pagination::bootstrap-4') }}
            </div>
        </div>

    </section>
    </div>
@endsection

{{-- @section('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search').on('keyup', function(e) {
                e.preventDefault();
                let search_string = $(this).val();
                console.log(search_string);

                // Perform search using AJAX
                $.ajax({
                    url: "/events/search",
                    method: 'GET',
                    data: {
                        search_string: search_string
                    },
                    success: function(res) {
                        console.log(res);
                        $('.events-container').html(res);
                    }
                });
            });

            // Initial load to display all data
            $.ajax({
                url: "/events/search",
                method: 'GET',
                success: function(res) {
                    console.log(res);
                    $('.events-container').html(res);
                }
            });
        });
    </script>
@endsection --}}
{{-- @section('filter')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#category').on('change', function() {
                var category = $(this).val();

                $.ajax({
                    url: "{{ route('events.filter') }}",
                    type: 'GET',
                    data: {
                        'category': category
                    },
                    success: function(data) {
                        var events = data.events;
                        var html = "";
                        if (events.length) {
                            for (let i = 0; i < events.length; i++) {
                                html += `
                                    <div class="col-xl-6 col-lg-6 col-md-6">
                                        <div class="home-blog-single mb-30">
                                            <div class="blog-img-cap">
                                                <div class="blog-img">
                                                    <img src="${events[i].image}" alt="">
                                                    <div class="blog-date text-center">
                                                        <span>${events[i].places}</span>
                                                        <p>places</p>
                                                    </div>
                                                </div>
            
                                                <div class="blog-cap">
                                                    <h3><a href="blog_details.html">${events[i].title}</a></h3>
                                                </div>
                                                <div style="display: flex; justify-content: space-between; align-items: center; gap: 10px;">
                                                    <form action="{{ route('reserveTicket') }}" method="post">
                                                        @csrf
                                                        <input type="hidden" name="user_id" value="{{ session('id') }}">
                                                        <input type="hidden" name="event_id" value="${events[i].id}">
                                                        <button type="submit" class="btn btn-success btn-get-ticket" style="border-radius: 10px; width: fit-content; margin: 2px;">Get Ticket</button>
                                                    </form>
                                                    <form action="{{ route('front-office.detail') }}" method="GET">
                                                        @csrf
                                                        <input type="hidden" name="event_id" value="${events[i].id}">
                                                        <button type="submit" class=" btn-primary btn-details" style="border-radius: 10px; width: fit-content; margin: 2px;">Details</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            }
                        } else {
                            html += `<tr>
                                <td>No Events found</td>
                            </tr>`;
                        }

                        $('#result').html(html);
                        console.log(data);
                    },
                    error: function(xhr, status, error) {
                        console.log(xhr.responseText);
                    }
                });
            });
        });
    </script>
@endsection --}}

<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/masonry.pkgd.min.js'></script>
<script type='text/javascript' src='js/jquery.collapsible.min.js'></script>
<script type='text/javascript' src='js/swiper.min.js'></script>
<script type='text/javascript' src='js/jquery.countdown.min.js'></script>
<script type='text/javascript' src='js/circle-progress.min.js'></script>
<script type='text/javascript' src='js/jquery.countTo.min.js'></script>
<script type='text/javascript' src='js/custom.js'></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXxZ8SCZFbbFI1vUB4=" crossorigin="anonymous"></script>


@section('scripts')
    <script>
        jQuery(document).ready(function($) {
            function handleSearch() {
                var categoryId = $('#category-select').val();
                var textsearch = $('#textsearch').val();

                if (textsearch == "") {
                    textsearch = 0;
                }

                console.log(textsearch);
                if (categoryId) {
                    $.ajax({
                        url: '/categories/' + categoryId + '/events/' + textsearch,
                        type: 'GET',
                        dataType: 'html',
                        success: function(eventsHtml) {
                            $('#events-container').html(eventsHtml);
                        },
                        error: function(xhr, status, error) {
                            console.error(xhr.responseText);
                        }
                    });
                } else {
                    console.error('No category data found');
                }
            }

            $('#category-select').change(handleSearch);
            $('#textsearch').on('input', handleSearch);
        });
    </script>
@endsection
