<?php
include("connect.php");
include("query.php");
$resetemail = $_POST['email'];

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\WestMed\PHPMailer\src\Exception.php';
require 'C:\xampp\htdocs\WestMed\PHPMailer\src\PHPMailer.php';
require 'C:\xampp\htdocs\WestMed\PHPMailer\src\SMTP.php';

$mail = new PHPMailer(true);

$sql = "SELECT UserID FROM users WHERE email='$resetemail'"; // Fix: use $resetemail here
$result = $con->query($sql);

if ($result->num_rows > 0) { // Fix: use > 0 instead of > 1
    try {
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username = 'aylietsugu@gmail.com';
        $mail->Password = 'sajk dwbq mrrk qjde';
        $mail->SMTPSecure = 'ssl';
        $mail->Port       = 465;

        $mail->setFrom("$email", 'West Med');
        $mail->addAddress("$email", '');

        $reset_link = "http://localhost/WestMed/resetpassword.php?email=$resetemail";
        $message = '
        <html>
        <body>
            <p>Dear Maam/Sir,</p>
            <p>We received a request to reset your password. Please click the link below to reset your password:</p>
            <p><a href="' . $reset_link . '">Reset Password</a></p>
            <p>If you did not request a password reset, please ignore this email.</p>
            <p>Thank you!</p>
        </body>
        </html>
    ';
        // Set the email content
        $mail->isHTML(true);
        $mail->Subject = 'Important: Reset Your West Med Account Password Now!';
        $mail->Body    = $message;
        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        // Send the email
        $mail->send();

        // Store the verification code in the database
        // Add your database connection and update query here
        echo '<script>alert("Reset link sent to your email!");</script>';
        echo '<script>window.location.href = "Landing page.php";</script>';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
} else {
    echo "<script>alert('User with this email does not exist');</script>.";
    echo '<script>window.history.back();</script>';
}
