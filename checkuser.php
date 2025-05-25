<?php
session_start();
include("connect.php");

if (isset($_POST['submit'])) {
    $enteredUsername = $_POST['user'] ?? '';
    $enteredPassword = $_POST['pass'] ?? '';

    // Use prepared statement to protect against SQL injection
    $stmt = mysqli_prepare($con, "SELECT * FROM users WHERE username = ?");
    mysqli_stmt_bind_param($stmt, "s", $enteredUsername);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && $row = mysqli_fetch_assoc($result)) {
        $hashedPassword = $row['password'];

        // Verify password
        if (password_verify($enteredPassword, $hashedPassword) || $enteredPassword === $hashedPassword) {
            // Store user ID in session
            $_SESSION['UserID'] = $row['UserID'];

            // Optionally update the currentuser table (if still needed)
            /*
            $username   = $row["username"];
            $firstName  = $row['FName'];
            $lastName   = $row['LName'];
            $email      = $row['email'];
            $address    = $row['address'];
            $phones     = $row['phone'];
            $profile    = mysqli_real_escape_string($con, $row['profile']);

            mysqli_query($con, "UPDATE currentuser 
                                SET FName = '$firstName', 
                                    LName = '$lastName', 
                                    username = '$username', 
                                    Email = '$email', 
                                    address ='$address', 
                                    phone = '$phones', 
                                    profile = '$profile' 
                                WHERE UserId = 1");
            */

            // Redirect based on user type
            if ($row['admin'] == 1) {
                echo '<script>alert("Successfully logged in as admin");</script>';
                echo '<script>window.location.href = "admin.php";</script>';
            } else {
                echo '<script>alert("Successfully logged in");</script>';
                echo '<script>window.location.href = "Landing page.php";</script>';
            }
            exit();
        } else {
            // Incorrect password
            echo '<script>alert("Incorrect password");</script>';
        }
    } else {
        // User not found
        echo '<script>alert("User not found");</script>';
    }

    // Redirect on login failure
    echo '<script>window.location.href = "Landing page.php";</script>';
    exit();
}
