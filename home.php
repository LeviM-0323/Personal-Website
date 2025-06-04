<?php
require_once __DIR__ . '/mailer/PHPMailer.php';
require_once __DIR__ . '/mailer/SMTP.php';
require_once __DIR__ . '/mailer/Exception.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'] ?? '';
$username = $_SESSION['username'] ?? '';
$isAdmin = strcasecmp($username, 'admin') === 0;
$subscribe_success = null;
$subscribe_error = null;
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['subscribe_email'])) {
  $subscriber_email = filter_var($_POST['subscribe_email'], FILTER_VALIDATE_EMAIL) ? $_POST['subscribe_email'] : '';
  if ($subscriber_email) {
    $mail = new PHPMailer(true);
    try {
      // --- Send notification to admin ---
      $mail->isSMTP();
      $mail->Host = 'smtp.gmail.com';
      $mail->SMTPAuth = true;
      $mail->Username = 'aidanmclean111@gmail.com';
      $mail->Password = 'zvmx gdye qpji grkq'; 
      $mail->SMTPSecure = 'tls';
      $mail->Port = 587;
      $mail->setFrom('your@gmail.com', 'Levi McLeans Website');
      $mail->addAddress('aidanmclean111@gmail.com');
      $mail->Subject = "New Subscription Notification";
      $mail->Body = "A new user has subscribed to your website!\n\n"
        . "Subscriber Email: $subscriber_email\n"
        . "Date: " . date('Y-m-d H:i:s') . "\n"
        . "IP Address: " . $_SERVER['REMOTE_ADDR'] . "\n\n"
        . "Keep up the great work!\n\n"
        . "This is an automated message from your website.";
      $mail->send();

      // --- Send confirmation to subscriber ---
      $mail->clearAddresses();
      $mail->addAddress($subscriber_email);
      $mail->Subject = "Welcome to Levi McLean's Website!";
      $mail->isHTML(true);
      $mail->Body = "
        <h2>Thank you for subscribing!</h2>
        <p>Hi there,</p>
        <p>We're excited to have you join our community at <strong>Levi McLean's Website</strong>!</p>
        <ul>
          <li>You'll be the first to know about new projects, blog posts, and updates.</li>
          <li>Get exclusive insights into programming tips, tutorials, and behind-the-scenes content.</li>
          <li>Stay tuned for upcoming features and interactive content.</li>
        </ul>
        <p>If you have any questions or suggestions, feel free to reply to this email or visit our <a href='https://yourwebsite.com/contact.php'>Contact Page</a>.</p>
        <hr>
        <p>Happy coding!<br>
        <strong>Levi McLean</strong></p>
        <small>This is an automated message. If you did not subscribe, please ignore this email.</small>
      ";
      $mail->AltBody = "Thank you for subscribing to Levi McLean's Website!\n\n"
        . "You'll be the first to know about new projects, blog posts, and updates.\n"
        . "If you have any questions, visit our website.\n\n"
        . "Happy coding!\nLevi McLean";
      $mail->send();

      $subscribe_success = "Thank you for subscribing! A confirmation email has been sent to your address.";
    } catch (Exception $e) {
      $subscribe_error = "Mailer Error: " . $mail->ErrorInfo;
    }
  } else {
    $subscribe_error = "Please enter a valid email address.";
  }
}
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
    <title>Levi McLean's Homepage</title>
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
    <!-- ./ Header -->

    <main>
      <section id="typography">
        <h2>Who Am I?</h2>
        <p>Welcome to my website! I am a college student currently in my second year at Fanshawe. This website is designed for me to practice my PHP, JS and SCSS as well as upgrade my website from the HTML/CSS combination only</p>
        <h2>What Can I Do?</h2>
        <p> Other than PHP, JS and SCSS I have quite a bit of experience in Python, Java, C, C++, C#, SQL, Bash, GO and Docker. Plus lesser experience in other areas of programming such as networking, memory management, object orientation, hashing, etc. My portfolio of skills and programming langauges grows and strengthens everyday because I'm passionate about programming even as just a hobby. The languages I'd like to pick up in the future are: Ruby, Rust, R, COBOL and objective-C as well as potentially learning more frameworks like Django, Bootstrap, React, Laravel and Ruby on Rails. Just taking things one day and one project at a time.</p>
        <h2>Personal Projects</h2>
        <blockquote>
          "Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate totam consequuntur hic rem, et nihil ipsam, debitis corrupti aliquid dolorum perspiciatis consectetur optio nemo a aspernatur odit pariatur ab fugiat? Lorem, ipsum dolor sit amet consectetur adipisicing elit. Perferendis, rem! Eum quia ipsam omnis ea placeat tempora libero, enim dolore maiores voluptate dicta incidunt at sunt excepturi adipisci rerum obcaecati."
          <footer>
            <cite>- Satisfied Customer</cite>
          </footer>
        </blockquote>
        <blockquote>
          "Lorem ipsum dolor sit amet consectetur adipisicing elit. Blanditiis fugit temporibus aperiam quisquam id doloremque molestiae recusandae perspiciatis illum itaque, et eligendi veritatis maxime fuga, totam repellat! Quas, aspernatur illum?"
          <footer>
            <cite>- Another Satisfied Customer</cite>
          </footer>
        </blockquote>
        <blockquote>
          "Lorem ipsum, dolor sit amet consectetur adipisicing elit. Modi excepturi nobis voluptates quam laudantium incidunt error provident ea! Nobis esse porro veritatis consequatur temporibus? Necessitatibus magnam adipisci et mollitia. Libero. Lorem ipsum dolor sit amet consectetur adipisicing elit. Hic, ex! Doloribus tempore ipsa iure, animi culpa deleniti voluptatibus id veniam in, est quas nisi ad."
          <footer>
            <cite>- Third Satisfied Customer</cite>
          </footer>
        </blockquote>
      </section>
    </main>

    <footer>
      <section id="preview">
        <h2>Subscribe (WIP)</h2>
        <p>I will not send you anything containing personal information or sensitive data. This is purely an experimental feature implemented to test the PHP Mail() function. Sign up with your email if you wish to participate.</p>
        <?php if (isset($subscribe_success)): ?>
            <article style="background: #e6ffe6; color: #225522; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1rem;">
                <?= $subscribe_success ?>
            </article>
        <?php elseif (isset($subscribe_error)): ?>
            <article style="background: #ffe6e6; color: #992222; border-radius: 0.5rem; padding: 1rem; margin-bottom: 1rem;">
                <?= $subscribe_error ?>
            </article>
        <?php endif; ?>
        <form method="post" autocomplete="off">
            <fieldset role="group">
                <input type="email" id="subscribe_email" name="subscribe_email" placeholder="Enter your email" required>
                <button type="submit">Subscribe</button>
            </fieldset>
        </form>
      </section>
      <hr>
      <small>&copy; 2025 Levi McLean</small>
      <br>
      <small>Built with 
        <a href="https://picocss.com" target="_blank">Pico</a> | <a href="https://github.com/LeviM-0323/Personal-Website" target="_blank">Source</a> | 
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