@extends('back-office.app.layout')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">title</th>
                <th scope="col">accept</th>
                <th scope="col">refuse</th>
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
@endsection
