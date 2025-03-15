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
        <fieldset role="group">
            <input type="email" id="email" name="email" placeholder="Enter your email" required>
            <button type="button">Subscribe</button>
        </fieldset>
        <p id="message" style="display: none;"></p>
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
    <script src="/js/subscribe.js"></script>
  </body>
</html>
