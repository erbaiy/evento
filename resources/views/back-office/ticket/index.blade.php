@extends('back-office.app.layout')

@section('content')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">event</th>
                <th scope="col">user</th>
                <th scope="col">accept revert </th>
                <th scope="col">refuse revert</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tickets as $ticket)
                <tr>
                    <td>{{ $ticket->ticket }}</td>
                    <td>{{ $event->token }}</td>
                    <td>
                        <a type="button" class="btn btn-success">accept revert
                        </a>
                    </td>
                    <td>
                        {{-- <form action="{{ route('events.destroy', $event->id) }}" method="POST"> --}}
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">refuse revert
                        </button>
                        {{-- </form> --}}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
