<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name    = htmlspecialchars($_POST['name']);
    $email   = htmlspecialchars($_POST['email']);
    $phone   = htmlspecialchars($_POST['phone']);
    $message = htmlspecialchars($_POST['message']);

    // Your receiving email
    $to = "website@hospitalityminds.com";

    $subject = "New Contact Form Submission";

    $body = "
    New Contact Form Submission

    Full Name: $name
    Email: $email
    Phone: $phone

    Message:
    $message
    ";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    if(mail($to, $subject, $body, $headers)){
        echo "<script>
                alert('Thank you! Your message has been sent successfully.');
                window.location.href='index.html';
              </script>";
    } else {
        echo "<script>
                alert('Sorry! Something went wrong.');
                window.history.back();
              </script>";
    }
}
?>