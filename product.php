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
            $ItemID = $row["ItemID"];
            $ItemName = $row["ItemName"];
            $name = $row['ItemName'];
            $ItemImage = $row["ItemImage"];
            $Price = $row["Price"];
            $Solds = $row["Solds"];
            $Quantity = $row["Quantity"];
            $Description = $row["description"];
            $price = formatPrice($row['Price']);
            $location = $row['ItemImage'];
            $category = $row['Category'];

            $txt .= "<a href='itempage.php?Itemname=$ItemName&Category=$category&ItemImage=$ItemImage&Price=$Price&Solds=$Solds&Quantity=$Quantity&ItemID=$ItemID&Description=$Description''><div class='item'><img class='imgsearch' src='$location'><h4>$name</h4><p class='ctgy'>$category</p><p class='price'>&#8369 <b>$price</b></p></div></a>";
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
