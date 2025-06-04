<?php
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'] ?? '';
$username = $_SESSION['username'] ?? '';
$isAdmin = strcasecmp($username, 'admin') === 0;
require 'db.php';
$message = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['password'])) {
    $password = $_POST['password'] ?? '';
    $stmt = $conn->prepare("SELECT password FROM users WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($hashed_password);
    if ($stmt->fetch() && password_verify($password, $hashed_password)) {
        $stmt->close();
        $del = $conn->prepare("DELETE FROM users WHERE username = ?");
        $del->bind_param("s", $username);
        $del->execute();
        $del->close();
        session_destroy();
        header("Location: index.php?deleted=1");
        exit();
    } else {
        $message = "Incorrect password. Account not deleted.";
        $stmt->close();
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Delete Account</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="color-scheme" content="light dark">
        <link rel="icon" type="image/x-icon" href="/img/icon.png">
        <link rel="stylesheet" href="/css/pico.classless.red.min.css">
        <link rel="stylesheet" href="/css/pico.colors.min.css">
    </head>

    <body>
    <!-- Header -->
    <header>
      <nav>
        <ul>
          <li><a href="#" data-theme-switcher="auto">Auto</a></li>
          <li><a href="#" data-theme-switcher="light">Light</a></li>
          <li><a href="#" data-theme-switcher="dark">Dark</a></li>
        </ul>
      </nav>
      <nav>
        <ul>
          <li><a href="home.php">Home</a></li>
          <li><a href="contact.php">Contact</a></li>
          <li><a href="resume.php">Resume</a></li>
          <li><a href="delete_account.php">Delete Account</a></li>
        </ul>
        <ul>
          <li><a href="logout.php">Logout</a></li>
        </ul>
      </nav>
      <div style="text-align: center;">
        <img src="/img/logo.png" alt="Personal Logo" height=auto width= 100%>
      </div>
    </header>

    <main>
        <hgroup>
            <h2>Delete Account</h2>
            <cite style="color:red;">Warning: This action is permanent!</cite>
        </hgroup>
        <p style="color: #555; margin-bottom: 1rem;">
            Logged in as: <strong><?= htmlspecialchars($username) ?></strong> (<?= htmlspecialchars($email) ?>)
        </p>
        <?php if ($message): ?>
            <article style="background: #ffe6e6; color: #992222; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1rem;">
                <?= htmlspecialchars($message) ?>
            </article>
        <?php endif; ?>
        <form method="post" autocomplete="off" onsubmit="return confirm('Are you sure you want to delete your account? This cannot be undone.');">
            <label for="password">Please confirm your password to delete your account:</label>
            <input type="password" id="password" name="password" required autocomplete="current-password">
            <button type="submit" style="background: #c00; color: #fff;">Delete My Account</button>
        </form>
        <p style="color:grey; margin-top:1rem;">All your data will be permanently removed. This cannot be undone.</p>
    </main>

    <footer>
      <hr>
      <small>&copy; 2025 Levi McLean</small>
      <br>
      <small>Built with 
        <a href="https://picocss.com">Pico</a> | <a href="https://github.com/LeviM-0323/Personal-Website" target="_blank">Source</a> |
        <?php if ($isAdmin): ?>
          <a href="admin.php">Admin</a>
        <?php else: ?>
          <span style="color: grey; cursor: not-allowed;">Admin</span>
        <?php endif; ?>
      </small>
    </footer>
    <script src="/js/minimal-theme-switcher.js"></script>
  </body>
</html>