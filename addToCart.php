
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include 'connect.php';
include 'query.php';

$productName = mysqli_real_escape_string($con, $_POST['Itemname']);
$quantity = mysqli_real_escape_string($con, $_POST['quantity']);

$getProductQuery = "SELECT * FROM Items WHERE ItemName = '$productName' LIMIT 1";
$productResult = mysqli_query($con, $getProductQuery);

if (!$productResult) {
    echo "Error retrieving product details: " . mysqli_error($con);
    exit();
}

$productRow = mysqli_fetch_assoc($productResult);
$product_id = $productRow['ItemID'];
$totalQuantity = $productRow['Quantity'];

$checkCartQuery = "SELECT * FROM cart WHERE customer_id = $UserID AND ItemID  = $product_id";
$checkCartResult = mysqli_query($con, $checkCartQuery);

$quantityInCart = 0;

if (mysqli_num_rows($checkCartResult) > 0) {
    $row = mysqli_fetch_assoc($checkCartResult);
    $quantityInCart = $row['quantity'];
}

$availableQuantity = $totalQuantity - $quantityInCart;

if ($quantity > $availableQuantity) {
    $quantity = $availableQuantity;
    echo '<script>alert("Apologies, we only have ' . $availableQuantity . ' units available in stock.\nAlso Try check.");</script>';
    echo '<script>window.history.go(-2);</script>';
    exit();
}
if ($quantityInCart > 0) {
    $newQuantity = $quantityInCart + $quantity;
    $updateCartQuery = "UPDATE cart SET quantity = $newQuantity WHERE customer_id = $UserID AND ItemID  = $product_id";

    if (mysqli_query($con, $updateCartQuery)) {
        echo "<script>alert('Item successfully added to your cart!');</script>";
        echo '<script>window.history.go(-2);</script>';
    } else {
        echo "Error updating product quantity in the cart: " . mysqli_error($con);
    }
} else {
    $insertCartQuery = "INSERT INTO cart (customer_id, ItemID , quantity) VALUES ($UserID, $product_id, $quantity)";

    if (mysqli_query($con, $insertCartQuery)) {
        echo "<script>alert('Item successfully added to your cart!');</script>";
        echo '<script>window.history.go(-2);</script>';
    } else {
        echo "Error adding product to the cart: " . mysqli_error($con);
    }
}
