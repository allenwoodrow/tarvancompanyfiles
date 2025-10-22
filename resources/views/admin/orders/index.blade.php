@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Orders</h2>
    <a href="{{ route('admin.orders.create') }}" class="btn btn-primary mb-3">➕ New Order</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th>#</th>
                <th>User</th>
                <th>Product</th>
                <th>Quantity</th>
                <th>Total ($)</th>
                <th>Status</th>
                <th>Payment</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ $order->user ? $order->user->name : 'N/A' }}</td>
                <td>{{ $order->product ? $order->product->name : 'N/A' }}</td>
                <td>{{ $order->quantity }}</td>
                <td>${{ number_format($order->total, 2) }}</td>
                <td>{{ ucfirst($order->status) }}</td>
                <td>
                    @if($order->payment)
                        <span class="badge bg-success">Paid</span>
                    @else
                        <span class="badge bg-warning">Unpaid</span>
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-sm btn-warning">✏ Edit</a>
                    <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline">
                        @csrf @method('DELETE')
                        <button class="btn btn-sm btn-danger" onclick="return confirm('Delete order?')">🗑 Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="8" class="text-center">No orders found</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection