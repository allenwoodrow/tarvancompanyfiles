@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>My Wishlist</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered align-middle">
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price ($)</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($wishlist as $id => $item)
            <tr>
                <td><img src="{{ $item['image'] }}" width="60"></td>
                <td>{{ $item['name'] }}</td>
                <td>${{ number_format($item['price'], 2) }}</td>
                <td>
                    <form action="{{ route('wishlist.remove', $id) }}" method="POST">
                        @csrf @method('DELETE')
                        <button class="btn btn-danger btn-sm">Remove</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="4" class="text-center">No items in wishlist</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
