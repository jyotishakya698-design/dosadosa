<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitize inputs
    $name    = htmlspecialchars(trim($_POST['name'] ?? ''));
    $mobile  = preg_replace('/\D/', '', $_POST['mobile'] ?? '');
    $date    = htmlspecialchars(trim($_POST['date'] ?? ''));
    $guests  = htmlspecialchars(trim($_POST['guests'] ?? ''));
    $message = htmlspecialchars(trim($_POST['message'] ?? ''));

    // Required field validation
    if (empty($name) || empty($mobile) || empty($date) || empty($guests)) {
        echo "<script>
                alert('Please fill in all required fields.');
                window.history.back();
              </script>";
        exit;
    }

    // Validate mobile number (exactly 10 digits)
    if (!preg_match('/^[0-9]{10}$/', $mobile)) {
        echo "<script>
                alert('Please enter a valid 10-digit mobile number.');
                window.history.back();
              </script>";
        exit;
    }

    // Convert date from YYYY-MM-DD to DD/MM/YYYY
    $formatted_date = date("d/m/Y", strtotime($date));

    // Recipient
    $to = "website@hospitalityminds.com";

    // Subject
    $subject = "New Reservation Request";

    // Email body
    $email_message = "
New Reservation Received

Name: $name
Mobile Number: $mobile
Reservation Date: $formatted_date
Number of Guests: $guests

Message:
$message
";

    // Email headers
    $headers = "From: website@hospitalityminds.com\r\n";
    $headers .= "Reply-To: website@hospitalityminds.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Send email
    if (mail($to, $subject, $email_message, $headers)) {
        echo "<script>
                alert('Reservation submitted successfully!');
                window.location.href='index.html';
              </script>";
    } else {
        echo "<script>
                alert('Failed to send reservation. Please try again.');
                window.history.back();
              </script>";
    }

} else {
    header("Location: index.html");
    exit;
}

?>