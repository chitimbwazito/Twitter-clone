@extends('layout.layout')
@section('content')
<div class='row'>
    <h1>Admin Panel</h1>
    <div class='col-md-14'>
        <div class='table-responsive'>
            <table class='table table-striped mt-3'>
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <a href="{{ route('admin.show-user', $user->id) }}"><i class='fa fa-user'></i></a>
                                <a href="{{ route('admin.edit-user', $user->id) }}"><i class='fa fa-edit'></i></a>
                                <form action="{{ route('admin.delete-user', $user->id) }}" method="POST">
                                    @csrf
                                    @method('Delete')
                                    <button type="submit">DELETE</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
