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

    {{-- jdhqlhm --}}
    <div class="container">

        <div class="wrap">
            <div class="search">
                <input type="text" id="search" name="search" class="searchTerm" placeholder="What are you looking for?">
                <button type="submit" class="searchButton">
                    <i class="fa fa-search"></i>
                </button>
            </div>


        </div>

        <div class="col-md-6">
            <select name="category" id="filter" class="form-control">
                <option value="">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                @endforeach
            </select>
        </div>
        {{-- drop down end --}}


        <section class="home-blog-area section-padding30">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-5 col-md-8">
                        <div class="section-tittle text-center mb-50">
                            <h2>News From Blog</h2>
                            <p>There are many variations of passages of sorem gp ilable, but the majority have ssorem gp
                                iluffe.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row events-container">
                    {{-- Placeholder for search results --}}
                </div>
            </div>
        </section>
    @endsection

    @section('scripts')
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
    @endsection
    @section('filter')
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

        <script>
            $(document).ready(function() {
                $('#filter').on('change', function(e) {
                    e.preventDefault();
                    let category_id = $(this).val();

                    // Perform search using AJAX
                    $.ajax({
                        url: "/events/filter",
                        method: 'GET',
                        data: {
                            category_id: category_id
                        },
                        success: function(res) {
                            console.log(res);
                            $('.events-container').html(res);
                        }
                    });
                });

                // Initial load to display all data
                $.ajax({
                    url: "/events/filter",
                    method: 'GET',
                    success: function(res) {
                        console.log(res);
                        $('.events-container').html(res);
                    }
                });
            });
        </script>
    @endsection
