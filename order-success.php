<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Optional: Clear the session cart if not already cleared
unset($_SESSION['cart']);

// Get order details from the URL
$order_id = $_GET['order_id'] ?? 'N/A';
$order_date = $_GET['order_date'] ?? 'N/A';
$order_amount = $_GET['order_amount'] ?? 'N/A';

error_log("Order ID: $order_id");
error_log("Order Date: $order_date");
error_log("Order Amount: $order_amount");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background: linear-gradient(rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), 
                        url('https://images.unsplash.com/photo-1607082348824-0a96f2a4b9da?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') no-repeat center center/cover;
            background-size: cover;
            margin: 0;
            padding: 0;
            color: #fff;
        }

        .container {
            max-width: 600px;
            margin: 100px auto;
            background: rgba(255, 255, 255, 0.9);
            padding: 30px;
            border-radius: 10px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #28a745;
            margin-bottom: 20px;
        }

        p {
            font-size: 18px;
            color: #333;
        }

        .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #e83e8c;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 600;
            transition: background 0.3s ease;
        }

        .btn:hover {
            background: #d63384;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order Placed Successfully!</h1>
        <p>Thank you for your order. Your payment has been processed successfully.</p>
        <p><strong>Order ID:</strong> <?= htmlspecialchars($order_id) ?></p>
        <p><strong>Date:</strong> <?= htmlspecialchars($order_date) ?></p>
        <p><strong>Amount:</strong> $<?= htmlspecialchars($order_amount) ?></p>
        <p>You can track your order or continue shopping.</p>
        <a href="track_order.php?order_id=<?= urlencode($order_id) ?>" class="btn">Track Order</a>
        <a href="shop_now.php" class="btn">Continue Shopping</a>
    </div>
</body>
</html>