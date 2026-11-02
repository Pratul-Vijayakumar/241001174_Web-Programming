    <!-- Back to Top Floating Button -->
    <button class="back-to-top" id="backToTopBtn" aria-label="Back to top">↑</button>

    <!-- Professional Footer -->
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <!-- Column 1: Brand -->
                <div class="footer-brand">
                    <a href="index.php" class="brand-logo" style="margin-bottom: 14px;">
                        <span class="logo-leaf">🌿</span>
                        <span>EcoMart</span>
                    </a>
                    <p class="footer-desc">
                        EcoMart is dedicated to empowering conscious living. We curate responsibly sourced, zero-waste, plastic-free alternatives that make green living effortless and beautiful.
                    </p>
                    <div class="social-links">
                        <a href="#" class="social-icon" aria-label="EcoMart Instagram">📸</a>
                        <a href="#" class="social-icon" aria-label="EcoMart Facebook">📘</a>
                        <a href="#" class="social-icon" aria-label="EcoMart Twitter">🐦</a>
                        <a href="#" class="social-icon" aria-label="EcoMart LinkedIn">💼</a>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div>
                    <h4 class="footer-heading">Shop Green</h4>
                    <ul class="footer-links">
                        <li><a href="products.php" class="footer-link">All Sustainable Goods</a></li>
                        <li><a href="products.php?category=Kitchenware" class="footer-link">Kitchenware</a></li>
                        <li><a href="products.php?category=Drinkware" class="footer-link">Eco Drinkware</a></li>
                        <li><a href="products.php?category=Personal Care" class="footer-link">Personal Care</a></li>
                        <li><a href="products.php?category=Bags %26 Storage" class="footer-link">Bags & Storage</a></li>
                        <li><a href="products.php?category=Home %26 Living" class="footer-link">Home & Living</a></li>
                    </ul>
                </div>

                <!-- Column 3: Company -->
                <div>
                    <h4 class="footer-heading">EcoMart</h4>
                    <ul class="footer-links">
                        <li><a href="about.php" class="footer-link">Our Story & Mission</a></li>
                        <li><a href="about.php#sustainability" class="footer-link">Sustainability Impact</a></li>
                        <li><a href="contact.php" class="footer-link">Contact Customer Support</a></li>
                        <li><a href="login.php" class="footer-link">Demonstration Login</a></li>
                        <li><a href="register.php" class="footer-link">Create Account</a></li>
                    </ul>
                </div>

                <!-- Column 4: Green Promise -->
                <div>
                    <h4 class="footer-heading">Our Green Pledge</h4>
                    <p class="footer-desc" style="margin-bottom: 16px;">
                        Every order placed on EcoMart funds coastal cleanup drives and plants 1 mangrove sapling in protected biospheres.
                    </p>
                    <div style="background: rgba(255,255,255,0.08); padding: 14px 18px; border-radius: var(--radius-md); border: 1px solid rgba(255,255,255,0.12);">
                        <div style="font-weight: 700; color: var(--sage-green); font-size: 0.95rem; margin-bottom: 4px;">100% Plastic-Free Dispatch</div>
                        <div style="font-size: 0.82rem; color: #b7c7b9;">Shipped in recycled corrugated cartons with paper tape and water-soluble cornstarch peanuts.</div>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <div>&copy; <?= date('Y') ?> EcoMart Sustainable Marketplace. "Shop Green. Live Better." All rights reserved.</div>
                <div style="display: flex; gap: 20px;">
                    <a href="about.php" class="footer-link">Privacy Policy</a>
                    <a href="about.php" class="footer-link">Terms of Service</a>
                    <a href="contact.php" class="footer-link">Help & FAQs</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Core JavaScript -->
    <script src="assets/js/script.js"></script>
</body>
</html>
