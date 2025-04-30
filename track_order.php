<?php
require_once 'database.php';

session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Get the order_id from the URL
$order_id = $_GET['order_id'] ?? null;

if (!$order_id) {
    die("Invalid order ID.");
}

// Fetch order details from the database
$stmt = $pdo->prepare("SELECT * FROM orders WHERE order_id = ? AND user_id = ?");
$stmt->execute([$order_id, $_SESSION['user_id']]);
$order = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$order) {
    die("Order not found or you do not have permission to view this order.");
}

// Fetch order items
$stmt = $pdo->prepare("SELECT * FROM order_items WHERE order_id = ?");
$stmt->execute([$order_id]);
$order_items = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Track Your Order | Wow Gifts</title>
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
            max-width: 800px;
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

        .order-info {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 30px;
            margin-bottom: 40px;
        }

        .order-info-card {
            background: var(--light);
            padding: 20px;
            border-radius: var(--border-radius-sm);
            box-shadow: var(--shadow);
        }

        .order-info-title {
            font-size: 1.1rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--primary);
            display: flex;
            align-items: center;
        }

        .order-info-title i {
            margin-right: 10px;
        }

        .order-info-detail {
            margin-bottom: 10px;
        }

        .order-info-detail strong {
            display: inline-block;
            min-width: 120px;
            color: var(--dark);
        }

        .tracking-container {
            margin-top: 40px;
        }

        .tracking-title {
            font-size: 1.5rem;
            margin-bottom: 20px;
            color: var(--primary);
            text-align: center;
        }

        .tracking-steps {
            position: relative;
            padding: 20px 0;
        }

        .tracking-line {
            position: absolute;
            top: 0;
            left: 50px;
            height: 100%;
            width: 4px;
            background: #e0e0e0;
            transform: translateX(-50%);
            z-index: 1;
        }

        .tracking-line-progress {
            position: absolute;
            top: 0;
            left: 50px;
            height: 60%;
            width: 4px;
            background: var(--primary);
            transform: translateX(-50%);
            z-index: 2;
            transition: var(--transition);
        }

        .tracking-step {
            display: flex;
            margin-bottom: 30px;
            position: relative;
            z-index: 3;
        }

        .tracking-step:last-child {
            margin-bottom: 0;
        }

        .tracking-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--white);
            border: 3px solid #e0e0e0;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 20px;
            flex-shrink: 0;
            transition: var(--transition);
        }

        .tracking-step.active .tracking-icon {
            border-color: var(--primary);
            background: var(--primary);
            color: var(--white);
        }

        .tracking-step.completed .tracking-icon {
            border-color: var(--primary);
            background: var(--primary);
            color: var(--white);
        }

        .tracking-content {
            flex-grow: 1;
            padding-top: 5px;
        }

        .tracking-step-title {
            font-weight: 600;
            margin-bottom: 5px;
            color: var(--dark);
        }

        .tracking-step.completed .tracking-step-title,
        .tracking-step.active .tracking-step-title {
            color: var(--primary);
        }

        .tracking-step-date {
            font-size: 0.9rem;
            color: #666;
        }

        .tracking-step.completed .tracking-step-date,
        .tracking-step.active .tracking-step-date {
            color: var(--dark);
        }

        .btn-container {
            display: flex;
            justify-content: center;
            margin-top: 40px;
        }

        .btn {
            padding: 12px 30px;
            background: var(--primary);
            color: white;
            border: none;
            border-radius: var(--border-radius-sm);
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-size: 1rem;
            text-decoration: none;
            display: inline-block;
            text-align: center;
        }

        .btn:hover {
            background: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(255, 105, 180, 0.6);
        }

        .btn:active {
            transform: translateY(0);
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .order-info {
                grid-template-columns: 1fr;
            }
            
            .tracking-steps {
                padding-left: 20px;
            }
            
            .tracking-line,
            .tracking-line-progress {
                left: 30px;
            }
        }

        @media (max-width: 576px) {
            .container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Track Your Order</h1>
        
        <div class="order-info">
            <div class="order-info-card">
                <div class="order-info-title">
                    <i class="fas fa-info-circle"></i>
                    <span>Order Information</span>
                </div>
                <div class="order-info-detail">
                    <strong>Order ID:</strong> <?= htmlspecialchars($order['order_id']) ?>
                </div>
                <div class="order-info-detail">
                    <strong>Date:</strong> <?= htmlspecialchars($order['created_at']) ?>
                </div>
                <div class="order-info-detail">
                    <strong>Amount:</strong> ₹<?= htmlspecialchars($order['total']) ?>
                </div>
            </div>
            
            <div class="order-info-card">
                <div class="order-info-title">
                    <i class="fas fa-truck"></i>
                    <span>Delivery Information</span>
                </div>
                <div class="order-info-detail">
                    <strong>Status:</strong> <?= htmlspecialchars($order['status'] ?? 'Pending') ?>
                </div>
                <div class="order-info-detail">
                    <strong>Carrier:</strong> WoW Express
                </div>
                <div class="order-info-detail">
                    <strong>Estimated Delivery:</strong>
                    <?php
                    // Calculate estimated delivery dynamically (e.g., 5 days from order date)
                    $order_date = $order['created_at'] ?? null;
                    if ($order_date) {
                        $estimated_delivery = date('Y-m-d', strtotime($order_date . ' + 5 days'));
                        echo htmlspecialchars($estimated_delivery);
                    } else {
                        echo 'Not available';
                    }
                    ?>
                </div>
            </div>
        </div>
        
        <div class="tracking-container">
            <h2 class="tracking-title">Order Items</h2>
            <table>
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($order_items as $item): ?>
                        <tr>
                            <td><?= htmlspecialchars($item['product_name']) ?></td>
                            <td><?= htmlspecialchars($item['quantity']) ?></td>
                            <td>₹<?= htmlspecialchars($item['price']) ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        
        <div class="btn-container">
            <a href="shop_now.php" class="btn">
                <i class="fas fa-arrow-left" style="margin-right: 8px;"></i>
                Back to Shop
            </a>
        </div>
    </div>
</body>
</html>