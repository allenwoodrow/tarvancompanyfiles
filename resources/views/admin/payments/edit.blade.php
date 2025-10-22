@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Edit Payment #{{ $payment->id }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.payments.update', $payment->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="order_id" class="form-label">Select Order</label>
            <select name="order_id" id="order_id" class="form-select" required>
                @foreach($orders as $order)
                    <option value="{{ $order->id }}" {{ $payment->order_id == $order->id ? 'selected' : '' }}>
                        Order #{{ $order->id }} - {{ $order->user->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amount" class="form-label">Amount ($)</label>
            <input type="number" name="amount" id="amount" class="form-control" step="0.01" min="0" value="{{ $payment->amount }}" required>
        </div>

        <div class="mb-3">
            <label for="method" class="form-label">Payment Method</label>
            <input type="text" name="method" id="method" class="form-control" value="{{ $payment->method }}" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="pending" {{ $payment->status == 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $payment->status == 'completed' ? 'selected' : '' }}>Completed</option>
                <option value="failed" {{ $payment->status == 'failed' ? 'selected' : '' }}>Failed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update Payment</button>
    </form>
</div>
@endsection
