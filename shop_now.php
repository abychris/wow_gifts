<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop Now | Wow Gifts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Montserrat:wght@400;600&family=Dancing+Script:wght@700&display=swap" rel="stylesheet">
    <style>
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
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo {
            font-family: 'Dancing Script', cursive;
            text-decoration: none;
            font-size: 2.2rem;
            font-weight: 700;
            color: var(--primary);
            display: flex;
            align-items: center;
        }

        .logo i {
            margin-right: 12px;
            font-size: 1.8rem;
            transition: var(--transition);
        }

        .cart-icon {
            position: relative;
            font-size: 1.5rem;
            color: var(--dark);
            cursor: pointer;
            transition: var(--transition);
        }

        .cart-icon:hover {
            color: var(--primary);
            transform: scale(1.1);
        }

        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background: var(--primary);
            color: white;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.8rem;
            font-family: 'Montserrat', sans-serif;
            font-weight: 600;
        }


        /* Shop Now Section */
        .shop-now {
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 120px 0 80px;
            background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.9)), 
                        url('https://images.unsplash.com/photo-1513151233558-d860c5398176?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') no-repeat center center/cover;
        
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
        }

        .section-title h1 {
            font-family: 'Playfair Display', serif;
            font-size: 2.5rem;
            color: var(--dark);
            margin-bottom: 15px;
        }

        .section-title p {
            color: #777;
            max-width: 700px;
            margin: 0 auto;
        }

        .product-category {
            margin-bottom: 60px;
        }

        .category-title {
            font-family: 'Playfair Display', serif;
            font-size: 1.8rem;
            color: var(--primary);
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--accent);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 30px;
            margin-bottom: 40px;
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
        }

        .product-info h3 {
            font-size: 1.1rem;
            margin-bottom: 10px;
            font-family: 'Playfair Display', serif;
        }

        .product-info p {
            color: #777;
            margin-bottom: 15px;
            font-size: 0.9rem;
        }

        .price {
            font-weight: 700;
            color: var(--primary);
            font-size: 1.1rem;
        }

        .add-to-cart {
            display: block;
            width: 100%;
            text-align: center;
            margin-top: 15px;
            background: var(--primary);
            color: white;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-weight: 600;
            transition: var(--transition);
            font-family: 'Montserrat', sans-serif;
        }

        .add-to-cart:hover {
            background: var(--secondary);
            transform: translateY(-2px);
        }

        .add-to-cart i {
            margin-right: 8px;
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

        /* Cart Modal */
        .cart-modal {
            display: none;
            position: fixed;
            top: 0;
            right: 0;
            width: 350px;
            height: 100%;
            background: var(--white);
            box-shadow: -5px 0 15px rgba(0, 0, 0, 0.1);
            z-index: 2000;
            padding: 20px;
            overflow-y: auto;
            transform: translateX(100%);
            transition: transform 0.3s ease;
        }

        .cart-modal.active {
            transform: translateX(0);
        }

        .cart-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 10px;
            border-bottom: 1px solid #eee;
        }

        .cart-header h2 {
            font-family: 'Playfair Display', serif;
            color: var(--dark);
        }

        .close-cart {
            background: none;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            color: var(--dark);
        }

        .cart-items {
            margin-bottom: 20px;
        }

        .cart-item {
            display: flex;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .cart-item-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 15px;
        }

        .cart-item-details {
            flex: 1;
        }

        .cart-item-title {
            font-weight: 600;
            margin-bottom: 5px;
        }

        .cart-item-price {
            color: var(--primary);
            font-weight: 600;
        }

        .remove-item {
            background: none;
            border: none;
            color: #777;
            cursor: pointer;
            font-size: 0.8rem;
        }

        .cart-total {
            font-weight: 700;
            font-size: 1.2rem;
            margin-bottom: 20px;
            text-align: right;
        }

        .checkout-btn {
            display: block;
            width: 100%;
            padding: 12px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .checkout-btn:hover {
            background: var(--secondary);
        }

        .overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1500;
        }

        .overlay.active {
            display: block;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .products-grid {
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            }
            
            .section-title h1 {
                font-size: 2rem;
            }
            
            .category-title {
                font-size: 1.5rem;
            }

            .cart-modal {
                width: 300px;
            }
        }

        @media (max-width: 480px) {
            .cart-modal {
                width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Header with Cart -->
    <header>
        <div class="container header-container">
            <a href="index.php " class="logo">
                <i class="fas fa-gift"></i>
                <span>Wow Gifts</span>
            </a>
            <a href="cart.php" class="cart-icon" id="cart-icon">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-count">0</span>
            </a>
        </div>
    </header>

    <!-- Cart Modal -->
    <div class="overlay" id="overlay"></div>
    <div class="cart-modal" id="cart-modal">
        <div class="cart-header">
            <h2>Your Cart</h2>
            <button class="close-cart" id="close-cart">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="cart-items" id="cart-items">
            <!-- Cart items will be added here dynamically -->
        </div>
        <div class="cart-total">
            Total: $<span id="cart-total">0.00</span>
        </div>
        <a href="cart.php" class="checkout-btn">Proceed to Checkout</a>
    </div>

    <!-- Shop Now Section -->
    <section class="shop-now">
        <div class="container">
            <div class="section-title">
                <h1>Our Gift Collection</h1>
                <p>Find the perfect personalized gift for every occasion</p>
            </div>
            
            <!-- Pillow Category -->
            <div class="product-category">
                <h2 class="category-title">Personalized Pillows</h2>
                <div class="products-grid">
                    <!-- Pillow 1 -->
                    <div class="product-card">
                        <div class="product-badge">Bestseller</div>
                        <div class="product-img">
                            <img src="https://5.imimg.com/data5/SELLER/Default/2022/3/VI/SW/FG/43553677/imgl8139-600x60-500x500.jpg" alt="Personalized Pillow">
                        </div>
                        <div class="product-info">
                            <h3>Classic Photo Pillow</h3>
                            <p>18x18 inches, soft polyester cover</p>
                            <div class="price">$39.99</div>
                            <button class="add-to-cart" data-id="1" data-name="Classic Photo Pillow" data-price="39.99" data-image="https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=880&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Pillow 2 -->
                    <div class="product-card">
                        <div class="product-img">
                            <img src="https://m.media-amazon.com/images/I/812vPq6TYkL.jpg" alt="Heart Pillow">
                        </div>
                        <div class="product-info">
                            <h3>Heart Shape Pillow</h3>
                            <p>16x16 inches, perfect for anniversaries</p>
                            <div class="price">$34.99</div>
                            <button class="add-to-cart" data-id="2" data-name="Heart Shape Pillow" data-price="34.99" data-image="https://images.unsplash.com/photo-1631729371254-42c2892f0e6e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Pillow 3 -->
                    <div class="product-card">
                        <div class="product-badge">New</div>
                        <div class="product-img">
                            <img src="https://i.etsystatic.com/28223038/r/il/912d0b/3823905761/il_fullxfull.3823905761_n06c.jpg" alt="Rectangle Pillow">
                        </div>
                        <div class="product-info">
                            <h3>Rectangle Throw Pillow</h3>
                            <p>12x20 inches, great for couch decor</p>
                            <div class="price">$29.99</div>
                            <button class="add-to-cart" data-id="3" data-name="Rectangle Throw Pillow" data-price="29.99" data-image="https://images.unsplash.com/photo-1576872381147-b9f6108c08ad?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Pillow 4 -->
                    <div class="product-card">
                        <div class="product-img">
                            <img src="https://images-cdn.ubuy.co.in/64103e467d0e1d33e01d4221-artscope-luxury-velvet-pillow-covers.jpg" alt="Velvet Pillow">
                        </div>
                        <div class="product-info">
                            <h3>Luxury Velvet Pillow</h3>
                            <p>18x18 inches, premium velvet material</p>
                            <div class="price">$44.99</div>
                            <button class="add-to-cart" data-id="4" data-name="Luxury Velvet Pillow" data-price="44.99" data-image="https://images.unsplash.com/photo-1576872381147-b9f6108c08ad?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Mug Category -->
            <div class="product-category">
                <h2 class="category-title">Personalized Mugs</h2>
                <div class="products-grid">
                    <!-- Mug 1 -->
                    <div class="product-card">
                        <div class="product-badge">Bestseller</div>
                        <div class="product-img">
                            <img src="https://thepreciousgifts.in/wp-content/uploads/2023/04/Customized-Couple-Coffee-Mugs-with-Name-and-Date.jpg" alt="Classic Mug">
                        </div>
                        <div class="product-info">
                            <h3>Classic Ceramic Mug</h3>
                            <p>11oz, microwave and dishwasher safe</p>
                            <div class="price">$19.99</div>
                            <button class="add-to-cart" data-id="5" data-name="Classic Ceramic Mug" data-price="19.99" data-image="https://images.unsplash.com/photo-1550583724-b2692b85b150?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=687&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Mug 2 -->
                    <div class="product-card">
                        <div class="product-img">
                            <img src="https://m.media-amazon.com/images/I/81If0etYAbL._AC_UF894,1000_QL80_.jpg" alt="Travel Mug">
                        </div>
                        <div class="product-info">
                            <h3>Travel Tumbler</h3>
                            <p>16oz, stainless steel, leak-proof</p>
                            <div class="price">$29.99</div>
                            <button class="add-to-cart" data-id="6" data-name="Travel Tumbler" data-price="29.99" data-image="https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=880&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Mug 3 -->
                    <div class="product-card">
                        <div class="product-badge">New</div>
                        <div class="product-img">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRarw_EMWbcNRnOqTG_eMuLYY72-tOpMyhEtw&s" alt="Photo Mug">
                        </div>
                        <div class="product-info">
                            <h3>Photo Wrap Mug</h3>
                            <p>15oz, full-color photo printing</p>
                            <div class="price">$24.99</div>
                            <button class="add-to-cart" data-id="7" data-name="Photo Wrap Mug" data-price="24.99" data-image="https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=880&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Mug 4 -->
                    <div class="product-card">
                        <div class="product-img">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcS_ZFkOk02nzZ-__-3lB8iGq-almfQA-5W55w&s" alt="Couple Mug">
                        </div>
                        <div class="product-info">
                            <h3>His & Hers Mug Set</h3>
                            <p>Pair of 12oz mugs, perfect for couples</p>
                            <div class="price">$39.99</div>
                            <button class="add-to-cart" data-id="8" data-name="His & Hers Mug Set" data-price="39.99" data-image="https://images.unsplash.com/photo-1598300042247-d088f8ab3a91?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=880&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Chocolate Category -->
            <div class="product-category">
                <h2 class="category-title">Personalized Chocolates</h2>
                <div class="products-grid">
                    <!-- Chocolate 1 -->
                    <div class="product-card">
                        <div class="product-badge">Bestseller</div>
                        <div class="product-img">
                            <img src="https://www.zoroy.com/cdn/shop/files/ZOROYValentineMessageAlmondButtercrunchTin_Crispcaramalisedcentrecoatedwithdarkchocolates_almonds_-150gms.jpg?v=1704368027" alt="Chocolate Box">
                        </div>
                        <div class="product-info">
                            <h3>Deluxe Chocolate Box</h3>
                            <p>16 pieces, assorted flavors</p>
                            <div class="price">$29.99</div>
                            <button class="add-to-cart" data-id="9" data-name="Deluxe Chocolate Box" data-price="29.99" data-image="https://images.unsplash.com/photo-1587135991058-8816a1a7e7ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Chocolate 2 -->
                    <div class="product-card">
                        <div class="product-img">
                            <img src="https://m.media-amazon.com/images/I/71C9P4heegL._AC_UF894,1000_QL80_.jpg" alt="Heart Chocolate">
                        </div>
                        <div class="product-info">
                            <h3>Heart Shape Chocolates</h3>
                            <p>12 pieces, milk and dark chocolate</p>
                            <div class="price">$24.99</div>
                            <button class="add-to-cart" data-id="10" data-name="Heart Shape Chocolates" data-price="24.99" data-image="https://images.unsplash.com/photo-1587135991058-8816a1a7e7ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Chocolate 3 -->
                    <div class="product-card">
                        <div class="product-badge">New</div>
                        <div class="product-img">
                            <img src="https://cdn.igp.com/f_auto,q_auto,t_pnopt19prodlp/products/p-premium-gourmet-chocolate-truffles-pack-of-6--266181-m.jpg" alt="Truffle Box">
                        </div>
                        <div class="product-info">
                            <h3>Gourmet Truffle Box</h3>
                            <p>9 pieces, premium Belgian chocolate</p>
                            <div class="price">$34.99</div>
                            <button class="add-to-cart" data-id="11" data-name="Gourmet Truffle Box" data-price="34.99" data-image="https://images.unsplash.com/photo-1587135991058-8816a1a7e7ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Chocolate 4 -->
                    <div class="product-card">
                        <div class="product-img">
                            <img src="https://m.media-amazon.com/images/I/61JwQrz1ChL._AC_UF894,1000_QL80_.jpg" alt="Chocolate Letters">
                        </div>
                        <div class="product-info">
                            <h3>Alphabet Chocolate Set</h3>
                            <p>Custom name with chocolate letters</p>
                            <div class="price">$27.99</div>
                            <button class="add-to-cart" data-id="12" data-name="Alphabet Chocolate Set" data-price="27.99" data-image="https://images.unsplash.com/photo-1587135991058-8816a1a7e7ab?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1471&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Cake Category -->
            <div class="product-category">
                <h2 class="category-title">Personalized Cakes</h2>
                <div class="products-grid">
                    <!-- Cake 1 -->
                    <div class="product-card">
                        <div class="product-badge">Bestseller</div>
                        <div class="product-img">
                            <img src="https://bkmedia.bakingo.com/sq-round-shaped-vanilla-cake-4-cake904vani-AA.jpg?tr=w-500,h-500" alt="Round Cake">
                        </div>
                        <div class="product-info">
                            <h3>Classic Round Cake</h3>
                            <p>8-inch, vanilla or chocolate</p>
                            <div class="price">$49.99</div>
                            <button class="add-to-cart" data-id="13" data-name="Classic Round Cake" data-price="49.99" data-image="https://images.unsplash.com/photo-1578985545062-69928b1d9587?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1089&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Cake 2 -->
                    <div class="product-card">
                        <div class="product-img">
                            <img src="https://www.sweetesbakeshop.com/cdn/shop/products/HERO_Confetti_Sheet_Cake_8a45e3ae-d55e-46ef-b2d5-5050cd8eebd5.jpg?v=1681487895" alt="Sheet Cake">
                        </div>
                        <div class="product-info">
                            <h3>Celebration Sheet Cake</h3>
                            <p>Serves 20-25 people</p>
                            <div class="price">$59.99</div>
                            <button class="add-to-cart" data-id="14" data-name="Celebration Sheet Cake" data-price="59.99" data-image="https://images.unsplash.com/photo-1578985545062-69928b1d9587?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1089&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Cake 3 -->
                    <div class="product-card">
                        <div class="product-badge">New</div>
                        <div class="product-img">
                            <img src="https://imgs.search.brave.com/cBwO_jmwU48-g8W9zzmhdivu7gs-fHXj5aCXePXkl4g/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tLm1l/ZGlhLWFtYXpvbi5j/b20vaW1hZ2VzL0kv/NzFUNnVPSUtFa0wu/anBn" alt="Cupcake Tower">
                        </div>
                        <div class="product-info">
                            <h3>Cupcake Tower</h3>
                            <p>24 cupcakes, assorted flavors</p>
                            <div class="price">$44.99</div>
                            <button class="add-to-cart" data-id="15" data-name="Cupcake Tower" data-price="44.99" data-image="https://images.unsplash.com/photo-1578985545062-69928b1d9587?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1089&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Cake 4 -->
                    <div class="product-card">
                        <div class="product-img">
                            <img src="https://imgs.search.brave.com/MvxfUX--uy1c0xQgr8CPHknnwVPo3vAtqtweq0DcqyQ/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pNS53/YWxtYXJ0aW1hZ2Vz/LmNvbS9zZW8vVG9y/bi1QYXBlci1QaG90/by1Db2xsYWdlLUFk/ZC1Zb3VyLU93bi1Q/aG90b3MtQ3VzdG9t/aXplYWJsZS1QaG90/by1GcmFtZS1FZGli/bGUtQ2FrZS1Ub3Bw/ZXItSW1hZ2UtRnJh/bWUtQUJQSUQ1NTA5/NV9jM2RmNTNkOC1m/NWU2LTRmNGEtODc1/Zi05M2E3NzE4Yzll/NTYuMjExYWQ5ZDQ4/NGJlNDhlMTEyZjA4/ODE3ZGM0MWZlMDYu/anBlZz9vZG5IZWln/aHQ9NTgwJm9kbldp/ZHRoPTU4MCZvZG5C/Zz1GRkZGRkY" alt="Photo Cake">
                        </div>
                        <div class="product-info">
                            <h3>Edible Photo Cake</h3>
                            <p>Your image printed on frosting</p>
                            <div class="price">$54.99</div>
                            <button class="add-to-cart" data-id="16" data-name="Edible Photo Cake" data-price="54.99" data-image="https://images.unsplash.com/photo-1578985545062-69928b1d9587?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1089&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Frame Category -->
            <div class="product-category">
                <h2 class="category-title">Personalized Frames</h2>
                <div class="products-grid">
                    <!-- Frame 1 -->
                    <div class="product-card">
                        <div class="product-badge">Bestseller</div>
                        <div class="product-img">
                            <img src="https://imgs.search.brave.com/DttUQleYiex3Qp4SzHv61yWDqF_faRarMasYQh2DgRo/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pLmV0/c3lzdGF0aWMuY29t/LzE3NDEzMjcwL2Mv/MTY0Mi8xNjQyLzE5/Ni8yMDIvaWwvNGMx/NzBiLzI2MDM3Mzgy/NjQvaWxfNjAweDYw/MC4yNjAzNzM4MjY0/X2RjYjguanBn" alt="Wooden Frame">
                        </div>
                        <div class="product-info">
                            <h3>Engraved Wood Frame</h3>
                            <p>4x6 inches, natural oak finish</p>
                            <div class="price">$34.99</div>
                            <button class="add-to-cart" data-id="17" data-name="Engraved Wood Frame" data-price="34.99" data-image="https://images.unsplash.com/photo-1596464716127-f2a82984de30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Frame 2 -->
                    <div class="product-card">
                        <div class="product-img">
                            <img src="https://imgs.search.brave.com/bpZ5hrxHWKzssoxoMPvHPaF4GEAc2QfwPR8EkbX17oY/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pLmV0/c3lzdGF0aWMuY29t/LzE5OTIxMDcxL2Mv/MTI1MC8xMjUwLzM1/Mi8wL2lsL2ZlNGQx/Mi8yNjc1NDc2Mjg5/L2lsXzYwMHg2MDAu/MjY3NTQ3NjI4OV90/cDI4LmpwZw" alt="Collage Frame">
                        </div>
                        <div class="product-info">
                            <h3>Multi-Photo Collage Frame</h3>
                            <p>Holds 4 photos, 8x10 inches</p>
                            <div class="price">$39.99</div>
                            <button class="add-to-cart" data-id="18" data-name="Multi-Photo Collage Frame" data-price="39.99" data-image="https://images.unsplash.com/photo-1596464716127-f2a82984de30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Frame 3 -->
                    <div class="product-card">
                        <div class="product-badge">New</div>
                        <div class="product-img">
                            <img src="https://imgs.search.brave.com/eQH-xpG8KZSTIAwtDmxVw_yuh0oa78MA8If0WcNy-ZQ/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93d3cu/bHV2bGluay5jb20v/Y2RuL3Nob3AvZmls/ZXMvYmxhY2tfMTAu/anBnP3Y9MTcyOTU2/NzExOCZ3aWR0aD0x/OTQ2" alt="Digital Frame">
                        </div>
                        <div class="product-info">
                            <h3>Digital Photo Frame</h3>
                            <p>10-inch display, stores 1000+ photos</p>
                            <div class="price">$79.99</div>
                            <button class="add-to-cart" data-id="19" data-name="Digital Photo Frame" data-price="79.99" data-image="https://images.unsplash.com/photo-1596464716127-f2a82984de30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Frame 4 -->
                    <div class="product-card">
                        <div class="product-img">
                            <img src="https://imgs.search.brave.com/HxgKb8x-4_Tr9OSuUeK42jYGIoPhEJO1A7mXrsFZy5Y/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9pNS53/YWxtYXJ0aW1hZ2Vz/LmNvbS9zZW8vMTgt/eDI0LUNsZWFyLUFj/cnlsaWMtV2FsbC1N/b3VudC1GbG9hdGlu/Zy1GcmFtZWxlc3Mt/UGljdHVyZS1GcmFt/ZS1Db2xsYWdlLVBo/b3RvLURpc3BsYXkt/SG9sZGVyX2NkYzNm/MDJmLTM3YjEtNDY5/MS1hYzY3LTY4MDEz/NjkyOTc0MS5iZGU5/NzJhNzFlNDEwMTJi/NWQxZDI3YWU4ZjBl/ZjEyNy5qcGVnP29k/bkhlaWdodD01ODAm/b2RuV2lkdGg9NTgw/Jm9kbkJnPUZGRkZG/Rg" alt="Acrylic Frame">
                        </div>
                        <div class="product-info">
                            <h3>Modern Acrylic Frame</h3>
                            <p>5x7 inches, clear acrylic design</p>
                            <div class="price">$29.99</div>
                            <button class="add-to-cart" data-id="20" data-name="Modern Acrylic Frame" data-price="29.99" data-image="https://images.unsplash.com/photo-1596464716127-f2a82984de30?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Blanket Category -->
            <div class="product-category">
                <h2 class="category-title">Personalized Blankets</h2>
                <div class="products-grid">
                    <!-- Blanket 1 -->
                    <div class="product-card">
                        <div class="product-badge">Bestseller</div>
                        <div class="product-img">
                            <img src="https://imgs.search.brave.com/OvKRazQE4RqTahyv-8SLOjj0P_PqUQSgc700-j5Vnd8/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly93d3cu/Y3VzdG9tZW52eS5j/b20vY2RuL3Nob3Av/ZmlsZXMvMzMuanBn/P3Y9MTcyMzQ3NTI4/MCZ3aWR0aD0yMDAw" alt="Fleece Blanket">
                        </div>
                        <div class="product-info">
                            <h3>Photo Fleece Blanket</h3>
                            <p>50x60 inches, ultra-soft material</p>
                            <div class="price">$59.99</div>
                            <button class="add-to-cart" data-id="21" data-name="Photo Fleece Blanket" data-price="59.99" data-image="https://images.unsplash.com/photo-1598302936620-9723f534f7a7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Blanket 2 -->
                    <div class="product-card">
                        <div class="product-img">
                            <img src="https://imgs.search.brave.com/i4IefF4QMzrFl6uw_Fm5LZAoymEu66-XhCi6qs9WdxI/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9tLm1l/ZGlhLWFtYXpvbi5j/b20vaW1hZ2VzL0kv/OTF5UVJoRHlWNUwu/anBn" alt="Sherpa Blanket">
                        </div>
                        <div class="product-info">
                            <h3>Luxury Sherpa Blanket</h3>
                            <p>60x80 inches, reversible design</p>
                            <div class="price">$69.99</div>
                            <button class="add-to-cart" data-id="22" data-name="Luxury Sherpa Blanket" data-price="69.99" data-image="https://images.unsplash.com/photo-1598302936620-9723f534f7a7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Blanket 3 -->
                    <div class="product-card">
                        <div class="product-badge">New</div>
                        <div class="product-img">
                            <img src="https://imgs.search.brave.com/zoMSPZ7BeLYWDpqAP7Uo3DvGzVArbSKOa3BDT2ByKg4/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly91cy5k/cm93c3lzbGVlcGNv/LmNvbS9jZG4vc2hv/cC9maWxlcy9Ecm93/c3ktc2xlZXAtY28t/c2lsay13ZWlnaHRl/ZC1ibGFua2V0LW1p/ZG5pZ2h0LWJsdWUt/c3F1YXJlNV92Mi5q/cGc_dj0xNzI5NzI3/MTEzJndpZHRoPTEw/MjQ" alt="Weighted Blanket">
                        </div>
                        <div class="product-info">
                            <h3>Weighted Blanket</h3>
                            <p>48x72 inches, 15 lbs, calming effect</p>
                            <div class="price">$89.99</div>
                            <button class="add-to-cart" data-id="23" data-name="Weighted Blanket" data-price="89.99" data-image="https://images.unsplash.com/photo-1598302936620-9723f534f7a7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                    
                    <!-- Blanket 4 -->
                    <div class="product-card">
                        <div class="product-img">
                            <img src="https://imgs.search.brave.com/pft5XOAd5qrWhQq840YbcNDRDqMEvtLD0b1aP9KpMSg/rs:fit:860:0:0:0/g:ce/aHR0cHM6Ly9jYWRl/bmxhbmUuY29tL2Nk/bi9zaG9wL2ZpbGVz/L3VuZGVyLWNvbnN0/cnVjdGlvbi0tcGVy/c29uYWxpemVkLWJs/YW5rZXQtMS5qcGc_/dj0xNzE3NDQ0MjI1/JndpZHRoPTEwMDA" alt="Kids Blanket">
                        </div>
                        <div class="product-info">
                            <h3>Kids Personalized Blanket</h3>
                            <p>40x50 inches, fun designs available</p>
                            <div class="price">$49.99</div>
                            <button class="add-to-cart" data-id="24" data-name="Kids Personalized Blanket" data-price="49.99" data-image="https://images.unsplash.com/photo-1598302936620-9723f534f7a7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80">
                                <i class="fas fa-cart-plus"></i> Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    // Cart functionality
    let cart = JSON.parse(localStorage.getItem('cart')) || [];
    const cartCount = document.querySelector('.cart-count');
    const cartIcon = document.getElementById('cart-icon');
    const cartModal = document.getElementById('cart-modal');
    const overlay = document.getElementById('overlay');
    const closeCart = document.getElementById('close-cart');
    const cartItemsContainer = document.getElementById('cart-items');
    const cartTotal = document.getElementById('cart-total');

    // Add to cart functionality
    document.querySelectorAll('.add-to-cart').forEach(button => {
    button.addEventListener('click', function () {
        const id = this.getAttribute('data-id');
        const name = this.getAttribute('data-name');
        const price = parseFloat(this.getAttribute('data-price'));
        const image = this.getAttribute('data-image');

        // Retrieve the cart from localStorage or initialize an empty array
        let cart = JSON.parse(localStorage.getItem('cart')) || [];

        // Check if the item already exists in the cart
        const existingItem = cart.find(item => item.id === id);
        if (existingItem) {
            // If the item exists, increase its quantity
            existingItem.quantity++;
        } else {
            // If the item does not exist, add it to the cart
            cart.push({
                id,
                name,
                price,
                image,
                quantity: 1
            });
        }

        // Save the updated cart back to localStorage
        localStorage.setItem('cart', JSON.stringify(cart));

        // Optionally, show a confirmation message
        alert(`${name} has been added to your cart.`);
    });
});

    // Update cart UI
    function updateCart() {
        // Update cart count
        const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
        cartCount.textContent = totalItems;
        
        // Update cart modal
        cartItemsContainer.innerHTML = '';
        
        let total = 0;
        
        cart.forEach(item => {
            const itemTotal = item.price * item.quantity;
            total += itemTotal;
            
            const cartItemElement = document.createElement('div');
            cartItemElement.className = 'cart-item';
            cartItemElement.innerHTML = `
                <img src="${item.image}" alt="${item.name}" class="cart-item-img">
                <div class="cart-item-details">
                    <h4 class="cart-item-title">${item.name}</h4>
                    <div class="cart-item-price">$${item.price.toFixed(2)} x ${item.quantity}</div>
                    <button class="remove-item" data-id="${item.id}">Remove</button>
                </div>
            `;
            
            cartItemsContainer.appendChild(cartItemElement);
        });
        
        cartTotal.textContent = total.toFixed(2);
        
        // Add event listeners to remove buttons
        document.querySelectorAll('.remove-item').forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                removeFromCart(id);
            });
        });
    }

    // Save cart to localStorage
    function saveCartToLocalStorage() {
        localStorage.setItem('cart', JSON.stringify(cart));
    }

    // Remove item from cart
    function removeFromCart(id) {
        cart = cart.filter(item => item.id !== id);
        updateCart();
        saveCartToLocalStorage();
    }

    // Toggle cart modal
    cartIcon.addEventListener('click', () => {
        updateCart(); // Ensure the cart is updated before showing the modal
        cartModal.classList.add('active');
        overlay.classList.add('active');
    });

    closeCart.addEventListener('click', () => {
        cartModal.classList.remove('active');
        overlay.classList.remove('active');
    });

    overlay.addEventListener('click', () => {
        cartModal.classList.remove('active');
        overlay.classList.remove('active');
    });

    // Initialize cart count on page load
    updateCart();
</script>
</body>
</html>