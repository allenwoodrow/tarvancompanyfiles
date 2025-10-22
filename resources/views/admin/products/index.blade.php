@extends('layouts.admin')

@section('content')
<div class="container-fluid mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="mb-0">Products Management</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Add New Product
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Filters and Search -->
    <div class="card mb-4">
        <div class="card-body">
            <div class="row g-3">
                <div class="col-md-6">
                    <input type="text" id="searchInput" class="form-control" placeholder="Search products by name...">
                </div>
                <div class="col-md-4">
                    <select id="stockFilter" class="form-select">
                        <option value="">All Stock Status</option>
                        <option value="in_stock">In Stock</option>
                        <option value="low_stock">Low Stock</option>
                        <option value="out_of_stock">Out of Stock</option>
                    </select>
                </div>
                <div class="col-md-2">
                    <button id="resetFilters" class="btn btn-outline-secondary w-100">Reset Filters</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card">
        <div class="card-body">
            @if($products->count() > 0)
            <div class="table-responsive">
                <table class="table table-hover" id="productsTable">
                    <thead class="table-light">
                        <tr>
                            <th width="80px">Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Variants</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <!-- <th>Status</th> -->
                            <th width="150px">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr>
                            <td>
                                <div class="product-image-container">
                                    @if($product->image)
                                        <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" 
                                             class="product-image" data-bs-toggle="modal" data-bs-target="#imageModal{{ $product->id }}">
                                    @else
                                        <div class="d-flex align-items-center justify-content-center h-100 bg-light">
                                            <i class="fas fa-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                                
                                <!-- Image Modal -->
                                @if($product->image)
                                <div class="modal fade" id="imageModal{{ $product->id }}" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">{{ $product->name }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body text-center">
                                                <img src="{{ asset($product->image) }}" alt="{{ $product->name }}" class="img-fluid">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-semibold">{{ $product->name }}</div>
                                <small class="text-muted">SKU: {{ $product->sku ?? 'N/A' }}</small>
                            </td>
                            <td>
                                <span class="badge bg-secondary">{{ $product->category }}</span>
                            </td>
                            <td>
                                @if($product->variants && $product->variants->count() > 0)
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" 
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                            {{ $product->variants->count() }} Variants
                                        </button>
                                        <ul class="dropdown-menu">
                                            @foreach($product->variants as $variant)
                                                <li class="dropdown-item-text">
                                                    <small>
                                                        <span class="badge bg-light text-dark">{{ $variant->color ?? 'N/A' }}</span>
                                                        <span class="badge bg-light text-dark">{{ $variant->size ?? 'N/A' }}</span>
                                                        <span class="text-muted">({{ $variant->stock ?? 0 }} in stock)</span>
                                                    </small>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @else
                                    <span class="text-muted">No variants</span>
                                @endif
                            </td>
                            <td>
                                <div>
                                    @if($product->old_price && $product->old_price > $product->price)
                                        <span class="text-danger"><del>${{ number_format($product->old_price, 2) }}</del></span>
                                    @endif
                                    <span class="fw-bold">${{ number_format($product->price, 2) }}</span>
                                </div>
                            </td>
                            <td>
                                @php
                                    // Calculate total stock including variants
                                    $totalStock = $product->stock;
                                    if ($product->variants && $product->variants->count() > 0) {
                                        $totalStock += $product->variants->sum('stock');
                                    }
                                    
                                    $stockStatus = $totalStock > 10 ? 'success' : ($totalStock > 0 ? 'warning' : 'danger');
                                    $stockText = $totalStock > 10 ? 'In Stock' : ($totalStock > 0 ? 'Low Stock' : 'Out of Stock');
                                @endphp
                                <span class="badge bg-{{ $stockStatus }}">
                                    {{ $totalStock }}
                                </span>
                                <small class="d-block text-muted">{{ $stockText }}</small>
                            </td>
                            <!-- <td>
                                <div class="form-check form-switch">
                                    <input class="form-check-input status-toggle" type="checkbox" 
                                           data-product-id="{{ $product->id }}"
                                           {{ $product->status ? 'checked' : '' }}>
                                    <label class="form-check-label">{{ $product->status ? 'Active' : 'Inactive' }}</label>
                                </div>
                            </td> -->
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                                       class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    @if(route('admin.products.index'))
                                    <a href="{{ route('admin.products.index', $product->id) }}" 
                                       class="btn btn-sm btn-outline-info" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @endif
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" 
                                                onclick="return confirm('Are you sure you want to delete this product?')" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Simple Pagination Info (without pagination links) -->
            <div class="d-flex justify-content-between align-items-center mt-3">
                <div class="text-muted">
                    Showing {{ $products->count() }} product(s)
                </div>
            </div>
            
            @else
            <div class="text-center py-5">
                <i class="fas fa-box-open fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">No products found</h4>
                <p class="text-muted">Get started by adding your first product.</p>
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary mt-2">
                    <i class="fas fa-plus"></i> Add New Product
                </a>
            </div>
            @endif
        </div>
    </div>
</div>

<style>
.product-image-container {
    width: 60px;
    height: 60px;
    overflow: hidden;
    border-radius: 4px;
    border: 1px solid #e0e0e0;
}

.product-image {
    width: 100%;
    height: 100%;
    object-fit: cover;
    cursor: pointer;
    transition: transform 0.3s;
}

.product-image:hover {
    transform: scale(1.05);
}

.table th {
    border-top: none;
    font-weight: 600;
}

.btn-group .btn {
    border-radius: 4px !important;
    margin-right: 2px;
}

.status-toggle {
    cursor: pointer;
}

.dropdown-menu {
    max-height: 200px;
    overflow-y: auto;
}

.bg-secondary {
    background-color: #6c757d !important;
}
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Search functionality
    const searchInput = document.getElementById('searchInput');
    const stockFilter = document.getElementById('stockFilter');
    const resetFilters = document.getElementById('resetFilters');
    const productsTable = document.getElementById('productsTable');
    
    if (productsTable) {
        const rows = productsTable.getElementsByTagName('tbody')[0].getElementsByTagName('tr');
        
        function filterProducts() {
            const searchTerm = searchInput.value.toLowerCase();
            const stockValue = stockFilter.value;
            
            for (let row of rows) {
                const name = row.cells[1].textContent.toLowerCase();
                const stockText = row.cells[5].textContent.toLowerCase();
                
                const nameMatch = name.includes(searchTerm);
                let stockMatch = true;
                
                if (stockValue === 'in_stock') {
                    stockMatch = stockText.includes('in stock');
                } else if (stockValue === 'low_stock') {
                    stockMatch = stockText.includes('low stock');
                } else if (stockValue === 'out_of_stock') {
                    stockMatch = stockText.includes('out of stock');
                }
                
                row.style.display = (nameMatch && stockMatch) ? '' : 'none';
            }
        }
        
        if (searchInput) searchInput.addEventListener('input', filterProducts);
        if (stockFilter) stockFilter.addEventListener('change', filterProducts);
        
        if (resetFilters) {
            resetFilters.addEventListener('click', function() {
                searchInput.value = '';
                stockFilter.selectedIndex = 0;
                filterProducts();
            });
        }
    }
    
    // Status toggle functionality
    // const statusToggles = document.querySelectorAll('.status-toggle');
    // statusToggles.forEach(toggle => {
    //     toggle.addEventListener('change', function() {
    //         const productId = this.getAttribute('data-product-id');
    //         const isActive = this.checked;
            
    //         // Show confirmation for status change
    //         if (!confirm(`Are you sure you want to ${isActive ? 'activate' : 'deactivate'} this product?`)) {
    //             this.checked = !isActive;
    //             return;
    //         }
            
    //         // In a real application, you would make an AJAX request here
    //         // This is a placeholder for the actual implementation
    //         fetch(`/admin/products/${productId}/status`, {
    //             method: 'PUT',
    //             headers: {
    //                 'Content-Type': 'application/json',
    //                 'X-CSRF-TOKEN': '{{ csrf_token() }}',
    //                 'X-Requested-With': 'XMLHttpRequest'
    //             },
    //             body: JSON.stringify({
    //                 status: isActive ? 1 : 0
    //             })
    //         })
    //         .then(response => {
    //             if (!response.ok) {
    //                 throw new Error('Network response was not ok');
    //             }
    //             return response.json();
    //         })
    //         .then(data => {
    //             if (data.success) {
    //                 // Update label
    //                 const label = this.nextElementSibling;
    //                 label.textContent = isActive ? 'Active' : 'Inactive';
                    
    //                 // Show success message
    //                 showAlert('Product status updated successfully', 'success');
    //             } else {
    //                 // Revert toggle if update failed
    //                 this.checked = !isActive;
    //                 showAlert('Failed to update product status', 'danger');
    //             }
    //         })
    //         .catch(error => {
    //             console.error('Error:', error);
    //             this.checked = !isActive;
    //             showAlert('An error occurred while updating product status', 'danger');
    //         });
    //     });
    // });
    
    function showAlert(message, type) {
        // Remove existing alerts
        const existingAlert = document.querySelector('.alert-dismissible');
        if (existingAlert) {
            existingAlert.remove();
        }
        
        // Create new alert
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.setAttribute('role', 'alert');
        alertDiv.innerHTML = `
            ${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        `;
        
        // Insert after the page title
        const container = document.querySelector('.container-fluid');
        const title = document.querySelector('h2');
        container.insertBefore(alertDiv, title.parentNode.nextSibling);
        
        // Auto remove after 5 seconds
        setTimeout(() => {
            if (alertDiv.parentNode) {
                alertDiv.remove();
            }
        }, 5000);
    }
});
</script>
@endsection