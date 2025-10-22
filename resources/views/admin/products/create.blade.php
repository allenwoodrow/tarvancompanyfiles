@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">➕ Add New Product</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" id="product-form">
        @csrf

        <!-- Basic Product Information -->
        <div class="card mb-4">
            <div class="card-header">
                <h5>Basic Product Information</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="name" class="form-label">Product Name *</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="category" class="form-label">Category *</label>
                        <select name="category" id="category" class="form-control" required>
                            <option value="">-- Select Category --</option>
                            @foreach(['T-shirts', 'Shirts', 'Polo Shirts', 'Sweaters', 'Hoodies', 'Jackets', 'Joggers', 'Shorts', 'Jeans', 'Trousers', 'Underwear', 'Head Gear', 'Bags', 'Accessories', 'Footwear'] as $category)
                                <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Description *</label>
                    <textarea name="description" id="description" rows="4" class="form-control" required>{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="price" class="form-label">Base Price ($) *</label>
                        <input type="number" step="0.01" name="price" id="price" class="form-control" value="{{ old('price') }}" required min="0">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="old_price" class="form-label">Old Price ($) <small class="text-muted">(Optional)</small></label>
                        <input type="number" step="0.01" name="old_price" id="old_price" class="form-control" value="{{ old('old_price') }}" min="0">
                    </div>
                </div>

                <div class="mb-3">
                    <label for="image" class="form-label">Main Product Image *</label>
                    <input type="file" name="image" id="image" class="form-control" accept="image/*" required>
                </div>
            </div>
        </div>

        <!-- Variant Management -->
        <div class="card mb-4">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5>Product Variants</h5>
                <button type="button" class="btn btn-sm btn-primary" id="add-variant-btn">➕ Add Variant</button>
            </div>
            <div class="card-body">
                <div id="variants-container">
                    <!-- Variants will be added here -->
                </div>
            </div>
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-success">💾 Save Product</button>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">⬅ Back</a>
        </div>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    let variantCount = 0;
    const variantsContainer = document.getElementById('variants-container');
    const addVariantBtn = document.getElementById('add-variant-btn');

    function addVariant() {
        const variantHtml = `
            <div class="variant-item border rounded p-3 mb-3">
                <div class="row">
                    <div class="col-md-3">
                        <label class="form-label">Color *</label>
                        <select name="variants[${variantCount}][color]" class="form-control" required>
                            <option value="">-- Select Color --</option>
                            @foreach(['Black', 'White', 'Red', 'Blue', 'Green', 'Yellow', 'Purple', 'Orange', 'Pink', 'Brown', 'Gray', 'Navy', 'Beige', 'Multi-color'] as $color)
                                <option value="{{ $color }}">{{ $color }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Size *</label>
                        <select name="variants[${variantCount}][size]" class="form-control" required>
                            <option value="">-- Select Size --</option>
                            @foreach(['XS', 'S', 'M', 'L', 'XL', 'XXL', 'XXXL', 'One Size'] as $size)
                                <option value="{{ $size }}">{{ $size }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Stock *</label>
                        <input type="number" name="variants[${variantCount}][stock]" class="form-control" value="0" min="0" required>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Price ($) <small class="text-muted">(Optional)</small></label>
                        <input type="number" step="0.01" name="variants[${variantCount}][price]" class="form-control" min="0" placeholder="Uses base price if empty">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">Actions</label>
                        <button type="button" class="btn btn-sm btn-danger remove-variant">🗑 Remove</button>
                    </div>
                </div>
            </div>
        `;
        
        variantsContainer.insertAdjacentHTML('beforeend', variantHtml);
        variantCount++;
    }

    addVariantBtn.addEventListener('click', addVariant);

    variantsContainer.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-variant')) {
            if (variantsContainer.querySelectorAll('.variant-item').length > 1) {
                e.target.closest('.variant-item').remove();
            } else {
                alert('At least one variant is required.');
            }
        }
    });

    // Add first variant by default
    addVariant();
});
</script>

<style>
.variant-item {
    background-color: #f8f9fa;
}
</style>
@endsection
