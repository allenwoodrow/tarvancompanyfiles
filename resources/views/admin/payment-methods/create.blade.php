@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Create Payment Method</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.payment-methods.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">Method Name</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>

        <div class="mb-3">
            <label for="account_name" class="form-label">Account Name / Email</label>
            <input type="text" class="form-control" name="account_name" id="account_name">
        </div>

        <div class="mb-3">
            <label for="account_email" class="form-label">Account Email</label>
            <input type="email" class="form-control" name="account_email" id="account_email">
        </div>

        <div class="mb-3">
            <label for="account_number" class="form-label">Account Number</label>
            <input type="text" class="form-control" name="account_number" id="account_number">
        </div>

        <div class="mb-3">
            <label for="bank_name" class="form-label">Bank / Payment Platform</label>
            <input type="text" class="form-control" name="bank_name" id="bank_name">
        </div>

        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" name="status" id="status" value="1" checked>
            <label class="form-check-label" for="status">Active</label>
        </div>

        <button type="submit" class="btn btn-primary">Create</button>
    </form>
</div>
@endsection
