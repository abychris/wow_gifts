<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart | Wow Gifts</title>
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
        }

        .back-to-shop {
            color: var(--primary);
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
        }

        .back-to-shop:hover {
            color: var(--secondary);
        }

        /* Cart Page */
        .cart-page {
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

        .cart-container {
            background: var(--white);
            border-radius: 10px;
            padding: 30px;
            box-shadow: var(--shadow);
        }

        .cart-header {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
            font-weight: 600;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 2fr 1fr 1fr 1fr;
            align-items: center;
            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .cart-product {
            display: flex;
            align-items: center;
        }

        .cart-product img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 20px;
        }

        .cart-product-info h3 {
            margin-bottom: 5px;
        }

        .cart-product-info p {
            color: #777;
            font-size: 0.9rem;
        }

        .cart-price {
            font-weight: 600;
        }

        .cart-quantity {
            display: flex;
            align-items: center;
        }

        .quantity-btn {
            background: none;
            border: 1px solid #ddd;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            transition: var(--transition);
        }

        .quantity-btn:hover {
            background: #f1f1f1;
        }

        .quantity-input {
            width: 50px;
            text-align: center;
            margin: 0 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 5px;
        }

        .remove-item {
            background: none;
            border: none;
            color: var(--primary);
            cursor: pointer;
            font-size: 0.9rem;
            transition: var(--transition);
        }

        .remove-item:hover {
            color: var(--secondary);
        }

        .cart-total {
            display: flex;
            justify-content: flex-end;
            margin-top: 30px;
        }

        .total-container {
            width: 300px;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
        }

        .total-row:last-child {
            border-top: 1px solid #eee;
            margin-top: 10px;
            font-weight: 600;
            font-size: 1.1rem;
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
            margin-top: 20px;
            font-size: 1rem;
        }

        .checkout-btn:hover {
            background: var(--secondary);
            transform: translateY(-2px);
        }

        .empty-cart {
            text-align: center;
            padding: 50px 0;
        }

        .empty-cart i {
            font-size: 3rem;
            color: #ddd;
            margin-bottom: 20px;
        }

        .empty-cart h3 {
            margin-bottom: 15px;
        }

        .empty-cart p {
            color: #777;
            margin-bottom: 20px;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .cart-header {
                display: none;
            }

            .cart-item {
                grid-template-columns: 1fr;
                gap: 15px;
                position: relative;
                padding: 30px 0;
            }

            .cart-product {
                margin-bottom: 15px;
            }

            .cart-price, .cart-quantity, .cart-total-col {
                display: flex;
                justify-content: space-between;
            }

            .cart-price::before {
                content: "Price: ";
                font-weight: 600;
            }

            .cart-total-col::before {
                content: "Total: ";
                font-weight: 600;
            }

            .remove-item {
                position: absolute;
                top: 10px;
                right: 0;
            }

            .total-container {
                width: 100%;
            }
        }

        @media (max-width: 480px) {
            .section-title h1 {
                font-size: 2rem;
            }
        }
    </style>
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container header-container">
            <a href="index.php" class="logo">
                <i class="fas fa-gift"></i>
                <span>Wow Gifts</span>
            </a>
            
            <a href="index.php" class="back-to-shop">
                <i class="fas fa-arrow-left"></i> Back to Shop
            </a>
        </div>
    </header>

    <!-- Cart Page -->
    <section class="cart-page">
        <div class="container">
            <div class="section-title">
                <h1>Your Shopping Cart</h1>
                <p>Review your items before checkout</p>
            </div>
            
            <div class="cart-container">
                <div id="cart-items-container">
                    <!-- Cart items will be loaded here -->
                    <div class="empty-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <h3>Your cart is empty</h3>
                        <p>Looks like you haven't added any items to your cart yet</p>
                        <a href="shop_now.php" class="checkout-btn">Continue Shopping</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    // Cart functionality
    document.addEventListener('DOMContentLoaded', () => {
        const urlParams = new URLSearchParams(window.location.search);
    if (urlParams.get('clear_cart') === 'true') {
        // Clear the cart in localStorage
        localStorage.removeItem('cart');
        console.log("Cart cleared after order placement."); // Debugging

        // Remove the flag from the URL to prevent repeated clearing
        const newUrl = window.location.href.split('?')[0];
        window.history.replaceState({}, document.title, newUrl);

        // Re-render the cart
        renderCart();
    }
        // Load cart from localStorage or initialize an empty array
        let cart = JSON.parse(localStorage.getItem('cart')) || [];
        console.log("Cart data from localStorage:", cart); // Debugging: Check the cart data

        const cartItemsContainer = document.getElementById('cart-items-container');

        // Render cart items
        function renderCart() {
            console.log("Rendering cart..."); // Debugging
            if (cart.length === 0) {
                cartItemsContainer.innerHTML = `
                    <div class="empty-cart">
                        <i class="fas fa-shopping-cart"></i>
                        <h3>Your cart is empty</h3>
                        <p>Looks like you haven't added any items to your cart yet</p>
                        <a href="shop_now.php" class="checkout-btn">Continue Shopping</a>
                    </div>
                `;
                return;
            }

            let cartHTML = `
                <div class="cart-header">
                    <div>Product</div>
                    <div>Price</div>
                    <div>Quantity</div>
                    <div>Total</div>
                </div>
            `;

            let subtotal = 0;

            cart.forEach(item => {
                const itemTotal = item.price * item.quantity;
                subtotal += itemTotal;

                cartHTML += `
                    <div class="cart-item" data-id="${item.id}">
                        <div class="cart-product">
                            <img src="${item.image}" alt="${item.name}">
                            <div class="cart-product-info">
                                <h3>${item.name}</h3>
                                <p>${item.description || 'Personalized gift item'}</p>
                            </div>
                        </div>
                        <div class="cart-price">$${item.price.toFixed(2)}</div>
                        <div class="cart-quantity">
                            <button class="quantity-btn minus-btn" data-id="${item.id}">-</button>
                            <input type="number" class="quantity-input" value="${item.quantity}" min="1" data-id="${item.id}">
                            <button class="quantity-btn plus-btn" data-id="${item.id}">+</button>
                        </div>
                        <div class="cart-total-col">$${itemTotal.toFixed(2)}</div>
                        <button class="remove-item" data-id="${item.id}">
                            <i class="fas fa-trash"></i> Remove
                        </button>
                    </div>
                `;
            });

            const tax = subtotal * 0.1; // 10% tax
            const total = subtotal + tax;

            cartHTML += `
                <div class="cart-total">
                    <div class="total-container">
                        <div class="total-row">
                            <span>Subtotal:</span>
                            <span>$${subtotal.toFixed(2)}</span>
                        </div>
                        <div class="total-row">
                            <span>Tax (10%):</span>
                            <span>$${tax.toFixed(2)}</span>
                        </div>
                        <div class="total-row">
                            <span>Total:</span>
                            <span>$${total.toFixed(2)}</span>
                        </div>
                        <form id="cart-form" method="POST" action="order-confirmation.php">
                            <input type="hidden" name="cart_data" id="cart-data">
                            <button type="button" class="checkout-btn" id="place-order-btn">
                                <i class="fas fa-shopping-bag"></i> Place Order
                            </button>
                        </form>
                    </div>
                </div>
            `;

            cartItemsContainer.innerHTML = cartHTML;

            // Add event listeners
            document.querySelectorAll('.minus-btn').forEach(btn => {
                btn.addEventListener('click', decreaseQuantity);
            });

            document.querySelectorAll('.plus-btn').forEach(btn => {
                btn.addEventListener('click', increaseQuantity);
            });

            document.querySelectorAll('.quantity-input').forEach(input => {
                input.addEventListener('change', updateQuantity);
            });

            document.querySelectorAll('.remove-item').forEach(btn => {
                btn.addEventListener('click', removeItem);
            });

            document.getElementById('place-order-btn')?.addEventListener('click', placeOrder);
        }

        // Quantity functions
        function decreaseQuantity(e) {
            const id = e.target.getAttribute('data-id');
            const item = cart.find(item => item.id === id);
            if (item.quantity > 1) {
                item.quantity--;
                updateCart();
            }
        }

        function increaseQuantity(e) {
            const id = e.target.getAttribute('data-id');
            const item = cart.find(item => item.id === id);
            item.quantity++;
            updateCart();
        }

        function updateQuantity(e) {
            const id = e.target.getAttribute('data-id');
            const item = cart.find(item => item.id === id);
            const newQuantity = parseInt(e.target.value);
            if (newQuantity >= 1) {
                item.quantity = newQuantity;
                updateCart();
            } else {
                e.target.value = item.quantity;
            }
        }

        // Remove item
        function removeItem(e) {
            const id = e.target.getAttribute('data-id');
            cart = cart.filter(item => item.id !== id);
            updateCart();
        }

        // Update cart in localStorage and re-render
        function updateCart() {
            localStorage.setItem('cart', JSON.stringify(cart));
            renderCart();
        }

        function placeOrder() {
            console.log("Place Order button clicked!"); // Debugging

    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    // Calculate subtotal and tax
    const subtotal = cart.reduce((sum, item) => sum + item.price * item.quantity, 0);
    const tax = subtotal * 0.1; // 10% tax
    const total = subtotal + tax;

    console.log("Subtotal:", subtotal); // Debugging
    console.log("Tax:", tax);           // Debugging
    console.log("Total:", total);       // Debugging

    // Add cart data to the hidden input
    const cartInput = document.getElementById('cart-data');
    cartInput.value = JSON.stringify(cart); // Convert cart array to JSON string

    // Add total amount to a new hidden input
    const totalInput = document.createElement('input');
    totalInput.type = 'hidden';
    totalInput.name = 'total_amount';
    totalInput.value = total.toFixed(2); // Add total amount (including tax)
    document.getElementById('cart-form').appendChild(totalInput);

    console.log("Hidden input for total_amount added:", totalInput); // Debugging

    //Submit the form
    const cartForm = document.getElementById('cart-form');
    cartForm.submit();
}
localStorage.removeItem('cart');
        // Initialize the cart view
        renderCart();
    });
</script>
</body>
</html>