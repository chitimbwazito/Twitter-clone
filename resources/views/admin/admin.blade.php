@extends('layout.layout')
@section('content')
<div class='row'>
    <h1>Admin Panel</h1>
    <div class='col-md-14'>
        <div class='table-responsive'>
            <table class='table table-bordered'>
                <thead>
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
                                <a href="{{ route('admin.delete-user', $user->id) }}"><i class='fa fa-trash'></i></a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
