@extends('layouts.app')

@section('content')
<section class="h-100">
  <div class="container h-100 py-5">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-10">

        <div class="d-flex justify-content-between align-items-center mb-4">
          <h3 class="fw-normal mb-0 text-primary">🛒 Your Cart</h3>
          <div>
            <p class="mb-0"><span class="text-muted">Items:</span> <span class="text-body">{{ $cart->items->count() ?? 0 }}</span></p>
          </div>
        </div>

        <!-- Cart items container -->
        <div id="cart-page-items" class="cart-items-list flex-grow-1 mb-4">
          @if($cart && count($cart->items) > 0)
            @foreach($cart->items as $item)
            <div class="card rounded-3 mb-4 page-cart-item" data-id="{{ $item->id }}" data-price="{{ $item->price }}">
              <div class="card-body p-4">
                <div class="row d-flex justify-content-between align-items-center">
                  <div class="col-md-2 col-lg-2 col-xl-2">
                    <img
                      src="{{ $item->product && $item->product->image ? asset($item->product->image) : asset('assets/images/default.jpg') }}"
                      class="img-fluid rounded-3" 
                      alt="{{ $item->product->name ?? 'Food Item' }}"
                      style="height: 120px; object-fit: cover;">
                  </div>
                  <div class="col-md-3 col-lg-3 col-xl-3">
                    <p class="lead text-dark fw-normal mb-2">{{ $item->product->name ?? 'Unnamed Dish' }}</p>
                    <p class="text-muted mb-0">₦<span class="item-price">{{ number_format($item->price, 2) }}</span> per plate</p>
                  </div>
                  <div class="col-md-3 col-lg-3 col-xl-2 d-flex align-items-center">
                    <button class="btn btn-link px-2 text-danger page-qty-btn" data-action="decrease">
                      <i class="fas fa-minus"></i>
                    </button>

                    <span class="page-quantity mx-2 fw-bold" style="min-width: 30px; text-align: center;">{{ $item->quantity }}</span>

                    <button class="btn btn-link px-2 text-success page-qty-btn" data-action="increase">
                      <i class="fas fa-plus"></i>
                    </button>
                  </div>
                  <div class="col-md-3 col-lg-2 col-xl-2 offset-lg-1">
                    <h5 class="mb-0 text-success">₦<span class="page-item-total">{{ number_format($item->price * $item->quantity, 2) }}</span></h5>
                  </div>
                  <div class="col-md-1 col-lg-1 col-xl-1 text-end">
                    <a href="javascript:void(0)" class="text-danger page-remove-item" title="Remove">
                      <i class="fas fa-trash fa-lg"></i>
                    </a>
                  </div>
                </div>
              </div>
            </div>
            @endforeach
          @else
            <div class="text-center text-muted py-5">
              <i class="fas fa-shopping-cart fa-3x mb-3"></i>
              <h5>Your cart is empty</h5>
              <p class="mb-0">Add some delicious items to get started!</p>
              <a href="{{ route('shop') }}" class="btn btn-warning mt-3">Browse Menu</a>
            </div>
          @endif
        </div>

        @if($cart && count($cart->items) > 0)
        <!-- Cart summary -->
        <div class="card mb-4">
          <div class="card-body p-4 d-flex flex-row">
            <div class="form-outline flex-fill">
              <input type="text" id="discount-code" class="form-control form-control-lg" placeholder=" " />
              <label class="form-label" for="discount-code">Discount code</label>
            </div>
            <button type="button" class="btn btn-outline-warning btn-lg ms-3">Apply</button>
          </div>
        </div>

        <div class="card rounded-3 mb-4">
          <div class="card-body p-4">
            <div class="row d-flex justify-content-between align-items-center">
              <div class="col-8">
                <h5 class="fw-bold mb-0">Order Summary</h5>
              </div>
              <div class="col-4 text-end">
                <p class="d-flex justify-content-between mb-1 text-dark">
                  <span>Subtotal:</span>
                  <strong id="page-cart-subtotal">₦{{ number_format($cart->subtotal, 2) }}</strong>
                </p>
                <p class="d-flex justify-content-between mb-1 text-dark">
                  <span>Discount:</span>
                  <strong id="page-cart-discount">₦0.00</strong>
                </p>
                <p class="d-flex justify-content-between fs-5 border-top pt-2 text-dark mb-0">
                  <span>Total:</span>
                  <strong id="page-cart-total">₦{{ number_format($cart->total, 2) }}</strong>
                </p>
              </div>
            </div>
          </div>
        </div>

        <!-- Buttons -->
        <div class="card">
          <div class="card-body text-center">
            <a href="{{ route('checkout.index') }}" class="btn btn-warning btn-lg w-100 text-dark fw-bold">
              Proceed to Checkout
            </a>
            <a href="{{ route('shop') }}" class="btn btn-outline-secondary btn-lg w-100 mt-2">
              Continue Shopping
            </a>
          </div>
        </div>
        @endif

      </div>
    </div>
  </div>
</section>
@endsection

@section('scripts')
<script>
// Cart Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    console.log('🛒 Cart page loaded - initializing...');
    
    // Initialize cart functionality
    initCart();
    
    function initCart() {
        console.log('🎯 Initializing cart functionality...');
        
        // Add event listeners using event delegation
        document.addEventListener('click', function(e) {
            // Handle quantity buttons
            if (e.target.closest('.page-qty-btn')) {
                handleQuantityClick(e.target.closest('.page-qty-btn'));
            }
            
            // Handle remove buttons
            if (e.target.closest('.page-remove-item')) {
                handleRemoveClick(e.target.closest('.page-remove-item'));
            }
        });
        
        console.log('✅ Cart functionality initialized');
        console.log('Items found:', document.querySelectorAll('.page-cart-item').length);
    }
    
    function handleQuantityClick(button) {
        const itemElement = button.closest('.page-cart-item');
        const itemId = itemElement.dataset.id;
        const action = button.dataset.action;
        const quantitySpan = itemElement.querySelector('.page-quantity');
        
        let quantity = parseInt(quantitySpan.textContent);
        
        // Update quantity
        if (action === 'increase') {
            quantity++;
        } else if (action === 'decrease' && quantity > 1) {
            quantity--;
        }
        
        console.log(`Updating item ${itemId} quantity to ${quantity}`);
        
        // Update UI immediately
        quantitySpan.textContent = quantity;
        updateItemTotal(itemElement);
        updateCartTotal();
        
        // Send to server
        updateQuantityOnServer(itemId, quantity);
    }
    
    function handleRemoveClick(button) {
        const itemElement = button.closest('.page-cart-item');
        const itemId = itemElement.dataset.id;
        
        if (confirm('Are you sure you want to remove this item from your cart?')) {
            console.log(`Removing item ${itemId}`);
            
            // Remove from UI immediately
            itemElement.style.opacity = '0.5';
            itemElement.style.transition = 'all 0.3s ease';
            setTimeout(() => {
                itemElement.remove();
                updateCartTotal();
                
                // Check if cart is empty
                if (document.querySelectorAll('.page-cart-item').length === 0) {
                    setTimeout(() => location.reload(), 1000);
                }
            }, 300);
            
            // Send to server
            removeItemFromServer(itemId);
        }
    }
    
    function updateItemTotal(itemElement) {
        const price = parseFloat(itemElement.dataset.price);
        const quantity = parseInt(itemElement.querySelector('.page-quantity').textContent);
        const total = price * quantity;
        itemElement.querySelector('.page-item-total').textContent = total.toFixed(2);
        return total;
    }
    
    function updateCartTotal() {
        let subtotal = 0;
        document.querySelectorAll('.page-cart-item').forEach(item => {
            subtotal += updateItemTotal(item);
        });
        
        document.getElementById('page-cart-subtotal').textContent = `₦${subtotal.toFixed(2)}`;
        document.getElementById('page-cart-total').textContent = `₦${subtotal.toFixed(2)}`;
        console.log('Cart total updated:', subtotal);
    }
    
    async function updateQuantityOnServer(itemId, quantity) {
        try {
            const response = await fetch(`/cart/update/${itemId}`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ quantity: quantity })
            });
            
            const data = await response.json();
            
            if (data.success) {
                showMessage('Quantity updated!', 'success');
                // Update cart counter in header
                updateHeaderCartCounter(data.cart_count);
            } else {
                showMessage(data.message || 'Update failed', 'error');
                // Revert UI on failure
                updateCartTotal();
            }
        } catch (error) {
            console.error('Error updating quantity:', error);
            showMessage('Network error. Please try again.', 'error');
            updateCartTotal();
        }
    }
    
    async function removeItemFromServer(itemId) {
        try {
            const response = await fetch(`/cart/remove/${itemId}`, {
                method: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json'
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                showMessage('Item removed from cart!', 'success');
                // Update cart counter in header
                updateHeaderCartCounter(data.cart_count);
            } else {
                showMessage(data.message || 'Remove failed', 'error');
            }
        } catch (error) {
            console.error('Error removing item:', error);
            showMessage('Network error. Please try again.', 'error');
        }
    }
    
    function updateHeaderCartCounter(count) {
        const cartCounter = document.querySelector('.cart-counter');
        if (cartCounter && count !== undefined) {
            cartCounter.textContent = count;
        }
    }
    
    function showMessage(message, type) {
        // Remove existing messages
        const existingMessages = document.querySelectorAll('.cart-page-message');
        existingMessages.forEach(msg => msg.remove());
        
        const messageDiv = document.createElement('div');
        messageDiv.className = 'cart-page-message';
        messageDiv.style.cssText = `
            position: fixed;
            top: 20px;
            right: 20px;
            padding: 12px 20px;
            background: ${type === 'success' ? '#28a745' : '#dc3545'};
            color: white;
            border-radius: 5px;
            z-index: 10000;
            font-weight: 500;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            animation: slideIn 0.3s ease;
        `;
        
        messageDiv.innerHTML = `
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} me-2"></i>
            ${message}
        `;
        
        document.body.appendChild(messageDiv);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            if (messageDiv.parentNode) {
                messageDiv.style.animation = 'slideIn 0.3s ease reverse';
                setTimeout(() => messageDiv.remove(), 300);
            }
        }, 3000);
    }
    
    // Initial total calculation
    updateCartTotal();
    console.log('🎉 Cart page ready!');
});
</script>

<style>
.page-qty-btn {
    transition: all 0.2s ease;
}

.page-qty-btn:hover {
    background-color: rgba(0,0,0,0.1) !important;
    transform: scale(1.1);
}

.page-remove-item {
    transition: all 0.2s ease;
}

.page-remove-item:hover {
    transform: scale(1.1);
}

.page-cart-item {
    transition: all 0.3s ease;
}

.page-cart-item:hover {
    box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

@keyframes slideIn {
    from { transform: translateX(100%); opacity: 0; }
    to { transform: translateX(0); opacity: 1; }
}
</style>
@endsection