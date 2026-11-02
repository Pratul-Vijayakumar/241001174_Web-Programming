<?php
// cart.php - EcoMart Shopping Cart Page
$pageTitle = 'Your Shopping Bag';
$metaDescription = 'Review your eco-friendly selections in your EcoMart shopping bag and calculate your positive environmental savings.';
require_once __DIR__ . '/includes/header.php';
?>

<!-- Cart Header Banner -->
<section class="page-header" style="padding: 40px 0;">
    <div class="container">
        <h1 class="page-title">Shopping Bag</h1>
        <div class="page-breadcrumb">
            <a href="index.php">Home</a> / <a href="products.php">Marketplace</a> / <span>Shopping Bag</span>
        </div>
    </div>
</section>

<!-- Cart Section -->
<section class="cart-section">
    <div class="container">
        <div class="cart-layout">
            <!-- Left Side: Dynamic LocalStorage Cart Items -->
            <div class="cart-card">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 24px; padding-bottom: 16px; border-bottom: 1.5px solid var(--border-color);">
                    <h2 style="font-size: 1.4rem; color: var(--forest-green); font-weight: 700;">Cart Products</h2>
                    <button type="button" class="btn-sm btn-secondary" onclick="EcoCart.clearCart(); renderCartPage(); EcoToast.show('Cart cleared 🍃');">
                        Clear All Items
                    </button>
                </div>

                <!-- Container rendered via JavaScript from LocalStorage -->
                <div id="cartItemsContainer">
                    <!-- Populated by script.js renderCartPage() -->
                </div>

                <div style="margin-top: 32px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                    <a href="products.php" class="btn btn-secondary">← Continue Shopping</a>
                </div>
            </div>

            <!-- Right Side: Order Summary Card -->
            <div class="summary-card">
                <h3 class="summary-title">Order Summary</h3>

                <div class="summary-line">
                    <span>Selected Items</span>
                    <strong id="cartSummaryCount" style="color: var(--dark-text);">0 items</strong>
                </div>

                <div class="summary-line">
                    <span>Items Subtotal</span>
                    <strong id="cartSubtotalAmount" style="color: var(--dark-text);">₹0.00</strong>
                </div>

                <div class="summary-line">
                    <span>Eco Packaging & Tape</span>
                    <span style="color: #2e7d32; font-weight: 700;">FREE</span>
                </div>

                <div class="summary-line">
                    <span>Carbon-Neutral Delivery</span>
                    <span style="color: #2e7d32; font-weight: 700;">FREE</span>
                </div>

                <div class="eco-savings-badge">
                    <span>🌱</span>
                    <span>1 mangrove tree will be planted with this order</span>
                </div>

                <div class="summary-line total-line">
                    <span>Estimated Total</span>
                    <span id="cartTotalAmount">₹0.00</span>
                </div>

                <div style="margin-top: 28px;">
                    <a href="checkout.php" id="proceedToCheckoutBtn" class="btn btn-primary btn-block btn-lg">
                        Proceed to Checkout ➔
                    </a>
                </div>

                <div style="margin-top: 20px; text-align: center; font-size: 0.84rem; color: var(--text-muted);">
                    🔒 100% Secure Checkout Guarantee • Cash on Delivery Available
                </div>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
