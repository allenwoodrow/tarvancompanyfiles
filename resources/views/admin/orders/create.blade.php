@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Create Order</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
        </div>
    @endif

    <form action="{{ route('admin.orders.store') }}" method="POST">
        @csrf

        <!-- User -->
        <div class="mb-3">
            <label for="user_id" class="form-label">User</label>
            <select name="user_id" id="user_id" class="form-select" required>
                <option value="">-- Choose User --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})</option>
                @endforeach
            </select>
        </div>

        <!-- Product -->
        <div class="mb-3">
            <label for="product_id" class="form-label">Product</label>
            <select name="product_id" id="product_id" class="form-select" required>
                <option value="">-- Choose Product --</option>
                @foreach($products as $product)
                    <option value="{{ $product->id }}">{{ $product->name }} (${{ number_format($product->price, 2) }})</option>
                @endforeach
            </select>
        </div>

        <!-- Quantity -->
        <div class="mb-3">
            <label for="quantity" class="form-label">Quantity</label>
            <input type="number" name="quantity" id="quantity" class="form-control" value="1" min="1" required>
        </div>

        <!-- Status -->
        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="pending">Pending</option>
                <option value="completed">Completed</option>
                <option value="cancelled">Cancelled</option>
            </select>
        </div>

        <!-- Billing Address -->
        <div class="mb-3">
            <label for="billing_address" class="form-label">Billing Address</label>
            <textarea name="billing_address" id="billing_address" class="form-control" rows="3">{{ old('billing_address') }}</textarea>
        </div>

        <!-- Shipping Address -->
        <div class="mb-3">
            <label for="shipping_address" class="form-label">Shipping Address</label>
            <textarea name="shipping_address" id="shipping_address" class="form-control" rows="3">{{ old('shipping_address') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Create Order</button>
    </form>
</div>
@endsection
