@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Record Payment</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.payments.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="order_id" class="form-label">Select Order</label>
            <select name="order_id" id="order_id" class="form-select" required>
                <option value="">-- Choose Order --</option>
                @foreach($orders as $order)
                    <option value="{{ $order->id }}">
                        Order #{{ $order->id }} - {{ $order->user->name }} - {{ $order->total_amount }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount ($)</label>
            <input type="number" name="amount" id="amount" class="form-control" step="0.01" min="0" required>
        </div>

        <div class="mb-3">
            <label for="method" class="form-label">Payment Method</label>
            <select name="method" id="method" class="form-select" required>
                <option value="Bank Transfer">Bank Transfer</option>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="cash_on_delivery">Cash on Delivery</option>
                <option value="Crypto">Crypto</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="failed">Failed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Record Payment</button>
    </form>
</div>
@endsection
