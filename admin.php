<?php
session_start();
if (!isset($_SESSION['is_admin']) || $_SESSION['is_admin'] !== true) {
    die("Access denied. Only admins can access this page.");
}
require_once 'database.php';

// Fetch users
$stmt = $pdo->query("SELECT id, username, email FROM users WHERE is_admin = 0");
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch orders
$orders_stmt = $pdo->query("SELECT * FROM orders ORDER BY created_at DESC");
$orders = $orders_stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch payments
$payments_stmt = $pdo->query("SELECT * FROM payments ORDER BY created_at DESC");
$payments = $payments_stmt->fetchAll(PDO::FETCH_ASSOC);

// Handle user deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user'])) {
    $userId = intval($_POST['user_id']);
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = ?");
    if ($stmt->execute([$userId])) {
        echo "<script>alert('User deleted successfully.'); window.location.href = 'admin.php?section=users';</script>";
    } else {
        echo "<script>alert('Error deleting user.');</script>";
    }
}

// Handle order deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_order'])) {
    $orderId = intval($_POST['order_id']);
    $stmt = $pdo->prepare("DELETE FROM orders WHERE order_id = ?");
    if ($stmt->execute([$orderId])) {
        echo "<script>alert('Order deleted successfully.'); window.location.href = 'admin.php?section=orders';</script>";
    } else {
        echo "<script>alert('Error deleting order.');</script>";
    }
}

// Handle payment deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_payment'])) {
    $paymentId = intval($_POST['payment_id']);
    $stmt = $pdo->prepare("DELETE FROM payments WHERE payment_id = ?");
    if ($stmt->execute([$paymentId])) {
        echo "<script>alert('Payment deleted successfully.'); window.location.href = 'admin.php?section=payments';</script>";
    } else {
        echo "<script>alert('Error deleting payment.');</script>";
    }
}

// Determine which section to display
$section = isset($_GET['section']) ? $_GET['section'] : 'users';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Wow Gifts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4CAF50;
            --secondary: rgb(208, 255, 201);
            --danger: #e83e8c;
            --danger-hover: #d63384;
            --dark: #2d3436;
            --light: #f7f7f7;
            --white: #ffffff;
            --shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            --transition: all 0.3s ease;
        }

        body {
            font-family: 'Montserrat', sans-serif;
            background-color: var(--light);
            color: var(--dark);
            margin: 0;
            display: flex;
        }

        .sidebar {
            width: 250px;
            background-color: var(--primary);
            color: var(--white);
            height: 100vh;
            padding: 20px;
            box-shadow: var(--shadow);
        }

        .sidebar h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar ul {
            list-style: none;
            padding: 0;
        }

        .sidebar ul li {
            margin-bottom: 15px;
        }

        .sidebar ul li a {
            color: var(--white);
            text-decoration: none;
            font-size: 1.1rem;
            display: block;
            padding: 10px;
            border-radius: 5px;
            transition: var(--transition);
        }

        .sidebar ul li a:hover {
            background-color: var(--secondary);
            color: var(--dark);
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        h1 {
            text-align: center;
            color: var(--primary);
            margin-bottom: 20px;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
            box-shadow: var(--shadow);
            border-radius: 10px;
            background: var(--white);
            padding: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        table th, table td {
            padding: 15px;
            text-align: left;
        }

        table th {
            background-color: var(--primary);
            color: var(--white);
            font-weight: bold;
        }

        table tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        table tr:hover {
            background-color: var(--secondary);
        }

        button {
            padding: 8px 15px;
            background-color: var(--danger);
            color: var(--white);
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: var(--transition);
        }

        button:hover {
            background-color: var(--danger-hover);
        }

        @media (max-width: 768px) {
            table th, table td {
                font-size: 0.9rem;
                padding: 10px;
            }

            button {
                font-size: 0.8rem;
                padding: 5px 10px;
            }
        }
    </style>
</head>
<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="admin.php?section=users">Users</a></li>
            <li><a href="admin.php?section=orders">Orders</a></li>
            <li><a href="admin.php?section=payments">Payments</a></li>
        </ul>
    </div>

    <!-- Content -->
    <div class="content">
        <h1>Admin Dashboard</h1>

        <?php if ($section === 'users'): ?>
            <!-- Users Section -->
            <section id="users">
                <h2>Manage Users</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($users as $user): ?>
                                <tr>
                                    <td><?= htmlspecialchars($user['id']) ?></td>
                                    <td><?= htmlspecialchars($user['username']) ?></td>
                                    <td><?= htmlspecialchars($user['email']) ?></td>
                                    <td>
                                        <form action="admin.php?section=users" method="POST" style="display: inline;">
                                            <input type="hidden" name="user_id" value="<?= $user['id'] ?>">
                                            <button type="submit" name="delete_user">
                                                <i class="fas fa-trash"></i> Delete
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        <?php elseif ($section === 'orders'): ?>
            <!-- Orders Section -->
            <section id="orders">
                <h2>Manage Orders</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Order ID</th>
                                <th>User ID</th>
                                <th>Items</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order): ?>
                                <tr>
                                    <td><?= htmlspecialchars((string) ($order['order_id'] ?? 'N/A')) ?></td>
                                    <td><?= htmlspecialchars((string) ($order['user_id'] ?? 'N/A')) ?></td>
                                    <td>
                                        <?php
                                        $items = json_decode($order['items'], true);
                                        if (is_array($items)) {
                                            foreach ($items as $item) {
                                                echo htmlspecialchars((string) ($item['name'] ?? 'Unknown')) . " (x" . htmlspecialchars((string) ($item['quantity'] ?? '0')) . ")<br>";
                                            }
                                        } else {
                                            echo 'N/A';
                                        }
                                        ?>
                                    </td>
                                    <td>$<?= number_format((float) ($order['total'] ?? 0), 2) ?></td>
                                    <td><?= htmlspecialchars((string) ($order['status'] ?? 'N/A')) ?></td>
                                    <td><?= htmlspecialchars((string) ($order['created_at'] ?? 'N/A')) ?></td>
                                    <td>
                                        <form action="admin.php?section=orders" method="POST" style="display: inline;">
                                            <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                            <button type="submit" name="delete_order">
                                                <i class="fas fa-trash"></i> Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        <?php elseif ($section === 'payments'): ?>
            <!-- Payments Section -->
            <section id="payments">
                <h2>Manage Payments</h2>
                <div class="table-container">
                    <table>
                        <thead>
                            <tr>
                                <th>Payment ID</th>
                                <th>Order ID</th>
                                <th>User ID</th>
                                <th>Payment Method</th>
                                <th>Payment Details</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($payments as $payment): ?>
                                <tr>
                                    <td><?= htmlspecialchars((string) ($payment['payment_id'] ?? 'N/A')) ?></td>
                                    <td><?= htmlspecialchars((string) ($payment['order_id'] ?? 'N/A')) ?></td>
                                    <td><?= htmlspecialchars((string) ($payment['user_id'] ?? 'N/A')) ?></td>
                                    <td><?= htmlspecialchars((string) ($payment['payment_method'] ?? 'N/A')) ?></td>
                                    <td><?= htmlspecialchars((string) ($payment['payment_details'] ?? 'N/A')) ?></td>
                                    <td>$<?= number_format((float) ($payment['amount'] ?? 0), 2) ?></td>
                                    <td><?= htmlspecialchars((string) ($payment['status'] ?? 'N/A')) ?></td>
                                    <td><?= htmlspecialchars((string) ($payment['created_at'] ?? 'N/A')) ?></td>
                                    <td>
                                        <form action="admin.php?section=payments" method="POST" style="display: inline;">
                                            <input type="hidden" name="payment_id" value="<?= $payment['payment_id'] ?>">
                                            <button type="submit" name="delete_payment">
                                                <i class="fas fa-trash"></i> Remove
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </section>
        <?php endif; ?>
    </div>
</body>
</html>