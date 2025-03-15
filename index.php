<?php

// Enable error reporting
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Start session caching
session_start();

//require database script
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get POST data
    $identifier = $_POST['identifier'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $identifier, $identifier);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        if (password_verify($password, $hashed_password)) {
            $_SESSION['username'] = $identifier;
            if ($identifier === 'admin' || $identifier === 'Admin') {
                header("Location: admin.php");
            } else {
                header("Location: home.php");
            }
            exit();
        } else {
            $error_message = "Invalid username/email or password.";
        }
    } else {
        $error_message = "Invalid username/email or password.";
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="color-scheme" content="light dark">
        <link rel="icon" type="image/x-icon" href="/img/icon.png">
        <link rel="stylesheet" href="/css/pico.classless.red.min.css" />
        <link rel="stylesheet" href="/css/pico.colors.min.css">
        <title>Login Page</title>
        <style>
            body {
                display: flex;
                justify-content: flex-start;
                align-items: flex-start;
                height: 100vh;
                margin: 0;
            }
            .login-container {
                padding: 20px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                width: 100%;
                max-width: 400px;
                margin: auto;
            }
            .login-container h2 {
                margin-bottom: 20px;
            }
            .login-container form {
                width: 100%;
            }
            .login-container label {
                display: block;
                margin-bottom: 10px;
            }
            .login-container input {
                width: 100%;
                padding: 10px;
                margin-bottom: 10px;
            }
            .login-container button {
                width: 100%;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <div class="login-container">
            <h2>Login</h2>
            <?php if (isset($error_message)): ?>
                <p class="error" style="color: red;"><?php echo $error_message; ?></p>
            <?php endif; ?>
            <form action="index.php" method="POST">
                <label for="identifier">
                    <input 
                    type="text" 
                    id="identifier" 
                    name="identifier"
                    placeholder="Username or Email" 
                    <?php if (isset($error_message)) echo 'class="invalid" aria-invalid="true"'; ?>
                    required>
                </label>
                <label for="password">
                    <input type="password"
                    id="password" 
                    name="password" 
                    placeholder="Password"
                    <?php if (isset($error_message)) echo 'class="invalid" aria-invalid="true"'; ?> 
                    required>
                </label>
                <button type="submit">Login</button>
                <a href="register.php">Sign Up</a><br>
                <a href="forgot_password.php">Forgot Password</a>
            </form>
        </div>
    </body>
</html>