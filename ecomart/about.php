<?php
// about.php - EcoMart About Us & Sustainability Mission
$pageTitle = 'Our Mission & Story';
$metaDescription = 'Learn about EcoMart\'s founding story, our commitment to eliminating single-use plastics, and our mission to make sustainable living accessible to all.';
require_once __DIR__ . '/includes/header.php';
?>

<!-- About Hero Banner -->
<section class="page-header" style="padding: 70px 0;">
    <div class="container">
        <h1 class="page-title">Shop Green. Live Better.</h1>
        <p class="section-subtitle" style="color: #d8e5d6; max-width: 600px; margin: 12px auto 0;">
            We are on a purpose-driven mission to eliminate single-use plastics from daily routines through beautifully crafted, earth-first alternatives.
        </p>
    </div>
</section>

<!-- Mission & Story Section -->
<section style="padding: 80px 0; background: var(--white);">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <div>
                <span class="section-tag">Our Founding Story</span>
                <h2 class="section-title">Born From A Simple Desire To Protect Our Planet</h2>
                <p style="font-size: 1.05rem; color: var(--dark-text); line-height: 1.8; margin-bottom: 20px;">
                    EcoMart started when a group of environmental advocates and designers grew tired of seeing shorelines and landfill sites inundated with disposable takeaway cups, flimsy plastic bags, and petroleum-based toothbrushes that take upwards of 500 years to degrade.
                </p>
                <p style="font-size: 1.02rem; color: var(--text-muted); line-height: 1.8; margin-bottom: 28px;">
                    We realized the barrier wasn't a lack of ecological awareness—it was convenience and quality. Sustainable alternatives were either exorbitantly priced or difficult to discover. EcoMart was built to bring certified, ethically manufactured, durable, and aesthetically stunning zero-waste goods straight to conscious Indian households.
                </p>
                <div style="display: flex; gap: 24px;">
                    <div>
                        <h4 style="font-size: 2.2rem; font-weight: 800; color: var(--forest-green); line-height: 1;">100%</h4>
                        <span style="font-size: 0.88rem; color: var(--text-muted);">Ethically Audited Materials</span>
                    </div>
                    <div>
                        <h4 style="font-size: 2.2rem; font-weight: 800; color: var(--sage-green); line-height: 1;">0%</h4>
                        <span style="font-size: 0.88rem; color: var(--text-muted);">Single-Use Petro-Plastics</span>
                    </div>
                </div>
            </div>

            <div>
                <img src="assets/images/about-mission.jpg" alt="EcoMart Sustainable Forest Mission" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-lg); width: 100%; height: 420px; object-fit: cover;">
            </div>
        </div>
    </div>
</section>

<!-- The Plastic Problem & Why It Matters -->
<section id="sustainability" style="padding: 80px 0; background: var(--cream);">
    <div class="container">
        <div class="section-header">
            <span class="section-tag">The Reality Check</span>
            <h2 class="section-title">Why Plastic Reduction Matters Today</h2>
            <p class="section-subtitle">Over 380 million tons of plastic are produced every year globally, half of which is utilized just once before being discarded.</p>
        </div>

        <div class="features-grid">
            <div class="feature-card" style="background: var(--white);">
                <div class="feature-icon-box" style="background: #e65100;">🌊</div>
                <h3 class="feature-title">Ocean Ecosystems</h3>
                <p class="feature-desc">More than 8 million tons of plastic enter our marine biospheres annually, endangering thousands of marine species and fragmenting into hazardous microplastics.</p>
            </div>

            <div class="feature-card" style="background: var(--white);">
                <div class="feature-icon-box" style="background: #2e7d32;">🌳</div>
                <h3 class="feature-title">Fossil Fuel Dependence</h3>
                <p class="feature-desc">Over 99% of conventional plastics are derived from crude oil and natural gas. Transitioning to bamboo and coconut bi-products drastically curbs industrial emissions.</p>
            </div>

            <div class="feature-card" style="background: var(--white);">
                <div class="feature-icon-box" style="background: var(--forest-green);">🏡</div>
                <h3 class="feature-title">Human Well-Being</h3>
                <p class="feature-desc">Plastic packaging releases toxic endocrine disruptors (BPA, phthalates) into food and hot beverages. Our glass, steel, and plant-based goods keep your family protected.</p>
            </div>
        </div>
    </div>
</section>

<!-- Team & Artisans Section -->
<section style="padding: 80px 0; background: var(--white);">
    <div class="container">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 60px; align-items: center;">
            <div>
                <img src="assets/images/about-team.jpg" alt="Artisans craft eco goods" style="border-radius: var(--radius-lg); box-shadow: var(--shadow-lg); width: 100%; height: 400px; object-fit: cover;">
            </div>

            <div>
                <span class="section-tag">Community & Ethics</span>
                <h2 class="section-title">Empowering Local Artisan Cooperatives</h2>
                <p style="font-size: 1.05rem; color: var(--dark-text); line-height: 1.8; margin-bottom: 20px;">
                    Behind each hand-carved coconut shell bowl and handwoven golden jute tote are skilled generational craftspeople across rural regions of India.
                </p>
                <p style="font-size: 1.02rem; color: var(--text-muted); line-height: 1.8; margin-bottom: 28px;">
                    We guarantee living wages, safe workshop spaces, and sustainable raw harvesting that supports regional circular economies. When you buy from EcoMart, your money strengthens honest artisanal livelihoods.
                </p>
                <a href="products.php" class="btn btn-primary btn-lg">Explore Handcrafted Goods ➔</a>
            </div>
        </div>
    </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
