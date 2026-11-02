# EcoMart – Sustainable Product Marketplace

EcoMart is a complete, modern, zero-waste, and plastic-free e-commerce marketplace built with **HTML5**, **CSS3**, **Vanilla JavaScript**, **PHP 8**, **PHP Sessions**, and **JavaScript LocalStorage**.

> **Tagline:** *"Shop Green. Live Better."*

---

## 🌿 Project Overview & Tech Stack

This project strictly adheres to all architectural constraints:
- **Frontend:** Semantic HTML5, Vanilla CSS3 (Custom design tokens, glassmorphism, responsive grid), Vanilla JavaScript (ES6+).
- **Backend:** PHP 8+ built-in development server, PHP Sessions for authentication and demo order storage.
- **Client Storage:** JavaScript `localStorage` for the shopping cart and wishlist persistence across pages and reloads.
- **Zero Database:** No MySQL, SQLite, MongoDB, or PostgreSQL. Predefined, structured PHP arrays are used for product information.
- **No Heavy Frameworks:** No React, Node.js, Bootstrap, or Tailwind CSS.

---

## 🎨 Color Palette & Typography
- **Forest Green:** `#244B36` (Primary brand color)
- **Sage Green:** `#8BAF79` (Accent and sustainability highlights)
- **Cream:** `#F5F3E9` (Warm, earthy background)
- **White:** `#FFFFFF` (Card surfaces)
- **Dark Text:** `#252B25` (High-contrast, legible typography)
- **Typography:** `Outfit` from Google Fonts

---

## 📂 Project Structure

```text
ecomart/
├── index.php                 # Home page: Hero, Featured items, Categories, Benefits, Reviews, Newsletter
├── products.php              # Products Catalog (12 items): Live Search, Category Filter, Price Sort
├── product-details.php       # Product Details: Specs, Sustainability Perks, Quantity Selector, Related Items
├── cart.php                  # Shopping Cart: LocalStorage persistence, item increment/decrement/remove
├── checkout.php              # Demonstration Checkout: Shipping form, Cash on Delivery, Session capture
├── order-success.php         # Order Confirmation: Order reference, receipt summary, cart reset
├── login.php                 # Member Login: Session-based demo authentication
├── register.php              # Registration: Session-based demo user registration
├── logout.php                # Session logout
├── about.php                 # Mission, Founding Story, Plastic crisis metrics, Artisan ethics
├── contact.php               # Customer care contact form with validation
├── includes/
│   ├── header.php            # Common header, sticky navbar, cart counter badge, flash alerts
│   ├── footer.php            # Professional footer, green pledge, social links
│   ├── products-data.php     # 12 detailed sustainable products (PHP array) & helper functions
│   └── functions.php         # Security escaping (e()), currency formatting, session auth helpers
├── assets/
│   ├── css/
│   │   └── style.css         # Complete vanilla stylesheet with rich aesthetics & animations
│   ├── js/
│   │   └── script.js         # EcoCart LocalStorage manager, wishlist, toasts, search & filter
│   └── images/               # High-quality downloaded photography for all 12 products + banners
└── README.md
```

---

## 🛍️ Included Sustainable Products (12 Items)

1. **Reusable Stainless Steel Water Bottle** (₹799) - BPA Free & Zero Waste
2. **Bamboo Toothbrush Set (Pack of 4)** (₹299) - 100% Biodegradable Handle
3. **Organic Cotton Tote Bag** (₹349) - GOTS Certified Organic
4. **Recycled Paper Hardbound Notebook** (₹399) - Post-Consumer Recycled
5. **Bamboo Cutlery Travel Set with Pouch** (₹449) - Zero Single-Use Plastic
6. **Eco-Friendly Stainless Steel Lunch Box** (₹999) - Leakproof & Plastic-Free
7. **Reusable Glass & Bamboo Coffee Cup** (₹599) - Barista Standard
8. **Natural Jute Shopping & Market Bag** (₹429) - 100% Golden Fiber Jute
9. **Solar-Powered Waterproof Garden Light** (₹899) - Zero Electricity Bills
10. **Biodegradable Coconut Coir Plant Pots (Set of 6)** (₹349) - Peat-Free Gardening
11. **Handcrafted Natural Coconut Shell Bowl** (₹299) - Upcycled Artisan Made
12. **Reusable Silicone Food Storage Bags (Set of 3)** (₹649) - Platinum Silicone & Airtight

---

## 🔑 Demo Authentication Credentials

The login system uses PHP Sessions to authenticate users:
- **Email:** `demo@ecomart.com`
- **Password:** `green123`

You can also use `register.php` to register any new test user in the active PHP session.

---

## 🚀 How to Run the Website Locally

1. Open PowerShell or Terminal.
2. Navigate to the `ecomart` directory:
   ```powershell
   cd "c:\Users\Pratul V\Web Programming Project\ecomart"
   ```
3. Start the PHP built-in web server:
   ```powershell
   php -S localhost:8000
   ```
4. Open your browser and navigate to:
   ```text
   http://localhost:8000
   ```
