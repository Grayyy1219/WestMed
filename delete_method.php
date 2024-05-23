<?php
include("connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_ids"])) {
    $userIds = explode(',', $_POST["user_ids"]);

    foreach ($userIds as $userId) {
        $userId = mysqli_real_escape_string($con, $userId);
        $query2 = "DELETE FROM paymethod  WHERE method_name  = '$userId'";
        $result2 = mysqli_query($con, $query2);
    }

    if ($result) {
        echo "Users deleted successfully";
    } else {
        echo "Error deleting users: " . mysqli_error($con);
    }
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Invalid request";
}

mysqli_close($con);
