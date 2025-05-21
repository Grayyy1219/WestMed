<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include("connect.php");
include("query.php");

$selectedItems = $_SESSION['selectedItems'];
if (!isset($_SESSION['selectedItems'])) {
    echo "No items selected for purchase.";
    exit();
}



// Fetch selected items details
$getSelectedItemsQuery = "SELECT items.ItemID, items.ItemName, items.price, cart.quantity 
                         FROM cart 
                         INNER JOIN items ON cart.ItemID = items.ItemID 
                         WHERE cart.customer_id = ? AND cart.cart_id IN ($selectedItems)";

$stmt = mysqli_prepare($con, $getSelectedItemsQuery);
mysqli_stmt_bind_param($stmt, "i", $UserID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    echo "Error retrieving selected items: " . mysqli_error($con);
    exit();
}

// Calculate total purchase value
$totalPurchaseValue = 0;
$itemsDetails = [];
while ($row = mysqli_fetch_assoc($result)) {
    $totalPurchaseValue += $row['quantity'] * $row['price'];
    $itemsDetails[] = $row;
}

// Start transaction
mysqli_begin_transaction($con);

try {
    // 1. Insert into orders table
    $orderQuantity = 0;
    $insertOrderSQL = "INSERT INTO orders (customer_id, order_date, total_amount, order_quantity)
                       VALUES (?, CURRENT_TIMESTAMP, ?, ?)";
    $stmtOrder = mysqli_prepare($con, $insertOrderSQL);
    mysqli_stmt_bind_param($stmtOrder, "idi", $UserID, $totalPurchaseValue, $orderQuantity);
    mysqli_stmt_execute($stmtOrder);
    $orderId = mysqli_insert_id($con);
    mysqli_stmt_close($stmtOrder);

    // 2. Insert into payment table
    $paymentMode = isset($_POST['paymentMode']) ? $_POST['paymentMode'] : 'Cash'; // or get from form
    $insertPaymentSQL = "INSERT INTO payment (order_id, customer_id, payment_mode, amount_paid)
                         VALUES (?, ?, ?, ?)";
    $stmtPayment = mysqli_prepare($con, $insertPaymentSQL);
    mysqli_stmt_bind_param($stmtPayment, "iisd", $orderId, $UserID, $paymentMode, $totalPurchaseValue);
    mysqli_stmt_execute($stmtPayment);
    mysqli_stmt_close($stmtPayment);

    // 3. Update item stock and sold count
    $productIDs = [];
    $quantities = [];
    foreach ($itemsDetails as $item) {
        $itemID = $item['ItemID'];
        $quantity = $item['quantity'];
        $orderQuantity += $quantity;

        $updateItemSQL = "UPDATE items SET quantity = quantity - ?, Solds = Solds + ? WHERE ItemID = ?";
        $stmtUpdateItem = mysqli_prepare($con, $updateItemSQL);
        mysqli_stmt_bind_param($stmtUpdateItem, "iii", $quantity, $quantity, $itemID);
        mysqli_stmt_execute($stmtUpdateItem);
        mysqli_stmt_close($stmtUpdateItem);

        $productIDs[] = $itemID;
        $quantities[] = $quantity;
    }

    // 4. Update order with product IDs and total quantity
    $productIDsStr = implode(',', $productIDs);
    $quantitiesStr = implode(',', $quantities);
    $updateOrderSQL = "UPDATE orders SET product_id = ?, order_quantity = ? WHERE order_id = ?";
    $stmtUpdateOrder = mysqli_prepare($con, $updateOrderSQL);
    mysqli_stmt_bind_param($stmtUpdateOrder, "sii", $productIDsStr, $orderQuantity, $orderId);
    mysqli_stmt_execute($stmtUpdateOrder);
    mysqli_stmt_close($stmtUpdateOrder);

    // 5. Clear cart
    $clearCartSQL = "DELETE FROM cart WHERE cart_id IN ($selectedItems) AND customer_id = ?";
    $stmtClearCart = mysqli_prepare($con, $clearCartSQL);
    mysqli_stmt_bind_param($stmtClearCart, "i", $UserID);
    mysqli_stmt_execute($stmtClearCart);
    mysqli_stmt_close($stmtClearCart);

    // Commit all changes
    mysqli_commit($con);
} catch (Exception $e) {
    // Rollback if any error occurs
    mysqli_rollback($con);
    die("Transaction failed: " . $e->getMessage());
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';
$mail = new PHPMailer(true);
try {
    $mail->SMTPDebug    = SMTP::DEBUG_SERVER;
    $mail->isSMTP();
    $mail->Host         = 'smtp.gmail.com';
    $mail->SMTPAuth     = true;
    $mail->Username     = 'noreply.thebookhaven@gmail.com';
    $mail->Password     = 'glyt mguu ymqy noks';
    $mail->SMTPSecure   = 'ssl';
    $mail->Port         = 465;
    $mail->setFrom("$email", 'West Med');
    $mail->addAddress("$email", '');
    $mail->isHTML(true);
    $getSelectedItemsQuery = "SELECT items.ItemID, items.ItemName, items.price, cart.quantity 
                         FROM cart 
                         INNER JOIN items ON cart.ItemID = items.ItemID 
                         WHERE cart.customer_id = ? AND cart.cart_id IN ($selectedItems)";
    $getSelectedItemsQuery = "SELECT items.ItemID, items.ItemName, items.ItemImage, cart.Quantity, items.Price
                         FROM cart
                         INNER JOIN items ON cart.ItemID = items.ItemID
                         WHERE cart.customer_id = ?
                         AND cart.cart_id IN ($selectedItems)";
    $stmt = mysqli_prepare($con, $getSelectedItemsQuery);
    mysqli_stmt_bind_param($stmt, "i", $UserID);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $items = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row['ItemName'];
    }
    $allitems = implode("<br> ", $items);
    $mail->Subject = 'Your Westmed Order Confirmation - Thank You for Your Purchase!';
    $mail->Body    = "
    Dear $FName,<br><br>
    Thank you for your recent purchase from Westmed! We are thrilled to have you as a customer. Your order has been successfully placed and is being processed.<br><br>
    <b>Order Details:</b><br>
    <ul>
        <li><b>Order Date:</b> " . date("Y-m-d") .
        "</li>
        <li><b>Shipping Address:</b>$address</li>
    </ul>
    <br>
    <b>Items Ordered:</b><br>
    $allitems
    <br><br>
    We will send you another email once your items have been shipped. In the meantime, you can track your order status by logging into your account on our website.<br><br>
    If you have any questions or need further assistance, please do not hesitate to contact our customer service team.<br><br>
    Thank you for choosing Westmed. We hope you enjoy your purchase!<br><br>
    Best regards,<br>
    The Westmed Team";
    $mail->AltBody = 'Thank you for your recent purchase from Westmed! Your order has been successfully placed and is being processed. We will send you another email once your items have been shipped. If you have any questions, please contact our customer service team. Thank you for choosing Westmed!';
    $clearCartQuery = "DELETE FROM cart WHERE cart_id IN ($selectedItems) AND customer_id = ?";
    $stmtClearCart = mysqli_prepare($con, $clearCartQuery);
    mysqli_stmt_bind_param($stmtClearCart, "i", $UserID);
    $resultClearCart = mysqli_stmt_execute($stmtClearCart);
    if (!$resultClearCart) {
        echo "Error clearing cart: " . mysqli_error($con);
    }
    $mail->send();
    echo '<script>window.location.href = "ordersuccessful.php";</script>';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
