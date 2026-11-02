<?php
// product-details.php - EcoMart Product Detail Page
require_once __DIR__ . '/includes/products-data.php';
require_once __DIR__ . '/includes/functions.php';

$productId = isset($_GET['id']) ? (int)$_GET['id'] : 1;
$product = getProductById($productId);

if (!$product) {
    // Fallback to first product if invalid id
    $product = getProductById(1);
}

$pageTitle = $product['name'] . ' – EcoMart';
$metaDescription = substr($product['description'], 0, 155) . '...';
require_once __DIR__ . '/includes/header.php';

$related = getRelatedProducts($product['id'], 4);
?>

<!-- Breadcrumb Header -->
<section class="page-header" style="padding: 40px 0;">
    <div class="container">
        <div class="page-breadcrumb">
            <a href="index.php">Home</a> / <a href="products.php">Marketplace</a> / <a href="products.php?category=<?= urlencode($product['category']) ?>"><?= e($product['category']) ?></a> / <span><?= e($product['name']) ?></span>
        </div>
    </div>
</section>

<!-- Product Details Section -->
<section class="details-section">
    <div class="container">
        <div class="details-grid">
            <!-- Product Image -->
            <div class="details-image-box">
                <img src="<?= e($product['image']) ?>" alt="<?= e($product['name']) ?>">
            </div>

            <!-- Product Info & Actions -->
            <div class="details-info">
                <span class="details-badge"><?= e($product['badge']) ?></span>
                <h1 class="details-title"><?= e($product['name']) ?></h1>

                <div class="product-meta" style="margin-bottom: 16px; font-size: 0.95rem;">
                    <span class="product-category"><?= e($product['category']) ?></span>
                    <span class="product-rating">★ <?= number_format($product['rating'], 1) ?> (<?= $product['reviews_count'] ?> verified reviews)</span>
                </div>

                <div class="details-price-row">
                    <span class="details-price"><?= formatRupees($product['price']) ?></span>
                    <span style="font-size: 0.92rem; color: #2e7d32; font-weight: 600;">✓ In Stock & Ready to Ship</span>
                </div>

                <p class="details-desc">
                    <?= e($product['description']) ?>
                </p>

                <!-- Sustainability Benefits Box -->
                <div class="benefits-box">
                    <h4 class="benefits-title">🌱 Sustainability & Ecological Benefits</h4>
                    <ul class="benefits-list">
                        <?php foreach ($product['benefits'] as $benefit): ?>
                            <li><span>✓</span> <?= e($benefit) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Product Specifications -->
                <div style="margin-bottom: 24px;">
                    <h4 style="font-size: 1rem; font-weight: 700; color: var(--forest-green); margin-bottom: 10px;">Specifications</h4>
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 8px; font-size: 0.88rem; background: var(--cream-light); padding: 14px 18px; border-radius: var(--radius-sm); border: 1px solid var(--border-color);">
                        <?php foreach ($product['specs'] as $specKey => $specVal): ?>
                            <div><strong style="color: var(--dark-text);"><?= e($specKey) ?>:</strong> <span style="color: var(--text-muted);"><?= e($specVal) ?></span></div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Quantity & Add to Cart -->
                <div class="details-order-actions">
                    <div class="quantity-selector">
                        <button type="button" class="qty-btn js-qty-minus" aria-label="Decrease Quantity">−</button>
                        <input type="number" class="qty-input js-quantity-input" value="1" min="1" max="99" readonly>
                        <button type="button" class="qty-btn js-qty-plus" aria-label="Increase Quantity">+</button>
                    </div>

                    <button type="button" class="btn btn-primary btn-lg js-add-to-cart" 
                            style="flex: 1; min-width: 200px;"
                            data-id="<?= $product['id'] ?>"
                            data-name="<?= e($product['name']) ?>"
                            data-price="<?= $product['price'] ?>"
                            data-image="<?= e($product['image']) ?>"
                            data-category="<?= e($product['category']) ?>">
                        🛒 Add to Cart
                    </button>

                    <button type="button" class="btn btn-secondary product-wishlist-btn" 
                            style="position: static; width: 50px; height: 50px; border-radius: var(--radius-md);"
                            data-id="<?= $product['id'] ?>" 
                            data-name="<?= e($product['name']) ?>" 
                            title="Add to Wishlist">
                        ♡
                    </button>
                </div>

                <div style="margin-top: 24px; padding-top: 20px; border-top: 1px solid var(--border-color); display: flex; gap: 24px; font-size: 0.85rem; color: var(--text-muted);">
                    <div>📦 <strong>Carbon-Neutral</strong> Delivery</div>
                    <div>🔄 <strong>30-Day</strong> Hassle-Free Returns</div>
                    <div>🛡️ <strong>100% Non-Toxic</strong> Guarantee</div>
                </div>
            </div>
        </div>

        <!-- Related Products Section -->
        <?php if (!empty($related)): ?>
            <div style="margin-top: 80px;">
                <div class="section-header" style="text-align: left; margin-bottom: 30px;">
                    <span class="section-tag">More Like This</span>
                    <h2 class="section-title" style="font-size: 1.8rem;">Complementary Sustainable Swaps</h2>
                </div>

                <div class="products-grid">
                    <?php foreach ($related as $rel): ?>
                        <div class="product-card">
                            <div class="product-image-wrap">
                                <img src="<?= e($rel['image']) ?>" alt="<?= e($rel['name']) ?>" loading="lazy">
                                <span class="product-badge"><?= e($rel['badge']) ?></span>
                            </div>
                            <div class="product-content">
                                <div class="product-meta">
                                    <span class="product-category"><?= e($rel['category']) ?></span>
                                    <span class="product-rating">★ <?= number_format($rel['rating'], 1) ?></span>
                                </div>
                                <h4 class="product-title">
                                    <a href="product-details.php?id=<?= $rel['id'] ?>"><?= e($rel['name']) ?></a>
                                </h4>
                                <div class="product-price-row">
                                    <span class="product-price"><?= formatRupees($rel['price']) ?></span>
                                </div>
                                <div class="product-actions">
                                    <button type="button" class="btn btn-primary btn-sm js-add-to-cart"
                                            data-id="<?= $rel['id'] ?>"
                                            data-name="<?= e($rel['name']) ?>"
                                            data-price="<?= $rel['price'] ?>"
                                            data-image="<?= e($rel['image']) ?>"
                                            data-category="<?= e($rel['category']) ?>">
                                        Add to Cart
                                    </button>
                                    <a href="product-details.php?id=<?= $rel['id'] ?>" class="btn btn-secondary btn-sm">View</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
