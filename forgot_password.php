<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password === $confirm_password) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $hashed_password = password_hash($new_password, PASSWORD_DEFAULT);

            $stmt = $conn->prepare("UPDATE users SET password = ? WHERE email = ?");
            $stmt->bind_param("ss", $hashed_password, $username);

            if ($stmt->execute()) {
                $success_message = "Password updated successfully.";
            } else {
                $error_message = "Error: " . $stmt->error;
            }

            $stmt->close();
        } else {
            $error_message = "Invalid email address.";
        }
    } else {
        $error_message = "Passwords do not match.";
    }
    
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
        <Title>Forgot Password Page</title>
        <style>
            body {
                display:flex;
                justify-content: flex-start;
                align-items: flex-start;
                height: 100vh;
                margin: 0;
            }
            .forgot-password-container {
                padding: 20px;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
                width: 100%;
                max-width: 400px;
                margin: auto;
            }
            .forgot-password-container h2 {
                margin-bottom: 20px;
            }
            .forgot-password-container form {
            width: 100%;
            }
            .forgot-password-container label {
                display: block;
                margin-bottom: 10px;
            }
            .forgot-password-container input {
                width: 100%;
                padding: 10px;
                margin-bottom: 10px;
            }
            .forgot-password-container button {
                width: 100%;
                padding: 10px;
            }
        </style>
    </head>
    <body>
        <div class="forgot-password-container">
        <h2>Forgot Password</h2>
        <?php if (isset($error_message)): ?>
            <p class="error" style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <?php if (isset($success_message)): ?>
            <p class="success" style="color: green;"><?php echo $success_message; ?></p>
        <?php endif; ?>
        <form action="forgot_password.php" method="POST">
            <label for="email">
                <input type="text" id="email" name="email" placeholder="Email" required>
            </label>
            <label for="new_password">
                <input type="password" id="new_password" name="new_password" placeholder="New Password" required>
            </label>
            <label for="confirm_password">
                <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
            </label>
            <button type="submit">Update Password</button>
        </form>
        <a href="index.php">Login</a>
        </div>
    </body>
</html>