<?php
$UserID = $_SESSION['UserID'] ?? '';
$isLoggedIn = false;
$cartcount = 0;

$username = $FName = $LName = $email = $address = $phone = $password = $verification = $block = $location = '0';

if (!empty($UserID)) {
    $queryUser = mysqli_query($con, "SELECT * FROM users WHERE UserID = '$UserID'");
    if ($queryUser && mysqli_num_rows($queryUser) > 0) {
        $rowUser = mysqli_fetch_assoc($queryUser);
        $location     = $rowUser["profile"];
        $username     = $rowUser["username"];
        $FName        = $rowUser["FName"];
        $LName        = $rowUser["LName"];
        $email        = $rowUser["email"];
        $address      = $rowUser["address"];
        $phone        = $rowUser["phone"];
        $password     = $rowUser["password"];
        $verification = $rowUser["verification"];
        $block        = $rowUser["block"];

        $isLoggedIn = true;

        $queryCart = mysqli_query($con, "SELECT COUNT(cart_id) AS count FROM cart WHERE customer_id = '$UserID'");
        $rowCart = mysqli_fetch_assoc($queryCart);
        $cartcount = $rowCart["count"] ?? 0;
    }
}
$queryPage = mysqli_query($con, "SELECT * FROM page WHERE ItemID IN (1,2,3,4,5)");
while ($rowPage = mysqli_fetch_assoc($queryPage)) {
    switch ($rowPage["ItemID"]) {
        case 1:
            $logo = $rowPage["value"];
            break;
        case 2:
            $companyname = $rowPage["value"];
            break;
        case 3:
            $backgroundimg = $rowPage["value"];
            break;
        case 4:
            $backgroundcolor = $rowPage["value"];
            break;
        case 5:
            $color = $rowPage["value"];
            break;
    }
}

// Slideshow session values
for ($i = 1; $i <= 4; $i++) {
    $_SESSION["slide$i"] = $_SESSION["slide$i"] ?? "slide$i";
    ${"slide$i"} = $_SESSION["slide$i"];
}

// Admin user info (if needed)
$queryAdmin = mysqli_query($con, "SELECT * FROM users WHERE UserID = 1");
$rowAdmin = mysqli_fetch_assoc($queryAdmin);
$hashedadminpassword = $rowAdmin["password"];
$alocation  = $rowAdmin["profile"];
$ausername  = $rowAdmin["username"];
$aFName     = $rowAdmin["FName"];
$aLName     = $rowAdmin["LName"];
$aemail     = $rowAdmin["email"];
$aaddress   = $rowAdmin["address"];
$aphone     = $rowAdmin["phone"];

// Slideshow images
$querySlide = mysqli_query($con, "SELECT * FROM slideshow WHERE SlideID IN (1, 2, 3)");
while ($rowSlide = mysqli_fetch_assoc($querySlide)) {
    ${"slide" . $rowSlide["SlideID"]} = $rowSlide["imagelocation"];
}
