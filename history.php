<?php
include("connect.php");
include("query.php");

$selectQuery = "SELECT items.*, orders.order_date, orders.order_quantity, orders.status
                FROM items
                JOIN orders ON items.ItemID  = orders.product_id
                WHERE orders.customer_id = '$UserID'  ORDER BY `orders`.`order_date` DESC";
$result = mysqli_query($con, $selectQuery);
?>

<html>

<head>
    <title></title>
    <link rel="stylesheet" href="css/global.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/borrow2.css">
    <link rel="icon" href="Image/logo.ico">
    <style>
        .penalty-form {
            margin-top: 10px;
        }

        .penalty-form label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        .penalty-form input {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        .penalty-form p {
            margin-bottom: 10px;
            font-size: 14px;
            color: #888;
        }

        .penalty-form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .penalty-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>

<body>
    <?php include("header.php");
    include("popups.php"); ?>
    <section>
        <div class="wrapper" id="w3">
            <h2>Purchase history</h2>
            <table>
                <tr>
                    <th>ID</th>
                    <th colspan="2">Product</th>
                    <th>Order Date</th>
                    <th>Delivery Date</th>
                    <th>Status</th>
                </tr>
                <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                    <tr id='book_row_<?= $row['ItemID'] ?>' class='<?= $row['returned'] ? 'returned-book' : '' ?>'>
                        <td>
                            <?= $row['ItemID'] ?>
                        </td>
                        <td><img src='<?= $row['ItemImage'] ?>' alt='<?= $row['ItemName'] ?>' width='50'></td>
                        <td>
                            <?= $row['ItemName'] ?>
                        </td>
                        <td>
                            <?php
                            $order_date = $row['order_date'];
                            $delivery_date = date('F j, Y', strtotime($order_date));
                            echo $delivery_date;
                            ?>
                        </td>
                        <td>
                            <?php
                            $order_date = $row['order_date'];
                            $delivery_date = date('F j, Y', strtotime($order_date . ' + 4 days'));
                            echo $delivery_date;
                            ?>
                        </td>
                        <td style="max-width: 40px;">
                            <?php
                            $current_date = date('F j, Y');
                            if ($delivery_date < $current_date) : ?>
                                <button type='submit' class='remove-button' name='remove_book'>Recived</button>
                            <?php else : ?>
                                <button type='submit' class='return-button' name='return_book'>On the way</button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        </div>
    </section>
</body>

</html>