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
            @foreach ($reservations as $reservation)
                <tr>
                    <td>{{ $reservation->user_id }}</td>
                    <td>{{ $reservation->event_id }}</td>
                    <td>
                        <form action="{{ route('reservation.accept') }}" method="POST">
                            @csrf
                            <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                            <input type="hidden" name="action" value="accepted">
                            <button type="submit" class="btn btn-seccess">accept revert
                            </button>
                        </form>
                    </td>
                    <td>
                        {{-- <form action="{{ route('reservation.refuse') }}" method="POST">
                            @csrf --}}
                        <input type="hidden" name="reservation_id" value="{{ $reservation->id }}">
                        <input type="hidden" name="action" value="refuse">
                        <button type="submit" class="btn btn-danger">refuse revert
                        </button>
                        {{-- </form> --}}
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
