<?php
require_once __DIR__ . '/mailer/PHPMailer.php';
require_once __DIR__ . '/mailer/SMTP.php';
require_once __DIR__ . '/mailer/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

//Check if user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'] ?? '';
$username = $_SESSION['username'] ?? '';
$isAdmin = strcasecmp($username, 'admin') === 0;

$contact_success = null;
$contact_error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact_message'])) {
    $from_email = filter_var($_POST['contact_email'], FILTER_VALIDATE_EMAIL) ? $_POST['contact_email'] : '';
    $from_name = htmlspecialchars(trim($_POST['contact_name']));
    $message = htmlspecialchars(trim($_POST['contact_message']));
    if ($from_email && $from_name && $message) {
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'aidanmclean111@gmail.com';
            $mail->Password = 'zvmx gdye qpji grkq';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom($from_email, $from_name);
            $mail->addAddress('aidanmclean111@gmail.com');
            $mail->Subject = "Contact Form Submission from $from_name";
            $mail->Body = "Name: $from_name\nEmail: $from_email\n\nMessage:\n$message";

            $mail->send();
            $contact_success = "Thank you for reaching out! Your message has been sent.";
        } catch (Exception $e) {
            $contact_error = "Mailer Error: " . $mail->ErrorInfo;
        }
    } else {
        $contact_error = "Please fill in all fields with valid information.";
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Contact Info</title>
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
            <h2>Contact Information</h2>
            <cite>Feel free to reach out using the information below.</cite>
        </hgroup>
        <article style="max-width: 600px; margin: 2rem auto;">
          <div class="grid">
              <div>
                <strong>Phone Number:</strong><br>
                <span id="contact-phone">(519) 535-1398</span>
              </div>
              <div>
                <strong>Email:</strong><br>
                <a id="contact-email" href="mailto:aidanmclean111@gmail.com">AidanMcLean111@gmail.com</a>
              </div>
              <div>
                <strong>GitHub:</strong><br>
                <a id="contact-github" href="https://github.com/LeviM-0323" target="_blank">LeviM0323</a>
              </div>
          </div>
        </article>
        <section style="max-width: 600px; margin: 2rem auto;">
          <h3>Contact Me Directly</h3>
            <?php if ($contact_success): ?>
              <article style="background: var(--pico-primary-background,#e6ffe6); color: var(--pico-primary,#225522); border-radius: 0.5rem; padding: 1rem; margin-bottom: 1rem;">
              <?= $contact_success ?>
              </article>
            <?php elseif ($contact_error): ?>
              <article style="background: var(--pico-primary-background,#ffe6e6); color: var(--pico-primary,#992222); border-radius: 0.5rem; padding: 1rem; margin-bottom: 1rem;">
              <?= $contact_error ?>
              </article>
            <?php endif; ?>
            <form method="post" autocomplete="off">
            <label>
              Your Name
              <input type="text" name="contact_name" required maxlength="100" placeholder="Your name">
            </label>
            <label>
              Your Email
              <input type="email" name="contact_email" required maxlength="100" placeholder="you@email.com">
            </label>
            <label>
              Message
              <textarea name="contact_message" required maxlength="1000" rows="5" placeholder="Type your message here..."></textarea>
            </label>
          <button type="submit" style="margin-top: 0.5rem;">Send Message</button>
        </form>
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