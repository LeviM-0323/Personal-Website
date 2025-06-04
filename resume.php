<?php
session_start();

//Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'] ?? '';
$username = $_SESSION['username'] ?? '';
$isAdmin = strcasecmp($username, 'admin') === 0;
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Resume Download</title>
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
        <img src="/img/logo.png" alt="Company Logo" height=auto width= 100%>
      </div>
    </header>

    <main>
        <hgroup>
            <h2>Resume &amp; Cover Letter</h2>
            <cite>Download my latest resume below</cite>
        </hgroup>
        <section style="max-width: 600px; margin: 2rem auto;">
            <p>
                Thank you for your interest in my professional background! Below you can download my most recent resume as a DOCX. 
                If you have any questions or would like to discuss opportunities, please feel free to <a href="contact.php">contact me</a>.
            </p>
            <ul>
                <li><strong>Name:</strong> Levi McLean</li>
                <li><strong>Email:</strong> AidanMclean111@gmail.com</li>
                <li><strong>Position Sought:</strong> Software Developer / Internet Applications Developer</li>
                <li><strong>Location:</strong> Woodstock, Ontario</li>
            </ul>
            <a href="/resume/Levi_McLean_Resume.docx" download class="contrast" style="display:inline-block; margin:1.5rem 0; padding:1rem 2rem; font-size:1.2rem;">
                📄 Download Resume (DOCX)
            </a>
            <p>
                <em>Last updated: <?= date("F Y", filemtime(__DIR__ . '/resume/Levi_McLean_Resume.docx')) ?></em>
            </p>
            <hr>
            <h3>Why Hire Me?</h3>
            <ul>
                <li>Proven experience in web and software development</li>
                <li>Strong problem-solving and analytical skills</li>
                <li>Excellent communication and teamwork abilities</li>
                <li>Passionate about learning and growth</li>
            </ul>
            <p>
                <strong>References available upon request.</strong>
            </p>
        </section>
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
    <script serc="/js/terms.js"></script>
  </body>    
</html>