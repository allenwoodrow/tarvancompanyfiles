@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Payments</h2>
    <a href="{{ route('admin.payments.create') }}" class="btn btn-primary mb-3">➕ Record Payment</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>Order</th>
                <th>User</th>
                <th>Amount ($)</th>
                <th>Method</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($payments as $payment)
            <tr>
                <td>{{ $payment->id }}</td>
                <td>#{{ $payment->order->id }}</td>
                <td>{{ $payment->order->user->name }}</td>
                <td>${{ number_format($payment->amount, 2) }}</td>
                <td>{{ ucfirst($payment->method) }}</td>
                <td>{{ ucfirst($payment->status) }}</td>
                <td>
                    <a href="{{ route('admin.payments.edit', $payment) }}" class="btn btn-sm btn-warning">✏ Edit</a>
                    <form action="{{ route('admin.payments.destroy', $payment) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete payment?')">🗑 Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7" class="text-center">No payments found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
