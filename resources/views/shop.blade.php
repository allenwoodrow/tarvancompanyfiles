@extends('layouts.app')

@php
    // Fallback variables if not passed from controller
    $categories = $categories ?? [];
    $colors = $colors ?? [];
    $sizes = $sizes ?? [];
    $categoryCounts = $categoryCounts ?? [];
    $colorCounts = $colorCounts ?? [];
    $sizeCounts = $sizeCounts ?? [];
    $maxPrice = $maxPrice ?? 1000;
@endphp

@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>Shop</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">home</a></li>
                        <li>shop</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>         
</div>
<!--breadcrumbs area end-->

<!--shop  area start-->
<div class="shop_area shop_reverse mb-80">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 col-md-12">
               <!--sidebar widget start-->
                <aside class="sidebar_widget">
                    <div class="widget_inner">
                        <!-- Search Form -->
                        <div class="widget_list widget_search">
                            <h3>Search Products</h3>
                            <form action="{{ route('shop') }}" method="GET">
                                <input type="text" name="search" placeholder="Search products..." value="{{ request('search') }}">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>

                        <!-- Price Filter -->
                        <div class="widget_list widget_filter">
                            <h3>Filter by price</h3>
                            <form action="{{ route('shop') }}" method="GET" id="price-filter-form">
                                <div id="slider-range"></div>   
                                <button type="submit">Filter</button>
                                <input type="text" name="price_range" id="amount" readonly />   
                                <input type="hidden" name="min_price" id="min_price" value="{{ request('min_price') }}">
                                <input type="hidden" name="max_price" id="max_price" value="{{ request('max_price') }}">
                            </form> 
                        </div>

                        <!-- Category Filter -->
                        <div class="widget_list widget_categories">
                            <h3>Categories</h3>
                            <ul>
                                @foreach($categories as $category)
                                <li>
                                    <a href="{{ route('shop', ['category' => $category] + request()->except('category', 'page')) }}" 
                                       class="{{ request('category') == $category ? 'active' : '' }}">
                                        {{ ucfirst($category) }}  
                                        <span>({{ $categoryCounts[$category] ?? 0 }})</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        
                        <!-- Color Filter -->
                        @if(!empty($colors))
                        <div class="widget_list widget_color">
                            <h3>Select By Color</h3>
                            <ul>
                                @foreach($colors as $color)
                                <li>
                                    <a href="{{ route('shop', ['color' => $color] + request()->except('color', 'page')) }}" 
                                    class="{{ request('color') == $color ? 'active' : '' }}">
                                        {{ ucfirst($color) }}  
                                        <span>({{ $colorCounts[$color] ?? 0 }})</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        
                        <!-- Size Filter -->
                        @if(!empty($sizes))
                        <div class="widget_list widget_size">
                            <h3>Select By Size</h3>
                            <ul>
                                @foreach($sizes as $size)
                                <li>
                                    <a href="{{ route('shop', ['size' => $size] + request()->except('size', 'page')) }}" 
                                    class="{{ request('size') == $size ? 'active' : '' }}">
                                        {{ strtoupper($size) }}  
                                        <span>({{ $sizeCounts[$size] ?? 0 }})</span>
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <!-- Clear Filters -->
                        @if(request()->anyFilled(['search', 'min_price', 'max_price', 'category', 'color', 'size', 'sort']))
                        <div class="widget_list">
                            <a href="{{ route('shop') }}" class="btn btn-secondary btn-block">Clear All Filters</a>
                        </div>
                        @endif
                    </div>
                </aside>
                <!--sidebar widget end-->
            </div>
            <div class="col-lg-9 col-md-12">
                <!--shop wrapper start-->
                
                <!--shop toolbar start-->
                <div class="shop_toolbar_wrapper">
                    <div class="shop_toolbar_btn">
                        <button data-role="grid_4" type="button" class="active btn-grid-4" data-bs-toggle="tooltip" title="4"></button>
                        <button data-role="grid_3" type="button" class="btn-grid-3" data-bs-toggle="tooltip" title="3"></button>
                        <button data-role="grid_list" type="button" class="btn-list" data-bs-toggle="tooltip" title="List"></button>
                    </div>
                    <div class="niceselect_option">
                        <div class="dropdown">
                            <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="sortDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                Sort: 
                                @switch(request('sort', 'newest'))
                                    @case('price_asc') Price: Low to High @break
                                    @case('price_desc') Price: High to Low @break
                                    @case('name_asc') Name: A-Z @break
                                    @case('name_desc') Name: Z-A @break
                                    @default Newest @break
                                @endswitch
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="sortDropdown">
                                <li><a class="dropdown-item {{ request('sort') == 'newest' ? 'active' : '' }}" href="{{ route('shop', ['sort' => 'newest'] + request()->except('sort', 'page')) }}">Sort by newness</a></li>
                                <li><a class="dropdown-item {{ request('sort') == 'price_asc' ? 'active' : '' }}" href="{{ route('shop', ['sort' => 'price_asc'] + request()->except('sort', 'page')) }}">Sort by price: low to high</a></li>
                                <li><a class="dropdown-item {{ request('sort') == 'price_desc' ? 'active' : '' }}" href="{{ route('shop', ['sort' => 'price_desc'] + request()->except('sort', 'page')) }}">Sort by price: high to low</a></li>
                                <li><a class="dropdown-item {{ request('sort') == 'name_asc' ? 'active' : '' }}" href="{{ route('shop', ['sort' => 'name_asc'] + request()->except('sort', 'page')) }}">Product Name: A-Z</a></li>
                                <li><a class="dropdown-item {{ request('sort') == 'name_desc' ? 'active' : '' }}" href="{{ route('shop', ['sort' => 'name_desc'] + request()->except('sort', 'page')) }}">Product Name: Z-A</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="page_amount">
                        <p>Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }} results</p>
                    </div>
                </div>
                <!--shop toolbar end-->
                 
                <div class="row shop_wrapper grid_4">
                    @forelse($products as $product)
                    @php
                        // Calculate total available stock (product stock + variants stock)
                        $totalStock = $product->stock;
                        $availableVariants = collect([]);
                        
                        if ($product->variants && $product->variants->count() > 0) {
                            $availableVariants = $product->variants->where('stock', '>', 0);
                            $totalStock += $availableVariants->sum('stock');
                        }
                        
                        // Get available colors and sizes from variants
                        $availableColors = $availableVariants->pluck('color')->unique()->filter()->toArray();
                        $availableSizes = $availableVariants->pluck('size')->unique()->filter()->toArray();
                        
                        // Check if product is available
                        $isAvailable = $totalStock > 0;
                    @endphp
                    
                    <div class="col-lg-3 col-md-4 col-sm-6 col-12">
                        <div class="single_product">
                            <div class="product_thumb">
                                <a class="primary_img" href="{{ route('product.show', $product->id) }}">
                                    <img src="{{ $product->image ? asset($product->image) : asset('assets/img/product/default.jpg') }}" alt="{{ $product->name }}">
                                </a>
                                @if($product->old_price && $product->old_price > $product->price)
                                <div class="label_product">
                                    <span class="label_sale">Sale</span>
                                </div>
                                @endif
                                
                                @if(!$isAvailable)
                                <div class="label_product">
                                    <span class="label_outofstock">Out of Stock</span>
                                </div>
                                @endif
                                
                                <div class="action_links">
                                    <ul>
                                        <li class="quick_button">
                                            <a href="#" class="quick-view-btn"
                                               data-id="{{ $product->id }}"
                                               data-name="{{ $product->name }}"
                                               data-price="{{ number_format($product->price, 2) }}"
                                               data-oldprice="{{ $product->old_price ? number_format($product->old_price, 2) : '' }}"
                                               data-description="{{ $product->description }}"
                                               data-variants='@json($availableVariants)'
                                               data-images='@json([$product->image ? asset($product->image) : asset('assets/img/product/default.jpg')])'
                                               data-bs-toggle="modal"
                                               data-bs-target="#modal_box">
                                                <span class="pe-7s-search"></span>
                                            </a>
                                        </li>
                                        <li class="wishlist">
                                            <a href="{{ route('wishlist.add', $product->id) }}" class="wishlist-btn">
                                                <span class="pe-7s-like"></span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="product_content grid_content">
                                <div class="product_content_inner">
                                    <h4 class="product_name">
                                        <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                                    </h4>
                                    <div class="price_box"> 
                                        @if($product->old_price && $product->old_price > $product->price)
                                        <span class="old_price">${{ number_format($product->old_price, 2) }}</span>
                                        @endif
                                        <span class="current_price">${{ number_format($product->price, 2) }}</span>
                                    </div>
                                    
                                    <!-- Variant Info -->
                                    @if(count($availableColors) > 0 || count($availableSizes) > 0)
                                    <div class="variant-info mt-2">
                                        <small class="text-muted">
                                            @if(count($availableColors) > 0)
                                                <span class="me-2">
                                                    <i class="fas fa-palette"></i> 
                                                    {{ implode(', ', $availableColors) }}
                                                </span>
                                            @endif
                                            @if(count($availableSizes) > 0)
                                                <span>
                                                    <i class="fas fa-ruler"></i> 
                                                    {{ implode(', ', $availableSizes) }}
                                                </span>
                                            @endif
                                        </small>
                                    </div>
                                    @endif
                                </div>
                                <div class="add_to_cart">
                                    @if($isAvailable)
                                        <a href="javascript:void(0)" class="add-to-cart-btn" 
                                           data-id="{{ $product->id }}"
                                           data-has-variants="{{ $availableVariants->count() > 0 ? 'true' : 'false' }}">
                                            Add to cart
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="btn-disabled" style="background: #ccc; color: #666; cursor: not-allowed;">
                                            Out of Stock
                                        </a>
                                    @endif
                                </div>
                            </div>
                            <div class="product_content list_content" style="display: none;">
                                <h4 class="product_name">
                                    <a href="{{ route('product.show', $product->id) }}">{{ $product->name }}</a>
                                </h4>
                                <div class="price_box"> 
                                    @if($product->old_price && $product->old_price > $product->price)
                                    <span class="old_price">${{ number_format($product->old_price, 2) }}</span>
                                    @endif
                                    <span class="current_price">${{ number_format($product->price, 2) }}</span>
                                </div>
                                <div class="product_rating">
                                    <ul>
                                        @for($i = 1; $i <= 5; $i++)
                                        <li>
                                            <a href="#">
                                                <i class="ion-android-star{{ $i <= ($product->rating ?? 0) ? '' : '-outline' }}"></i>
                                            </a>
                                        </li>
                                        @endfor
                                    </ul>
                                </div>
                                <div class="product_desc">
                                    <p>{{ Str::limit($product->description, 150) }}</p>
                                    
                                    <!-- Variant Info for List View -->
                                    @if(count($availableColors) > 0 || count($availableSizes) > 0)
                                    <div class="variant-info mt-2">
                                        <strong>Available in:</strong>
                                        @if(count($availableColors) > 0)
                                            <span class="badge bg-light text-dark me-1">
                                                Colors: {{ implode(', ', $availableColors) }}
                                            </span>
                                        @endif
                                        @if(count($availableSizes) > 0)
                                            <span class="badge bg-light text-dark">
                                                Sizes: {{ implode(', ', $availableSizes) }}
                                            </span>
                                        @endif
                                    </div>
                                    @endif
                                </div>
                                <div class="add_to_cart shop_list_cart">
                                    @if($isAvailable)
                                        <a href="javascript:void(0)" class="add-to-cart-btn" 
                                           data-id="{{ $product->id }}"
                                           data-has-variants="{{ $availableVariants->count() > 0 ? 'true' : 'false' }}">
                                            Add to cart
                                        </a>
                                    @else
                                        <a href="javascript:void(0)" class="btn-disabled" style="background: #ccc; color: #666; cursor: not-allowed;">
                                            Out of Stock
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="col-12">
                        <div class="alert alert-info text-center">
                            <h4>No products found</h4>
                            <p>Try adjusting your search or filter criteria</p>
                            <a href="{{ route('shop') }}" class="btn btn-primary">Clear Filters</a>
                        </div>
                    </div>
                    @endforelse
                </div>
                
                <div class="shop_toolbar t_bottom">
                    <div class="pagination">
                        {{ $products->appends(request()->query())->links('vendor.pagination.custom') }}
                    </div>
                </div>
                <!--shop toolbar end-->
                <!--shop wrapper end-->
            </div>
        </div>
    </div>
    
    <!-- Modal -->
    <div class="modal fade" id="modal_box" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true"><i class="ion-android-close"></i></span>
                </button>
                <div class="modal_body">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-5 col-md-5 col-sm-12">
                                <div class="modal_tab">  
                                    <div class="tab-content product-details-large" id="modal_image_tabs">
                                        <!-- JS will inject product images here -->
                                    </div>
                                </div>  
                            </div> 
                            <div class="col-lg-7 col-md-7 col-sm-12">
                                <div class="modal_right">
                                    <div class="modal_title mb-10">
                                        <h2 id="modal_product_name"></h2> 
                                    </div>
                                    <div class="modal_price mb-10">
                                        <span class="new_price" id="modal_product_price"></span>    
                                        <span class="old_price" id="modal_product_oldprice"></span>    
                                    </div>
                                    <div class="modal_description mb-15">
                                        <p id="modal_product_description"></p>    
                                    </div> 
                                    
                                    <!-- Variant Selection -->
                                    <div class="variants_selects" id="modal_variants_section" style="display: none;">
                                        <div class="variants_size mb-3">
                                            <h3>Size</h3>
                                            <div class="size-options" id="modal_size_options">
                                                <!-- JS will populate size options -->
                                            </div>
                                        </div>
                                        <div class="variants_color mb-3">
                                            <h3>Color</h3>
                                            <div class="color-options" id="modal_color_options">
                                                <!-- JS will populate color options -->
                                            </div>
                                        </div>
                                        <div class="selected-variant-info mb-3" id="selected_variant_info" style="display: none;">
                                            <p class="text-success"><i class="fas fa-check-circle"></i> <span id="selected_variant_text"></span></p>
                                        </div>
                                    </div>
                                    
                                    <div class="modal_add_to_cart">
                                        <form id="modal_add_to_cart_form">
                                            @csrf
                                            <input type="hidden" name="product_id" id="modal_product_id">
                                            <input type="hidden" name="variant_id" id="modal_variant_id">
                                            <input type="hidden" name="size" id="modal_selected_size">
                                            <input type="hidden" name="color" id="modal_selected_color">
                                            <div class="quantity-container mb-3">
                                                <label for="modal_quantity">Quantity:</label>
                                                <input min="1" max="100" step="1" value="1" type="number" name="quantity" id="modal_quantity" class="form-control d-inline-block w-auto">
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="modal_add_to_cart_btn">Add to cart</button>
                                        </form>
                                    </div>   
                                    
                                    <div class="modal_social mt-3">
                                        <h3>Share this product</h3>
                                        <ul>
                                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i></a></li>
                                            <li class="pinterest"><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                        </ul>    
                                    </div>      
                                </div>    
                            </div>    
                        </div>     
                    </div>
                </div>    
            </div>
        </div>
    </div>
    <!-- modal area end-->
</div>
<!--shop  area end-->
@endsection

@section('scripts')
<script>
    // Global variable to track if event listeners are attached
    let cartEventListenersAttached = false;
    let currentVariants = [];

    document.addEventListener("DOMContentLoaded", function() {
        console.log('DOM loaded - initializing shop functionality');

        // Grid/List view toggle
        const gridButtons = document.querySelectorAll('.shop_toolbar_btn button');
        const shopWrapper = document.querySelector('.shop_wrapper');
        
        gridButtons.forEach(button => {
            button.addEventListener('click', function() {
                const role = this.getAttribute('data-role');
                
                gridButtons.forEach(btn => btn.classList.remove('active'));
                this.classList.add('active');
                
                shopWrapper.classList.remove('grid_4', 'grid_3', 'list');
                shopWrapper.classList.add(role);
                
                if (role === 'grid_list') {
                    document.querySelectorAll('.grid_content').forEach(el => el.style.display = 'none');
                    document.querySelectorAll('.list_content').forEach(el => el.style.display = 'block');
                } else {
                    document.querySelectorAll('.grid_content').forEach(el => el.style.display = 'block');
                    document.querySelectorAll('.list_content').forEach(el => el.style.display = 'none');
                }
            });
        });

        // Price range slider
        const minPrice = {{ request('min_price', 0) }};
        const maxPrice = {{ request('max_price', 1000) }};
        const maxProductPrice = {{ $maxPrice ?? 1000 }};
        
        if (typeof $.fn.slider !== 'undefined') {
            $("#slider-range").slider({
                range: true,
                min: 0,
                max: maxProductPrice,
                values: [minPrice, maxPrice],
                slide: function(event, ui) {
                    $("#amount").val("$" + ui.values[0] + " - $" + ui.values[1]);
                    $("#min_price").val(ui.values[0]);
                    $("#max_price").val(ui.values[1]);
                }
            });
            
            $("#amount").val("$" + $("#slider-range").slider("values", 0) + " - $" + $("#slider-range").slider("values", 1));
        }

        // Add to cart functionality
        if (!cartEventListenersAttached) {
            attachCartEventListeners();
            cartEventListenersAttached = true;
        }

        // Quick view modal functionality
        document.querySelectorAll('.quick-view-btn').forEach(btn => {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                fillQuickViewModal(this);
            });
        });

        // Modal variant selection
        document.addEventListener('change', function(e) {
            if (e.target.classList.contains('variant-option')) {
                updateSelectedVariant();
            }
        });

        // Modal add to cart
        const modalAddToCartForm = document.getElementById('modal_add_to_cart_form');
        if (modalAddToCartForm) {
            modalAddToCartForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const productId = document.getElementById('modal_product_id').value;
                const variantId = document.getElementById('modal_variant_id').value;
                const size = document.getElementById('modal_selected_size').value;
                const color = document.getElementById('modal_selected_color').value;
                const quantity = document.getElementById('modal_quantity').value;
                
                addToCart(productId, quantity, variantId, size, color);
                
                // Close modal
                const modal = bootstrap.Modal.getInstance(document.getElementById('modal_box'));
                if (modal) {
                    modal.hide();
                }
            });
        }
    });

    function attachCartEventListeners() {
        document.addEventListener('click', function(e) {
            if (e.target.closest('.add-to-cart-btn')) {
                e.preventDefault();
                const button = e.target.closest('.add-to-cart-btn');
                const productId = button.dataset.id;
                const hasVariants = button.dataset.hasVariants === 'true';
                
                if (hasVariants) {
                    // For products with variants, open quick view modal
                    const quickViewBtn = button.closest('.single_product').querySelector('.quick-view-btn');
                    if (quickViewBtn) {
                        quickViewBtn.click();
                    }
                } else {
                    // For products without variants, add directly to cart
                    addToCart(productId, 1);
                }
            }
        });
    }

    function addToCart(productId, quantity = 1, variantId = null, size = null, color = null) {
        const buttons = document.querySelectorAll(`.add-to-cart-btn[data-id="${productId}"]`);
        buttons.forEach(button => {
            const originalText = button.textContent;
            button.textContent = 'Adding...';
            button.disabled = true;
            
            setTimeout(() => {
                button.textContent = originalText;
                button.disabled = false;
            }, 2000);
        });

        const formData = new FormData();
        formData.append('_token', '{{ csrf_token() }}');
        formData.append('product_id', productId);
        formData.append('quantity', quantity);
        if (variantId) {
            formData.append('variant_id', variantId);
        }
        if (size) {
            formData.append('size', size);
        }
        if (color) {
            formData.append('color', color);
        }

        fetch('{{ route("cart.add") }}', {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => {
            if (response.status === 401) {
                return response.json().then(data => {
                    if (data.redirect) {
                        window.location.href = data.redirect;
                    } else {
                        window.location.href = '{{ route("login") }}';
                    }
                    return { success: false };
                });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                document.querySelectorAll('.item_count').forEach(el => {
                    el.textContent = data.cart_count;
                });
                showNotification('Product added to cart!', 'success');
            } else if (data.redirect) {
                window.location.href = data.redirect;
            } else {
                showNotification(data.message || 'Error adding product to cart', 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showNotification('Error adding product to cart', 'error');
        });
    }

    function fillQuickViewModal(button) {
        const modal = document.getElementById('modal_box');
        if (!modal) return;
        
        const modalTitle = modal.querySelector('.modal_title h2');
        const newPrice = modal.querySelector('.new_price');
        const oldPrice = modal.querySelector('.old_price');
        const modalDescription = modal.querySelector('.modal_description p');
        const productIdInput = modal.querySelector('#modal_product_id');
        const variantsSection = document.getElementById('modal_variants_section');
        
        if (modalTitle) modalTitle.textContent = button.dataset.name;
        if (newPrice) newPrice.textContent = '$' + button.dataset.price;
        if (productIdInput) productIdInput.value = button.dataset.id;
        
        if (oldPrice) {
            if (button.dataset.oldprice) {
                oldPrice.textContent = '$' + button.dataset.oldprice;
                oldPrice.style.display = 'inline';
            } else {
                oldPrice.style.display = 'none';
            }
        }
        
        if (modalDescription) modalDescription.textContent = button.dataset.description;
        
        // Parse variants
        try {
            currentVariants = JSON.parse(button.dataset.variants.replace(/&quot;/g, '"'));
        } catch (e) {
            currentVariants = [];
        }
        
        // Show/hide variant section based on whether product has variants
        if (currentVariants.length > 0) {
            variantsSection.style.display = 'block';
            updateVariantSelectionUI();
        } else {
            variantsSection.style.display = 'none';
            // Enable add to cart button for products without variants
            document.getElementById('modal_add_to_cart_btn').disabled = false;
            document.getElementById('modal_variant_id').value = '';
            document.getElementById('modal_selected_size').value = '';
            document.getElementById('modal_selected_color').value = '';
        }
        
        // Parse and set images
        let images = [];
        try {
            images = JSON.parse(button.dataset.images.replace(/&quot;/g, '"'));
        } catch (e) {
            images = [button.dataset.images];
        }
        
        // Update modal images
        const tabContent = modal.querySelector('.product-details-large');
        if (tabContent) {
            tabContent.innerHTML = '';
            images.forEach((img, index) => {
                tabContent.innerHTML += `
                    <div class="tab-pane fade ${index === 0 ? 'show active' : ''}" id="tab${index + 1}" role="tabpanel">
                        <div class="modal_tab_img">
                            <img src="${img}" alt="${button.dataset.name}" style="width: 100%; height: auto;">    
                        </div>
                    </div>
                `;
            });
        }
    }

    function updateVariantSelectionUI() {
        const sizeOptions = document.getElementById('modal_size_options');
        const colorOptions = document.getElementById('modal_color_options');
        
        if (currentVariants.length > 0) {
            // Get unique sizes and colors
            const sizes = [...new Set(currentVariants.map(v => v.size).filter(Boolean))];
            const colors = [...new Set(currentVariants.map(v => v.color).filter(Boolean))];
            
            // Populate size options
            if (sizes.length > 0) {
                sizeOptions.innerHTML = sizes.map(size => `
                    <label class="variant-option-label">
                        <input type="radio" name="size" value="${size}" class="variant-option" ${sizes.length === 1 ? 'checked' : ''}>
                        <span class="variant-option-text">${size}</span>
                    </label>
                `).join('');
            } else {
                sizeOptions.innerHTML = '<p>No size options</p>';
            }
            
            // Populate color options
            if (colors.length > 0) {
                colorOptions.innerHTML = colors.map(color => `
                    <label class="variant-option-label">
                        <input type="radio" name="color" value="${color}" class="variant-option" ${colors.length === 1 ? 'checked' : ''}>
                        <span class="variant-option-text">${color}</span>
                    </label>
                `).join('');
            } else {
                colorOptions.innerHTML = '<p>No color options</p>';
            }
        } else {
            sizeOptions.innerHTML = '<p>No variants available</p>';
            colorOptions.innerHTML = '<p>No variants available</p>';
        }
        
        updateSelectedVariant();
    }

    function updateSelectedVariant() {
        const selectedSize = document.querySelector('input[name="size"]:checked');
        const selectedColor = document.querySelector('input[name="color"]:checked');
        const variantInfo = document.getElementById('selected_variant_info');
        const variantText = document.getElementById('selected_variant_text');
        const variantIdInput = document.getElementById('modal_variant_id');
        const sizeInput = document.getElementById('modal_selected_size');
        const colorInput = document.getElementById('modal_selected_color');
        const addToCartBtn = document.getElementById('modal_add_to_cart_btn');
        
        if (!selectedSize && !selectedColor) {
            variantInfo.style.display = 'none';
            variantIdInput.value = '';
            sizeInput.value = '';
            colorInput.value = '';
            if (addToCartBtn) addToCartBtn.disabled = true;
            return;
        }
        
        // Find matching variant
        const matchingVariant = currentVariants.find(variant => {
            const sizeMatch = !selectedSize || variant.size === selectedSize.value;
            const colorMatch = !selectedColor || variant.color === selectedColor.value;
            return sizeMatch && colorMatch && variant.stock > 0;
        });
        
        if (matchingVariant) {
            variantInfo.style.display = 'block';
            let text = 'Selected: ';
            if (matchingVariant.size) text += `Size: ${matchingVariant.size} `;
            if (matchingVariant.color) text += `Color: ${matchingVariant.color} `;
            text += `(Stock: ${matchingVariant.stock})`;
            
            variantText.textContent = text;
            variantText.className = 'text-success';
            variantIdInput.value = matchingVariant.id;
            sizeInput.value = matchingVariant.size || '';
            colorInput.value = matchingVariant.color || '';
            if (addToCartBtn) addToCartBtn.disabled = false;
        } else {
            variantInfo.style.display = 'block';
            variantText.textContent = 'Selected combination is out of stock';
            variantText.className = 'text-danger';
            variantIdInput.value = '';
            sizeInput.value = '';
            colorInput.value = '';
            if (addToCartBtn) addToCartBtn.disabled = true;
        }
    }

    function showNotification(message, type) {
        document.querySelectorAll('.cart-notification').forEach(el => el.remove());
        
        const notification = document.createElement('div');
        notification.className = `cart-notification alert alert-${type === 'success' ? 'success' : 'danger'} fixed-top mx-auto mt-3`;
        notification.style.cssText = 'max-width: 300px; z-index: 9999; left: 50%; transform: translateX(-50%); text-align: center; padding: 10px;';
        notification.textContent = message;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            if (notification.parentNode) {
                notification.parentNode.removeChild(notification);
            }
        }, 3000);
    }
</script>

<style>
    .variant-info {
        font-size: 0.85em;
    }

    .variant-option-label {
        display: inline-block;
        margin-right: 10px;
        margin-bottom: 5px;
        padding: 5px 10px;
        border: 1px solid #ddd;
        border-radius: 3px;
        cursor: pointer;
    }

    .variant-option-label:hover {
        border-color: #007bff;
    }

    .variant-option-label input[type="radio"] {
        display: none;
    }

    .variant-option-label input[type="radio"]:checked + .variant-option-text {
        color: #007bff;
        font-weight: bold;
    }

    .label_outofstock {
        background: #dc3545;
        color: white;
        padding: 2px 8px;
        border-radius: 3px;
        font-size: 0.8em;
    }

    .btn-disabled {
        background: #ccc !important;
        color: #666 !important;
        cursor: not-allowed !important;
        border: none !important;
    }

    .cart-notification {
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            transform: translateX(-50%) translateY(-20px);
            opacity: 0;
        }
        to {
            transform: translateX(-50%) translateY(0);
            opacity: 1;
        }
    }

    /* Active filter styles */
    .widget_list a.active {
        color: #007bff;
        font-weight: bold;
    }

    /* Filter links styling */
    .widget_list ul li a {
        display: flex;
        justify-content: space-between;
        padding: 5px 0;
        text-decoration: none;
        color: #333;
        transition: color 0.3s ease;
    }
    .widget_list ul li a:hover {
        color: #007bff;
    }
    .widget_list ul li a.active {
        color: #007bff;
        font-weight: bold;
    }
</style>
@endsection