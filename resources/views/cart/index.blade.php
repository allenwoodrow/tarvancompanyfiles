@extends('layouts.app')

@section('content')
<!--breadcrumbs area start-->
<div class="breadcrumbs_area">
    <div class="container">   
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb_content">
                    <h3>Cart</h3>
                    <ul>
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li>Shopping Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>         
</div>
<!--breadcrumbs area end-->

<!--shopping cart area start -->
<div class="shopping_cart_area">
    <div class="container">  
        <div class="row">
            <div class="col-12">
                <div class="table_desc">
                    <div class="cart_page table-responsive">
                        <table>
                            <thead>
                                <tr>
                                    <th class="product_remove">Delete</th>
                                    <th class="product_thumb">Image</th>
                                    <th class="product_name">Product</th>
                                    <th class="product-price">Price</th>
                                    <th class="product_size">Size</th>
                                    <th class="product_color">Color</th>
                                    <th class="product_quantity">Quantity</th>
                                    <th class="product_total">Total</th>
                                </tr>
                            </thead>
                            <tbody id="cart-body">
                                @if($cart->items->count() > 0)
                                    @foreach($cart->items as $item)
                                        <tr data-id="{{ $item->id }}" data-price="{{ $item->price }}">
                                            <td class="product_remove">
                                                <a href="javascript:void(0)" class="remove-from-cart" data-id="{{ $item->id }}">
                                                    <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                            <td class="product_thumb">
                                                <img src="{{ $item->product->image ? asset($item->product->image) : asset('assets/img/product/default.jpg') }}" alt="{{ $item->product->name }}" width="70">
                                            </td>
                                            <td class="product_name">{{ $item->product->name }}</td>
                                            <td class="product-price product-price-value" data-price="{{ $item->price }}">
                                                ${{ number_format($item->price, 2) }}
                                            </td>
                                            <td>
                                                <select class="update-cart" data-id="{{ $item->id }}" data-field="size">
                                                    <option value="">--</option>
                                                    <option value="S" {{ $item->size == 'S' ? 'selected' : '' }}>S</option>
                                                    <option value="M" {{ $item->size == 'M' ? 'selected' : '' }}>M</option>
                                                    <option value="L" {{ $item->size == 'L' ? 'selected' : '' }}>L</option>
                                                    <option value="XL" {{ $item->size == 'XL' ? 'selected' : '' }}>XL</option>
                                                    <option value="XXL" {{ $item->size == 'XXL' ? 'selected' : '' }}>XXL</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select class="update-cart" data-id="{{ $item->id }}" data-field="color">
                                                    <option value="">--</option>
                                                    <option value="Red" {{ $item->color == 'Red' ? 'selected' : '' }}>Red</option>
                                                    <option value="Blue" {{ $item->color == 'Blue' ? 'selected' : '' }}>Blue</option>
                                                    <option value="Black" {{ $item->color == 'Black' ? 'selected' : '' }}>Black</option>
                                                    <option value="White" {{ $item->color == 'White' ? 'selected' : '' }}>White</option>
                                                    <option value="Green" {{ $item->color == 'Green' ? 'selected' : '' }}>Green</option>
                                                    <option value="Yellow" {{ $item->color == 'Yellow' ? 'selected' : '' }}>Yellow</option>
                                                    <option value="Gray" {{ $item->color == 'Gray' ? 'selected' : '' }}>Gray</option>
                                                    <option value="Pink" {{ $item->color == 'Pink' ? 'selected' : '' }}>Pink</option>
                                                    <option value="Purple" {{ $item->color == 'Purple' ? 'selected' : '' }}>Purple</option>
                                                    <option value="Orange" {{ $item->color == 'Orange' ? 'selected' : '' }}>Orange</option>
                                                </select>
                                            </td>
                                            
                                            <td class="product_quantity">
                                                <input type="number" value="{{ $item->quantity }}" 
                                                    class="qty-input" 
                                                    data-id="{{ $item->id }}" min="1">
                                                <!-- <button class="btn btn-sm btn-primary update-row" data-id="{{ $item->id }}">Update</button> -->
                                            </td>
                                            <td class="product_total line-total">
                                                ${{ number_format($item->price * $item->quantity, 2) }}
                                            </td>
                                        </tr>
                                    @endforeach
                                @else
                                    <tr>
                                        <td colspan="8" class="text-center">Your cart is empty!</td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>   
                    </div>  
                </div>
            </div>
        </div>

        <!-- Cart Totals -->
        <div class="row mt-4">
            <div class="col-lg-6 col-md-6 offset-lg-6">
                <div class="cart_totals">
                    <h3>Cart Totals</h3>
                    <div class="cart_subtotal">
                        <p>Subtotal</p>
                        <p class="cart_amount" id="subtotal">
                            ${{ number_format($cart->subtotal, 2) }}
                        </p>
                    </div>
                    <div class="cart_subtotal">
                        <p>Shipping</p>
                        <p class="cart_amount" id="shipping">${{ number_format($cart->shipping, 2) }}</p>
                    </div>
                    <div class="cart_subtotal">
                        <p>Total</p>
                        <p class="cart_amount" id="grandTotal">
                            ${{ number_format($cart->total, 2) }}
                        </p>
                    </div>
                    <div class="checkout_btn">
                        <a href="{{ route('checkout.index') }}">Proceed to Checkout</a>
                    </div>
                </div>
            </div>
        </div>
    </div>     
</div>
<!--shopping cart area end -->
@endsection

@section('scripts')
<script>
document.addEventListener("DOMContentLoaded", function() {
    const CSRF_TOKEN = '{{ csrf_token() }}';

    // Function to update cart totals in UI
    function updateCartTotals(data) {
        if (data.subtotal !== undefined) {
            document.getElementById("subtotal").textContent = "$" + parseFloat(data.subtotal).toFixed(2);
        }
        if (data.shipping !== undefined) {
            document.getElementById("shipping").textContent = "$" + parseFloat(data.shipping).toFixed(2);
        }
        if (data.total !== undefined) {
            document.getElementById("grandTotal").textContent = "$" + parseFloat(data.total).toFixed(2);
        }
        
        // Update mini cart count
        if (data.count !== undefined) {
            document.querySelectorAll('.item_count').forEach(el => {
                el.textContent = data.count;
            });
        }
        
        // Update global mini cart if available
        if (typeof window.CartManager !== 'undefined') {
            window.CartManager.updateMiniCart(data);
        }
    }

    // Function to update cart item on server
    async function updateCartItem(id, field, value) {
        try {
            const response = await fetch(`/cart/update/${id}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': CSRF_TOKEN,
                    'X-Requested-With': 'XMLHttpRequest'
                },
                body: JSON.stringify({ [field]: value })
            });

            if (!response.ok) throw new Error('Network response was not ok');
            
            const data = await response.json();
            
            if (data.success) {
                // Update line total if quantity changed
                if (field === 'quantity') {
                    const row = document.querySelector(`tr[data-id="${id}"]`);
                    if (row) {
                        const price = parseFloat(row.dataset.price);
                        const lineTotal = price * value;
                        row.querySelector('.line-total').textContent = '$' + lineTotal.toFixed(2);
                    }
                }
                
                // Update all totals
                updateCartTotals(data.cart);
                
                return data;
            } else {
                console.error('Update failed:', data.message);
                alert('Error: ' + (data.message || 'Failed to update cart'));
            }
        } catch (error) {
            console.error('Error updating cart:', error);
            alert('Error updating cart. Please try again.');
        }
    }

    // Handle quantity input changes
    document.querySelectorAll('.qty-input').forEach(input => {
        input.addEventListener('change', function() {
            const id = this.dataset.id;
            const quantity = parseInt(this.value) || 1;
            
            if (quantity < 1) {
                this.value = 1;
                return;
            }
            
            updateCartItem(id, 'quantity', quantity);
        });
    });

    // Handle update button clicks
    document.querySelectorAll('.update-row').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            const input = document.querySelector(`.qty-input[data-id="${id}"]`);
            if (!input) return;
            
            const quantity = parseInt(input.value) || 1;
            
            if (quantity < 1) {
                input.value = 1;
                return;
            }
            
            updateCartItem(id, 'quantity', quantity);
        });
    });

    // Handle size/color changes
    document.querySelectorAll('select.update-cart').forEach(select => {
        select.addEventListener('change', function() {
            const id = this.dataset.id;
            const field = this.dataset.field;
            const value = this.value;
            
            updateCartItem(id, field, value);
        });
    });

    // Handle remove item
    document.querySelectorAll('.remove-from-cart').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.dataset.id;
            
            if (confirm('Are you sure you want to remove this item from your cart?')) {
                fetch(`/cart/remove/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': CSRF_TOKEN,
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) throw new Error('Network response was not ok');
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Remove the item row
                        const row = document.querySelector(`tr[data-id="${id}"]`);
                        if (row) row.remove();
                        
                        // Update totals
                        updateCartTotals(data.cart);
                        
                        // Check if cart is empty
                        if (Object.keys(data.cart.items || {}).length === 0) {
                            document.getElementById('cart-body').innerHTML = 
                                '<tr><td colspan="8" class="text-center">Your cart is empty!</td></tr>';
                        }
                        
                        // Show success message
                        alert('Item removed from cart successfully!');
                    } else {
                        alert('Error: ' + (data.message || 'Failed to remove item'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('Error removing item from cart');
                });
            }
        });
    });
});
</script>
@endsection