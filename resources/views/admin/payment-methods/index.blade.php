@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Payment Methods</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.payment-methods.create') }}" class="btn btn-primary mb-3">Add New Payment Method</a>

    <table class="table table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Method Name</th>
                <th>Account Name / Email</th>
                <th>Account Email</th>
                <th>Account Number</th>
                <th>Bank / Platform</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($paymentMethods as $method)
            <tr>
                <td>{{ $method->id }}</td>
                <td>{{ $method->name }}</td>
                <td>{{ $method->account_name ?? '-' }}</td>
                <td>{{ $method->account_email ?? '-' }}</td>
                <td>{{ $method->account_number ?? '-' }}</td>
                <td>{{ $method->bank_name ?? '-' }}</td>
                <td>
                    @if($method->status)
                        <span class="badge bg-success">Active</span>
                    @else
                        <span class="badge bg-secondary">Inactive</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.payment-methods.edit', $method->id) }}" class="btn btn-sm btn-warning">Edit</a>

                    <form action="{{ route('admin.payment-methods.destroy', $method->id) }}" method="POST" class="d-inline-block" onsubmit="return confirm('Are you sure you want to delete this method?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8" class="text-center">No payment methods found.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
