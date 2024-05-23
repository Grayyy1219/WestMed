<?php
include("connect.php");
if (!$con) {
    die("Connection failed: " . mysqli_connect_error());
}

function getSearchResults($searchValue, $con)
{
    $searchQuery = "SELECT * FROM items WHERE ItemName LIKE '%$searchValue%'";
    $result = mysqli_query($con, $searchQuery);

    $txt = "";
    if (mysqli_num_rows($result) > 0) {
        $displayedItems = 0;
        while ($row = mysqli_fetch_assoc($result)) {
            if ($displayedItems >= 5) {
                break;
            }

            $name = $row['ItemName'];
            $price = formatPrice($row['Price']);
            $location = $row['ItemImage'];
            $category = $row['Category'];

            $txt .= "<div class='item'><img class='imgsearch' src='$location'><h4>$name</h4><p class='ctgy'>$category</p><p class='price'>&#8369 <b>$price</b></p></div>";
            $displayedItems++;
        }
    } else {
        $txt .= "<h1>No Data Found</h1>";
    }
    return $txt;
}

function formatPrice($number)
{
    return number_format($number, 2);
}

if (isset($_GET['search'])) {
    $searchValue = $_GET['search'];
    $searchResults = getSearchResults($searchValue, $con);
    echo $searchResults;
}

mysqli_close($con);
