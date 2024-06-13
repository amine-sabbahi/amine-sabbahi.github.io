<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $email = trim($_POST['email']);
    $subject = trim($_POST['subject']);
    $message = trim($_POST['message']);

    // Validate inputs (basic validation example)
    if (empty($fname) || empty($lname) || empty($email) || empty($subject) || empty($message)) {
        // Handle validation errors
        die('Please fill in all fields.');
    }

    // Sanitize inputs (prevent XSS attacks)
    $fname = htmlspecialchars($fname);
    $lname = htmlspecialchars($lname);
    $email = filter_var($email, FILTER_SANITIZE_EMAIL);
    $subject = htmlspecialchars($subject);
    $message = htmlspecialchars($message);

    // Example of sending an email (you can use a library like PHPMailer for better email handling)
    $to = "aminesebbahi11@gmail.com"; // Replace with your email
    $headers = "From: $email \r\n";
    $headers .= "Reply-To: $email \r\n";
    $email_subject = "New Contact Form Submission: $subject";
    $email_body = "You have received a new message from your website contact form.\n\n";
    $email_body .= "Name: $fname $lname\n";
    $email_body .= "Email: $email\n";
    $email_body .= "Message:\n$message";

    // Attempt to send email
    if (mail($to, $email_subject, $email_body, $headers)) {
        // Redirect to thank you page
        header('Location: thank-you.html'); // Replace with your thank you page
        exit;
    } else {
        // Handle email sending failure
        die('Error sending email. Please try again later.');
    }
} else {
    // Handle non-POST requests (optional)
    die('Form submission method not allowed.');
}
?>
