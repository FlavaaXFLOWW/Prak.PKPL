<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Naturallink</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&family=Young+Serif&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="./css/Main.css"> 
    <link rel="stylesheet" href="./css/Custom.css"> 
    
    <style id="unified-styles">
        /* === GLOBAL & UTILITIES === */
        body {
            font-family: 'Poppins', sans-serif;
        }

        .hidden {
            display: none !important;
        }

        .auth-modal-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            display: none; /* Default hidden, controlled by JS */
            justify-content: center;
            align-items: center;
            z-index: 1000;
            background-color: rgba(26, 26, 46, 0.7);
        }

        .auth-modal-overlay.login-gate {
            background-image: url('https://images.unsplash.com/photo-1519681393784-d120267933ba?auto=format&fit=crop&w=1950&q=80');
            background-size: cover;
            background-position: center;
        }

        /* === GLASSMORPHISM MODAL CONTAINER (Digunakan oleh semua modal) === */
        .auth-modal-content {
            background: rgba(35, 35, 55, 0.6);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.15);
            padding: 40px 30px;
            border-radius: 15px;
            width: 100%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            color: #ffffff;
            position: relative;
        }

        .close-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            font-size: 28px;
            color: #aaa;
            cursor: pointer;
            transition: color 0.3s ease;
            font-weight: 300;
        }
        .close-btn:hover {
            color: #ffffff;
        }

        /* === AUTH FORMS (Login & Register) === */
        .auth-form h2 {
            color: #ffffff;
            text-align: center;
            margin: 0 0 30px 0;
            font-weight: 600;
            letter-spacing: 2px;
            font-family: 'Poppins', sans-serif;
            text-transform: uppercase;
            position: relative;
            padding-bottom: 10px;
        }
        
        .auth-form h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 70px;
            height: 3px;
            background-color: #9b59b6;
        }

        .auth-form .form-group {
            margin-bottom: 25px;
        }

        .auth-form label {
            display: block;
            color: #bdc3c7;
            margin-bottom: 8px;
            font-size: 14px;
            font-weight: 500;
        }

        /* Glassmorphism Input Fields (Berlaku untuk auth form) */
        .auth-form input[type="text"],
        .auth-form input[type="email"],
        .auth-form input[type="password"],
        .auth-form input[type="number"],
        .auth-form textarea,
        .auth-form select {
            width: 100%;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            color: #ffffff;
            font-size: 16px;
            padding: 12px 15px;
            outline: none;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }
        
        .auth-form input[type="text"]:focus,
        .auth-form input[type="email"]:focus,
        .auth-form input[type="password"]:focus,
        .auth-form input[type="number"]:focus,
        .auth-form textarea:focus,
        .auth-form select:focus {
            background: rgba(255, 255, 255, 0.15);
            border-color: #9b59b6;
        }
        
        /* Style khusus untuk select */
        .auth-form select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            background-image: url('data:image/svg+xml;charset=US-ASCII,%3Csvg%20xmlns%3D%22http%3A//www.w3.org/2000/svg%22%20width%3D%22292.4%22%20height%3D%22292.4%22%3E%3Cpath%20fill%3D%22%23BDC3C7%22%20d%3D%22M287%2069.4a17.6%2017.6%200%200%200-13-5.4H18.4c-5%200-9.3%201.8-12.9%205.4A17.6%2017.6%200%200%200%200%2082.2c0%205%201.8%209.3%205.4%2012.9l128%20127.9c3.6%203.6%207.8%205.4%2012.8%205.4s9.2-1.8%2012.8-5.4L287%2095c3.5-3.5%205.4-7.8%205.4-12.8%200-5-1.9-9.2-5.5-12.8z%22/%3E%3C/svg%3E');
            background-repeat: no-repeat;
            background-position: right 15px top 50%;
            background-size: .65em auto;
        }

        .auth-form .auth-btn {
            width: 100%;
            padding: 12px;
            background: #8e44ad;
            border: none;
            border-radius: 8px;
            color: #ffffff;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            text-transform: capitalize;
            transition: background-color 0.3s ease;
            margin-top: 15px;
        }

        .auth-form .auth-btn:hover {
            background: #9b59b6;
        }

        .auth-form .switch-form {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #bdc3c7;
        }
        
        .auth-form .switch-form a {
            color: #ffffff;
            text-decoration: none;
            font-weight: 500;
        }
        
        .auth-form .message {
            text-align: center;
            margin-top: 15px;
            font-weight: 500;
            min-height: 1.2em;
        }
        
        /* === PURCHASE MODAL SPECIFIC STYLES === */
        #purchase-modal .horizontal-group {
            display: flex;
            gap: 15px;
            align-items: flex-end;
        }
        #purchase-modal .form-group { flex: 1; }
        #purchase-modal .qty-group-item { max-width: 80px; }
        #purchase-modal hr { border: none; border-top: 1px solid rgba(255, 255, 255, 0.1); margin: 25px 0; }

        /* === PROFILE MODAL SPECIFIC STYLES === */
        .profile-info p { margin: 12px 0; color: #dfe6e9; font-size: 16px; }
        .profile-info strong { color: #ffffff; }
        #profile-modal h2 { color: #4CAF50; font-family: 'Young Serif', serif; text-align: center; }

        /* === ORDERS MODAL SPECIFIC STYLES === */
        #orders-list-container { max-height: 450px; overflow-y: auto; padding-right: 15px; }
        .order-item-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 15px;
            color: #dfe6e9;
        }
        .order-detail-group {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 10px;
            font-size: 14px;
            margin-top: 10px;
            color: #bdc3c7;
        }

        /* === ADMIN DASHBOARD === */
        .admin-dashboard-container {
            display: flex;
            min-height: 100vh;
            background: linear-gradient(120deg, #fdfbfb 0%, #ebedee 100%);
        }
        .admin-sidebar {
            width: 260px;
            background: linear-gradient(180deg, #2d3436 0%, #1e272e 100%);
            color: #ffffff;
            display: flex;
            flex-direction: column;
            position: fixed;
            height: 100%;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            z-index: 100;
        }
        .sidebar-header {
            padding: 25px 20px;
            display: flex;
            align-items: center;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
        }
        .sidebar-header img {
            width: 40px;
            margin-right: 15px;
            filter: brightness(0) invert(1);
        }
        .sidebar-header h2 {
            margin: 0;
            font-family: 'Young Serif', serif;
            font-size: 22px;
            color: #4CAF50;
        }
        .sidebar-nav {
            flex-grow: 1;
            padding-top: 20px;
        }
        .sidebar-nav .nav-link {
            display: flex;
            align-items: center;
            padding: 15px 25px;
            color: #dfe6e9;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            gap: 15px;
            font-size: 16px;
        }
        .sidebar-nav .nav-link:hover {
            background-color: rgba(76, 175, 80, 0.1);
            color: #4CAF50;
            border-left: 4px solid #4CAF50;
            padding-left: 21px;
        }
        .sidebar-nav .nav-link.active {
            background-color: rgba(76, 175, 80, 0.2);
            color: #ffffff;
            border-left: 4px solid #4CAF50;
            padding-left: 21px;
            font-weight: 600;
        }
        .sidebar-nav .nav-link .icon {
            width: 20px;
            height: 20px;
        }
        .sidebar-footer {
            padding: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
        }
        .sidebar-footer #admin-logout-btn {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 15px;
            background-color: rgba(217, 83, 79, 0.8);
            color: white;
            text-decoration: none;
            padding: 12px 20px;
            border-radius: 8px;
            text-align: center;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }
        .sidebar-footer #admin-logout-btn:hover {
            background-color: #c9302c;
        }
        .admin-main-content {
            flex-grow: 1;
            margin-left: 260px;
            padding: 40px;
        }
        .admin-section {
            background: rgba(255, 255, 255, 0.45);
            backdrop-filter: blur(15px);
            -webkit-backdrop-filter: blur(15px);
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.15);
            padding: 30px;
            color: #1e272e;
        }
        .admin-section h2 {
            font-family: 'Young Serif', serif;
            color: #1e272e;
            margin-top: 0;
            margin-bottom: 25px;
            font-size: 28px;
        }
        
        .admin-order-item {
            background: rgba(248, 249, 250, 0.8);
            border: 1px solid rgba(0,0,0,0.05);
            border-radius: 6px;
            padding: 10px 15px;
            margin-bottom: 8px;
            font-size: 14px;
            color: #343a40;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .admin-order-item .details {
            font-weight: 600;
        }
        .admin-order-item .meta {
            color: #6c757d;
            font-size: 12px;
            display: block;
        }
        .admin-order-item .price {
            color: #4CAF50;
            font-size: 1.1em;
            font-weight: bold;
        }
        
        /* === ADMIN DASHBOARD FORMS (NEW STYLES) === */
        #admin-products-section h2 {
            padding-bottom: 15px;
            border-bottom: 1px solid rgba(30, 39, 46, 0.1);
            margin-bottom: 30px;
        }
        
        .admin-section .form-group {
            margin-bottom: 25px;
        }

        .admin-section .form-group label {
            color: #1e272e;
            font-weight: 600;
            margin-bottom: 10px;
            font-size: 15px;
            display: block;
        }
        
        /* Glass inputs for the light admin dashboard theme */
        .admin-section .dashboard-form input[type="text"],
        .admin-section .dashboard-form input[type="number"],
        .admin-section .dashboard-form input[type="file"],
        .admin-section .dashboard-form textarea {
            width: 100%;
            background: rgba(255, 255, 255, 0.7);
            border: 1px solid rgba(30, 39, 46, 0.15);
            border-radius: 8px;
            color: #2d3436;
            font-size: 16px;
            padding: 12px 15px;
            outline: none;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05) inset;
        }
        
        .admin-section .dashboard-form input::placeholder,
        .admin-section .dashboard-form textarea::placeholder {
            color: #888;
        }
        
        .admin-section .dashboard-form input:focus,
        .admin-section .dashboard-form textarea:focus {
            background: #ffffff;
            border-color: #4CAF50;
            box-shadow: 0 0 0 3px rgba(76, 175, 80, 0.2);
        }
        
        /* Custom style for file input */
        .admin-section .dashboard-form input[type="file"] {
            padding: 8px 15px;
            line-height: 1.5;
        }
        
        .admin-section .dashboard-form input[type="file"]::file-selector-button {
            margin-right: 15px;
            border: none;
            background: #2d3436;
            padding: 10px 16px;
            border-radius: 5px;
            color: #fff;
            cursor: pointer;
            transition: background .2s ease-in-out;
        }
        
        .admin-section .dashboard-form input[type="file"]::file-selector-button:hover {
            background: #4CAF50;
        }
        
        /* Custom button style for admin form */
        #add-product-form .auth-btn {
            background: #4CAF50;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: bold;
            box-shadow: 0 4px 15px rgba(76, 175, 80, 0.3);
            margin-top: 20px;
            padding: 15px;
            transition: all 0.3s ease;
        }
        
        #add-product-form .auth-btn:hover {
            background: #45a049;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(76, 175, 80, 0.4);
        }
    </style>
</head>
<body>

    <div id="auth-modal" class="auth-modal-overlay login-gate">
        <div class="auth-modal-content">
            <div class="auth-forms-container">
                
                <form id="login-form" class="auth-form">
                    <h2>LOGIN</h2>
                    <div class="form-group">
                        <label for="login-email">Username</label>
                        <input type="text" id="login-email" name="email" required autocomplete="username">
                    </div>
                    <div class="form-group">
                        <label for="login-password">Password</label>
                        <input type="password" id="login-password" name="password" required autocomplete="current-password">
                    </div>
                    <button type="submit" class="auth-btn">LOGIN</button>
                    <p class="switch-form">
                        Belum punya akun? <a href="#" id="switch-to-register">Register di sini</a>
                    </p>
                    <p id="login-message" class="message" aria-live="polite"></p>
                </form>

                <form id="register-form" class="auth-form hidden">
                    <h2>REGISTER</h2>
                     <div class="form-group">
                        <label for="register-username">Username</label>
                        <input type="text" id="register-username" name="username" required autocomplete="username">
                    </div>
                    <div class="form-group">
                        <label for="register-email">Email</label>
                        <input type="email" id="register-email" name="email" required autocomplete="email">
                    </div>
                    <div class="form-group">
                        <label for="register-password">Password</label>
                        <input type="password" id="register-password" name="password" required autocomplete="new-password">
                    </div>
                    <input type="hidden" name="role" value="user"> 
                    <button type="submit" class="auth-btn register-btn">Register</button>
                    <p class="switch-form">
                        Sudah punya akun? <a href="#" id="switch-to-login">Login di sini</a>
                    </p>
                    <p id="register-message" class="message" aria-live="polite"></p>
                </form>

            </div>
        </div>
    </div>
    
    <div id="user-content-wrapper" class="page-content-wrapper">
        <nav id="navbar" class="custom-navbar">
            <div class="navbar-logo">
                <img src="./images/naturalink.png" alt="Naturallink Logo">
            </div>
            
            <div class="navbar-menu">
                <a href="#">Home</a>
                <a href="#">About</a>
                <a href="#products">Product</a>

                <div class="shop-btn-container" id="nav-shop-btn-container" style="display: none;">
                    <a href="#" id="nav-shop-btn" title="Pesanan Anda">
                        <svg class="shop-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                            <path d="M7 18c-1.1 0-1.99.9-1.99 2S5.9 22 7 22s2-.9 2-2-.9-2-2-2zM1 2v2h2l3.6 7.59L3.62 17H20v-2H6.5l.42-1.21.92-1.79H19c.75 0 1.41-.41 1.75-1.03l3.58-6.49c.28-.5-.17-1.07-.75-1.07H5.21L4.2 2H1zm14 16c-1.1 0-1.99.9-1.99 2s.89 2 1.99 2 2-.9 2-2-.9-2-2-2z"/>
                        </svg>
                        <span id="order-count">0</span>
                    </a>
                </div>
                <a href="#" class="profile-btn hidden" id="nav-profile-btn" title="Profile Account">
                    <svg class="profile-icon-svg" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.83 6-3.83 2.01 0 5.97 1.84 6 3.83-1.29 1.94-3.5 3.22-6 3.22z"/>
                    </svg>
                    <span id="profile-email">Account</span>
                </a>
            </div>
        </nav>

        <section class="hero-section" style="background-image: url('./images/b2b.jpg');"> 
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <h1>Organic rice grown with care.</h1>
                <p>Healthy Living, From Farmers to the world.</p>
                <a href="#products" class="shop-btn">Shop Now</a>
            </div>
        </section>

        <section class="marquee-section">
            <div class="marquee-content">
                Rooted in Real Food. Grown for Everyday Wellness. | Our rice is naturally rich in nutrients and ideal for any diet. | Less noise. More nourishment. &nbsp;&nbsp;&nbsp;
            </div>
            <div class="marquee-content" aria-hidden="true">
                Rooted in Real Food. Grown for Everyday Wellness. | Our rice is naturally rich in nutrients and ideal for any diet. | Less noise. More nourishment. &nbsp;&nbsp;&nbsp;
            </div>
        </section>

        <section class="features">
            <div class="section-title">
                <span>Our Features</span>
                <h2>Why Choose Our Organic Rice</h2>
            </div>
            <div class="feature-grid">
                <div class="feature-item">
                    <img src="./images/purenatural.png" alt="Pure Natural">
                    <h3>Pure & Natural</h3>
                    <p>Our rice is grown without additives, ensuring every grain is as natural as it gets.</p>
                </div>
                <div class="feature-item">
                    <img src="./images/withoutcemicals.png" alt="Without Chemicals">
                    <h3>Without Chemicals</h3>
                    <p>Free from harmful pesticides and chemicals, safe for your health and environment.</p>
                </div>
                <div class="feature-item">
                    <img src="./images/harvested.png" alt="Harvested by Hand">
                    <h3>Harvested by Hand</h3>
                    <p>Carefully harvested by local farmers to preserve quality and authenticity.</p>
                </div>
            </div>
        </section>

        <section class="products-section" id="products">
            <div class="section-title">
                <span>Our Collections</span>
                <h2>Explore Our Signature Organic Rice</h2>
            </div>
            <div class="product-gallery" id="product-gallery">
            </div>
        </section>

        <footer class="footer-section">
            <div class="footer-container">
                <div class="footer-top">
                    <div class="footer-logo">
                        <img src="./images/naturalink.png" alt="Naturalink Logo" />
                    </div>
    
                    <div class="footer-col-group">
                        <div class="footer-col">
                            <h4>CONTACT</h4>
                            <p><strong>hello@naturalink.com</strong></p>
                            <p>+62 87 886 7812 990</p>
                        </div>
                        <div class="footer-col">
                            <h4>SHOP</h4>
                            <p><strong>Tokopedia</strong></p>
                            <p><strong>Shopee</strong></p>
                        </div>
                        <div class="footer-col">
                            <h4>FOLLOW</h4>
                            <p><strong>Instagram</strong></p>
                            <p><strong>Facebook</strong></p>
                            <p><strong>TikTok</strong></p>
                        </div>
                    </div>
    
                    <div class="footer-nav-right">
                        <p><strong>Home</strong></p>
                        <p><strong>Product</strong></p>
                        <p><strong>About</strong></p>
                    </div>
                </div>
    
                <div class="footer-bottom">
                    <p>2025 © by PT. Syifa Agro Natura</p>
                    <a href="#" class="scroll-top">&#8593;</a>
                </div>
            </div>
        </footer>
    </div> 

    <div id="admin-dashboard" class="admin-dashboard-container" style="display: none;">
        <aside class="admin-sidebar">
            <div class="sidebar-header">
                <img src="./images/naturalink.png" alt="Naturallink Logo">
                <h2>Naturallink</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="#" class="nav-link" data-target="sales">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M3 4H21V6H3V4ZM3 11H15V13H3V11ZM3 18H21V20H3V18Z"/></svg>
                    Sales
                </a>
                <a href="#" class="nav-link" data-target="products">
                     <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M20 4H4V6H20V4ZM21 14V12L20 7H4L3 12V14H4V20H14V14H18V20H20V14H21ZM12 14H6V9H12V14Z"/></svg>
                    Products
                </a>
                <a href="#" class="nav-link" data-target="users">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M12 12C14.21 12 16 10.21 16 8C16 5.79 14.21 4 12 4C9.79 4 8 5.79 8 8C8 10.21 9.79 12 12 12ZM12 14C9.33 14 4 15.34 4 18V20H20V18C20 15.34 14.67 14 12 14Z"/></svg>
                    Users
                </a>
            </nav>
            <div class="sidebar-footer">
                <a href="#" id="admin-logout-btn">
                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor"><path d="M16 17V19H5V5H16V7H18V3H3V21H18V17H16ZM21 12L17 8V11H9V13H17V16L21 12Z"/></svg>
                    Logout Admin
                </a>
            </div>
        </aside>

        <main class="admin-main-content">
            <section id="admin-sales-section" class="admin-section" style="display:none;">
                <h2>Daftar Penjualan/Pesanan</h2>
                <div id="admin-orders-list">
                </div>
            </section>

            <section id="admin-products-section" class="admin-section" style="display:none;">
                <h2>Tambah Produk Baru</h2>
                <form id="add-product-form" class="dashboard-form">
                    <div class="form-group">
                        <label for="new-product-name">Nama Produk</label>
                        <input type="text" id="new-product-name" name="name" required placeholder="Cth: Organic Yellow Rice">
                    </div>
                    <div class="form-group">
                        <label for="new-product-price">Harga (per unit)</label>
                        <input type="number" id="new-product-price" name="price" required min="1" step="0.01" value="10.00">
                    </div>
                    <div class="form-group">
                        <label for="new-product-image">Gambar Produk</label>
                        <input type="file" id="new-product-image" name="image" accept="image/*">
                    </div>
                    <div class="form-group">
                        <label for="new-product-desc">Deskripsi</label>
                        <textarea id="new-product-desc" name="description" rows="2" placeholder="Deskripsi singkat produk"></textarea>
                    </div>
                    <button type="submit" class="auth-btn">Tambah Produk</button>
                    <p id="product-message" class="message" aria-live="polite"></p>
                </form>
            </section>

            <section id="admin-users-section" class="admin-section" style="display:none;">
                <h2>Daftar Akun Pengguna</h2>
                <ul class="dashboard-list" id="users-list">
                    <li>User: user@example.com (user)</li>
                    <li>Admin: admin@example.com (admin)</li>
                </ul>
                <p style="font-size: 12px; color: #999; margin-top: 15px;">Akun simulasi untuk demo role.</p>
            </section>
        </main>
    </div>
    
    <div id="profile-modal" class="auth-modal-overlay">
        <div class="auth-modal-content">
            <span class="close-btn" id="close-profile-btn">&times;</span>
            <h2>Profil Akun</h2>
            <div class="profile-info">
                <p><strong>Username:</strong> <span id="display-username"></span></p>
                <p><strong>Role:</strong> <span id="display-role" style="text-transform: capitalize;"></span></p>
                <button id="logout-btn" class="auth-btn" style="background-color: #d9534f; margin-top: 25px;">LOGOUT</button>
            </div>
        </div>
    </div>

    <div id="purchase-modal" class="auth-modal-overlay">
        <div class="auth-modal-content">
            <span class="close-btn" id="close-purchase-btn">&times;</span>
            <form id="purchase-form" class="auth-form">
                 <h2>Form Pembelian</h2>
                <div class="horizontal-group">
                    <div class="form-group" style="flex: 2;">
                        <label for="purchase-product">Produk</label>
                        <input type="text" id="purchase-product" name="product" readonly>
                    </div>
                    <div class="form-group qty-group-item">
                        <label for="purchase-quantity">Jumlah</label>
                        <input type="number" id="purchase-quantity" name="quantity" min="1" value="1" required>
                    </div>
                    <div class="form-group" style="flex: 1.5;">
                        <label for="purchase-total">Total Harga</label>
                        <input type="text" id="purchase-total" name="total" readonly>
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <label for="purchase-name">Nama Penerima</label>
                    <input type="text" id="purchase-name" name="name" required placeholder="Cth: Budi Santoso">
                </div>
                
                <div class="horizontal-group">
                    <div class="form-group">
                        <label for="purchase-city">Kota</label>
                        <input type="text" id="purchase-city" name="city" required placeholder="Cth: Bandung">
                    </div>
                    <div class="form-group">
                        <label for="purchase-province">Provinsi</label>
                        <input type="text" id="purchase-province" name="province" required placeholder="Cth: Jawa Barat">
                    </div>
                    <div class="form-group qty-group-item">
                        <label for="purchase-postal">Kode Pos</label>
                        <input type="text" id="purchase-postal" name="postal" required pattern="\d{5}" title="Kode pos harus 5 digit angka" placeholder="Cth: 40135">
                    </div>
                </div>

                <div class="form-group">
                    <label for="purchase-address">Alamat Lengkap</label>
                    <textarea id="purchase-address" name="address" required rows="3" placeholder="Masukkan alamat lengkap pengiriman"></textarea>
                </div>
                <div class="form-group">
                    <label for="purchase-payment">Metode Pembayaran</label>
                    <select id="purchase-payment" name="payment" required>
                        <option value="transfer">Transfer Bank</option>
                        <option value="cod">COD (Bayar di Tempat)</option>
                        <option value="e-wallet">E-Wallet (OVO/Gopay)</option>
                    </select>
                </div>

                <div class="form-group" style="display: flex; align-items: center; gap: 10px; margin-top: 15px; margin-bottom: 20px;">
                    <input type="checkbox" id="purchase-terms" name="terms" required style="width: auto;">
                    <label for="purchase-terms" style="margin-bottom: 0; font-weight: 400; color: #dfe6e9;">Saya setuju dengan <a href="#" style="color: #4CAF50; text-decoration: none; font-weight: 500;">Syarat & Ketentuan</a></label>
                </div>
                <button type="submit" class="auth-btn">PESAN SEKARANG</button>
                <p id="purchase-message" class="message" aria-live="polite"></p>
            </form>
        </div>
    </div>

    <div id="orders-modal" class="auth-modal-overlay">
        <div class="auth-modal-content" style="max-width: 700px; padding: 25px;">
            <span class="close-btn" id="close-orders-btn" aria-label="Close orders">&times;</span>
            <h2 style="margin-bottom: 25px; color: #fff; font-family: 'Young Serif', serif; text-shadow: 1px 1px 3px rgb(255, 255, 255); text-align:center;">Rincian Pesanan Anda</h2>
            
            <div id="orders-list-container">
            </div>

            <div id="orders-empty-state" style="text-align: center; padding: 30px; color: #fff; display: none;">
                <p>Anda belum memiliki pesanan tersimpan.</p>
                <p>Silakan jelajahi produk kami dan pesan sekarang! 🛒</p>
            </div>
            
            <button id="clear-orders-btn" class="auth-btn" style="background-color: #d9534f; margin-top: 25px; display: none;">HAPUS SEMUA PESANAN</button>
        </div>
    </div>

    <script>
        // ... (JavaScript logic remains the same, but with updated render functions) ...
        // --- DATA PRODUK (Simulasi data yang seharusnya dari API) ---
        let PRODUCTS = [
            { name: "Organic White Rice", price: 15.00, description: "Premium quality white rice with a soft, fluffy texture, perfect for daily consumption.", image: "./images/blackrice.png" },
            { name: "Organic Brown Rice", price: 18.50, description: "High in fiber and nutrients, this brown rice has a nutty flavor and satisfying chewiness.", image: "./images/brownrice.png" },
            { name: "Organic Black Rice", price: 22.00, description: "A superfood rich in antioxidants, offering a unique color and rich, slightly sweet taste.", image: "./images/blackrice.png" },
            { name: "Organic Red Rice", price: 17.00, description: "Known for its earthy, nutty taste, red rice retains its bran layer, providing excellent texture.", image: "./images/redrice.png" },
        ];
        
        // --- ELEMENTS ---
        const authModal = document.getElementById('auth-modal');
        const userContentWrapper = document.getElementById('user-content-wrapper');
        const adminDashboard = document.getElementById('admin-dashboard');
        const profileModal = document.getElementById('profile-modal'); 
        const closeProfileBtn = document.getElementById('close-profile-btn');
        const logoutBtn = document.getElementById('logout-btn');
        const navProfileBtn = document.getElementById('nav-profile-btn'); 
        const profileEmailSpan = document.getElementById('profile-email');
        const displayUsername = document.getElementById('display-username');
        const displayRole = document.getElementById('display-role');
        const loginForm = document.getElementById('login-form');
        const registerForm = document.getElementById('register-form');
        const switchToRegister = document.getElementById('switch-to-register');
        const switchToLogin = document.getElementById('switch-to-login');
        const registerMessage = document.getElementById('register-message');
        const loginMessage = document.getElementById('login-message');
        const navShopBtnContainer = document.getElementById('nav-shop-btn-container');
        const orderCountSpan = document.getElementById('order-count');
        const purchaseModal = document.getElementById('purchase-modal');
        const closePurchaseBtn = document.getElementById('close-purchase-btn');
        const purchaseForm = document.getElementById('purchase-form');
        const purchaseProduct = document.getElementById('purchase-product');
        const purchaseQuantity = document.getElementById('purchase-quantity');
        const purchaseTotal = document.getElementById('purchase-total');
        const purchaseMessage = document.getElementById('purchase-message'); 
        const ordersModal = document.getElementById('orders-modal');
        const closeOrdersBtn = document.getElementById('close-orders-btn');
        const ordersListContainer = document.getElementById('orders-list-container');
        const ordersEmptyState = document.getElementById('orders-empty-state');
        const clearOrdersBtn = document.getElementById('clear-orders-btn');
        const productGallery = document.getElementById('product-gallery');
        const adminLogoutBtn = document.getElementById('admin-logout-btn');
        const addProductForm = document.getElementById('add-product-form');
        const productMessage = document.getElementById('product-message');
        const adminOrdersList = document.getElementById('admin-orders-list');
        const API_BASE_URL = 'http://localhost:5001/api/auth'; 
        const API_USER_URL = 'http://localhost:5001/api/user';

        function initializeAdminDashboard() {
            const sidebarLinks = document.querySelectorAll('.admin-sidebar .nav-link');
            const adminSections = document.querySelectorAll('.admin-main-content .admin-section');
            const defaultTarget = 'sales'; 

            const switchTab = (targetId) => {
                adminSections.forEach(section => {
                    section.style.display = 'none';
                });
                const targetSection = document.getElementById(`admin-${targetId}-section`);
                if (targetSection) {
                    targetSection.style.display = 'block';
                }
                sidebarLinks.forEach(l => l.classList.remove('active'));
                const activeLink = document.querySelector(`.nav-link[data-target="${targetId}"]`);
                if(activeLink) {
                    activeLink.classList.add('active');
                }
            };
            
            switchTab(defaultTarget);

            sidebarLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const targetId = link.getAttribute('data-target');
                    switchTab(targetId);
                });
            });
        }

        // --- UTILITY FUNCTIONS ---
        function renderProducts() {
            productGallery.innerHTML = PRODUCTS.map(product => `
                <div class="product-card">
                    <img src="${product.image}" alt="${product.name}">
                    <div class="product-details">
                        <h3>${product.name}</h3>
                        <p class="product-description">${product.description}</p>
                    </div>
                    <div class="product-footer">
                        <span class="product-price" data-price="${product.price.toFixed(2)}">${product.price.toFixed(2)}</span>
                        <button class="buy-btn" data-product-name="${product.name}">BUY NOW</button>
                    </div>
                </div>
            `).join('');
            
            document.querySelectorAll('.buy-btn').forEach(btn => {
                btn.removeEventListener('click', handleBuyNowClick); 
                btn.addEventListener('click', handleBuyNowClick);
            });
        }
        
        // ==== FUNGSI RENDER ADMIN ORDERS DIPERBARUI (MENGGUNAKAN CLASS) ====
        function renderAdminOrders() {
            const orders = JSON.parse(localStorage.getItem('naturallink_orders') || '[]');
            adminOrdersList.innerHTML = '';

            if (orders.length === 0) {
                 adminOrdersList.innerHTML = '<p style="font-size: 14px; color: #6c757d; text-align: center; padding: 20px 0;">Belum ada pesanan yang tersimpan.</p>';
                 return;
            }
            
            orders.sort((a, b) => new Date(b.timestamp) - new Date(a.timestamp));
            
            const ordersHtml = orders.slice(0, 10).map((order) => { 
                const formattedDate = new Date(order.timestamp).toLocaleString('id-ID', { hour: '2-digit', minute: '2-digit', day:'2-digit', month:'short' });
                return `
                    <li class="admin-order-item">
                        <div>
                            <span class="details">${order.product} (x${order.quantity})</span>
                            <span class="meta">by ${order.name} - ${formattedDate}</span>
                        </div>
                        <strong class="price">Rp${order.total}</strong>
                    </li>
                `;
            }).join('');
            
            adminOrdersList.innerHTML = `<ul style="list-style: none; padding: 0;">${ordersHtml}</ul>`;
            if (orders.length > 10) {
                 adminOrdersList.innerHTML += `<p style="text-align: center; margin-top: 15px; font-size: 12px;"><a href="#" id="view-all-orders">Lihat Semua Pesanan</a></p>`;
                 document.getElementById('view-all-orders').onclick = (e) => { e.preventDefault(); document.getElementById('nav-shop-btn').click(); };
            }
        }
        
        // ==== FUNGSI RENDER ORDERS DIPERBARUI (MENGGUNAKAN CLASS) ====
        function renderOrders() {
            const orders = JSON.parse(localStorage.getItem('naturallink_orders') || '[]');
            ordersListContainer.innerHTML = '';

            if (orders.length === 0) {
                ordersEmptyState.style.display = 'block';
                clearOrdersBtn.style.display = 'none';
                ordersListContainer.style.display = 'none';
                return;
            }

            ordersEmptyState.style.display = 'none';
            clearOrdersBtn.style.display = 'block';
            ordersListContainer.style.display = 'block';

            orders.sort((a, b) => new Date(b.timestamp) - new Date(a.timestamp));

            orders.forEach((order, index) => {
                const orderCard = document.createElement('div');
                orderCard.className = 'order-item-card';
                
                const formattedDate = new Date(order.timestamp).toLocaleString('id-ID', {
                    day: 'numeric', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit'
                });
                
                orderCard.innerHTML = `
                    <p style="font-size: 10px; color: #ccc; text-align: right; margin-bottom: 5px;">${formattedDate}</p>
                    <p style="margin-bottom: 10px;"><strong>Pesanan #${orders.length - index}</strong> (ID: ${order.orderId})</p>
                    <p style="font-size: 18px; margin: 5px 0;">Produk: <strong>${order.product}</strong></p>
                    <div class="order-detail-group">
                        <p>Jumlah: ${order.quantity}x</p>
                        <p>Harga Satuan: Rp ${order.pricePerUnit}</p>
                        <p>Metode Bayar: ${order.payment.toUpperCase()}</p>
                    </div>
                    <p style="font-size: 16px; margin-top: 10px; border-top: 1px dashed rgba(255, 255, 255, 0.2); padding-top: 10px;">TOTAL BAYAR: <strong style="color: #ff5722; font-size: 1.1em;">Rp ${order.total}</strong></p>
                    <p style="font-size: 12px; color: #aaa; margin-top: 15px;">
                        <span style="font-weight: bold;">Penerima:</span> ${order.name}<br>
                        <span style="font-weight: bold;">Alamat:</span> ${order.address}, ${order.city}, ${order.province} (${order.postal})
                    </p>
                `;
                ordersListContainer.appendChild(orderCard);
            });
        }


        function updateShopUI() {
            const orders = JSON.parse(localStorage.getItem('naturallink_orders') || '[]');
            const count = orders.length;
            orderCountSpan.textContent = count;
            
            if (count > 0 || localStorage.getItem('naturallink_token')) {
                navShopBtnContainer.style.display = 'block'; 
            } else {
                navShopBtnContainer.style.display = 'none';
            }
        }

        function switchForms(target) {
            loginForm.classList.toggle('hidden', target === 'register');
            registerForm.classList.toggle('hidden', target === 'login');
            loginMessage.textContent = ''; 
            registerMessage.textContent = '';
        }

        async function fetchUserData(token) {
            try {
                const response = await fetch(`${API_USER_URL}/me`, {
                    method: 'GET',
                    headers: { 'Content-Type': 'application/json','x-auth-token': token }
                });
                if (response.ok) return await response.json();
                if (response.status === 401 || response.status === 403) {
                    localStorage.removeItem('naturallink_token');
                    localStorage.removeItem('naturallink_role');
                }
                return null;
            } catch (error) {
                console.error("Error fetching user data:", error);
                localStorage.removeItem('naturallink_token');
                localStorage.removeItem('naturallink_role');
                return null;
            }
        }

        async function updateNavUI() {
            const token = localStorage.getItem('naturallink_token');
            const role = localStorage.getItem('naturallink_role');

            if (token && role) {
                const user = await fetchUserData(token);
                if (user && user.email) {
                    authModal.classList.remove('login-gate');
                    authModal.style.display = 'none'; 
                    profileEmailSpan.textContent = user.email;

                    if (role === 'admin') {
                        userContentWrapper.style.display = 'none';
                        adminDashboard.style.display = 'flex';
                        renderAdminOrders(); 
                        initializeAdminDashboard();
                    } else { 
                        userContentWrapper.style.display = 'block';
                        adminDashboard.style.display = 'none';
                        navProfileBtn.classList.remove('hidden'); 
                    }
                } else {
                    handleLogout(false); 
                }
            } else {
                authModal.classList.add('login-gate');
                authModal.style.display = 'flex'; 
                userContentWrapper.style.display = 'none';
                adminDashboard.style.display = 'none';
            }
            updateShopUI(); 
        }

        function handleLogout(clearGate = true) {
            localStorage.removeItem('naturallink_token');
            localStorage.removeItem('naturallink_role');
            localStorage.removeItem('naturallink_username');
            profileModal.style.display = 'none'; 
            if(clearGate) updateNavUI();
        }
        
        function handleBuyNowClick() {
            const card = this.closest('.product-card');
            const productName = card.querySelector('h3').textContent;
            const productPrice = parseFloat(card.querySelector('.product-price').textContent);
            
            purchaseProduct.value = productName;
            purchaseQuantity.value = 1;
            purchaseTotal.value = (productPrice * 1).toFixed(2);
            document.getElementById('purchase-message').textContent = ''; 
            purchaseForm.dataset.pricePerUnit = productPrice.toFixed(2); 

            const username = localStorage.getItem('naturallink_username');
            if (username) {
                document.getElementById('purchase-name').value = username; 
                document.getElementById('purchase-city').value = '';
                document.getElementById('purchase-province').value = '';
                document.getElementById('purchase-postal').value = '';
                document.getElementById('purchase-address').value = '';
            } else {
                alert("Anda harus login untuk melakukan pembelian!");
                handleLogout(true);
                return;
            }
            
            document.getElementById('purchase-payment').value = 'transfer'; 
            purchaseModal.style.display = 'flex';

            purchaseQuantity.oninput = () => {
                const price = parseFloat(purchaseForm.dataset.pricePerUnit) || 0;
                const qty = parseInt(purchaseQuantity.value) || 0;
                if (qty < 1) purchaseQuantity.value = 1; 
                purchaseTotal.value = (price * (parseInt(purchaseQuantity.value) || 0)).toFixed(2);
            }
        }

        // --- EVENT LISTENERS ---
        switchToRegister.onclick = (e) => { e.preventDefault(); switchForms('register'); };
        switchToLogin.onclick = (e) => { e.preventDefault(); switchForms('login'); };

        navProfileBtn.onclick = function(e) { 
            e.preventDefault();
            const username = localStorage.getItem('naturallink_username') || 'N/A';
            const role = localStorage.getItem('naturallink_role') || 'user';
            
            displayUsername.textContent = username;
            displayRole.textContent = role;
            
            profileModal.style.display = 'flex';
        }
        
        closeProfileBtn.onclick = () => profileModal.style.display = 'none';
        logoutBtn.addEventListener('click', () => handleLogout(true));
        adminLogoutBtn.addEventListener('click', () => handleLogout(true));
        
        closePurchaseBtn.onclick = () => purchaseModal.style.display = 'none';
        
        closeOrdersBtn.onclick = () => ordersModal.style.display = 'none';
        document.getElementById('nav-shop-btn').onclick = (e) => {
            e.preventDefault();
            renderOrders(); 
            ordersModal.style.display = 'flex';
        };
        
        clearOrdersBtn.onclick = () => {
            if (confirm("Anda yakin ingin menghapus SEMUA riwayat pesanan?")) {
                localStorage.removeItem('naturallink_orders');
                renderOrders(); 
                renderAdminOrders(); 
                updateShopUI(); 
            }
        };

        // --- FORM HANDLERS ---
        async function handleAuthFormSubmit(event, endpoint, messageElement) {
            event.preventDefault();
            messageElement.textContent = 'Processing...'; 
            messageElement.style.color = '#ff5722';
            const formData = new FormData(event.target);
            const data = Object.fromEntries(formData.entries());
            
            if (endpoint === 'login' && data.email === 'admin@example.com') {
                data.role = 'admin'; 
            } else if (endpoint === 'login') {
                data.role = 'user';
            }
            
            try {
                const response = await fetch(`${API_BASE_URL}/${endpoint}`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify(data),
                });
                const result = await response.json();
                
                if (response.ok) {
                    messageElement.style.color = 'green';
                    messageElement.textContent = result.msg || 'Success!';
                    if (endpoint === 'login' && result.token) {
                        localStorage.setItem('naturallink_token', result.token);
                        localStorage.setItem('naturallink_role', data.role || result.role);
                        localStorage.setItem('naturallink_username', data.email);
                        
                        setTimeout(() => { updateNavUI(); }, 500); 
                    } else if (endpoint === 'register') {
                        setTimeout(() => { switchForms('login'); loginMessage.style.color = 'green'; loginMessage.textContent = "Registrasi berhasil! Silakan login."; registerForm.reset(); }, 1000);
                    }
                } else {
                    messageElement.style.color = 'red';
                    messageElement.textContent = result.msg || 'An unknown error occurred.';
                }
            } catch (error) {
                console.error('Network Error:', error);
                messageElement.style.color = 'red';
                messageElement.textContent = 'Connection Error: Could not reach the server.';
            }
        }
        
        purchaseForm.onsubmit = (e) => {
            e.preventDefault();
            
            const formData = new FormData(purchaseForm);
            const purchaseData = Object.fromEntries(formData.entries());
            purchaseData.timestamp = new Date().toISOString();
            
            purchaseData.quantity = (parseInt(purchaseQuantity.value) || 1).toString();
            purchaseData.total = (parseFloat(purchaseTotal.value) || 0).toFixed(2);
            purchaseData.pricePerUnit = (parseFloat(purchaseForm.dataset.pricePerUnit) || 0).toFixed(2);
            purchaseData.orderId = 'ORD-' + Date.now();

            if(parseFloat(purchaseData.pricePerUnit) === 0) {
                 purchaseMessage.style.color = 'red';
                 purchaseMessage.textContent = 'Gagal menyimpan: Harga produk tidak valid.';
                 return;
            }

            const existingOrders = JSON.parse(localStorage.getItem('naturallink_orders') || '[]');
            existingOrders.push(purchaseData);
            localStorage.setItem('naturallink_orders', JSON.stringify(existingOrders));

            purchaseMessage.style.color = 'green';
            purchaseMessage.textContent = 'Pesanan berhasil ditempatkan!';
            
            setTimeout(() => {
                purchaseModal.style.display = 'none';
                purchaseForm.reset();
                updateNavUI(); 
                if (localStorage.getItem('naturallink_role') === 'admin') {
                    renderAdminOrders(); 
                }
            }, 1500);
        }
        
        addProductForm.onsubmit = (e) => {
            e.preventDefault();
            productMessage.textContent = 'Menambahkan produk...';
            productMessage.style.color = '#ff5722';
            
            const formData = new FormData(addProductForm);
            const data = Object.fromEntries(formData.entries());
            data.price = parseFloat(data.price);
            
            const imageInput = document.getElementById('new-product-image');
            
            if (imageInput.files && imageInput.files[0]) {
                data.image = URL.createObjectURL(imageInput.files[0]);
            } else {
                data.image = "./images/blackrice.png"; 
            }

            if (PRODUCTS.find(p => p.name.toLowerCase() === data.name.toLowerCase())) {
                productMessage.style.color = 'red';
                productMessage.textContent = 'Gagal: Produk dengan nama yang sama sudah ada.';
                return;
            }

            PRODUCTS.push(data); 
            addProductForm.reset();
            
            productMessage.style.color = 'green';
            productMessage.textContent = `Produk "${data.name}" berhasil ditambahkan!`;
            setTimeout(() => productMessage.textContent = '', 3000);

            renderProducts();
        }

        // --- INITIALIZATION ---
        loginForm.addEventListener('submit', (e) => handleAuthFormSubmit(e, 'login', loginMessage));
        registerForm.addEventListener('submit', (e) => handleAuthFormSubmit(e, 'register', registerMessage));
        document.addEventListener('DOMContentLoaded', () => {
            renderProducts(); 
            updateNavUI(); 
        });
        
        let prevScrollPos = window.pageYOffset;
        const navbar = document.getElementById('navbar');
        window.onscroll = function() {
            if (userContentWrapper.style.display === 'block') { 
                const currentScrollPos = window.pageYOffset;
                if (prevScrollPos > currentScrollPos || currentScrollPos < 50) {
                    navbar.style.top = "0";
                } else {
                     navbar.style.top = "-80px";
                }
                prevScrollPos = currentScrollPos;
            }
        }
    </script>
</body>
</html>