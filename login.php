<?php
require_once 'database.php';

// Handle Signup
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['signup'])) {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $userExists = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($userExists) {
        echo "<script>alert('User already exists. Please log in.');</script>";
    } else {
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        if ($stmt->execute([$name, $email, $password])) {
            echo "<script>alert('Sign-Up successful! Please log in.');</script>";
        } else {
            echo "<script>alert('Error: Could not sign up. Please try again.');</script>";
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Start a session and store user information
        session_start();
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
    
        // Redirect to index.php
        header("Location: index.php");
        exit;
    } else {
        echo "<script>alert('Invalid email or password. Please try again.');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login & Signup | Wow Gifts</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(45deg, rgba(232, 62, 140, 0.1), rgba(255, 255, 255, 0.9)),
                        url('https://images.unsplash.com/photo-1513151233558-d860c5398176?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80') no-repeat center center/cover;
        }
        .form-container {
            background: rgba(255, 255, 255, 0.95);
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(232, 62, 140, 0.15);
            width: 100%;
            max-width: 440px;
        }
        .form-container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .form-container form {
            display: flex;
            flex-direction: column;
        }
        .form-container input {
            margin-bottom: 15px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .form-container button {
            padding: 10px;
            background: #e83e8c;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .form-container .switch-button {
            margin-top: 10px;
            text-align: center;
        }
        .form-container .switch-button a {
            text-decoration: none;
            color: #e83e8c;
            font-weight: bold;
        }
        .form-container .switch-button a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2 id="form-title">Login</h2>
        <form action="login.php" method="POST" id="auth-form">
            <div id="name-group" style="display: none;">
                <input type="text" name="name" placeholder="Name">
            </div>
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit" name="login" id="auth-btn">Login</button>
        </form>
        <div class="switch-button">
            <p>Don't have an account? <a href="#" id="toggle-auth">Sign Up</a></p>
        </div>
        <div class="switch-button">
            <p>Not a User? <a href="admin_login.php">Switch to Admin Login</a></p>
        </div>
        
        
    </div>

    <script>
    const formTitle = document.getElementById('form-title');
    const nameGroup = document.getElementById('name-group');
    const authBtn = document.getElementById('auth-btn');
    const toggleAuth = document.getElementById('toggle-auth');
    const authForm = document.getElementById('auth-form');

    let isLogin = true;

    toggleAuth.addEventListener('click', (e) => {
        e.preventDefault();
        isLogin = !isLogin;

        if (isLogin) {
            formTitle.textContent = 'Login';
            nameGroup.style.display = 'none';
            authBtn.textContent = 'Login';
            authBtn.setAttribute('name', 'login');
            toggleAuth.textContent = "Sign Up"; // Update link text
            toggleAuth.parentElement.firstChild.textContent = "Don't have an account? "; // Update surrounding text
        } else {
            formTitle.textContent = 'Sign Up';
            nameGroup.style.display = 'block';
            authBtn.textContent = 'Sign Up';
            authBtn.setAttribute('name', 'signup');
            toggleAuth.textContent = "Login"; // Update link text
            toggleAuth.parentElement.firstChild.textContent = "Have an account? "; // Update surrounding text
        }
    });
</script>
</body>
</html>