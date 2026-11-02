/**
 * EcoMart - Sustainable Product Marketplace
 * Core JavaScript: Cart (LocalStorage), Wishlist, Notifications, Filters & Mobile Nav
 */

const EcoCart = {
    STORAGE_KEY: 'ecomart_cart',

    getItems() {
        try {
            const raw = localStorage.getItem(this.STORAGE_KEY);
            return raw ? JSON.parse(raw) : [];
        } catch (e) {
            console.error('Failed to read cart from LocalStorage', e);
            return [];
        }
    },

    saveItems(items) {
        try {
            localStorage.setItem(this.STORAGE_KEY, JSON.stringify(items));
            this.updateBadge();
        } catch (e) {
            console.error('Failed to save cart to LocalStorage', e);
        }
    },

    addItem(product, quantity = 1) {
        quantity = parseInt(quantity, 10);
        if (isNaN(quantity) || quantity <= 0) quantity = 1;

        let items = this.getItems();
        const existingIndex = items.findIndex(item => item.id === product.id);

        if (existingIndex > -1) {
            items[existingIndex].quantity += quantity;
        } else {
            items.push({
                id: product.id,
                name: product.name,
                price: parseFloat(product.price),
                image: product.image,
                category: product.category || 'Eco Product',
                quantity: quantity
            });
        }

        this.saveItems(items);
        EcoToast.show(`Added ${quantity}x "${product.name}" to your cart! 🌿`);
    },

    updateQuantity(productId, quantity) {
        productId = parseInt(productId, 10);
        quantity = parseInt(quantity, 10);

        let items = this.getItems();
        if (quantity <= 0) {
            this.removeItem(productId);
            return;
        }

        const index = items.findIndex(item => item.id === productId);
        if (index > -1) {
            items[index].quantity = quantity;
            this.saveItems(items);
        }
    },

    removeItem(productId) {
        productId = parseInt(productId, 10);
        let items = this.getItems();
        const itemToRemove = items.find(item => item.id === productId);
        items = items.filter(item => item.id !== productId);
        this.saveItems(items);

        if (itemToRemove) {
            EcoToast.show(`Removed "${itemToRemove.name}" from your cart.`);
        }
    },

    clearCart() {
        localStorage.removeItem(this.STORAGE_KEY);
        this.updateBadge();
    },

    getCount() {
        const items = this.getItems();
        return items.reduce((acc, item) => acc + (item.quantity || 0), 0);
    },

    getSubtotal() {
        const items = this.getItems();
        return items.reduce((acc, item) => acc + ((item.price || 0) * (item.quantity || 0)), 0);
    },

    updateBadge() {
        const count = this.getCount();
        const badges = document.querySelectorAll('.cart-count-badge');
        badges.forEach(badge => {
            badge.textContent = count;
            badge.style.display = count > 0 ? 'flex' : 'none';
            // Bounce animation
            badge.style.transform = 'scale(1.3)';
            setTimeout(() => badge.style.transform = 'scale(1)', 200);
        });
    }
};

const EcoWishlist = {
    STORAGE_KEY: 'ecomart_wishlist',

    getItems() {
        try {
            const raw = localStorage.getItem(this.STORAGE_KEY);
            return raw ? JSON.parse(raw) : [];
        } catch (e) {
            return [];
        }
    },

    toggle(productId, productName) {
        productId = parseInt(productId, 10);
        let items = this.getItems();
        const exists = items.includes(productId);

        if (exists) {
            items = items.filter(id => id !== productId);
            EcoToast.show(`Removed from wishlist 🤍`);
        } else {
            items.push(productId);
            EcoToast.show(`Saved "${productName || 'Product'}" to wishlist! 💚`);
        }

        localStorage.setItem(this.STORAGE_KEY, JSON.stringify(items));
        this.updateUI();
    },

    updateUI() {
        const items = this.getItems();
        const badge = document.querySelector('.wishlist-count-badge');
        if (badge) {
            badge.textContent = items.length;
            badge.style.display = items.length > 0 ? 'flex' : 'none';
        }

        document.querySelectorAll('.product-wishlist-btn').forEach(btn => {
            const id = parseInt(btn.getAttribute('data-id'), 10);
            if (items.includes(id)) {
                btn.classList.add('active');
                btn.innerHTML = '♥';
            } else {
                btn.classList.remove('active');
                btn.innerHTML = '♡';
            }
        });
    }
};

const EcoToast = {
    show(message) {
        let container = document.querySelector('.toast-container');
        if (!container) {
            container = document.createElement('div');
            container.className = 'toast-container';
            document.body.appendChild(container);
        }

        const toast = document.createElement('div');
        toast.className = 'toast';
        toast.innerHTML = `
            <span>🌿</span>
            <div style="flex:1;">${message}</div>
            <button style="background:none; border:none; color:#fff; cursor:pointer; opacity:0.8; font-size:1.1rem;" onclick="this.parentElement.remove()">✕</button>
        `;
        container.appendChild(toast);

        setTimeout(() => {
            toast.classList.add('toast-remove');
            setTimeout(() => toast.remove(), 350);
        }, 3500);
    }
};

// DOM Initializations
document.addEventListener('DOMContentLoaded', () => {
    // 1. Initial Badge Render
    EcoCart.updateBadge();
    EcoWishlist.updateUI();

    // 2. Mobile Menu Toggle
    const mobileToggle = document.querySelector('.mobile-toggle');
    const navLinks = document.querySelector('.nav-links');
    if (mobileToggle && navLinks) {
        mobileToggle.addEventListener('click', () => {
            navLinks.classList.toggle('active');
        });
    }

    // 3. Back-to-Top Button
    const backToTopBtn = document.querySelector('.back-to-top');
    if (backToTopBtn) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTopBtn.classList.add('show');
            } else {
                backToTopBtn.classList.remove('show');
            }
        });
        backToTopBtn.addEventListener('click', () => {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // 4. Cart Add Event Listeners for buttons
    document.addEventListener('click', (e) => {
        // Add to Cart
        const addBtn = e.target.closest('.js-add-to-cart');
        if (addBtn) {
            e.preventDefault();
            const product = {
                id: parseInt(addBtn.dataset.id, 10),
                name: addBtn.dataset.name,
                price: parseFloat(addBtn.dataset.price),
                image: addBtn.dataset.image,
                category: addBtn.dataset.category
            };
            const qtyInput = document.querySelector('.js-quantity-input');
            const qty = qtyInput ? parseInt(qtyInput.value, 10) : 1;
            EcoCart.addItem(product, qty);
        }

        // Wishlist Toggle
        const wishBtn = e.target.closest('.product-wishlist-btn');
        if (wishBtn) {
            e.preventDefault();
            const id = wishBtn.dataset.id;
            const name = wishBtn.dataset.name;
            EcoWishlist.toggle(id, name);
        }
    });

    // 5. Quantity selector controls (+ / -)
    const qtyInput = document.querySelector('.js-quantity-input');
    const qtyMinus = document.querySelector('.js-qty-minus');
    const qtyPlus = document.querySelector('.js-qty-plus');

    if (qtyInput && qtyMinus && qtyPlus) {
        qtyMinus.addEventListener('click', () => {
            let val = parseInt(qtyInput.value, 10) || 1;
            if (val > 1) qtyInput.value = val - 1;
        });
        qtyPlus.addEventListener('click', () => {
            let val = parseInt(qtyInput.value, 10) || 1;
            qtyInput.value = val + 1;
        });
    }

    // 6. Products Page Filtering and Searching
    const searchInput = document.getElementById('productSearchInput');
    const sortSelect = document.getElementById('productSortSelect');
    const catPills = document.querySelectorAll('.cat-pill');
    const productsGrid = document.getElementById('productsCatalogGrid');

    if (productsGrid) {
        const filterProducts = () => {
            const query = (searchInput ? searchInput.value : '').toLowerCase().trim();
            const activePill = document.querySelector('.cat-pill.active');
            const selectedCategory = activePill ? activePill.dataset.category : 'all';
            const sortMode = sortSelect ? sortSelect.value : 'default';

            const cards = Array.from(productsGrid.querySelectorAll('.product-card'));
            let visibleCount = 0;

            cards.forEach(card => {
                const name = (card.dataset.name || '').toLowerCase();
                const category = card.dataset.category || '';
                const matchesSearch = !query || name.includes(query) || category.toLowerCase().includes(query);
                const matchesCategory = selectedCategory === 'all' || category === selectedCategory;

                if (matchesSearch && matchesCategory) {
                    card.style.display = 'flex';
                    visibleCount++;
                } else {
                    card.style.display = 'none';
                }
            });

            // Sorting visible cards
            if (sortMode !== 'default') {
                const sortedCards = cards.filter(c => c.style.display !== 'none').sort((a, b) => {
                    const priceA = parseFloat(a.dataset.price);
                    const priceB = parseFloat(b.dataset.price);
                    if (sortMode === 'price-asc') return priceA - priceB;
                    if (sortMode === 'price-desc') return priceB - priceA;
                    if (sortMode === 'name-asc') return a.dataset.name.localeCompare(b.dataset.name);
                    return 0;
                });

                sortedCards.forEach(c => productsGrid.appendChild(c));
            }

            // No results notice
            let noResultMsg = document.getElementById('noProductsMessage');
            if (visibleCount === 0) {
                if (!noResultMsg) {
                    noResultMsg = document.createElement('div');
                    noResultMsg.id = 'noProductsMessage';
                    noResultMsg.className = 'empty-state';
                    noResultMsg.style.gridColumn = '1 / -1';
                    noResultMsg.innerHTML = `
                        <div class="empty-state-icon">🔍</div>
                        <h3>No Sustainable Products Found</h3>
                        <p>We couldn't find matches for "${query}". Try another search term or reset your category filter.</p>
                        <button class="btn btn-primary" onclick="window.resetFilters()">View All Products</button>
                    `;
                    productsGrid.appendChild(noResultMsg);
                }
            } else if (noResultMsg) {
                noResultMsg.remove();
            }
        };

        window.resetFilters = () => {
            if (searchInput) searchInput.value = '';
            catPills.forEach(p => p.classList.toggle('active', p.dataset.category === 'all'));
            if (sortSelect) sortSelect.value = 'default';
            filterProducts();
        };

        if (searchInput) searchInput.addEventListener('input', filterProducts);
        if (sortSelect) sortSelect.addEventListener('change', filterProducts);

        catPills.forEach(pill => {
            pill.addEventListener('click', (e) => {
                e.preventDefault();
                catPills.forEach(p => p.classList.remove('active'));
                pill.classList.add('active');
                filterProducts();
            });
        });
    }

    // 7. Cart Page Render and Interactions
    const cartContainer = document.getElementById('cartItemsContainer');
    if (cartContainer) {
        renderCartPage();
    }

    // 8. Checkout Page Render and Sync
    const checkoutContainer = document.getElementById('checkoutOrderReview');
    if (checkoutContainer) {
        renderCheckoutReview();
    }
});

/**
 * Render the Cart Page dynamically from LocalStorage
 */
function renderCartPage() {
    const container = document.getElementById('cartItemsContainer');
    const summarySubtotal = document.getElementById('cartSubtotalAmount');
    const summaryTotal = document.getElementById('cartTotalAmount');
    const summaryCount = document.getElementById('cartSummaryCount');
    const checkoutBtn = document.getElementById('proceedToCheckoutBtn');

    if (!container) return;

    const items = EcoCart.getItems();

    if (items.length === 0) {
        container.innerHTML = `
            <div class="empty-state">
                <div class="empty-state-icon">🛒</div>
                <h3>Your shopping bag is empty</h3>
                <p>Discover our curated collection of zero-waste, eco-friendly essentials to begin your green journey.</p>
                <a href="products.php" class="btn btn-primary">Start Shopping</a>
            </div>
        `;
        if (summarySubtotal) summarySubtotal.textContent = '₹0.00';
        if (summaryTotal) summaryTotal.textContent = '₹0.00';
        if (summaryCount) summaryCount.textContent = '0 items';
        if (checkoutBtn) {
            checkoutBtn.classList.add('disabled');
            checkoutBtn.style.pointerEvents = 'none';
            checkoutBtn.style.opacity = '0.5';
        }
        return;
    }

    if (checkoutBtn) {
        checkoutBtn.classList.remove('disabled');
        checkoutBtn.style.pointerEvents = 'auto';
        checkoutBtn.style.opacity = '1';
    }

    let rowsHtml = `
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
    `;

    items.forEach(item => {
        const itemSubtotal = (item.price * item.quantity).toFixed(2);
        rowsHtml += `
            <tr class="cart-item-row" data-id="${item.id}">
                <td>
                    <div class="cart-product-info">
                        <img src="${item.image}" alt="${item.name}" class="cart-item-img">
                        <div>
                            <div class="cart-item-title"><a href="product-details.php?id=${item.id}">${item.name}</a></div>
                            <div class="cart-item-category">${item.category}</div>
                        </div>
                    </div>
                </td>
                <td>
                    <div class="cart-item-price">₹${item.price.toFixed(2)}</div>
                </td>
                <td>
                    <div class="quantity-selector">
                        <button type="button" class="qty-btn" onclick="modifyCartQty(${item.id}, -1)">−</button>
                        <input type="number" class="qty-input" value="${item.quantity}" readonly>
                        <button type="button" class="qty-btn" onclick="modifyCartQty(${item.id}, 1)">+</button>
                    </div>
                </td>
                <td>
                    <div class="cart-item-total">₹${itemSubtotal}</div>
                </td>
                <td>
                    <button type="button" class="cart-remove-btn" onclick="removeCartItem(${item.id})" title="Remove product">✕</button>
                </td>
            </tr>
        `;
    });

    rowsHtml += `</tbody></table>`;
    container.innerHTML = rowsHtml;

    const subtotal = EcoCart.getSubtotal();
    const count = EcoCart.getCount();

    if (summarySubtotal) summarySubtotal.textContent = `₹${subtotal.toFixed(2)}`;
    if (summaryTotal) summaryTotal.textContent = `₹${subtotal.toFixed(2)}`;
    if (summaryCount) summaryCount.textContent = `${count} ${count === 1 ? 'item' : 'items'}`;
}

function modifyCartQty(id, delta) {
    const items = EcoCart.getItems();
    const item = items.find(i => i.id === id);
    if (item) {
        EcoCart.updateQuantity(id, item.quantity + delta);
        renderCartPage();
    }
}

function removeCartItem(id) {
    EcoCart.removeItem(id);
    renderCartPage();
}

/**
 * Render the Checkout review list and serialize cart into hidden form field
 */
function renderCheckoutReview() {
    const container = document.getElementById('checkoutOrderReview');
    const inputField = document.getElementById('checkoutCartDataInput');
    const summarySubtotal = document.getElementById('checkoutSubtotal');
    const summaryTotal = document.getElementById('checkoutTotal');
    const placeOrderBtn = document.getElementById('placeOrderBtn');

    if (!container) return;

    const items = EcoCart.getItems();

    if (items.length === 0) {
        container.innerHTML = `
            <div class="empty-state" style="padding: 30px 10px;">
                <p>Your cart is empty. Please add sustainable items before proceeding to checkout.</p>
                <a href="products.php" class="btn btn-primary btn-sm">Explore Marketplace</a>
            </div>
        `;
        if (placeOrderBtn) {
            placeOrderBtn.disabled = true;
            placeOrderBtn.style.opacity = '0.5';
        }
        return;
    }

    if (inputField) {
        inputField.value = JSON.stringify(items);
    }

    let listHtml = `<div style="display: flex; flex-direction: column; gap: 14px; margin-bottom: 20px;">`;
    items.forEach(item => {
        listHtml += `
            <div style="display: flex; justify-content: space-between; align-items: center; gap: 12px; font-size: 0.94rem;">
                <div style="display: flex; align-items: center; gap: 10px;">
                    <img src="${item.image}" alt="${item.name}" style="width: 44px; height: 44px; border-radius: 6px; object-fit: cover;">
                    <div>
                        <div style="font-weight: 600; color: var(--forest-green); max-width: 180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">${item.name}</div>
                        <div style="font-size: 0.82rem; color: var(--text-muted);">Qty: ${item.quantity} × ₹${item.price.toFixed(2)}</div>
                    </div>
                </div>
                <div style="font-weight: 700; color: var(--dark-text);">₹${(item.price * item.quantity).toFixed(2)}</div>
            </div>
        `;
    });
    listHtml += `</div>`;

    container.innerHTML = listHtml;

    const subtotal = EcoCart.getSubtotal();
    if (summarySubtotal) summarySubtotal.textContent = `₹${subtotal.toFixed(2)}`;
    if (summaryTotal) summaryTotal.textContent = `₹${subtotal.toFixed(2)}`;
}
