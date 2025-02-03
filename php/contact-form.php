<?php

// Check if the form was submitted and the "url" field is empty (honeypot technique)
if(isset($_POST['url']) && $_POST['url'] == '') {

    // Define recipient email
    $youremail = 'hernandezedca@gmail.com';

    // Ensure required fields are set
    if(isset($_POST['name'], $_POST['email'], $_POST['subject'], $_POST['message'])) {

        // Sanitize user input
        $name = htmlspecialchars($_POST['name']);
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);

        // Prepare email message
        $body = "You have received a new message from the contact form on your website - RMVTherapy:
        
        Name: $name
        Email: $email
        Subject: $subject
        Message: $message";

        // Validate email and prevent header injection
        if(filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/[\r\n]/", $email)) {
            $headers = "From: $email\r\nReply-To: $email";
        } else {
            $headers = "From: $youremail";
        }

        // Send email
        if(mail($youremail, "Message from RMV Therapy", $body, $headers)) {
            // Redirect to thank you page
            header("Location: thank-you.html");
            exit;
        } else {
            echo "Error sending email.";
        }
    } else {
        echo "All fields are required.";
    }
} else {
    echo "Invalid submission.";
}

?>
