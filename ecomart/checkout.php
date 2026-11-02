<?php
// checkout.php - EcoMart Checkout Page (Demonstration Order Processing)
require_once __DIR__ . '/includes/functions.php';
require_once __DIR__ . '/includes/products-data.php';

$errors = [];
$name = '';
$email = '';
$phone = '';
$address = '';
$city = '';
$pincode = '';

// Pre-fill user data if demo user is logged in
if (isLoggedIn()) {
    $u = getCurrentUser();
    $name = $u['name'] ?? '';
    $email = $u['email'] ?? '';
}

// Process Order Placement Submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $phone = trim($_POST['phone'] ?? '');
    $address = trim($_POST['address'] ?? '');
    $city = trim($_POST['city'] ?? '');
    $pincode = trim($_POST['pincode'] ?? '');
    $cartDataRaw = $_POST['cart_data'] ?? '[]';

    // Decode cart contents sent from JavaScript LocalStorage
    $cartItems = json_decode($cartDataRaw, true);

    // Validations
    if (empty($name)) $errors['name'] = 'Full name is required.';
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) $errors['email'] = 'Valid email is required.';
    if (empty($phone) || !preg_match('/^[0-9+\-\s]{8,15}$/', $phone)) $errors['phone'] = 'Valid phone number is required.';
    if (empty($address)) $errors['address'] = 'Street address is required.';
    if (empty($city)) $errors['city'] = 'City is required.';
    if (empty($pincode) || strlen($pincode) < 4) $errors['pincode'] = 'Valid PIN code is required.';

    if (empty($cartItems) || !is_array($cartItems)) {
        $errors['cart'] = 'Your cart appears empty. Please return to the marketplace and select items.';
    }

    if (empty($errors)) {
        // Calculate Totals
        $subtotal = 0;
        foreach ($cartItems as $item) {
            $subtotal += ($item['price'] * $item['quantity']);
        }
        $total = $subtotal; // Free shipping

        // Generate demo order reference ID
        $orderRef = 'ECO-' . strtoupper(substr(md5(uniqid(rand(), true)), 0, 8));

        // Store demonstration order in PHP session
        $_SESSION['latest_order'] = [
            'reference' => $orderRef,
            'customer' => [
                'name' => $name,
                'email' => $email,
                'phone' => $phone,
                'address' => $address,
                'city' => $city,
                'pincode' => $pincode
            ],
            'items' => $cartItems,
            'subtotal' => $subtotal,
            'total' => $total,
            'payment_method' => 'Cash on Delivery (Zero-Emissions Courier)',
            'created_at' => date('F j, Y, g:i a')
        ];

        // Redirect to Order Success Page
        header('Location: order-success.php');
        exit;
    }
}

$pageTitle = 'Secure Checkout';
require_once __DIR__ . '/includes/header.php';
?>

<!-- Checkout Banner -->
<section class="page-header" style="padding: 40px 0;">
    <div class="container">
        <h1 class="page-title">Checkout & Shipping</h1>
        <div class="page-breadcrumb">
            <a href="index.php">Home</a> / <a href="cart.php">Shopping Bag</a> / <span>Checkout</span>
        </div>
    </div>
</section>

<section class="checkout-section">
    <div class="container">
        <!-- Demonstration System Banner -->
        <div class="demo-credentials-box" style="margin-bottom: 30px;">
            <strong style="color: var(--forest-green);">Demonstration Checkout:</strong> This checkout captures your test details and saves the order to your <strong>PHP Session</strong>. No payment card or database is required.
        </div>

        <?php if (!empty($errors['cart'])): ?>
            <div class="flash-alert alert-error" style="margin-bottom: 24px;">
                <span class="alert-icon">⚠</span>
                <span class="alert-text"><?= e($errors['cart']) ?></span>
            </div>
        <?php endif; ?>

        <form action="checkout.php" method="POST" id="checkoutForm" novalidate>
            <!-- Hidden input synchronised with JavaScript LocalStorage cart items -->
            <input type="hidden" name="cart_data" id="checkoutCartDataInput" value="[]">

            <div class="checkout-layout">
                <!-- Left Column: Shipping & Payment Details -->
                <div class="form-card">
                    <h3 style="font-size: 1.35rem; color: var(--forest-green); font-weight: 700; margin-bottom: 20px;">
                        1. Delivery Address
                    </h3>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="checkoutName" class="form-label">Full Name *</label>
                            <input type="text" id="checkoutName" name="name" class="form-control" 
                                   value="<?= e($name) ?>" placeholder="e.g. Priya Sharma" required>
                            <?php if (!empty($errors['name'])): ?><div class="form-help" style="color: #dc3545;"><?= e($errors['name']) ?></div><?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="checkoutEmail" class="form-label">Email Address *</label>
                            <input type="email" id="checkoutEmail" name="email" class="form-control" 
                                   value="<?= e($email) ?>" placeholder="priya@example.com" required>
                            <?php if (!empty($errors['email'])): ?><div class="form-help" style="color: #dc3545;"><?= e($errors['email']) ?></div><?php endif; ?>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="checkoutPhone" class="form-label">Phone Number *</label>
                        <input type="tel" id="checkoutPhone" name="phone" class="form-control" 
                               value="<?= e($phone) ?>" placeholder="e.g. +91 98765 43210" required>
                        <?php if (!empty($errors['phone'])): ?><div class="form-help" style="color: #dc3545;"><?= e($errors['phone']) ?></div><?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="checkoutAddress" class="form-label">Delivery Street Address *</label>
                        <textarea id="checkoutAddress" name="address" class="form-control" rows="3" 
                                  placeholder="House/Flat number, Street, Landmark" required><?= e($address) ?></textarea>
                        <?php if (!empty($errors['address'])): ?><div class="form-help" style="color: #dc3545;"><?= e($errors['address']) ?></div><?php endif; ?>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="checkoutCity" class="form-label">City *</label>
                            <input type="text" id="checkoutCity" name="city" class="form-control" 
                                   value="<?= e($city) ?>" placeholder="e.g. Mumbai, Bengaluru" required>
                            <?php if (!empty($errors['city'])): ?><div class="form-help" style="color: #dc3545;"><?= e($errors['city']) ?></div><?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="checkoutPincode" class="form-label">PIN / Postal Code *</label>
                            <input type="text" id="checkoutPincode" name="pincode" class="form-control" 
                                   value="<?= e($pincode) ?>" placeholder="e.g. 560001" required>
                            <?php if (!empty($errors['pincode'])): ?><div class="form-help" style="color: #dc3545;"><?= e($errors['pincode']) ?></div><?php endif; ?>
                        </div>
                    </div>

                    <!-- Payment Option: Cash on Delivery -->
                    <h3 style="font-size: 1.35rem; color: var(--forest-green); font-weight: 700; margin: 30px 0 16px;">
                        2. Payment Method
                    </h3>

                    <div style="border: 2px solid var(--forest-green); background: var(--cream-light); padding: 18px; border-radius: var(--radius-md); display: flex; align-items: center; gap: 14px;">
                        <input type="radio" id="paymentCod" name="payment_method" value="cod" checked style="width: 20px; height: 20px; accent-color: var(--forest-green);">
                        <label for="paymentCod" style="cursor: pointer;">
                            <strong style="color: var(--forest-green); font-size: 1.05rem; display: block;">Cash on Delivery (COD)</strong>
                            <span style="font-size: 0.86rem; color: var(--text-muted);">Pay in cash or via mobile UPI QR scan upon receiving your zero-waste package.</span>
                        </label>
                    </div>
                </div>

                <!-- Right Column: Order Review Summary -->
                <div class="summary-card">
                    <h3 class="summary-title">Order Review</h3>

                    <!-- Dynamically populated review from LocalStorage -->
                    <div id="checkoutOrderReview">
                        <!-- Populated by script.js renderCheckoutReview() -->
                    </div>

                    <div class="summary-line">
                        <span>Subtotal</span>
                        <strong id="checkoutSubtotal" style="color: var(--dark-text);">₹0.00</strong>
                    </div>

                    <div class="summary-line">
                        <span>Carbon-Neutral Shipping</span>
                        <span style="color: #2e7d32; font-weight: 700;">FREE</span>
                    </div>

                    <div class="summary-line total-line">
                        <span>Total to Pay</span>
                        <span id="checkoutTotal">₹0.00</span>
                    </div>

                    <div style="margin-top: 28px;">
                        <button type="submit" id="placeOrderBtn" class="btn btn-primary btn-block btn-lg">
                            Place Demonstration Order ➔
                        </button>
                    </div>

                    <div style="margin-top: 18px; text-align: center; font-size: 0.82rem; color: var(--text-muted);">
                        🌿 Shipped in plastic-free recycled paper packaging.
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
