<link rel="stylesheet" href="css/search.css">
<link rel="stylesheet" href="css/header.css">
<header>
    <a href="admin.php" class="ahead">
        <img src="Image\left-arrow.png" width="22">
        <h4>Go Back</h4>
    </a>
</header>
<?php
include 'connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $sql = "SELECT * FROM items";

    $stmt = $con->prepare($sql);

    if (!empty($params)) {
        $types = str_repeat("s", count($params));
        $stmt->bind_param($types, ...$params);
    }

    $stmt->execute();

    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows > 0) {
            echo "<h3>Search Results:</h3>";
            echo "<table border='1'>";
            echo "<tr><th>Item ID</th><th>Item Name</th><th>Category</th><th>ItemImage</th><th>Price</th><th>Solds</th><th>Quantity</th><th>Sell</th></tr>";
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>{$row['ItemID']}</td>";
                echo "<td>{$row['ItemName']}</td>";
                echo "<td>{$row['Category']}</td>";
                echo "<td><img src='{$row['ItemImage']}' height='50px'></td>";
                echo "<td>{$row['Price']}</td>";
                echo "<td>{$row['Solds']}</td>";
                echo "<td>{$row['Quantity']}</td>";
                echo "<td><button onclick='openPopup({$row['ItemID']}, {$row['Price']})'>Buy</button></td>";
                echo "</tr>";
            }

            echo "</table>";
        } else {
            echo "No results found.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<script>
    function openPopup(bookId, price) {
        var quantity = prompt("Enter Quantity:", "1");
        if (quantity !== null) {
            window.location.href = `purchaseItems3.php?selectedItems=${bookId}&Quantity=${quantity}&Price=${price}`;
        }
    }
</script>
