<?php
include("connect.php");
session_start();

if (!isset($_SESSION['UserID'])) {
    echo '<script>alert("You must be logged in to update your profile.");</script>';
    echo '<script>window.location.href = "login.php";</script>';
    exit();
}

$UserID = $_SESSION['UserID'];
$username = $_POST['username'];
$full_name = $_POST['name'];
$address = $_POST['address'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if (isset($_POST["submit"])) {
    if ($_FILES['img']['size'] > 0) {
        $name = basename($_FILES['img']['name']);
        $tmp_name = $_FILES['img']['tmp_name'];
        $location = "upload/users/" . $name;
        move_uploaded_file($tmp_name, $location);
    } else {
        // Keep current profile image
        $queryProfile = mysqli_query($con, "SELECT profile FROM users WHERE UserID = $UserID");
        $row = mysqli_fetch_assoc($queryProfile);
        $location = $row['profile'];
    }

    $updateQuery = mysqli_query($con, "UPDATE users SET username = '$username', profile = '$location', FName = '$full_name', Email = '$email', address = '$address', phone = '$phone' WHERE UserID = $UserID");

    if ($updateQuery) {
        // Update session data for use elsewhere if needed
        $_SESSION['username'] = $username;
        $_SESSION['FName'] = $full_name;
        $_SESSION['email'] = $email;
        $_SESSION['address'] = $address;
        $_SESSION['phone'] = $phone;
        $_SESSION['profile'] = $location;

        echo '<script>alert("Profile updated successfully.");</script>';
        echo '<script>window.location.href = "Landing page.php";</script>';
    } else {
        echo '<script>alert("Error updating profile. Please try again later.");</script>';
        echo '<script>window.location.href = "edituser.php";</script>';
    }
} else {
    echo '<script>alert("Invalid submission.");</script>';
    echo '<script>window.location.href = "edituser.php";</script>';
}
