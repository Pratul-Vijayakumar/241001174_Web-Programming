<?php
// products.php - EcoMart Product Catalog Page
$pageTitle = 'Sustainable Products Catalog';
$metaDescription = 'Explore EcoMart\'s full collection of sustainable, eco-friendly, zero-waste products. Reusable bottles, bamboo toothbrushes, organic tote bags and more.';
require_once __DIR__ . '/includes/header.php';

$allProducts = getAllProducts();
$categories = getCategories();
$selectedCategory = isset($_GET['category']) ? trim($_GET['category']) : 'all';
?>

<!-- Catalog Header Banner -->
<section class="page-header">
    <div class="container">
        <h1 class="page-title">Sustainable Product Marketplace</h1>
        <div class="page-breadcrumb">
            <a href="index.php">Home</a> / <span>Marketplace</span>
        </div>
    </div>
</section>

<div class="container">
    <!-- Search & Filter Control Bar -->
    <div class="filters-bar" id="productsFilterToolbar">
        <div class="search-box">
            <span class="search-icon-pos">🔍</span>
            <input type="text" id="productSearchInput" class="search-input" placeholder="Search eco products (e.g., bamboo, bottle, cotton)...">
        </div>

        <div class="filter-controls">
            <label for="productSortSelect" style="font-weight:600; font-size:0.92rem; color:var(--dark-text);">Sort By:</label>
            <select id="productSortSelect" class="custom-select">
                <option value="default">Featured Selection</option>
                <option value="price-asc">Price: Low to High</option>
                <option value="price-desc">Price: High to Low</option>
                <option value="name-asc">Product Name (A-Z)</option>
            </select>
        </div>
    </div>

    <!-- Category Filter Pills -->
    <div class="category-pills">
        <button type="button" class="cat-pill <?= $selectedCategory === 'all' ? 'active' : '' ?>" data-category="all">
            All Products (<?= count($allProducts) ?>)
        </button>
        <?php foreach ($categories as $catName => $count): ?>
            <button type="button" class="cat-pill <?= $selectedCategory === $catName ? 'active' : '' ?>" data-category="<?= e($catName) ?>">
                <?= e($catName) ?> (<?= $count ?>)
            </button>
        <?php endforeach; ?>
    </div>

    <!-- Responsive Product Grid (All 12 items) -->
    <div class="products-grid" id="productsCatalogGrid" style="margin-bottom: 90px;">
        <?php foreach ($allProducts as $product): ?>
            <div class="product-card" 
                 data-id="<?= $product['id'] ?>" 
                 data-name="<?= e($product['name']) ?>" 
                 data-price="<?= $product['price'] ?>" 
                 data-category="<?= e($product['category']) ?>"
                 style="<?= ($selectedCategory !== 'all' && $selectedCategory !== $product['category']) ? 'display: none;' : '' ?>">
                
                <div class="product-image-wrap">
                    <img src="<?= e($product['image']) ?>" alt="<?= e($product['name']) ?>" loading="lazy">
                    <span class="product-badge"><?= e($product['badge']) ?></span>
                    <button type="button" class="product-wishlist-btn" data-id="<?= $product['id'] ?>" data-name="<?= e($product['name']) ?>" aria-label="Save to Wishlist">♡</button>
                </div>

                <div class="product-content">
                    <div class="product-meta">
                        <span class="product-category"><?= e($product['category']) ?></span>
                        <span class="product-rating">★ <?= number_format($product['rating'], 1) ?> (<?= $product['reviews_count'] ?>)</span>
                    </div>

                    <h3 class="product-title">
                        <a href="product-details.php?id=<?= $product['id'] ?>"><?= e($product['name']) ?></a>
                    </h3>

                    <div class="product-price-row">
                        <span class="product-price"><?= formatRupees($product['price']) ?></span>
                    </div>

                    <div class="product-actions">
                        <button type="button" class="btn btn-primary btn-sm js-add-to-cart" 
                                data-id="<?= $product['id'] ?>"
                                data-name="<?= e($product['name']) ?>"
                                data-price="<?= $product['price'] ?>"
                                data-image="<?= e($product['image']) ?>"
                                data-category="<?= e($product['category']) ?>">
                            Add to Cart
                        </button>
                        <a href="product-details.php?id=<?= $product['id'] ?>" class="btn btn-secondary btn-sm">Details</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
