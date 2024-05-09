<?php
include("connect.php");

$targetUserId = 1;
$username = $_POST['username'];
$full_name = $_POST['name'];
$address = $_POST['address'];
$email = $_POST['email'];
$phone = $_POST['phone'];

if (isset($_POST["submit"])) {
    if ($_FILES['img']['size'] > 0) {
        $name = $_FILES['img']['name'];
        $tmp_name = $_FILES['img']['tmp_name'];
        $location = "upload/users/$name";
        move_uploaded_file($tmp_name, $location);
    } else {
        $queryRetrieveProfile = mysqli_query($con, "SELECT profile FROM currentuser WHERE userid = $targetUserId");
        $row = mysqli_fetch_assoc($queryRetrieveProfile);
        $location = $row['profile'];
    }
    $queryRetrieveUsername = mysqli_query($con, "SELECT * FROM currentuser WHERE userid = $targetUserId");

    if ($queryRetrieveUsername && mysqli_num_rows($queryRetrieveUsername) > 0) {
        $row = mysqli_fetch_assoc($queryRetrieveUsername);
        $targetUsername = $row['username'];
        $targetFName = $row['FName'];
        $queryUpdateUsers = mysqli_query($con, "UPDATE users SET username = '$username', profile = '$location', FName = '$full_name', Email = '$email', address ='$address', phone = '$phone' WHERE username = '$targetUsername'");
        $queryUpdate = mysqli_query($con, "UPDATE currentuser SET username = '$username', profile = '$location', FName = '$full_name', Email = '$email', address ='$address', phone = '$phone' WHERE userid = $targetUserId");


        echo '<script>alert("Profile updated successfully for User: ' . $targetFName . ' ");</script>';
        echo '<script>window.location.href = "Landing page.php";</script>';
    } else {
        echo '<script>alert("Error retrieving username. Please try again later.");</script>';
    }

} else {
    echo '<script>alert("Error updating profile2. Please try again later.");</script>';
    echo '<script>window.location.href = "edituser.php";</script>';
}
