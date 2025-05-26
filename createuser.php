<?php
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // reCAPTCHA validation
    $recaptchaSecret = "6Lex2UkrAAAAAAFAy3HaMIHZEkos4awqtKnLbpsS";
    $recaptchaResponse = $_POST['g-recaptcha-response'];

    $verifyResponse = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$recaptchaSecret}&response={$recaptchaResponse}");
    $responseData = json_decode($verifyResponse);

    if (!$responseData->success) {
        echo '<script>alert("Please complete the reCAPTCHA."); window.history.back();</script>';
        exit();
    }

    $fname = $_POST['txtfname'];
    $username = $_POST['txtusername'];
    $password = $_POST['txtpassword'];
    $email = $_POST['txtemail'];
    $profile = 'upload/users/new.jpg';

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $checkQuery = "SELECT username FROM users WHERE username = ? OR email = ?";
    $checkStmt = mysqli_prepare($con, $checkQuery);
    mysqli_stmt_bind_param($checkStmt, "ss", $username, $email);
    mysqli_stmt_execute($checkStmt);
    mysqli_stmt_store_result($checkStmt);

    if (mysqli_stmt_num_rows($checkStmt) > 0) {
        // Username or email already taken
        mysqli_stmt_close($checkStmt);
        mysqli_close($con);
        echo '<script>alert("Username or email already exists. Please choose a different one.");</script>';
        echo '<script>window.location.href = "Landing page.php";</script>';
    } else {
        // Proceed with user registration
        mysqli_stmt_close($checkStmt);

        $sql = "INSERT INTO users (Fname, username, password, email, profile) VALUES (?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($con, $sql);
        mysqli_stmt_bind_param($stmt, "sssss", $fname, $username, $hashedPassword, $email, $profile);
        mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        mysqli_close($con);

        echo '<script>alert("Signup Successfully!");</script>';
        echo '<script>window.location.href = "Landing page.php";</script>';
    }
}
