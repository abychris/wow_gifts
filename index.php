<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wow Gifts | Premium Custom Gifts for Every Occasion</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
    <script defer src="script.js"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Playfair+Display:wght@400;500;600;700&family=Dancing+Script:wght@500;600;700&display=swap');

        :root {
            --primary: #e83e8c;
            --secondary: #ff69b4;
            --accent: #ffd166;
            --dark: #2d3436;
            --light: #f7f7f7;
            --white: #ffffff;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
            overflow-x: hidden;
        }

        h1, h2, h3, h4 {
            font-family: 'Playfair Display', serif;
            font-weight: 600;
            line-height: 1.2;
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        /* Header */
        header {
            background: var(--white);
            box-shadow: var(--shadow);
            position: fixed;
            width: 100%;
            z-index: 1000;
            padding: 20px 0;
            transition: var(--transition);
        }

        header.scrolled {
            padding: 15px 0;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(5px);
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Dancing Script', cursive;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 10px;
            font-size: 1.8rem;
        }

        nav ul {
            display: flex;
            list-style: none;
        }

        nav ul li {
            margin-left: 30px;
            position: relative;
        }

        nav ul li a {
            text-decoration: none;
            color: var(--dark);
            font-weight: 500;
            font-size: 1rem;
            transition: var(--transition);
            padding: 5px 0;
        }

        nav ul li a:hover {
            color: var(--primary);
        }

        nav ul li a::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary);
            transition: var(--transition);
        }

        nav ul li a:hover::after {
            width: 100%;
        }

        .nav-cta {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            padding: 10px 20px;
            border-radius: 30px;
            margin-left: 20px;
            box-shadow: var(--shadow);
        }

        .nav-cta:hover {
            transform: translateY(-3px);
            color: var(--white);
        }

        .nav-cta:hover::after {
            width: 0;
        }

        .mobile-menu {
            display: none;
            font-size: 1.5rem;
            cursor: pointer;
        }

        /* User Profile - Updated to match reference image */
        .user-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .user-action {
            display: flex;
            flex-direction: column;
            align-items: center;
            cursor: pointer;
            color: var(--dark);
            text-decoration: none;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .user-action:hover {
            color: var(--primary);
        }

        .user-action a {
        display: flex; /* Use flexbox for alignment */
        flex-direction: column; /* Stack icon and text vertically */
        align-items: center; /* Center-align the icon and text */
        text-decoration: none; /* Remove underline from the link */
        color: var(--dark); /* Set text color */
        font-size: 0.9rem; /* Adjust text size */
        transition: var(--transition); /* Add smooth transition */
        }

        .user-action a:hover {
        color: var(--primary); /* Change color on hover */
        }

        .user-action a i {
        font-size: 1.5rem; /* Adjust icon size */
        margin-bottom: 0.25px; /* Add space between icon and text */
        }

        .user-action a span {
        text-align: center; /* Center-align the text */
        }

        .user-action i {
            font-size: 1.5rem;
            margin-bottom: 5px;
        }

        .user-action span {
            font-size: 0.9rem; /* Adjust text size */
            text-align: center; /* Center-align the text */
            margin-top: 5px; /* Add space between the icon and text */
        }

        .user-action i, .user-action span {
            pointer-events: none; /* Disable hover interactions */
        }

        .user-action:hover {
            color: inherit; /* Prevent color change on hover */
        }

        .profile-dropdown {
            position: absolute;
            top: 100%;
            right: 0;
            background: var(--white);
            border-radius: 10px;
            box-shadow: var(--shadow);
            padding: 20px;
            width: 250px;
            z-index: 1000;
            opacity: 0;
            visibility: hidden;
            transition: var(--transition);
            transform: translateY(10px);
        }

        .profile-dropdown.active {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .profile-dropdown-header {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .profile-dropdown-header img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 15px;
        }

        .profile-dropdown-header h4 {
            font-size: 1rem;
            margin-bottom: 5px;
        }

        .profile-dropdown-header p {
            color: #777;
            font-size: 0.8rem;
        }

        .profile-dropdown-menu {
            list-style: none;
        }

        .profile-dropdown-menu li {
            margin-bottom: 10px;
        }

        .profile-dropdown-menu a {
            display: flex;
            align-items: center;
            color: var(--dark);
            text-decoration: none;
            padding: 8px 0;
            transition: var(--transition);
        }

        .profile-dropdown-menu a:hover {
            color: var(--primary);
            padding-left: 5px;
        }

        .profile-dropdown-menu i {
            margin-right: 10px;
            width: 20px;
            text-align: center;
        }

        .login-signup {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 15px;
        }

        .login-signup a {
            text-align: center;
            padding: 8px;
            border-radius: 4px;
            text-decoration: none;
            transition: var(--transition);
        }

        .login-signup a:first-child {
            background: var(--primary);
            color: white;
        }

        .login-signup a:last-child {
            border: 1px solid #ddd;
            color: var(--dark);
        }

        .login-signup a:hover {
            opacity: 0.9;
        }

        /* Hero Section */
        .hero {
            height: 100vh;
            min-height: 700px;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') no-repeat center center/cover;
            display: flex;
            align-items: center;
            text-align: center;
            color: var(--white);
            padding-top: 80px;
        }

        .hero-content {
            max-width: 800px;
            margin: 0 auto;
            animation: fadeInUp 1s ease;
        }

        .hero h1 {
            font-size: 4rem;
            margin-bottom: 20px;
            font-family: 'Dancing Script', cursive;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 30px;
            opacity: 0.9;
        }

        .hero-btns {
            display: flex;
            justify-content: center;
            gap: 20px;
        }

        .btn {
            display: inline-block;
            padding: 15px 30px;
            border-radius: 30px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            font-size: 1rem;
            border: none;
            cursor: pointer;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            box-shadow: var(--shadow);
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(232, 62, 140, 0.3);
        }

        .btn-secondary {
            background: transparent;
            color: var(--white);
            border: 2px solid var(--white);
        }

        .btn-secondary:hover {
            background: var(--white);
            color: var(--primary);
        }

        /* Features Section */
        .features {
            padding: 100px 0;
            background: var(--white);
        }

        .section-title {
            text-align: center;
            margin-bottom: 60px;
        }

        .section-title h2 {
            font-size: 2.5rem;
            color: var(--dark);
            margin-bottom: 15px;
        }

        .section-title p {
            color: #777;
            max-width: 700px;
            margin: 0 auto;
        }

        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 30px;
        }

        .feature-card {
            background: var(--light);
            border-radius: 10px;
            padding: 40px 30px;
            text-align: center;
            transition: var(--transition);
            box-shadow: var(--shadow);
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            font-size: 3rem;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .feature-card h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
        }

        /* Products Preview */
        .products {
            padding: 100px 0;
            background: var(--light);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
        }

        .product-card {
            background: var(--white);
            border-radius: 10px;
            overflow: hidden;
            transition: var(--transition);
            box-shadow: var(--shadow);
            position: relative;
        }

        .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.1);
        }

        .product-img {
            height: 250px;
            overflow: hidden;
        }

        .product-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .product-card:hover .product-img img {
            transform: scale(1.05);
        }

        .product-info {
            padding: 20px;
            text-align: center;
        }

        .product-info h3 {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .product-info .price {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.2rem;
            margin-bottom: 15px;
        }

        .product-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            background: var(--accent);
            color: var(--dark);
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 600;
        }

        /* Testimonials */
        .testimonials {
            padding: 100px 0;
            background: var(--white);
        }

        .testimonials-slider {
            max-width: 800px;
            margin: 0 auto;
            text-align: center;
        }

        .testimonial-card {
            background: var(--light);
            padding: 40px;
            border-radius: 10px;
            box-shadow: var(--shadow);
            margin: 20px;
        }

        .testimonial-text {
            font-size: 1.1rem;
            font-style: italic;
            margin-bottom: 20px;
            color: #555;
        }

        .testimonial-author {
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .author-img {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            overflow: hidden;
            margin-right: 15px;
        }

        .author-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .author-info h4 {
            font-size: 1.1rem;
            margin-bottom: 5px;
        }

        .author-info p {
            color: #777;
            font-size: 0.9rem;
        }

        /* Newsletter */
        .newsletter {
            padding: 80px 0;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            color: var(--white);
            text-align: center;
        }

        .newsletter h2 {
            margin-bottom: 20px;
        }

        .newsletter p {
            max-width: 600px;
            margin: 0 auto 30px;
            opacity: 0.9;
        }

        .newsletter-form {
            display: flex;
            max-width: 500px;
            margin: 0 auto;
        }

        .newsletter-form input {
            flex: 1;
            padding: 15px 20px;
            border: none;
            border-radius: 30px 0 0 30px;
            font-size: 1rem;
            outline: none;
        }

        .newsletter-form button {
            background: var(--dark);
            color: var(--white);
            border: none;
            padding: 0 30px;
            border-radius: 0 30px 30px 0;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
        }

        .newsletter-form button:hover {
            background: #1a1a1a;
        }

        /* Footer */
        footer {
            background: var(--dark);
            color: var(--white);
            padding: 60px 0 20px;
        }

        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 40px;
            margin-bottom: 40px;
        }

        .footer-col h3 {
            font-size: 1.3rem;
            margin-bottom: 20px;
            position: relative;
            padding-bottom: 10px;
        }

        .footer-col h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--primary);
        }

        .footer-col ul {
            list-style: none;
        }

        .footer-col ul li {
            margin-bottom: 10px;
        }

        .footer-col ul li a {
            color: #bbb;
            text-decoration: none;
            transition: var(--transition);
        }

        .footer-col ul li a:hover {
            color: var(--white);
            padding-left: 5px;
        }

        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }

        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            color: var(--white);
            transition: var(--transition);
        }

        .social-links a:hover {
            background: var(--primary);
            transform: translateY(-3px);
        }

        .footer-bottom {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
            color: #bbb;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        /* Responsive */
        @media (max-width: 992px) {
            .hero h1 {
                font-size: 3.5rem;
            }
        }

        @media (max-width: 768px) {
            .mobile-menu {  
                display: block;
            }

            nav {
                position: fixed;
                top: 80px;
                left: -100%;
                width: 80%;
                height: calc(100vh - 80px);
                background: var(--white);
                box-shadow: var(--shadow);
                transition: var(--transition);
                z-index: 999;
            }

            nav.active {
                left: 0;
            }

            nav ul {
                flex-direction: column;
                padding: 30px;
            }

            nav ul li {
                margin: 15px 0;
            }

            .nav-cta {
                margin-left: 0;
                display: block;
                text-align: center;
            }

            .hero h1 {
                font-size: 2.8rem;
            }

            .hero-btns {
                flex-direction: column;
                gap: 15px;
            }

            .btn {
                width: 100%;
            }

            .newsletter-form {
                flex-direction: column;
            }

            .newsletter-form input {
                border-radius: 30px;
                margin-bottom: 10px;
            }

            .newsletter-form button {
                border-radius: 30px;
                padding: 15px;
            }

            .profile-dropdown {
                width: 200px;
                right: 20px;
            }

            .user-actions {
                gap: 15px;
            }
        }

        @media (max-width: 576px) {
            .hero h1 {
                font-size: 2.2rem;
            }

            .hero p {
                font-size: 1rem;
            }

            .section-title h2 {
                font-size: 2rem;
            }

            .user-action span {
                display: none;
            }

            .user-action i {
                margin-bottom: 0;
                font-size: 1.5rem;
            }
        }
        #back-to-top {
        position: fixed;
        bottom: 20px;
        right: 20px;
        background: var(--primary);
        color: var(--white);
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        font-size: 1.2rem;
        cursor: pointer;
        box-shadow: var(--shadow);
        transition: var(--transition);
        z-index: 1000;
        }

        #back-to-top:hover {
        background: var(--secondary);
        transform: translateY(-3px);
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header id="header">
        <div class="container header-container">
            <div class="logo">
                <i class="fas fa-gift"></i>
                <span>Wow Gifts</span>
            </div>
            
            <nav id="nav">
                <ul>
                    <li><a href="#features">Why Us?</a></li>
                    <li><a href="#products">Products</a></li>
                    <li><a href="#testimonials">Testimonials</a></li>
                </ul>
            </nav>
            
            <!-- User Actions Section - Updated to match reference image -->
            
            <div class="user-actions">
    <?php if (isset($_SESSION['username'])): ?>
        <!-- Show welcome message when logged in -->
        <div class="user-action">
            <i class="fas fa-user-circle"></i>
            <span>Welcome, <?= htmlspecialchars($_SESSION['username']); ?></span>
            <a href="logout.php">Logout</a>
        </div>
    <?php else: ?>
        <!-- Show login button when not logged in -->
        <div class="user-action">
            <a href="login.php">
                <i class="fas fa-user"></i>
                <span>Login</span>
            </a>
        </div>
    <?php endif; ?>
</div>
                    
                    <!-- Profile dropdown -->
                    <div id="profile-dropdown" class="profile-dropdown">
                        <!-- Logged in content -->
                        <div id="logged-in-content" style="display: none;">
                            <div class="profile-dropdown-header">
                                <img src="https://www.pinterest.com/ideas/whatsapp-no-profile-picture-icon/948159067224/" alt="User Image" id="user-image">
                                <div>
                                    <h4 id="user-name">Sarah Johnson</h4>
                                    <p id="user-email">sarah@example.com</p>
                                </div>
                            </div>
                            <ul class="profile-dropdown-menu">
                                <li><a href="profile.php"><i class="fas fa-user"></i> My Profile</a></li>
                                <li><a href="orders.php"><i class="fas fa-box"></i> Orders</a></li>
                                <li><a href="wishlist.php"><i class="fas fa-heart"></i> Wishlist</a></li>
                                <li><a href="rewards.php"><i class="fas fa-award"></i> Rewards</a></li>
                                <li><a href="giftcards.php"><i class="fas fa-gift"></i> Gift Cards</a></li>
                            </ul>
                            <button id="logout-btn" class="btn btn-primary" style="width: 100%; margin-top: 10px;">Logout</button>
                        </div>
                        
                        <!-- Logged out content -->
                        <div id="logged-out-content">
                            <p style="text-align: center; margin-bottom: 15px;">Access account and manage orders</p>
                            <div class="login-signup">
                                <a href="login.php">Login</a>
                                <a href="signup.php">Sign Up</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    
            <div class="mobile-menu" id="mobile-menu">
                <i class="fas fa-bars"></i>
            </div>
        </div>
    </header>

    <!-- Rest of your HTML content remains the same -->
    <!-- Hero Section -->
    <section class="hero">
        <div class="container hero-content">
            <h1>Thoughtful Gifts for Special Moments</h1>
            <p>Personalized gifts that show you care. Custom pillows, mugs, chocolates, and more - crafted with love for every occasion.</p>
            <div class="hero-btns">
                <a href="shop_now.php" class="btn btn-secondary">Shop Now</a>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="container">
            <div class="section-title">
                <h2>Why Choose Wow Gifts</h2>
                <p>We combine quality craftsmanship with personal touches to create gifts that truly stand out</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-star"></i>
                    </div>
                    <h3>Premium Quality</h3>
                    <p>We use only the finest materials to ensure your gifts look beautiful and last long.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-paint-brush"></i>
                    </div>
                    <h3>Fully Customizable</h3>
                    <p>Personalize every detail to create a one-of-a-kind gift that's uniquely yours.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-shipping-fast"></i>
                    </div>
                    <h3>Fast Shipping</h3>
                    <p>Get your gifts delivered quickly with our reliable shipping options.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Products Preview -->
    <section class="products" id="products">
        <div class="container">
            <div class="section-title">
                <h2>Our Popular Gifts</h2>
                <p>Explore our curated collection of most-loved personalized gifts</p>
            </div>
            
            <div class="products-grid">
                <div class="product-card">
                    <div class="product-badge">Bestseller</div>
                    <div class="product-img">
                        <img src="https://images.zoomin.com/photo_cushion_fur_snowy_white/4.0.0/product_images/web/fur-lined-photo-cushion-1.jpg" alt="Custom Pillow">
                    </div>
                    <div class="product-info">
                        <h3>Personalized Photo Pillow</h3>
                        <div class="price">$39.99</div>
                        <a href="#" class="btn btn-primary">Customize</a>
                    </div>
                </div>
                
                <div class="product-card">
                    <div class="product-img">
                        <img src="https://www.vedicparadise.com/cdn/shop/files/51ZbvmUSeUL-Photoroom.webp?v=1718803600" alt="Custom Mug">
                    </div>
                    <div class="product-info">
                        <h3>Custom Printed Mug</h3>
                        <div class="price">$24.99</div>
                        <a href="#" class="btn btn-primary">Customize</a>
                    </div>
                </div>
                
                <div class="product-card">
                    <div class="product-badge">New</div>
                    <div class="product-img">
                        <img src="https://www.puneonlineflorists.com/images/CMC4691-VA_big.webp" alt="Chocolate Box">
                    </div>
                    <div class="product-info">
                        <h3>Personalized Chocolate Box</h3>
                        <div class="price">$29.99</div>
                        <a href="#" class="btn btn-primary">Customize</a>
                    </div>
                </div>
                
                <div class="product-card">
                    <div class="product-img">
                        <img src="https://images.unsplash.com/photo-1578985545062-69928b1d9587?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1089&q=80" alt="Custom Cake">
                    </div>
                    <div class="product-info">
                        <h3>Custom Message Cake</h3>
                        <div class="price">$49.99</div>
                        <a href="#" class="btn btn-primary">Customize</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="testimonials" id="testimonials">
        <div class="container">
            <div class="section-title">
                <h2>What Our Customers Say</h2>
                <p>Hear from people who've made their loved ones smile with our gifts</p>
            </div>
            
            <div class="testimonials-slider">
                <div class="testimonial-card">
                    <p class="testimonial-text">"The personalized pillow I ordered was even better than I imagined! The print quality is excellent and it arrived right on time for my mom's birthday. She absolutely loved it!"</p>
                    <div class="testimonial-author">
                        <div class="author-img">
                            <img src="https://randomuser.me/api/portraits/women/43.jpg" alt="Sarah J.">
                        </div>
                        <div class="author-info">
                            <h4>Sarah J.</h4>
                            <p>Verified Customer</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="newsletter">
        <div class="container">
            <h2>Join Our Gift Community</h2>
            <p>Subscribe to receive exclusive offers, gift ideas, and early access to new products</p>
            <form class="newsletter-form">
                <input type="email" placeholder="Your email address" required>
                <button type="submit">Subscribe</button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-col">
                    <div class="logo">
                        <i class="fas fa-gift"></i>
                        <span>Wow Gifts</span>
                    </div>
                    <p>Creating memorable gifts for life's special moments since 2025.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-pinterest-p"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
                
                <div class="footer-col">
                    <h3>Shop</h3>
                    <ul>
                        <li><a href="#">All Products</a></li>
                        <li><a href="#">New Arrivals</a></li>
                        <li><a href="#">Best Sellers</a></li>
                        <li><a href="#">Gift Cards</a></li>
                        <li><a href="#">Sale</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3>Help</h3>
                    <ul>
                        <li><a href="#">FAQ</a></li>
                        <li><a href="#">Shipping Info</a></li>
                        <li><a href="#">Returns & Exchanges</a></li>
                        <li><a href="#">Size Guide</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                
                <div class="footer-col">
                    <h3>Company</h3>
                    <ul>
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Our Story</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Careers</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2025 Wow Gifts. All rights reserved. | Designed with <i class="fas fa-heart" style="color: var(--primary);"></i> for special moments</p>
            </div>
        </div>
    </footer>
    <button id="back-to-top" style="display: none;">
        <i class="fas fa-arrow-up"></i>
    </button>

    <script>
        // Mobile Menu Toggle
        const mobileMenu = document.getElementById('mobile-menu');
        const nav = document.getElementById('nav');
        
        mobileMenu.addEventListener('click', () => {
            nav.classList.toggle('active');
            mobileMenu.innerHTML = nav.classList.contains('active') ? 
                '<i class="fas fa-times"></i>' : '<i class="fas fa-bars"></i>';
        });
        
        // Header Scroll Effect
        const header = document.getElementById('header');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });
        
        // Smooth Scrolling for Anchor Links
        /*document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                
                if (this.getAttribute('href') === '#') return;
                
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                    
                    // Close mobile menu if open
                    if (nav.classList.contains('active')) {
                        nav.classList.remove('active');
                        mobileMenu.innerHTML = '<i class="fas fa-bars"></i>';
                    }
                }
            });
        });*/
        
        // Animation on Scroll
        const animateOnScroll = () => {
            const elements = document.querySelectorAll('.feature-card, .product-card, .testimonial-card');
            
            elements.forEach(element => {
                const elementPosition = element.getBoundingClientRect().top;
                const screenPosition = window.innerHeight / 1.2;
                
                if (elementPosition < screenPosition) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        };
        
        // Set initial state for animated elements
        document.querySelectorAll('.feature-card, .product-card, .testimonial-card').forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            element.style.transition = 'all 0.6s ease';
        });
        
        window.addEventListener('scroll', animateOnScroll);
        window.addEventListener('load', animateOnScroll);
    </script>

    
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const userProfile = document.getElementById('user-profile');
            const loginState = document.getElementById('login-state');
            const profileState = document.getElementById('profile-state');
            const profileDropdown = document.getElementById('profile-dropdown');
            const loggedInContent = document.getElementById('logged-in-content');
            const loggedOutContent = document.getElementById('logged-out-content');
            const logoutBtn = document.getElementById('logout-btn');
    
            // Load user data from localStorage
            const userData = JSON.parse(localStorage.getItem('user')) || null;
    
            // Check if user is logged in
            if (userData) {
                // Show profile state
                loginState.style.display = 'none';
                profileState.style.display = 'flex';
                loggedInContent.style.display = 'block';
                loggedOutContent.style.display = 'none';
    
                // Update user info
                document.getElementById('profile-name').textContent = userData.name.split(' ')[0];
                document.getElementById('user-name').textContent = userData.name;
                document.getElementById('user-email').textContent = userData.email;
    
                if (userData.image) {
                    document.getElementById('user-image').src = userData.image;
                }
            } else {
                // Show login state
                loginState.style.display = 'flex';
                profileState.style.display = 'none';
                loggedInContent.style.display = 'none';
                loggedOutContent.style.display = 'block';
            }
    
            // Toggle profile dropdown
            userProfile.addEventListener('click', (e) => {
                if (e.target.closest('.user-action')) {
                    profileDropdown.classList.toggle('active');
                }
            });
    
            // Close dropdown when clicking outside
            document.addEventListener('click', (e) => {
                if (!userProfile.contains(e.target)) {
                    profileDropdown.classList.remove('active');
                }
            });
    
            // Logout functionality
            logoutBtn.addEventListener('click', () => {
                localStorage.removeItem('user');
                location.reload();
            });
    
            // Redirect to login page when clicking on "Login"
            document.querySelectorAll('[href="login.php"]').forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    window.location.href = 'login.php';
                });
            });
        });
    </script>
    <script>
    // Smooth Scrolling for Navigation Links
    document.querySelectorAll('nav ul li a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default anchor behavior

            const targetId = this.getAttribute('href'); // Get the target section ID
            const targetElement = document.querySelector(targetId); // Find the target element

            if (targetElement) {
                // Scroll to the target element smoothly
                window.scrollTo({
                    top: targetElement.offsetTop - 80, // Adjust for header height
                    behavior: 'smooth'
                });
            }
        });
    });

    </script>
<script>
    const backToTopButton = document.getElementById('back-to-top');

window.addEventListener('scroll', () => {
    if (window.scrollY > 300) {
        backToTopButton.style.display = 'flex';
    } else {
        backToTopButton.style.display = 'none';
    }
});

backToTopButton.addEventListener('click', () => {
    window.scrollTo({
        top: 0,
        behavior: 'smooth'
    });
});
</script>
<script>
    // Smooth Scrolling for Navigation Links
    document.querySelectorAll('nav ul li a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault(); // Prevent default anchor behavior

            const targetId = this.getAttribute('href'); // Get the target section ID
            const targetElement = document.querySelector(targetId); // Find the target element
            
            console.log(`Scrolling to: ${targetId}`);

            if (targetElement) {
                // Scroll to the target element smoothly
                window.scrollTo({
                    top: targetElement.offsetTop - 80, // Adjust for header height
                    behavior: 'smooth'
                });
            }
        });
    });
</script>
</body>
</html>