@extends('back-office.app.layout')


@section('content')
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>

        <script>
            setTimeout(function() {
                window.location.href = "{{ route('event.index') }}";
            }, 20000); // 20 seconds
        </script>
    @endif
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        new event
    </button>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">title</th>
                <th scope="col">places</th>
                <th scope="col">update</th>
                <th scope="col">delete</th>
            </tr>
        </thead>
        <tbody>

            @foreach ($events as $event)
                <tr>
                    <th scope="row">1</th>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->places }}</td>
                    <td>
                        <a type="button" class="btn btn-success">Success</a>
                    </td>
                    <td>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">new event</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- from start  --}}

                    <form action="{{ route('events.store') }}" method="POST" class="container"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Title:</label>
                            <input type="text" name="title" id="title" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="btn btn-success">
                                <input name="image" type="file" />Add Image</label>
                            @if ($errors->has('image'))
                                <span class="alert">
                                    {{ $errors->first('image') }}
                                </span>
                            @endif
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description:</label>
                            <textarea name="description" id="description" class="form-control"></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="date" class="form-label">Date:</label>
                            <input type="date" name="date" id="date" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="user_id" class="form-label">User:</label>
                            <input type="hidden" name="user_id" id="user_id" value="1" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status:</label>
                            <select name="status" id="status" class="form-select">
                                <option value="valide">Valid</option>
                                <option value="invalide">Invalid</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="typeAccept" class="form-label">Type of Acceptance:</label>
                            <select name="typeAccept" id="typeAccept" class="form-select">
                                <option value="auto">Automatic</option>
                                <option value="manuelle">Manual</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location:</label>
                            <input type="text" name="location" id="location" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label for="category_id" class="form-label">Category:</label>
                            <select name="category_id" id="category_id" class="form-select">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->title }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="places" class="form-label">Places:</label>
                            <input type="number" name="places" id="places" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                    {{-- from end  --}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
