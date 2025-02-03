<?php

if(isset($_POST['url']) && $_POST['url'] == '') { // Simple spam prevention

    // Put your email address here
    $youremail = 'hernandezedca@gmail.com';

    // Sanitize and validate input
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars(strip_tags($_POST['subject']));
    $message = htmlspecialchars(strip_tags($_POST['message']));

    // Validate email format
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Invalid email address.");
    }

    // Email headers
    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Email body
    $body = "You have received a new message from the contact form on RMV Therapy:

Name: $name
Email: $email
Subject: $subject

Message:
$message";

    // Send email and check if successful
    if(mail($youremail, 'Message from RMV Therapy', $body, $headers)) {
        echo "<!DOCTYPE HTML>
        <html>
        <head><title>Thanks!</title></head>
        <body><p>Thank you! We will get back to you soon.</p></body>
        </html>";
    } else {
        echo "<!DOCTYPE HTML>
        <html>
        <head><title>Error</title></head>
        <body><p>Sorry, your message could not be sent. Please try again later.</p></body>
        </html>";
    }
}
?>
