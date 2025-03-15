<?php
// filepath: /test/php/register.php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $password);

        if ($stmt->execute()) {
            header("Location: index.php");
            exit();
        } else {
            $error_message = "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        $error_message = "Invalid email address.";
    }
    
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="color-scheme" content="light dark">
    <link rel="icon" type="image/x-icon" href="/img/icon.png">
    <link rel="stylesheet" href="/css/pico.classless.red.min.css" />
    <link rel="stylesheet" href="/css/pico.colors.min.css">
    <title>Register Page</title>
    <style>
        body {
            display: flex;
            justify-content: flex-start;
            align-items: flex-start;
            height: 100vh;
            margin: 0;
        }
        .register-container {
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            width: 100%;
            max-width: 400px;
            margin: auto;
        }
        .register-container h2 {
            margin-bottom: 20px;
        }
        .register-container form {
            width: 100%;
        }
        .register-container label {
            display: block;
            margin-bottom: 10px;
        }
        .register-container input {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
        }
        .register-container button {
            width: 100%;
            padding: 10px;
        }
    </style>
</head>
<body>
    <div class="register-container">
        <h2>Register</h2>
        <?php if (isset($error_message)): ?>
            <p class="error" style="color: red;"><?php echo $error_message; ?></p>
        <?php endif; ?>
        <form action="register.php" method="POST">
            <label for="username">
                <input type="text" id="username" name="username" placeholder="Username" required>
            </label>
            <label for="email">
                <input type="email" id="email" name="email" placeholder="Email" required>
            </label>
            <label for="password">
                <input type="password" id="password" name="password" placeholder="Password" required>
            </label>
            <button type="submit">Register</button>
        </form>
        <a href="index.php">Login</a>
    </div>
</body>
</html>