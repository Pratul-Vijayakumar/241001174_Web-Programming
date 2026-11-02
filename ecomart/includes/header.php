<?php
// includes/header.php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/products-data.php';

$currentPage = basename($_SERVER['PHP_SELF']);
$pageTitle = isset($pageTitle) ? $pageTitle . ' | EcoMart' : 'EcoMart – Sustainable Product Marketplace';
$metaDescription = isset($metaDescription) ? $metaDescription : 'EcoMart is your premier destination for zero-waste, eco-friendly, and sustainable lifestyle essentials. Shop Green. Live Better.';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="<?= e($metaDescription) ?>">
    <title><?= e($pageTitle) ?></title>
    <!-- Google Fonts: Outfit -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <!-- Top Announcement Bar -->
    <div class="top-bar">
        <span>🌱 Free eco-conscious carbon-neutral shipping on orders over ₹999! <a href="products.php">Shop Now</a></span>
    </div>

    <!-- Main Navigation Header -->
    <header class="header-sticky">
        <div class="container">
            <nav class="navbar">
                <!-- EcoMart Logo -->
                <a href="index.php" class="brand-logo" id="brandLogoLink">
                    <span class="logo-leaf">🌿</span>
                    <span>EcoMart</span>
                    <span class="brand-tag">SUSTAINABLE</span>
                </a>

                <!-- Nav Links -->
                <ul class="nav-links" id="mainNavLinks">
                    <li><a href="index.php" class="nav-link <?= $currentPage === 'index.php' ? 'active' : '' ?>">Home</a></li>
                    <li><a href="products.php" class="nav-link <?= in_array($currentPage, ['products.php', 'product-details.php']) ? 'active' : '' ?>">Marketplace</a></li>
                    <li><a href="about.php" class="nav-link <?= $currentPage === 'about.php' ? 'active' : '' ?>">Our Mission</a></li>
                    <li><a href="contact.php" class="nav-link <?= $currentPage === 'contact.php' ? 'active' : '' ?>">Contact</a></li>
                </ul>

                <!-- Nav Actions (Cart, User, Mobile Toggle) -->
                <div class="nav-actions">
                    <!-- Wishlist Count Icon -->
                    <a href="products.php" class="btn-icon" title="Wishlist" id="wishlistNavBtn">
                        <span>♡</span>
                        <span class="wishlist-count-badge" style="display:none;">0</span>
                    </a>

                    <!-- Shopping Cart Icon -->
                    <a href="cart.php" class="btn-icon" title="Shopping Cart" id="cartNavBtn">
                        <span>🛒</span>
                        <span class="cart-count-badge" style="display:none;">0</span>
                    </a>

                    <!-- Authentication Link -->
                    <?php if (isLoggedIn()): ?>
                        <?php $user = getCurrentUser(); ?>
                        <div style="display:flex; align-items:center; gap:8px;">
                            <a href="checkout.php" class="user-nav-link" title="User Profile">
                                <span>👤</span>
                                <span><?= e($user['name']) ?></span>
                            </a>
                            <a href="logout.php" class="btn-sm btn-secondary" style="padding: 6px 12px; font-size: 0.8rem;" title="Logout">Logout</a>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-sm btn-primary" id="navLoginBtn">Login</a>
                    <?php endif; ?>

                    <!-- Mobile Hamburger Toggle -->
                    <button class="mobile-toggle" id="mobileMenuToggle" aria-label="Toggle Navigation Menu">
                        <svg width="26" height="26" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </nav>
        </div>
    </header>

    <!-- Global Flash Notification Messages -->
    <div class="flash-container">
        <?php renderFlashMessage(); ?>
    </div>
