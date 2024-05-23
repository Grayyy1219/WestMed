<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Cart</title>
    <link rel="stylesheet" href="css/swiftieshopper.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/cart.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f5f5f5;
            margin: 0;
            padding: 0;
        }

        section {
            padding: 20px;
        }

        .wrapper {
            width: 80%;
            margin: 0 auto;
        }

        .checkout-container {
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .item-summary {
            padding: 15px;
            border-bottom: 1px solid #ddd;
            display: flex;
            align-items: center;
        }

        .item-image {
            max-width: 100px;
            max-height: 100px;
            margin-right: 15px;
            border-radius: 8px;
        }

        .checkout-button {
            text-align: center;
            padding: 20px;
        }

        button {
            font-weight: bold;
            font-size: 20px;
            background-color: forestgreen;
            color: white;
            padding: 15px 30px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: darkgreen;
        }

        p {
            margin: 10px 0;
        }

        p.total-purchase-value {
            font-weight: bold;
            font-size: larger;
            color: green;
        }

        .cart-item-details input {
            width: 50px;
            text-align: center;
        }
    </style>
</head>

<?php
include 'connect.php';
include 'query.php';
$getCartItemsQuery = "SELECT cart.cart_id, items.ItemID, items.ItemName, items.ItemImage, cart.quantity, items.price
                     FROM cart
                     INNER JOIN items ON cart.ItemID = items.ItemID
                     WHERE cart.customer_id = $UserID";
$result = mysqli_query($con, $getCartItemsQuery);
?>

<body>
    <?php
    include("header.php");
    include("popups.php");
    ?>
    <section class="wrapper">
        <div class="body2">
            <h1>Your Cart</h1>
            <div class="cart-container">
                <form method="post" action="" id="cartForm" enctype="multipart/form-data">
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        $totalPrice = $row['quantity'] * $row['price'];
                    ?>
                        <div class="cart-item">
                            <input type="checkbox" name="selectedItems[]" value="<?= $row['cart_id']; ?>" onchange="updateTotal(this)">
                            <img src="<?= $row['ItemImage']; ?>" alt="Product Image" class="cart-item-image">
                            <div class="cart-item-details">
                                <p><?= $row['ItemName']; ?></p>
                                <p>Quantity:
                                    <input type="number" name="quantity[]" value="<?= $row['quantity']; ?>" min="1" data-price="<?= $row['price']; ?>" data-cart-id="<?= $row['cart_id']; ?>" onchange="updateQuantity(this)">
                                </p>
                                <p class='total-price'>Total Price: PHP <span><?= $totalPrice; ?></span></p>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <div class="cart-total">
                        <button type="submit" name="deleteSelected" formaction="deleteCartItem.php" onclick="return confirmAction()">Remove Selected</button>
                        <button type="submit" name="buySelected" formaction="processCartAction.php">Buy Now</button>
                        <p>Total Selected Item Price: PHP <span id="totalCartValue">0.00</span></p>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <script>
        function confirmAction() {
            var checkboxes = document.getElementsByName('selectedItems[]');
            var checkedBoxes = Array.from(checkboxes).filter(checkbox => checkbox.checked);

            if (checkedBoxes.length === 0) {
                alert("Please select an item to proceed to checkout.");
                return false;
            } else {
                return confirm("Would you like to confirm the deletion of selected items?");
            }
        }

        function updateTotal(checkbox) {
            var checkboxes = document.getElementsByName('selectedItems[]');
            var total = 0;

            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    var totalPriceElement = checkbox.closest('.cart-item').querySelector('.total-price span');
                    total += parseFloat(totalPriceElement.textContent);
                }
            });

            document.getElementById('totalCartValue').textContent = total.toFixed(2);
        }

        function updateQuantity(input) {
            var quantity = input.value;
            var price = input.dataset.price;
            var cartId = input.dataset.cartId;
            var totalPriceElement = input.closest('.cart-item').querySelector('.total-price span');
            var newTotalPrice = quantity * price;

            totalPriceElement.textContent = newTotalPrice.toFixed(2);

            var checkboxes = document.getElementsByName('selectedItems[]');
            checkboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    updateTotal(checkbox);
                }
            });

            // Send AJAX request to update quantity in database
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "updateQuantity.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    console.log(xhr.responseText); // Handle the response from the server
                }
            };
            xhr.send("cart_id=" + cartId + "&quantity=" + quantity);
        }
    </script>
</body>

</html>