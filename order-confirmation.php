<?php

require_once 'database.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fetch cart data from session or POST request
$cart_data = isset($_POST['cart_data']) ? json_decode($_POST['cart_data'], true) : (isset($_SESSION['cart']) ? $_SESSION['cart'] : []);

// If cart data is empty, redirect back to cart.php
if (empty($cart_data)) {
    header("Location: cart.php");
    exit;
}

// Calculate total
$subtotal = array_reduce($cart_data, function ($sum, $item) {
    return $sum + ($item['price'] * $item['quantity']);
}, 0);
$tax = $subtotal * 0.1; // 10% tax
$total = $subtotal + $tax;

$error_message = null; // Initialize error message
$total = isset($_POST['total_amount']) ? floatval($_POST['total_amount']) : 0;

if ($total <= 0) {
    die("Error: Total amount is missing or invalid.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payment_method'])) {
    $payment_method = $_POST['payment_method'];
    $upi_id = $_POST['upi_id'] ?? null;
    $card_number = $_POST['card_number'] ?? null;

    // Mask card number (store only the last 4 digits)
    $masked_card_number = $card_number ? '**** **** **** ' . substr($card_number, -4) : null;

    // Validate UPI ID if UPI Payment is selected
    if ($payment_method === 'UPI' && (!preg_match('/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+$/', $upi_id))) {
        $error_message = "Invalid UPI ID. Please enter a valid UPI ID.";
    } else {
        try {
            // Save the order to the database
            $user_id = $_SESSION['user_id'];
            $items = json_encode($cart_data); // Serialize the cart data to store in the database

            $stmt = $pdo->prepare("INSERT INTO orders (user_id, items, total, status) VALUES (?, ?, ?, 'Pending')");
            if ($stmt->execute([$user_id, $items, $total])) {
                $order_id = $pdo->lastInsertId(); // Retrieve the ID of the newly created order

                // Save payment details
                $payment_details = $payment_method === 'UPI' ? $upi_id : $masked_card_number;
                $stmt = $pdo->prepare("INSERT INTO payments (order_id, user_id, payment_method, payment_details, amount, status) VALUES (?, ?, ?, ?, ?, 'Success')");
                $stmt->execute([$order_id, $user_id, $payment_method, $payment_details, $total]);

                // Save order items
                foreach ($cart_data as $item) {
                    $stmt = $pdo->prepare("INSERT INTO order_items (order_id, product_id, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)");
                    $stmt->execute([
                        $order_id,
                        $item['id'],
                        $item['name'],
                        $item['quantity'],
                        $item['price'],
                    ]);
                }

                // Clear the cart
                unset($_SESSION['cart']);

// Redirect to success page with order details
$order_date = date('Y-m-d H:i:s'); // Current date and time
header("Location: order-success.php?order_id=$order_id&order_date=$order_date&order_amount=$total&clear_cart=true");
            } else {
                throw new Exception("Failed to insert order into the database.");
            }
        } catch (PDOException $e) {
            // Log the error for debugging
            error_log("Database Error: " . $e->getMessage());

            // Display a user-friendly error message
            die("Failed to place the order. Please try again later.");
        } catch (Exception $e) {
            // Log the error for debugging
            error_log("General Error: " . $e->getMessage());

            // Display a user-friendly error message
            die("An unexpected error occurred. Please try again later.");
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Place Order | Wow Gifts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #e83e8c;
            --secondary: #ff69b4;
            --dark: #2d3436;
            --light: #f7f7f7;
            --white: #ffffff;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
            --border-radius: 10px;
            --border-radius-sm: 6px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') no-repeat center center/cover;
            font-family: 'Montserrat', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            line-height: 1.6;
            min-height: 100vh;
            padding: 20px;
        }

        .container {
            width: 100%;
            max-width: 600px;
            margin: 30px auto;
            background: var(--white);
            padding: 40px;
            border-radius: var(--border-radius);
            box-shadow: var(--shadow);
            position: relative;
            overflow: hidden;
        }

        .container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 5px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        h1 {
            text-align: center;
            font-size: 2.2rem;
            color: var(--primary);
            margin-bottom: 30px;
            font-weight: 700;
            position: relative;
            padding-bottom: 15px;
        }

        h1::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--primary), var(--secondary));
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
            color: var(--dark);
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 12px;
            border: 2px solid #e0e0e0;
            border-radius: var(--border-radius-sm);
            font-family: 'Montserrat', sans-serif;
            transition: var(--transition);
        }

        .form-group input:focus, .form-group select:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(232, 62, 140, 0.2);
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 15px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--border-radius-sm);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-size: 1.1rem;
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 4px 15px rgba(232, 62, 140, 0.4);
        }

        .submit-btn:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 105, 180, 0.6);
        }

        .submit-btn:active {
            transform: translateY(0);
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Place Your Order</h1>
        <?php if ($error_message): ?>
            <p style="color: red; text-align: center;"><?php echo $error_message; ?></p>
        <?php endif; ?>

        <form method="POST" action="order-confirmation.php">
    <input type="hidden" name="cart_data" value='<?php echo json_encode($cart_data); ?>'>
    <input type="hidden" name="total_amount" value="<?php echo $total; ?>"> <!-- Add this line -->
    <div class="form-group">
        <label for="payment-method">Payment Method</label>
        <select name="payment_method" id="payment-method" required>
            <option value="">Select Payment Method</option>
            <option value="card">Credit Card</option>
            <option value="UPI">UPI Payment</option>
        </select>
    </div>

    <div class="form-group" id="card-details" style="display: none;">
        <label for="card-number">Card Number</label>
        <input type="text" name="card_number" id="card-number" placeholder="1234 5678 9012 3456">
    </div>

    <div class="form-group" id="upi-details" style="display: none;">
        <label for="upi-id">UPI ID</label>
        <input type="text" name="upi_id" id="upi-id" placeholder="yourname@upi">
    </div>

    <button type="submit" class="submit-btn">Place Order</button>
</form>
        </div>

        <!--<form method="POST" action="order-confirmation.php">
            <input type="hidden" name="cart_data" value='<?php echo json_encode($cart_data); ?>'>
            <div class="form-group">
                <label for="payment-method">Payment Method</label>
                <select name="payment_method" id="payment-method" required>
                    <option value="">Select Payment Method</option>
                    <option value="card">Credit Card</option>
                    <option value="UPI">UPI Payment</option>
                </select>
            </div>

            <div class="form-group" id="card-details" style="display: none;">
                <label for="card-number">Card Number</label>
                <input type="text" name="card_number" id="card-number" placeholder="1234 5678 9012 3456">
            </div>

            <div class="form-group" id="upi-details" style="display: none;">
                <label for="upi-id">UPI ID</label>
                <input type="text" name="upi_id" id="upi-id" placeholder="yourname@upi">
            </div>

            <button type="submit" class="submit-btn">Place Order</button>
        </form>
    </div>-->

    <script>
        const paymentMethod = document.getElementById('payment-method');
        const cardDetails = document.getElementById('card-details');
        const upiDetails = document.getElementById('upi-details');

        paymentMethod.addEventListener('change', () => {
            if (paymentMethod.value === 'card') {
                cardDetails.style.display = 'block';
                upiDetails.style.display = 'none';
            } else if (paymentMethod.value === 'UPI') {
                upiDetails.style.display = 'block';
                cardDetails.style.display = 'none';
            } else {
                cardDetails.style.display = 'none';
                upiDetails.style.display = 'none';
            }
        });
    </script>
</body>
</html>