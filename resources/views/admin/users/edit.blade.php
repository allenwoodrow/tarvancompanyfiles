@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Edit User</h2>
    <form action="{{ route('admin.users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}">
        </div>

        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}">
        </div>

        <div class="mb-3">
            <label>Phone</label>
            <input type="text" name="phone" class="form-control" value="{{ old('phone', $user->phone) }}">
        </div>

        <div class="mb-3">
            <label>Primary Address</label>
            <input type="text" name="primary_address" class="form-control" value="{{ old('primary_address', $user->primary_address) }}">
        </div>

        <div class="mb-3">
            <label>Secondary Address</label>
            <input type="text" name="secondary_address" class="form-control" value="{{ old('secondary_address', $user->secondary_address) }}">
        </div>

        <button type="submit" class="btn btn-success">Update User</button>
    </form>
</div>
@endsection
