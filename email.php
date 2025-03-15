<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];

    // Configure XAMPP to send emails
    $to = $email;
    $subject = "Welcome to the Techniko Inc. Newsletter!";
    $message = "This is a test email from Techniko Inc. We are an up-and-coming biotechnics company based in North America. Thank you for subscribing to our newsletter however, there will not be very many emails sent out as this is only a test feature and shouldnt be used for actual newsletters.";
    $headers = "From: no-reply@techniko.com";

    if(mail($to, $subject, $message, $headers)) {
        echo "Email sent successfully!";
    } else {
        echo "Email failed to send!";
    }
}
?>