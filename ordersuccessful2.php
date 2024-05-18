<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/stylemain.css">
    <link rel="stylesheet" href="css/borrow.css">
    <link rel="stylesheet" href="css/header.css">
    <title>Order Success</title>
    <style>
    
        #img {
            max-width: 300px;
            height: auto;
        }

        .success-message {
            margin-top: 20px;
            font-size: 20px;
            color: green;
        }

        #home-link {
            display: block;
            margin-top: 20px;
            text-decoration: none;
            background-color: #1E9AFE;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
        }
    </style>
</head>

<body>
    <?php
    include 'connect.php';
    session_start();
    include 'query.php';
    include("header.php");
    include("popups.php");
    ?>
    <section class="wrapper" id="w1">
        <?php
        $selectedItems = $_SESSION['selectedItems'];
        $Quantity = $_SESSION['Quantity'];
        $totalPurchaseValue = $_SESSION['Price'];
        $getSelectedItemsQuery = "SELECT ItemID, ItemName, ItemImage, Quantity, Price FROM items WHERE ItemId = $selectedItems";
        $result = mysqli_query($con, $getSelectedItemsQuery);
        while ($row = mysqli_fetch_assoc($result)) {
            $bookTitle = $row['ItemName'];
        }

        $confirmationMessage = "Thank you for Buying!<br>$bookTitle<br>Price: $totalPurchaseValue.00<br><br>Happy Shopping!<br>Thank you for choosing Swiftie Shopper.";

        if (!$result) {
            echo "Error retrieving selected items: " . mysqli_error($con);
            exit();
        }
        if (!empty($confirmationMessage)) {
            echo "<h1>Confirmation</h1>";
            echo "<p class='p2'>$confirmationMessage</p>";
        }
        ?>
        <br>
        <br>
        <div class="btnb">
            <a href="Landing page.php"><button>Home</button></a>
        </div>
    </section>

</body>

</html>