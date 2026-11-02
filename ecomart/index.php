<?php
// index.php - EcoMart Home Page
$pageTitle = 'EcoMart – Sustainable Product Marketplace | Shop Green. Live Better.';
$metaDescription = 'EcoMart is an online sustainable marketplace featuring plastic-free, zero-waste, and biodegradable products for home, kitchen, and everyday life.';
require_once __DIR__ . '/includes/header.php';

$featured = getFeaturedProducts();
$categories = getCategories();
?>

<!-- Hero Banner Section -->
<section class="hero" id="homeHeroSection">
    <div class="container">
        <div class="hero-content">
            <div class="hero-badge">
                <span>🌱</span>
                <span>Earth-First Sustainable Living</span>
            </div>
            <h1 class="hero-title">
                Small Choices.
                <span>Big Impact.</span>
            </h1>
            <p class="hero-subtitle">
                Welcome to EcoMart, your curated destination for mindful living. Discover premium zero-waste essentials, biodegradable kitchenware, and ethically crafted goods designed to nurture both your home and our planet.
            </p>
            <div class="hero-actions">
                <a href="products.php" class="btn btn-primary btn-lg" id="heroShopNowBtn">Shop Now ➔</a>
                <a href="about.php" class="btn btn-secondary btn-lg" style="background: rgba(255,255,255,0.15); color: #fff; border-color: rgba(255,255,255,0.4);">Our Mission</a>
            </div>

            <!-- Impact Counter Stats -->
            <div class="hero-stats">
                <div class="stat-item">
                    <h4>45,000+</h4>
                    <p>Plastic Bottles Prevented</p>
                </div>
                <div class="stat-item">
                    <h4>100%</h4>
                    <p>Plastic-Free Packaging</p>
                </div>
                <div class="stat-item">
                    <h4>12,800+</h4>
                    <p>Conscious Shoppers</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Shop by Category Section -->
<section class="categories-section" id="categoriesSection">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Collections</span>
            <h2 class="section-title">Shop by Mindful Category</h2>
            <p class="section-subtitle">Every collection is independently audited for carbon impact, fair labor wages, and ethical material sourcing.</p>
        </div>

        <div class="categories-grid">
            <a href="products.php?category=Kitchenware" class="category-card">
                <div class="category-icon">🥥</div>
                <h3 class="category-title">Kitchenware</h3>
                <span class="category-count">Zero-waste meal prep & bowls</span>
            </a>

            <a href="products.php?category=Drinkware" class="category-card">
                <div class="category-icon">💧</div>
                <h3 class="category-title">Drinkware</h3>
                <span class="category-count">Insulated flasks & reusable cups</span>
            </a>

            <a href="products.php?category=Bags %26 Storage" class="category-card">
                <div class="category-icon">👜</div>
                <h3 class="category-title">Bags & Storage</h3>
                <span class="category-count">Organic cotton & natural jute</span>
            </a>

            <a href="products.php?category=Personal Care" class="category-card">
                <div class="category-icon">🪥</div>
                <h3 class="category-title">Personal Care</h3>
                <span class="category-count">Biodegradable bamboo oral care</span>
            </a>
        </div>
    </div>
</section>

<!-- Featured Products Section -->
<section class="products-section" id="featuredProductsSection">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Handpicked Essentials</span>
            <h2 class="section-title">Trending Sustainable Favorites</h2>
            <p class="section-subtitle">Customers love these zero-plastic swaps for their exceptional durability and earth-friendly footprint.</p>
        </div>

        <div class="products-grid">
            <?php foreach ($featured as $product): ?>
                <div class="product-card" data-id="<?= $product['id'] ?>" data-name="<?= e($product['name']) ?>" data-price="<?= $product['price'] ?>" data-category="<?= e($product['category']) ?>">
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

        <div style="text-align: center; margin-top: 48px;">
            <a href="products.php" class="btn btn-secondary btn-lg">Browse Complete Catalog (12 Products) ➔</a>
        </div>
    </div>
</section>

<!-- Why Choose EcoMart Section -->
<section class="why-section" id="whyChooseSection">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">The EcoMart Standard</span>
            <h2 class="section-title">Why Conscious Shoppers Choose Us</h2>
            <p class="section-subtitle">We believe sustainability should never compromise on design, utility, or affordability.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon-box">🌿</div>
                <h3 class="feature-title">100% Plastic-Free</h3>
                <p class="feature-desc">Every product and shipment is completely free from petrochemical single-use plastics, microplastics, and petroleum lacquers.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-box">🔄</div>
                <h3 class="feature-title">Circular & Recyclable</h3>
                <p class="feature-desc">Thoughtfully engineered from rapid-renewables like Moso bamboo, organic fibers, upcycled coconut shells, and recyclable steel.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-box">🤝</div>
                <h3 class="feature-title">Ethical Fair-Trade</h3>
                <p class="feature-desc">We collaborate directly with rural artisans and green workshops, ensuring equitable living wages and safe conditions.</p>
            </div>

            <div class="feature-card">
                <div class="feature-icon-box">📦</div>
                <h3 class="feature-title">Zero-Carbon Delivery</h3>
                <p class="feature-desc">We offset 100% of shipping carbon emissions through verified regional reforestation and bio-energy conservation projects.</p>
            </div>
        </div>
    </div>
</section>

<!-- Sustainability Benefits Section -->
<section class="impact-banner" id="sustainabilityBenefitsSection">
    <div class="container">
        <div class="impact-grid">
            <div class="impact-text">
                <h2>Measurable Good For Our Shared Tomorrow</h2>
                <p>When you switch one everyday essential to a sustainable alternative, the compound benefits ripple across oceans, landfills, and communities.</p>
                
                <ul class="impact-list">
                    <li>
                        <span class="check-icon">✓</span>
                        <span>Keep toxic microplastics out of our drinking water and food systems.</span>
                    </li>
                    <li>
                        <span class="check-icon">✓</span>
                        <span>Dramatically lower greenhouse emissions compared to virgin plastic refining.</span>
                    </li>
                    <li>
                        <span class="check-icon">✓</span>
                        <span>Support biodiversity conservation by utilizing regenerative botanical materials.</span>
                    </li>
                    <li>
                        <span class="check-icon">✓</span>
                        <span>Save thousands of rupees long-term with reusables that outlast disposables.</span>
                    </li>
                </ul>
            </div>

            <div>
                <div class="impact-card-stat">
                    <div class="metric-box">
                        <div class="metric-number">92%</div>
                        <div class="metric-label">Reduction in household plastic footprint reported by our active members within 60 days.</div>
                    </div>
                    <div class="metric-box">
                        <div class="metric-number">18.4 Tons</div>
                        <div class="metric-label">Landfill waste diverted through our bamboo, jute, and stainless steel collections this year.</div>
                    </div>
                    <div class="metric-box">
                        <div class="metric-number">1:1</div>
                        <div class="metric-label">For every order shipped, one native mangrove tree is planted along vulnerable coastlines.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Customer Testimonials Section -->
<section class="testimonials-section" id="testimonialsSection">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">Customer Stories</span>
            <h2 class="section-title">Loved by Conscious Homes</h2>
            <p class="section-subtitle">Real experiences from customers who made the green switch with EcoMart.</p>
        </div>

        <div class="testimonials-grid">
            <div class="testimonial-card">
                <div>
                    <div class="testi-stars">★★★★★</div>
                    <p class="testi-quote">"The stainless steel water bottle keeps ice-cold water all day in Bangalore heat. Zero metallic smell and arrived in entirely plastic-free paper carton. Highly recommended!"</p>
                </div>
                <div class="testi-author">
                    <div class="author-avatar">AP</div>
                    <div class="author-info">
                        <h5>Ananya Patel</h5>
                        <span>Bengaluru • Verified Buyer</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div>
                    <div class="testi-stars">★★★★★</div>
                    <p class="testi-quote">"Switched our family to the bamboo toothbrushes and coconut bowls. The craftsmanship is breathtaking. It feels wonderful knowing we are not adding plastic junk to landfills."</p>
                </div>
                <div class="testi-author">
                    <div class="author-avatar">RM</div>
                    <div class="author-info">
                        <h5>Rohan Malhotra</h5>
                        <span>Mumbai • Verified Buyer</span>
                    </div>
                </div>
            </div>

            <div class="testimonial-card">
                <div>
                    <div class="testi-stars">★★★★★</div>
                    <p class="testi-quote">"The organic cotton tote and jute bag are so sturdy! I carry heavy vegetables every weekend and there's not a single torn thread. Truly premium quality at fair prices."</p>
                </div>
                <div class="testi-author">
                    <div class="author-avatar">SN</div>
                    <div class="author-info">
                        <h5>Sneha Nair</h5>
                        <span>Kochi • Verified Buyer</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Newsletter Subscription Interface -->
<section class="newsletter-section" id="newsletterSection">
    <div class="container">
        <div class="newsletter-card">
            <h3>Join the Green Living Movement</h3>
            <p>Subscribe for zero-waste lifestyle tips, new sustainable product drops, and exclusive community discounts. Zero spam, unsubscribe whenever you wish.</p>
            <form class="newsletter-form" onsubmit="event.preventDefault(); EcoToast.show('Thank you for subscribing to EcoMart green updates! 🌿'); this.reset();">
                <input type="email" class="newsletter-input" placeholder="Enter your email address..." required>
                <button type="submit" class="btn btn-sage">Subscribe</button>
            </form>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
