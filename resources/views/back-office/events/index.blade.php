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
                <th scope="col">image</th>
                <th scope="col">title</th>
                <th scope="col">location</th>
                <th scope="col">update</th>
                <th scope="col">delete</th>
            </tr>
        </thead>
        <tbody>

            <td>{{ $event->title }}</td>

            @foreach ($events as $event)
                <tr>
                    <td>
                        <img src="{{ $event->image }}" alt="">
                    </td>
                    <td>{{ $event->title }}</td>
                    <td>{{ $event->location }}</td>

                    <td>
                        <form action="{{ route('events.destroy', $event->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>

                    <td>

                        <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editemodale{{ $event->id }}">
                            edite
                        </button>

                        <div class="modal fade" id="editemodale{{ $event->id }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">new event</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        {{-- from start  --}}

                                        <form action="{{ route('event.update', $event->id) }}" method="POST"
                                            class="container" enctype="multipart/form-data">
                                            @csrf
                                            @method('put')

                                            <div class="mb-3">
                                                <label for="title" class="form-label">Title:</label>
                                                <input type="text" name="title" id="title"
                                                    value="{{ $event->title }}" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label class="btn btn-success">
                                                    <input name="image" type="file" />Add Image
                                                </label>
                                                @if ($errors->has('image'))
                                                    <span class="alert">
                                                        {{ $errors->first('image') }}
                                                    </span>
                                                @endif
                                                @if (old('image'))
                                                    <p>Previously uploaded image: {{ old('image') }}</p>
                                                @endif
                                            </div>

                                            <div class="mb-3">
                                                <label for="description" class="form-label">Description:</label>
                                                <textarea name="description" id="description" class="form-control">{{ old('description', $event->description) }}</textarea>
                                            </div>

                                            <div class="mb-3">
                                                <label for="date" class="form-label">Date:</label>
                                                <input type="date" name="date" id="date" class="form-control"
                                                    value="{{ old('date', $event->date) }}">
                                            </div>
                                            <div class="mb-3">
                                                <input type="hidden" name="user_id" id="user_id"
                                                    value="{{ session('id') }}" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label for="typeAccept" class="form-label">Type of Acceptance:</label>
                                                <select name="typeAccept" id="typeAccept" class="form-select">
                                                    <option value="auto"
                                                        @if ($event->typeAccept === 'auto') selected @endif>Automatic</option>
                                                    <option value="manuelle"
                                                        @if ($event->typeAccept === 'manuelle') selected @endif>manuelle</option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="location" class="form-label">Location:</label>
                                                <input type="text" name="location" id="location"
                                                    value="{{ $event->location }}" class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label for="category_id" class="form-label">Category:</label>
                                                <select name="category_id" id="category_id" class="form-select">
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}"
                                                            @if (old('category_id', $event->category_id) == $category->id) selected @endif>
                                                            {{ $category->title }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="places" class="form-label">Places:</label>
                                        <input type="number" name="places" id="places" class="form-control"
                                            value="{{ old('places', $event->places) }}">
                                    </div>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    </form>
                                    {{-- from end  --}}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary"
                                        data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                </div>
                            </div>
                        </div>
                        </div>
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
                            <input type="hidden" name="user_id" id="user_id" value="{{ session('id') }}"
                                class="form-control">
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
