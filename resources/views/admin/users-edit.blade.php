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
                        <tr>
                            <form action="{{route('admin.update-user', $user->id)}}" method="POST">
                                @csrf
                                @method('PUT')
                            <td>{{ $user->id }}</td>
                            <td><input type="text" name="name" id="name" value="{{ $user->name }}"></td>
                            <td><input type="text" name="email" id="email" value="{{ $user->email }}"></td>
                            <td>
                                <button type="submit">UPDATE</button>
                            </form>
                        </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
