<?php
include("connect.php");
include("query.php");


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer\src\Exception.php';
require 'PHPMailer\src\PHPMailer.php';
require 'PHPMailer\src\SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username = 'aylietsugu@gmail.com';
    $mail->Password = 'sajk dwbq mrrk qjde';
    $mail->SMTPSecure = 'ssl';
    $mail->Port       = 465;

    // Recipients
    $mail->setFrom("$email", 'West Med');
    $mail->addAddress("$email", '');

    $verificationCode = rand(10000, 99999);
    $sql = "UPDATE users SET verification_code = '$verificationCode' WHERE email = '$email'";
    mysqli_query($con, $sql);
    // Include the verification code in the link
    $verificationLink = "http://localhost/westmed/verify.php?code=$verificationCode";

    // Set the email content
    $mail->isHTML(true);
    $mail->Subject = 'Confirm Your Westmed Account - Dive into Med Bliss!';
    $mail->Body    = "Thank you for creating an account with Westmed!. To ensure the security of your account, please verify your email address by clicking on the following link: <br> <b><a href='$verificationLink'>Verification Link</a></b> Link: $verificationLink <br><br> If you did not create an account with Westmed, please ignore this email.<br><br>Thank you for choosing Westmed and happy shopping!";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    // Send the email
    $mail->send();

    // Store the verification code in the database
    // Add your database connection and update query here
    echo '<script>alert("Verification link sent to you email!");</script>';
    echo '<script>window.location.href = "Landing page.php";</script>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
