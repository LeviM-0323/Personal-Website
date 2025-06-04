<?php
// filepath: e:\Server\config\nginx-config\www\all_users.php

session_start();
require_once "db.php";

// Check if user is logged in and is admin
if (!isset($_SESSION['username']) || strcasecmp($_SESSION['username'], 'admin') !== 0) {
    http_response_code(403);
    echo "Access denied. Admins only.";
    exit();
}

// Handle user deletion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_user_id'])) {
    $user_id = intval($_POST['delete_user_id']);
    // Prevent admin from deleting themselves
    $stmt = $conn->prepare("SELECT username FROM users WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $stmt->bind_result($del_username);
    $stmt->fetch();
    $stmt->close();

    if ($del_username && strcasecmp($del_username, 'admin') !== 0) {
        $del_stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
        $del_stmt->bind_param("i", $user_id);
        $del_stmt->execute();
        $del_stmt->close();
    }
    header("Location: all_users.php");
    exit();
}

// Fetch all users
$result = $conn->query("SELECT id, username, email FROM users ORDER BY id ASC");
$users = [];
if ($result) {
    while ($row = $result->fetch_assoc()) {
        $users[] = $row;
    }
}
$conn->close();
?>
<!doctype html>
    <html lang="en">
        <head>
            <meta charset="utf-8">
            <meta name="viewport" content="width=device-width, initial-scale=1">
            <meta name="color-scheme" content="light dark">
            <link rel="icon" type="image/x-icon" href="/img/icon.png">
            <link rel="stylesheet" href="/css/pico.classless.red.min.css">
            <link rel="stylesheet" href="/css/pico.colors.min.css">
            <title>All Users - Admin</title>
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
                    <li><a href="home.php">User Home</a></li>
                    <li><a href="admin.php">Admin Home</a></li>
                    <li><a href="all_users.php">All Users</a></li>
                </ul>
                <ul>
                <li><a href="logout.php">Logout</a></li>
                </ul>
            </nav>
        </header>
        <!-- ./ Header -->

        <!-- Body -->
        <main>
            <h1>All Users</h1>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Delete</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user['id']) ?></td>
                        <td><?= htmlspecialchars($user['username']) ?></td>
                        <td><?= htmlspecialchars($user['email']) ?></td>
                        <td>
                            <?php if (strcasecmp($user['username'], 'admin') !== 0): ?>
                            <form method="post" style="margin:0;">
                                <input type="hidden" name="delete_user_id" value="<?= $user['id'] ?>">
                                <button type="submit" onclick="return confirm('Delete user <?= htmlspecialchars($user['username']) ?>?');">Delete</button>
                            </form>
                            <?php else: ?>
                                <em>Protected</em>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </main>
        <!-- ./ Body -->

        <!-- Footer -->
        <footer>
            <hr>
            <small>&copy; 2025 Levi McLean</small>
            <br>
            <small>Built with 
                <a href="https://picocss.com">Pico</a> | <a href="https://github.com/LeviM-0323/Personal-Website" target="_blank">Source</a>
            </small>
        </footer>
        <!-- ./ Footer -->
         
        <script src="/js/minimal-theme-switcher.js"></script>
    </body>
</html>