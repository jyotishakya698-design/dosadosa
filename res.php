<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name      = htmlspecialchars($_POST['name']);
    $email     = htmlspecialchars($_POST['email']);
    $date_time = htmlspecialchars($_POST['date_time']);
    $guest     = htmlspecialchars($_POST['guest']);
    $message   = htmlspecialchars($_POST['message']);

    $to = "website@hospitalityminds.com"; // Replace with your email

    $subject = "New Reservation Request";

    $email_message = "
    New Reservation Received

    Name: $name
    Email: $email
    Date & Time: $date_time
    Guests: $guest

    Message:
    $message
    ";

    $headers = "From: $email\r\n";
    $headers .= "Reply-To: $email\r\n";

    if(mail($to, $subject, $email_message, $headers)){
        echo "
        <script>
            alert('Reservation submitted successfully!');
            window.location.href='index.html';
        </script>";
    } else {
        echo "
        <script>
            alert('Failed to send reservation.');
            window.history.back();
        </script>";
    }
}

?>