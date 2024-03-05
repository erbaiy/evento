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
                    <td>{{ $event->title }}</td>
                    <td> <img src="{{ $event->image }}" class="w-10" alt=""></td>
                    <form action="{{ route('eventAction') }}" method="POST">
                        @csrf
                        <td><input type="hidden" name="id" value="{{ $event->id }}"></td>
                        <td>

                            <button type="submit" class="btn btn-success" name="valide" value="valide">accept</button>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-danger" name="invalide" value="invalide">refuse</button>
                    </form>
                    </td>
                </tr>
            @endforeach

        </tbody>
    </table>
@endsection
