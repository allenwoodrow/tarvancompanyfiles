@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Admin Dashboard</h1>

    {{-- Quick Links --}}
    <div class="row mb-4">
        <div class="col-md-3">
            <a href="{{ route('admin.users.index') }}" class="btn btn-primary w-100">Manage Users</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.orders.index') }}" class="btn btn-success w-100">Manage Orders</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.payments.index') }}" class="btn btn-warning w-100">Manage Payments</a>
        </div>
        <div class="col-md-3">
            <a href="{{ route('admin.products.index') }}" class="btn btn-info w-100">Manage Products</a>
        </div>
    </div>

    {{-- Summary Stats --}}
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Users</h5>
                    <p class="card-text fs-4">{{ $totalUsers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Products</h5>
                    <p class="card-text fs-4">{{ $totalProducts }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-dark mb-3 shadow">
                <div class="card-body">
                    <h5 class="card-title">Total Orders</h5>
                    <p class="card-text fs-4">{{ $totalOrders }}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
