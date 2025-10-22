<!-- Currency & Cart System Scripts -->
<script>
/* -------------------------------
   SIMPLE CURRENCY TOGGLE SYSTEM
-------------------------------- */
class SimpleCurrencyToggle {
    constructor() {
        this.isNGNMode = localStorage.getItem('currencyMode') === 'NGN';
        this.exchangeRate = 1500; // fallback rate
        this.originalPrices = new Map();
        this.isConverting = false;
        this.init();
    }

    async init() {
        await this.loadExchangeRate();
        this.setupButton();
        this.recordOriginalPrices();
        this.applyCurrentMode();
    }

    async loadExchangeRate() {
        try {
            const cached = localStorage.getItem('ngnExchangeRate');
            const cacheTime = localStorage.getItem('ngnExchangeRateTime');
            if (cached && cacheTime && (Date.now() - cacheTime) < 3600000) {
                this.exchangeRate = parseFloat(cached);
                return;
            }

            const response = await fetch('https://api.exchangerate-api.com/v4/latest/USD');
            const data = await response.json();
            if (data.rates.NGN) {
                this.exchangeRate = data.rates.NGN;
                localStorage.setItem('ngnExchangeRate', this.exchangeRate);
                localStorage.setItem('ngnExchangeRateTime', Date.now());
            }
        } catch (err) {
            console.warn('Using fallback rate', this.exchangeRate);
        }
    }

    setupButton() {
        const btn = document.createElement('div');
        btn.id = 'currency-toggle-btn';
        btn.className = 'currency-toggle-button';
        btn.innerHTML = `<span class="currency-icon">$</span><span class="currency-text">USD</span>`;
        document.body.appendChild(btn);

        if (this.isNGNMode) btn.classList.add('ngn-mode');
        this.updateButtonText();

        btn.addEventListener('click', () => this.toggleCurrency());
    }

    toggleCurrency() {
        this.isNGNMode = !this.isNGNMode;
        localStorage.setItem('currencyMode', this.isNGNMode ? 'NGN' : 'USD');
        if (this.isNGNMode) this.convertToNGN(); else this.convertToUSD();
        this.updateButtonText();
        this.showNotification();
    }

    updateButtonText() {
        const btn = document.querySelector('#currency-toggle-btn');
        const text = btn.querySelector('.currency-text');
        if (this.isNGNMode) {
            btn.classList.add('ngn-mode');
            text.textContent = 'NGN';
        } else {
            btn.classList.remove('ngn-mode');
            text.textContent = 'USD';
        }
    }

    recordOriginalPrices() {
        document.querySelectorAll('.current_price, .price, .new_price, .old_price').forEach(el => {
            const priceMatch = el.textContent.match(/\$([\d,\.]+)/);
            if (priceMatch) {
                const price = parseFloat(priceMatch[1].replace(/,/g, ''));
                this.originalPrices.set(el, price);
            }
        });
    }

    convertToNGN() {
        this.originalPrices.forEach((price, el) => {
            const ngn = price * this.exchangeRate;
            el.innerHTML = `<span class="price-converted">₦${ngn.toLocaleString()}</span>`;
        });
    }

    convertToUSD() {
        this.originalPrices.forEach((price, el) => {
            el.innerHTML = `$${price.toLocaleString(undefined, {minimumFractionDigits: 2})}`;
        });
    }

    applyCurrentMode() {
        if (this.isNGNMode) this.convertToNGN();
    }

    showNotification() {
        const note = document.createElement('div');
        note.className = 'conversion-notification';
        note.innerHTML = `<strong>Prices now in ${this.isNGNMode ? '₦ NGN' : '$ USD'}</strong><br>
            <small>Rate: 1 USD = ${this.exchangeRate.toLocaleString()} NGN</small>`;
        document.body.appendChild(note);
        setTimeout(() => note.remove(), 3000);
    }
}

window.SimpleCurrencyToggle = SimpleCurrencyToggle;

/* -------------------------------
        CART MANAGER SYSTEM
-------------------------------- */
window.CartManager = {
    CSRF_TOKEN: '{{ csrf_token() }}',

    updateMiniCart: function(data) {
        const miniCart = document.querySelector('.mini_cart');
        if (!miniCart) return;

        const gallery = miniCart.querySelector('.cart_gallery');
        gallery.innerHTML = `<div class="cart_close">
            <div class="cart_text"><h3>Cart</h3></div>
            <div class="mini_cart_close"><a href="javascript:void(0)"><i class="ion-android-close"></i></a></div>
        </div>`;

        if (!data.cart || Object.keys(data.cart.items || {}).length === 0) {
            gallery.innerHTML += '<p class="text-center">Your cart is empty</p>';
        } else {
            Object.entries(data.cart.items).forEach(([id, item]) => {
                gallery.innerHTML += `
                    <div class="cart_item" data-id="${id}">
                        <div class="cart_img"><img src="${item.image}" alt="${item.name}" width="50"></div>
                        <div class="cart_info"><a href="#">${item.name}</a><p>${item.quantity} × $${item.price}</p></div>
                        <div class="cart_remove"><a href="javascript:void(0)" data-id="${id}" class="mini-cart-remove"><i class="ion-ios-close-outline"></i></a></div>
                    </div>`;
            });
        }
    },

    showNotification: function(message, type = 'success') {
        const note = document.createElement('div');
        note.className = `cart-notification alert alert-${type} fixed-top mx-auto mt-3`;
        note.style.cssText = 'max-width:300px;left:50%;transform:translateX(-50%);z-index:9999;text-align:center;';
        note.textContent = message;
        document.body.appendChild(note);
        setTimeout(() => note.remove(), 3000);
    }
};

/* -------------------------------
           INITIALIZATION
-------------------------------- */
document.addEventListener('DOMContentLoaded', function() {
    window.currencyToggle = new SimpleCurrencyToggle();
    window.CartManager.updateMiniCart({ cart: { items: {} } });
});
</script>

<style>
.currency-toggle-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
    color: white;
    padding: 10px 20px;
    border-radius: 25px;
    font-weight: bold;
    cursor: pointer;
    z-index: 10000;
    display: flex;
    align-items: center;
    gap: 6px;
}
.currency-toggle-button.ngn-mode {
    background: linear-gradient(135deg, #ffcc00, #ff8800);
}
.price-converted {
    background-color: #fff8e1;
    padding: 2px 5px;
    border-radius: 3px;
}
.conversion-notification {
    position: fixed;
    top: 20px;
    right: 20px;
    background: #fff;
    border-left: 4px solid #f4b400;
    padding: 10px 15px;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    z-index: 10001;
}
</style>
