<?php
// order-success.php - EcoMart Order Confirmation Page
require_once __DIR__ . '/includes/functions.php';

$order = !empty($_SESSION['latest_order']) ? $_SESSION['latest_order'] : null;

if (!$order) {
    // If accessed directly without an order, redirect to marketplace
    header('Location: products.php');
    exit;
}

$pageTitle = 'Order Confirmed! – EcoMart';
require_once __DIR__ . '/includes/header.php';
?>

<div class="container">
    <div class="success-card">
        <div class="success-icon-wrap">
            ✓
        </div>

        <h1 style="font-size: 2.2rem; font-weight: 800; color: var(--forest-green); margin-bottom: 8px;">
            Thank You for Choosing Green!
        </h1>
        <p style="color: var(--text-muted); font-size: 1.05rem;">
            Your sustainable order has been placed successfully in this demonstration environment.
        </p>

        <div class="order-ref-pill">
            Order Reference: <?= e($order['reference']) ?>
        </div>

        <div class="order-summary-box">
            <h4 style="font-size: 1.1rem; color: var(--forest-green); margin-bottom: 16px; border-bottom: 1px solid var(--border-color); padding-bottom: 8px;">
                Shipping & Order Information
            </h4>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; font-size: 0.92rem;">
                <div>
                    <strong style="color: var(--dark-text); display: block;">Recipient:</strong>
                    <span><?= e($order['customer']['name']) ?></span><br>
                    <span><?= e($order['customer']['phone']) ?></span><br>
                    <span><?= e($order['customer']['email']) ?></span>
                </div>
                <div>
                    <strong style="color: var(--dark-text); display: block;">Delivery Address:</strong>
                    <span><?= e($order['customer']['address']) ?></span><br>
                    <span><?= e($order['customer']['city']) ?> – <?= e($order['customer']['pincode']) ?></span><br>
                    <span><strong>Payment:</strong> <?= e($order['payment_method']) ?></span>
                </div>
            </div>

            <!-- Ordered Products Table -->
            <div style="margin-top: 24px; padding-top: 16px; border-top: 1px solid var(--border-color);">
                <strong style="color: var(--forest-green); display: block; margin-bottom: 12px;">Items in this Order:</strong>
                <div style="display: flex; flex-direction: column; gap: 10px;">
                    <?php foreach ($order['items'] as $item): ?>
                        <div style="display: flex; justify-content: space-between; align-items: center; font-size: 0.92rem;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <img src="<?= e($item['image']) ?>" alt="<?= e($item['name']) ?>" style="width: 40px; height: 40px; border-radius: 6px; object-fit: cover;">
                                <span><?= e($item['name']) ?> × <?= (int)$item['quantity'] ?></span>
                            </div>
                            <strong><?= formatRupees($item['price'] * $item['quantity']) ?></strong>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div style="margin-top: 16px; padding-top: 12px; border-top: 1.5px dashed var(--border-color); display: flex; justify-content: space-between; font-size: 1.15rem; font-weight: 800; color: var(--forest-green);">
                    <span>Total Amount</span>
                    <span><?= formatRupees($order['total']) ?></span>
                </div>
            </div>
        </div>

        <div class="eco-savings-badge" style="justify-content: center; max-width: 460px; margin: 24px auto;">
            <span>🌱</span>
            <span>You prevented approximately 4 single-use plastic items with this order!</span>
        </div>

        <div style="margin-top: 32px; display: flex; gap: 16px; justify-content: center; flex-wrap: wrap;">
            <a href="products.php" class="btn btn-primary btn-lg">Explore More Eco Products</a>
            <a href="index.php" class="btn btn-secondary btn-lg">Back to Home</a>
        </div>
    </div>
</div>

<!-- Clear cart in JavaScript LocalStorage upon successful order completion -->
<script>
    document.addEventListener('DOMContentLoaded', () => {
        if (typeof EcoCart !== 'undefined') {
            EcoCart.clearCart();
        }
    });
</script>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
