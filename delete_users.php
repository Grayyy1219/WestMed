<?php
include("connect.php");
include("query.php");
$adminpassword = $hashedadminpassword;

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_ids"], $_POST["admin_password"])) {
    $entered_password = $_POST["admin_password"];

    if ($entered_password !== $adminpassword) {
        http_response_code(403);
        echo "Invalid admin password.";
        exit;
    }

    // Sanitize the input to prevent SQL injection
    $userIds = explode(',', $_POST["user_ids"]);

    $allDeleted = true;

    foreach ($userIds as $userId) {
        $userId = mysqli_real_escape_string($con, $userId);

        // First, delete from payment table
        $query2 = "DELETE FROM payment WHERE customer_id = '$userId'";
        $result2 = mysqli_query($con, $query2);

        // Then delete the user, ensure not admin
        $query = "DELETE FROM users WHERE UserID = '$userId' AND admin != 1";
        $result = mysqli_query($con, $query);

        if (!$result || !$result2) {
            $allDeleted = false;
        }
    }

    if ($allDeleted) {
        echo "Users deleted successfully.";
    } else {
        http_response_code(500);
        echo "Error deleting some users: " . mysqli_error($con);
    }
} else {
    header("HTTP/1.1 400 Bad Request");
    echo "Invalid request.";
}

mysqli_close($con);
