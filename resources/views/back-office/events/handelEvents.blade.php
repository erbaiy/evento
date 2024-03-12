@extends('back-office.app.layout')

@section('content')
    <div class="table-responsive">

        <table class=" table table-striped">
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

                        <form action="{{ route('eventAction') }}" method="POST">
                            @csrf
                            <input type="hidden" name="id" value="{{ $event->id }}">
                            <td>

                                <button type="submit" class="btn btn-success" name="valide" value="valide">accept</button>
                            </td>
                            <td>
                                <button type="submit" class="btn btn-danger" name="invalide"
                                    value="invalide">refuse</button>
                        </form>
                        </td>
                    </tr>
                @endforeach

            </tbody>
        </table>
        <!-- Display pagination links -->
        <div class="pagination">
            {{-- {{ $events->links('pagination::bootstrap-4') }} --}}
        </div>
    </div>
@endsection
