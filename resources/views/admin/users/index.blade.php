@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Users</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th><th>Email</th><th>Phone</th><th>Primary Address</th><th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
            <tr>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>{{ $user->phone }}</td>
                <td>{{ $user->primary_address }}</td>
                <td>
                    <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-sm btn-warning">Edit</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
