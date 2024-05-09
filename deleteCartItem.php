<link rel="stylesheet" href="css/stylemain.css">
<?php
include 'connect.php';
include 'query.php';

// Check if the delete button is clicked
if (isset($_POST['deleteSelected'])) {
    $customerId = $UserID;

    // Delete selected items from the cart
    if (!empty($_POST['selectedItems'])) {
        $selectedItems = implode(',', $_POST['selectedItems']);
        $deleteItemsQuery = "DELETE FROM cart WHERE cart_id IN ($selectedItems) AND customer_id = $customerId";
        $result = mysqli_query($con, $deleteItemsQuery);

        if (!$result) {
            echo "Error deleting items: " . mysqli_error($con);
        } else {
            echo '<script>alert("Deleted successfully.");</script>';
            echo '<script>window.location.href = "cart.php";</script>';
        }
    } else {
        echo '<script>alert("No items selected to delete.");</script>';
        echo '<script>window.location.href = "cart.php";</script>';
    }
}


?>