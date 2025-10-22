<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }} - Fashion Store</title>
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
</head>
<body>

    <!-- Breadcrumb / Navigation -->
    <div class="breadcrumb_area">
        <div class="container">
            <ul class="breadcrumb_list">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>{{ $product->name }}</li>
            </ul>
        </div>
    </div>

    <!-- Product Details Section -->
    <div class="product_details_area mt-5 mb-5">
        <div class="container">
            <div class="row">
                <!-- Product Image -->
                <div class="col-md-6">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('assets/img/product/default.jpg') }}" 
                         alt="{{ $product->name }}" class="img-fluid rounded shadow-sm">
                </div>

                <!-- Product Info -->
                <div class="col-md-6">
                    <h2>{{ $product->name }}</h2>

                    <div class="price_box mb-3">
                        @if($product->old_price && $product->old_price > $product->price)
                            <span class="old_price text-muted">${{ number_format($product->old_price, 2) }}</span>
                        @endif
                        <span class="current_price fw-bold text-danger">${{ number_format($product->price, 2) }}</span>
                    </div>

                    <p class="mb-3">{{ $product->description }}</p>
                    <p class="text-muted">Stock: {{ $product->stock }}</p>

                    <!-- Add to Cart Form -->
                    <form action="{{ route('cart.add') }}" method="POST" class="mb-3">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="input-group" style="max-width: 200px;">
                            <input type="number" 
                                   name="quantity" 
                                   class="form-control" 
                                   value="1" 
                                   min="1" 
                                   max="{{ $product->stock }}" 
                                   required>
                            <button type="submit" class="btn btn-primary">🛒 Add to Cart</button>
                        </div>
                    </form>

                    <!-- Save for Later -->
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <input type="hidden" name="quantity" value="1">
                        <input type="hidden" name="save_for_later" value="1">
                        <button type="submit" class="btn btn-outline-secondary">❤️ Save for Later</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
