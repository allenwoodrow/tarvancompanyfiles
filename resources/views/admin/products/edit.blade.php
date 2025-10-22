@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">✏️ Edit Product</h2>

    <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="card mb-4">
            <div class="card-header">
                <h5>Product Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <!-- Name -->
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Product Name *</label>
                        <input type="text" name="name" id="name" 
                               class="form-control @error('name') is-invalid @enderror" 
                               value="{{ old('name', $product->name) }}" required>
                        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Category -->
                    <div class="col-md-6 mb-3">
                        <label for="category" class="form-label">Category *</label>
                        <select name="category" id="category" class="form-control @error('category') is-invalid @enderror" required>
                            <option value="">-- Select Category --</option>
                            <option value="T-shirts" {{ old('category', $product->category) == 'T-shirts' ? 'selected' : '' }}>T-shirts</option>
                            <option value="Shirts" {{ old('category', $product->category) == 'Shirts' ? 'selected' : '' }}>Shirts</option>
                            <option value="Jeans" {{ old('category', $product->category) == 'Jeans' ? 'selected' : '' }}>Jeans</option>
                            <option value="Jackets" {{ old('category', $product->category) == 'Jackets' ? 'selected' : '' }}>Jackets</option>
                            <option value="Sweaters" {{ old('category', $product->category) == 'Sweaters' ? 'selected' : '' }}>Sweaters</option>
                            <option value="Hoodies" {{ old('category', $product->category) == 'Hoodies' ? 'selected' : '' }}>Hoodies</option>
                            <option value="Activewear" {{ old('category', $product->category) == 'Activewear' ? 'selected' : '' }}>Activewear</option>
                            <option value="Polo Shirts" {{ old('category', $product->category) == 'Polo Shirts' ? 'selected' : '' }}>Polo Shirts</option>
                            <option value="Shorts" {{ old('category', $product->category) == 'Shorts' ? 'selected' : '' }}>Shorts</option>
                            <option value="Accessories" {{ old('category', $product->category) == 'Accessories' ? 'selected' : '' }}>Accessories</option>
                            <option value="Footwear" {{ old('category', $product->category) == 'Footwear' ? 'selected' : '' }}>Footwear</option>
                            <option value="Joggers" {{ old('category', $product->category) == 'Joggers' ? 'selected' : '' }}>Joggers</option>
                            <option value="Head wear" {{ old('category', $product->category) == 'Headwear' ? 'selected' : '' }}>Headwear</option>
                            <option value="Underwear" {{ old('category', $product->category) == 'Underwear' ? 'selected' : '' }}>Underwear</option>
                            <option value="Trouser" {{ old('category', $product->category) == 'trouser' ? 'selected' : '' }}>Trousers</option>
                            <option value="Socks" {{ old('category', $product->category) == 'Socks' ? 'selected' : '' }}>Socks</option>
                            <option value="Footwear" {{ old('category', $product->category) == 'Footwear' ? 'selected' : '' }}>Footwear</option>
                            <option value="Bag" {{ old('category', $product->category) == 'Bag' ? 'selected' : '' }}>Bag</option>
                            <!-- ... other categories ... -->
                        </select>
                        @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <div class="row">
                    <!-- Color -->
                    <div class="col-md-6 mb-3">
                        <label for="color" class="form-label">Color *</label>
                        <select name="color" id="color" class="form-control @error('color') is-invalid @enderror" required>
                            <option value="">-- Select Color --</option>
                            <option value="Black" {{ old('color', $product->color) == 'Black' ? 'selected' : '' }}>Black</option>
                            <option value="White" {{ old('color', $product->color) == 'White' ? 'selected' : '' }}>White</option>
                            <option value="Red" {{ old('color', $product->color) == 'Red' ? 'selected' : '' }}>Red</option>
                            <option value="Blue" {{ old('color', $product->color) == 'Blue' ? 'selected' : '' }}>Blue</option>
                            <option value="Green" {{ old('color', $product->color) == 'Green' ? 'selected' : '' }}>Green</option>
                            <option value="Yellow" {{ old('color', $product->color) == 'Yellow' ? 'selected' : '' }}>Yellow</option>
                            <option value="Pink" {{ old('color', $product->color) == 'Pink' ? 'selected' : '' }}>Pink</option>
                            <option value="Purple" {{ old('color', $product->color) == 'Purple' ? 'selected' : '' }}>Purple</option>
                            <option value="Orange" {{ old('color', $product->color) == 'Orange' ? 'selected' : '' }}>Orange</option>
                            <option value="Gray" {{ old('color', $product->color) == 'Gray' ? 'selected' : '' }}>Gray</option>
                            <option value="Brown" {{ old('color', $product->color) == 'Brown' ? 'selected' : '' }}>Brown</option>
                            <option value="Cyan" {{ old('color', $product->color) == 'Cyan' ? 'selected' : '' }}>Cyan</option>
                            <option value="Multi-color" {{ old('color', $product->color) == 'Multi-color' ? 'selected' : '' }}>Multi-color</option>
                            <!-- ... other colors ... -->
                        </select>
                        @error('color')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Size -->
                    <div class="col-md-6 mb-3">
                        <label for="size" class="form-label">Size *</label>
                        <select name="size" id="size" class="form-control @error('size') is-invalid @enderror" required>
                            <option value="">-- Select Size --</option>
                            <option value="XS" {{ old('size', $product->size) == 'XS' ? 'selected' : '' }}>XS</option>
                            <option value="S" {{ old('size', $product->size) == 'S' ? 'selected' : '' }}>S</option>
                            <option value="M" {{ old('size', $product->size) == 'M' ? 'selected' : '' }}>M</option>
                            <option value="L" {{ old('size', $product->size) == 'L' ? 'selected' : '' }}>L</option>
                            <option value="XL" {{ old('size', $product->size) == 'XL' ? 'selected' : '' }}>XL</option>
                            <option value="XXL" {{ old('size', $product->size) == 'XXL' ? 'selected' : '' }}>XXL</option>
                            <option value="XXXL" {{ old('size', $product->size) == 'XXXL' ? 'selected' : '' }}>XXXL</option>
                            <option value="XXXXL" {{ old('size', $product->size) == 'XXXXL' ? 'selected' : '' }}>XXXXL</option>
                            <!-- ... other sizes ... -->
                        </select>
                        @error('size')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description *</label>
                    <textarea name="description" id="description" rows="4" 
                              class="form-control @error('description') is-invalid @enderror" required>{{ old('description', $product->description) }}</textarea>
                    @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="row">
                    <!-- Stock -->
                    <div class="col-md-4 mb-3">
                        <label for="stock" class="form-label">Stock Quantity *</label>
                        <input type="number" name="stock" id="stock" 
                               class="form-control @error('stock') is-invalid @enderror" 
                               value="{{ old('stock', $product->stock) }}" required min="0">
                        @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Price -->
                    <div class="col-md-4 mb-3">
                        <label for="price" class="form-label">Price ($) *</label>
                        <input type="number" step="0.01" name="price" id="price" 
                               class="form-control @error('price') is-invalid @enderror" 
                               value="{{ old('price', $product->price) }}" required min="0">
                        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>

                    <!-- Old Price -->
                    <div class="col-md-4 mb-3">
                        <label for="old_price" class="form-label">Old Price ($) <small class="text-muted">(Optional)</small></label>
                        <input type="number" step="0.01" name="old_price" id="old_price" 
                               class="form-control @error('old_price') is-invalid @enderror" 
                               value="{{ old('old_price', $product->old_price) }}" min="0">
                        @error('old_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                </div>

                <!-- Image -->
                <div class="mb-3">
                    <label for="image" class="form-label">Product Image</label>
                    @if($product->image)
                        <div class="mb-2">
                            <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" style="max-width: 200px; height: auto;" class="img-thumbnail">
                            <br>
                            <small>Current image</small>
                        </div>
                    @endif
                    <input type="file" name="image" id="image" 
                           class="form-control @error('image') is-invalid @enderror" accept="image/*">
                    @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror>
                    <small class="form-text text-muted">Leave empty to keep current image</small>
                </div>
            </div>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-success">💾 Update Product</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">⬅ Back to Products</a>
        </div>
    </form>
</div>
@endsection