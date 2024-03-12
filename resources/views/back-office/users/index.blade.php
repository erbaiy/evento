@extends('back-office.app.layout')

@section('content')
    @if (session('seccess'))
        <div class="alert alert-success">{{ session('seccess') }}</div>
    @endif


    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        new user
    </button>
    <div class="table-responsive">

        <table class="container table table-striped">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>role</th>
                    <th>Edite</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td> {{ $user->email }} </td>
                        <td> {{ $user->role }} </td>
                        <td>
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $user->id }}">
                                Edite
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edite modale</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>

                                        <div class="modal-body">
                                            <form action="{{ route('user.update', $user->id) }}" method="post">
                                                @csrf
                                                @method('put')

                                                <div class="">
                                                    <label for="name">Name:</label>
                                                    <input type="text" name="name" id="name"
                                                        value="{{ $user->name }}" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email:</label>
                                                    <input type="email" name="email" id="email"
                                                        value="{{ $user->email }}" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="password">Password:</label>
                                                    <input type="password" name="password" id="password"
                                                        class="form-control" placeholder="enter the new password" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="role">Role:</label>
                                                    <select name="role" id="role" class="form-select">
                                                        <option value="admin"
                                                            @if ($user->role === 'admin') selected @endif>admin
                                                        </option>
                                                        <option value="user"
                                                            @if ($user->role === 'user') selected @endif>user
                                                        </option>
                                                        <option value="organizer"
                                                            @if ($user->role === 'organizer') selected @endif>organizer
                                                        </option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save</button>

                                            </form>

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

                        </td>

                        <td>
                            <form action="{{ route('user.destroy', $user->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="id" value="{{ $user->id }}" id="">
                                <button class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach

                <!-- Add more rows as needed -->
            </tbody>
        </table>
        <!-- Display pagination links -->
        <div class="pagination">
            {{ $users->links('pagination::bootstrap-4') }}
        </div>
    </div>



    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">New user</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('user.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">Name:</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email:</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password:</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="role">Role:</label>
                            <select name="role" id="role" class="form-control" required>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                                <option value="organizer">Organizer</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
