<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Event</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-3">
        <h1>Update Event</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('event.update', $event->id) }}" enctype="multipart/form-data">
            @csrf <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                    name="title" value="{{ old('title', $event->title) }}" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                    rows="3" required>{{ old('description', $event->description) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">Date</label>
                <input type="date" class="form-control @error('date') is-invalid @enderror" id="date"
                    name="date" value="{{ old('date', $event->date) }}" required>
            </div>

            <div class="mb-3">
                <label for="typeAccept" class="form-label">Type</label>
                <input type="text" class="form-control @error('typeAccept') is-invalid @enderror" id="typeAccept"
                    name="typeAccept" value="{{ old('typeAccept', $event->typeAccept) }}" required>
            </div>

            <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <input type="text" class="form-control @error('location') is-invalid @enderror" id="location"
                    name="location" value="{{ old('location', $event->location) }}" required>
            </div>

            <div class="mb-3">
                <label for="category_id" class="form-label">Category</label>
                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                    name="category_id" required>
                    <option value="">-- Select Category --</option>
                    <option value="1">Conference</option>
                    <option value="2">Workshop</option>
                    <option value="3">Meetup</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="places" class="form-label">Available Places</label>
                <input type="number" class="form-control @error('places') is-invalid @enderror" id="places"
                    name="places" min="1" value="{{ old('places', $event->places) }}" required>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">Event
