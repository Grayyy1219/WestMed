<?php

// Fetch available genres from the database
$genreQuery = "SELECT DISTINCT ItemCategory  FROM category";
$genreResult = mysqli_query($con, $genreQuery);
$genres = [];

while ($genreRow = mysqli_fetch_assoc($genreResult)) {
    $genres[] = $genreRow['ItemCategory'];
}

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$items_per_page = 10;
$offset = ($page - 1) * $items_per_page;

$filterGenre = isset($_GET['filterGenre']) ? $_GET['filterGenre'] : 'all';

$query = "SELECT * FROM items";

if ($filterGenre !== 'all') {
    $query .= " WHERE Category = '$filterGenre'";
}

$query .= " LIMIT $offset, $items_per_page";

$result = mysqli_query($con, $query);
?>
<h1 class="dash_h1" style="font-size: 50px">Inventory Management</h1>


<form id="filter-form" action="#" method="get">
    <label for="filterGenre">Genre:</label>
    <select name="filterGenre" id="filterGenre">
        <option value="all" <?= ($filterGenre == 'all') ? 'selected' : '' ?>>All Category</option>
        <?php foreach ($genres as $genre): ?>
            <option value="<?= $genre ?>" <?= ($filterGenre == $genre) ? 'selected' : '' ?>>
                <?= $genre ?>
            </option>
        <?php endforeach; ?>
    </select>

    <input type="submit" value="Apply Filter">
</form>
<div id="Add">
    <a href="editgenre.php">
        <button class="Add">Category</button>
    </a>
    <form action="search.php" method="post">
        <input type="submit" class="Add" value="Sell">
    </form>
    <a href="add_book_form.php">
        <button class="Add">Add Products</button>
    </a>
</div>


<table id="inventory-table">

    <tr>
        <th>ID</th>
        <th>Product Name</th>
        <th>Cover</th>
        <th>Price</th>
        <th>Stock</th>
        <th>Action</th>
        <th>Select</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <?php $bookId = $row['ItemID'] ?>
        <tr>
            <td>
                <?= $bookId ?>
            </td>
            <td style="min-width: 680px;">
                <?= (strlen($row['ItemName']) > 45) ? rtrim(wordwrap($row['ItemName'], 45, '<br>', true), '<br>') : $row['ItemName']; ?>
            </td>
            <td><img class="product-image" src='<?= $row['ItemImage'] ?>' alt='Product Image' style='height: 80px;'>
            </td>
            <td>
                <?= $row['Price'] ?>
            </td>
            <td>
                <button class="adjust" data-productid="<?= $bookId ?>" data-change="-1">-</button>
                <input type='text' class='quantity' id='quantity<?= $bookId ?>' value='<?= $row['Quantity'] ?>'>
                <button class="adjust" data-productid="<?= $bookId ?>" data-change="1">+</button><br>
            </td>
            <td>
                <a href="edititem.php?bookId=<?= $bookId ?>"><button class="edit" type="submit">Edit</button></a>
                <?php echo "<input class='edit' type='submit' onclick='openPopup({$row['ItemID']}, {$row['Price']})' value='Buy'>" ?>
            </td>
            <td style="min-width: 86px;">
                <input type="checkbox" class="delete-checkbox" data-productid="<?= $bookId ?>">
            </td>
        </tr>
    <?php endwhile; ?>

</table>
<div id="delete">
    <button class="delete" onclick="deleteSelectedRows()">Delete Selected</button>
</div>

<div class="pagination">
    <p><b>Page:</b></p>
    <?php

    $total_rows_query = "SELECT COUNT(*) as total FROM items";

    // Include genre filter in total rows query if it's not 'all'
    if ($filterGenre !== 'all') {
        $total_rows_query .= " WHERE Category = '$filterGenre'";
    }

    $total_result = mysqli_query($con, $total_rows_query);
    $total_rows = mysqli_fetch_assoc($total_result)['total'];


    $total_pages = ceil($total_rows / $items_per_page);

    for ($i = 1; $i <= $total_pages; $i++) {
        $selectedClass = ($i == $page) ? 'selected-page' : '';
        echo "<a class='pageno $selectedClass' href='javascript:void(0);' onclick='loadPage(\"$i\")'>$i</a> ";
    }
    ?>
</div>
<script src="jquery-3.6.4.min.js"></script>
<script>
    function openPopup(bookId, price) {
        var quantity = prompt("Enter Quantity:", "1");
        if (quantity !== null) {
            window.location.href = `purchaseItems3.php?selectedItems=${bookId}&Quantity=${quantity}&Price=${price}`;
        }
    }

    function loadPage(page) {

        var filterGenreValue = $("#filterGenre").val();

        $.ajax({
            url: '?page=' + page + '&filterGenre=' + filterGenreValue,
            type: 'GET',
            success: function(data) {
                var parsedData = $(data);
                $('#inventory-table').html(parsedData.find('#inventory-table').html());
                $('.pagination').html(parsedData.find('.pagination').html());
            },
            error: function(xhr, status, error) {
                console.error("AJAX Error: " + status + " - " + error);
            }
        });
    }
    $(document).ready(function($) {
        $("#filter-form").submit(function(event) {
            event.preventDefault();
            loadFilteredData();
        });
        document.addEventListener("click", function(event) {
            if (event.target.classList.contains("adjust")) {
                adjustStock(event.target.dataset.productid, parseInt(event.target.dataset.change));
            } else if (event.target.classList.contains("update")) {
                addStock(event.target.dataset.productid);
            }
        });

        function adjustStock(productId, change) {
            var quantityField = document.getElementById("quantity" + productId);
            var currentQuantity = parseInt(quantityField.value);
            if (currentQuantity + change >= 0) {
                var newQuantity = currentQuantity + change;
                quantityField.value = newQuantity;
                updateStockInDatabase(productId, newQuantity);
            }
        }

        function addStock(productId) {
            var quantityField = document.getElementById("quantity" + productId);
            var quantityToAdd = parseInt(quantityField.value);
            updateStockInDatabase(productId, quantityToAdd, true);
        }

        function updateStockInDatabase(productId, newQuantity, showAlert) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4) {
                    if (xhr.status == 200) {
                        console.log(xhr.responseText);
                        if (showAlert) {
                            alert("Successfully updated stocks!");
                        }
                    } else {
                        console.error("Error updating stocks.");
                    }
                }
            };
            var params = "productId=" + productId + "&newQuantity=" + newQuantity;
            xhr.open("POST", "update_stock.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.send(params);
        }

        function loadFilteredData() {

            var filterGenreValue = $("#filterGenre").val();

            $.ajax({
                url: '?page=1&filterGenre=' + filterGenreValue,
                type: 'GET',
                success: function(data) {
                    var parsedData = $(data);
                    $('#inventory-table').html(parsedData.find('#inventory-table').html());
                    $('.pagination').html(parsedData.find('.pagination').html());
                },
                error: function(xhr, status, error) {
                    console.error("AJAX Error: " + status + " - " + error);
                }
            });
        }
        $(document).on("click", ".delete", function() {
            deleteSelectedRows();
        });

        function deleteSelectedRows() {
            console.log("deleteSelectedRows function called");
            var selectedProductIds = [];

            // Find all checkboxes that are checked
            $(".delete-checkbox:checked").each(function() {
                selectedProductIds.push($(this).attr("data-productid"));
            });

            if (selectedProductIds.length > 0) {
                // Call a PHP script to handle the deletion on the server side
                $.ajax({
                    url: "delete_books.php",
                    type: "POST",
                    data: {
                        productIds: selectedProductIds
                    },
                    success: function(data) {
                        // Remove the deleted rows from the HTML
                        $(".delete-checkbox:checked").closest("tr").remove();

                        alert("Selected Category deleted successfully!");
                    },
                    error: function(xhr, status, error) {
                        console.error("AJAX Error: " + status + " - " + error);
                    }
                });
            } else {
                alert("No books selected for deletion.");
            }
        }

    });
</script>