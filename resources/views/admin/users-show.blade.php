@extends('layout.layout')
@section('content')
<div class="container mt-4">
    <h1>User Details</h1>

    <!-- Back button to go back to user list -->
    <a href="{{ route('admin.dashboard') }}" class="btn btn-primary mb-3">Back to Users List</a>

    <!-- Displaying User Details -->
    <div class="card">
        <div class="card-header">
            <h2>{{ $user->name }} (User ID: {{ $user->id }})</h2>
        </div>
        <div class="card-body">
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <th>Name:</th>
                        <td>{{ $user->name }}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{{ $user->email }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            <!-- Buttons for admin actions -->
            <a href="" class="btn btn-warning">Edit User</a>
            <form action="" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this user?');">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete User</button>
            </form>
        </div>
    </div>
</div>
@endsection
