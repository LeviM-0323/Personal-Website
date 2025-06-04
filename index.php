<?php

session_start();

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
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
        <div id="guest-message" style="
            background: #d93526;
            color: #333;
            padding: 1rem 2.5rem 1rem 1rem;
            text-align: center;
            font-weight: 500;
            border-radius: 0.5rem;
            margin-bottom: 1.5rem;
            box-shadow: 0 2px 8px #0001;
            position: fixed;
            top: 0;
            left: 50%;
            transform: translate(-50%, -120%);
            max-width: 500px;
            z-index: 1000;
            transition: transform 0.7s cubic-bezier(.68,-0.55,.27,1.55);
            border: 1px #000000;">
            <span style="display:inline-block;vertical-align:middle;">
                👋 New here? You can log in with <b>Username: Guest</b> and <b>Password: guest</b> if you do not wish to register.
            </span>
            <div id="guest-progress" style="height: 4px; background: #000000; position: absolute; left: 0; bottom: 0; width: 100%; border-radius: 0 0 0.5rem 0.5rem; transition: width 0.2s;"></div>
        </div>
        <script>
            let guestMsg = document.getElementById('guest-message');
            let guestBar = document.getElementById('guest-progress');
            setTimeout(() => {
                guestMsg.style.transform = "translate(-50%, 30px)";
            }, 100);
            let duration = 7000, interval = 20, elapsed = 0;
            let timer = setInterval(() => {
                elapsed += interval;
                let percent = Math.max(0, 100 - (elapsed / duration) * 100);
                guestBar.style.width = percent + "%";
                if (elapsed >= duration) {
                    dismissGuestMsg();
                }
            }, interval);
            function dismissGuestMsg() {
                guestMsg.style.transform = "translate(-50%, -120%)";
                clearInterval(timer);
                setTimeout(() => { guestMsg.style.display = 'none'; }, 700);
            }
        </script>
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