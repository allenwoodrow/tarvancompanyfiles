<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>So Sweet Tarvan - Fast Food Ordering Restaurant & Cafe</title>
  <!--Essential css files-->
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/nice-select.css">
  <link rel="stylesheet" href="assets/css/animate.css">
  <link rel="stylesheet" href="assets/css/owl.carousel.min.css">
  <link rel="stylesheet" href="assets/css/owl.theme.default.min.css">
  <link rel="stylesheet" href="assets/css/magnific-popup.css">
  <link rel="stylesheet" href="assets/css/all.css">
  <link rel="stylesheet" href="assets/css/lenis.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    /* Custom styles for cart modal */
    .cart-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 8px 0;
      border-bottom: 1px solid #eee;
    }

    .cart-item img {
      width: 50px;
      height: 50px;
      object-fit: cover;
      border-radius: 50%;
    }

    .cart-item .item-details {
      flex: 1;
      margin-left: 10px;
    }

    .cart-item .item-name {
      font-weight: 600;
      font-size: 14px;
      margin-bottom: 2px;
    }

    .cart-item small {
      color: #666;
    }

    .cart-item .actions {
      display: flex;
      align-items: center;
      gap: 6px;
    }

    /* Cart specific styles */
    .cart-item {
        transition: all 0.3s ease;
    }

    .cart-item:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }

    .qty-input {
        border: 1px solid #ddd;
        margin: 0 5px;
    }

    .btn-link {
        text-decoration: none;
    }

    .btn-link:hover {
        background-color: rgba(0,0,0,0.05);
    }

    /* Ensure proper spacing */
    .card.rounded-3 {
        border-radius: 0.75rem !important;
    }

    .qty-btn {
      width: 28px;
      height: 28px;
      border: none;
      background: #f5f5f5;
      border-radius: 5px;
      font-weight: bold;
      transition: all 0.2s;
    }

    .qty-btn:hover {
      background: #f1c40f;
    }

    .remove-item {
      border: none;
      background: transparent;
      color: #dc3545;
      font-size: 16px;
      line-height: 1;
    }

    .remove-item:hover {
      color: #a71d2a;
    }

    /* Cart counter styles */
    .cart-counter {
      position: absolute;
      top: -8px;
      right: -8px;
      background: #f39c12;
      color: white;
      border-radius: 50%;
      width: 20px;
      height: 20px;
      font-size: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      font-weight: bold;
    }
  </style>

  <!--favicon-->
  <link rel="icon" href="assets/images/favicon.png">
</head>

<body class="">

    <!-- Header -->
    @include('layouts.navigation')

    <!-- Page Content -->
    <main>
        @yield('content')
    </main>

<!-- footer -->
<footer class="roister-footer-1" data-background="{{ asset('assets/images/bg/footer-bg.png') }}">
  <div class="container">
    <div class="row">
      <div class="col-lg-6 left-side border-right">
        <div class="download-app-widget">
          <h3 class="title mb-48">Order Easily — Coming Soon on App Stores</h3>
          <p class="des mb-40">Your favorite meals anytime, anywhere.</p>
          <div class="btn-wraper">
            <a href="#" class="primary-btn border-radius-6">Play Store</a>
            <a href="#" class="outline-white-btn border-radius-6">Apple Store</a>
          </div>
        </div>
      </div>
      <div class="col-lg-6 right-side">
        <div class="row gy-4 justify-content-center">
          <div class="col-sm-6 col-md-5">
            <div class="footer-widget">
              <h4 class="widget-title mb-24">Popular Dishes</h4>
              <ul>
                <li><a href="#">Jollof Rice</a></li>
                <li><a href="#">Pounded Yam & Egusi</a></li>
                <li><a href="#">Pepper Soup</a></li>
                <li><a href="#">Suya Mix</a></li>
                <li><a href="#">Fried Plantain & Egg</a></li>
                <li><a href="#">Ofada Stew</a></li>
              </ul>
            </div>
          </div>
          <div class="col-sm-6 col-md-5">
            <div class="footer-widget">
              <h4 class="widget-title mb-24">Quick Links</h4>
              <ul>
                <li><a href="{{ url('/') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('shop') }}">Shop Meals</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">FAQs</a></li>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="copyright-area">
      <p>© {{ date('Y') }} So Sweet Tarvan. All Rights Reserved.</p>
    </div>
  </div>
</footer>

<button type="button" class="scroll-top-btn"><i class="fa-solid fa-angles-up"></i></button>

<!--Esential Js Files-->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/nice-select.js"></script>
<script src="assets/js/wow.js"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/magnific-popup.js"></script>
<script src="assets/js/counterup.js"></script>
<script src="assets/js/waypoints.min.js"></script>
<script src="assets/js/lenis.min.js"></script>
<script src="assets/js/gsap.min.js"></script>
<script src="assets/js/ScrollTrigger.min.js"></script>
<script src="assets/js/default-passive-events.js"></script>
<script src="assets/js/script.js"></script>

<!-- Global Cart Functionality - always load -->
<script>
(function () {
    const CSRF = '{{ csrf_token() }}';

    async function safeFetchJSON(url, options = {}) {
        try {
            const res = await fetch(url, options);
            const text = await res.text();
            try {
                return { ok: res.ok, status: res.status, data: JSON.parse(text) };
            } catch {
                return { ok: res.ok, status: res.status, data: { success: false, message: 'Invalid JSON' } };
            }
        } catch (err) {
            return { ok: false, status: 0, data: { success: false, message: 'Network error' } };
        }
    }

    // Refresh cart data for navbar / offcanvas
    async function refreshCartModal() {
        const resp = await safeFetchJSON('/cart/data', { method: 'GET', headers: { 'Accept': 'application/json' }});
        if (!resp.ok && resp.status === 401 && resp.data && resp.data.redirect) {
            // not authenticated
            updateHeaderCartCounter(0);
            return;
        }
        const data = resp.data;
        if (!data.success || !data.cart) {
            updateHeaderCartCounter(0);
            return;
        }

        const cart = data.cart;
        const cartItemsDiv = document.getElementById('cart-items'); // offcanvas modal element
        const cartCounter = document.querySelector('.cart-counter');

        // Update navbar count
        if (cartCounter) {
            cartCounter.textContent = data.cart_count ?? cart.count ?? 0;
        }

        if (!cartItemsDiv) {
            // no modal DOM here — nothing to populate
            return;
        }

        // Build content
        cartItemsDiv.innerHTML = '';
        if (!cart.items || Object.keys(cart.items).length === 0) {
            cartItemsDiv.innerHTML = '<p class="text-center text-muted">Your cart is empty.</p>';
        } else {
            Object.values(cart.items).forEach(item => {
                const div = document.createElement('div');
                div.className = 'cart-item';
                div.dataset.id = item.id;
                div.innerHTML = `
                    <img src="${item.image}" alt="${item.name}">
                    <div class="item-details">
                        <div class="item-name">${item.name}</div>
                        <small>₦${Number(item.price).toLocaleString()} × ${item.quantity}</small>
                    </div>
                    <div class="actions">
                        <button class="qty-btn decrease" data-id="${item.id}">-</button>
                        <span class="qty">${item.quantity}</span>
                        <button class="qty-btn increase" data-id="${item.id}">+</button>
                        <button class="remove-item" data-id="${item.id}" title="Remove"><i class="fa fa-trash"></i></button>
                    </div>
                `;
                cartItemsDiv.appendChild(div);
            });
        }

        // Update totals if present
        const subtotalEl = document.getElementById('cart-subtotal');
        const totalEl = document.getElementById('cart-total');
        if (subtotalEl) subtotalEl.textContent = `₦${Number(cart.subtotal).toLocaleString()}`;
        if (totalEl) totalEl.textContent = `₦${Number(cart.total).toLocaleString()}`;

        attachModalEventListeners();
    }

    function attachModalEventListeners() {
        const cartItemsDiv = document.getElementById('cart-items');
        if (!cartItemsDiv) return;

        // quantity buttons
        cartItemsDiv.querySelectorAll('.qty-btn').forEach(btn => {
            btn.onclick = async function () {
                const itemId = this.dataset.id;
                const isIncrease = this.classList.contains('increase');
                const qtySpan = this.parentElement.querySelector('.qty');
                let quantity = parseInt(qtySpan.textContent);
                quantity = isIncrease ? quantity + 1 : Math.max(1, quantity - 1);

                const resp = await safeFetchJSON(`/cart/update/${itemId}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': CSRF,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ quantity })
                });

                if (resp.data && resp.data.success) {
                    // refresh whole modal UI from server authoritative state
                    refreshCartModal();
                } else if (resp.data && resp.data.redirect) {
                    window.location.href = resp.data.redirect;
                } else {
                    alert(resp.data.message || 'Could not update item.');
                }
            };
        });

        // remove buttons
        cartItemsDiv.querySelectorAll('.remove-item').forEach(btn => {
            btn.onclick = async function () {
                const itemId = this.dataset.id;
                if (!confirm('Remove this item from cart?')) return;

                const resp = await safeFetchJSON(`/cart/remove/${itemId}`, {
                    method: 'DELETE',
                    headers: { 'X-CSRF-TOKEN': CSRF, 'Accept': 'application/json' }
                });

                if (resp.data && resp.data.success) {
                    refreshCartModal();
                } else {
                    alert(resp.data.message || 'Could not remove item.');
                }
            };
        });
    }

    function updateHeaderCartCounter(count) {
        const cartCounter = document.querySelector('.cart-counter');
        if (cartCounter) cartCounter.textContent = (typeof count === 'number' ? count : cartCounter.textContent);
    }

    // Expose a small API for other pages
    window.CartAPI = {
        refresh: refreshCartModal,
        safeFetchJSON
    };

    // initialize on load
    document.addEventListener('DOMContentLoaded', function () {
        // initial load
        refreshCartModal();
    });
})();
</script>

<!-- Safe run utility -->
<script>
window.safeRun = function (fn) {
    try { fn(); } catch (e) { console.warn('SafeRun skipped error:', e); }
};
</script>

</body>
</html>