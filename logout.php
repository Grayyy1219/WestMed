<?php
include("connect.php");
$query = mysqli_query($con, "UPDATE currentuser SET username = '0' WHERE userid = 1");

if ($query) {
    echo '<script>alert("Logout successfully");</script>';
    echo '<script>window.location.href = "Landing page.php";</script>';
    session_destroy();
} else {
    echo "Update failed: " . mysqli_error($con);
    echo '<script>window.location.href = "Landing page.php";</script>';
}
