<link rel="stylesheet" href="css/page.css">

<form action="" id="myForm" method="get" enctype="multipart/form-data">
    <?php
    if (!isset($_GET['page'])) {
        $_GET['page'] = 1;
    }
    if (!isset($_GET['category'])) {
        exit("Category not set");
    }

    $category = $_GET['category'];
    $currentPage = (int)$_GET['page'];

    // Default items per page
    $imagesPerPage = isset($_GET['limit']) ? (int)$_GET['limit'] : 8;
    $validLimits = [4, 6, 8, 12, 16, 24];
    if (!in_array($imagesPerPage, $validLimits)) {
        $imagesPerPage = 8;
    }

    $startIndex = ($currentPage - 1) * $imagesPerPage;

    // Get category info
    $queryUser = mysqli_query($con, "SELECT * FROM category WHERE ItemCategory = '$category'");
    $rowUser2 = mysqli_fetch_assoc($queryUser);

    echo "<div id='shop'>
        <div style='margin: 25px 20% 0 auto;display: flex;gap: 10px;background: #e7e7e7;padding: 10px;border-radius: 5px;border: solid 0.5px #b3b3b3; align-items: center;;'>
            <label for='limit'>Show: </label>
            <select name='limit' id='limit' onchange='this.form.submit()'>
";

    foreach ($validLimits as $limit) {
        $selected = ($limit == $imagesPerPage) ? "selected" : "";
        echo "<option value='$limit' $selected>$limit</option>";
    }
    echo "</select>
        <input type='hidden' name='category' value='$category'>
        <input type='hidden' name='page' value='1'>
        </div>";

    echo "<div class='shop'>";

    // Prepare item query
    $stmt = $con->prepare("SELECT * FROM items WHERE category = ? ORDER BY ItemName LIMIT ?, ?");
    $stmt->bind_param("sii", $category, $startIndex, $imagesPerPage);
    $stmt->execute();
    $result = $stmt->get_result();

    while ($row = $result->fetch_assoc()) {
        $ItemID = $row["ItemID"];
        $ItemName = $row["ItemName"];
        $category = $row["Category"];
        $ItemImage = $row["ItemImage"];
        $Price = $row["Price"];
        $Solds = $row["Solds"];
        $Quantity = $row["Quantity"];
        $Description = $row["description"];

        $shortenedTitle = (strlen($ItemName) > 78) ? substr($ItemName, 0, 78) . '...' : $ItemName;

        echo "<div class='itemcard'>
            <img src='{$ItemImage}' width='200'>
            <strong style='text-align: center;margin: 10px 0 0;'>{$shortenedTitle}</strong>
            <p style='font-size: small'>Stocks {$Quantity}</p><br>
            <h4>₱{$Price}</h4>
           <div class='div-282' onclick=\"submitForm('itempage.php?Itemname=$ItemName&Category=$category&ItemImage=$ItemImage&Price=$Price&Solds=$Solds&Quantity=$Quantity&ItemID=$ItemID&Description=$Description')\">
                <input type='submit' style='all:unset' class='div-29' value='Add to cart'>
            </div>
        </div>";
    }

    // Pagination
    $totalRecords = mysqli_num_rows(mysqli_query($con, "SELECT * FROM items WHERE category = '$category'"));
    $totalPages = ceil($totalRecords / $imagesPerPage);

    echo "</div><br><br><div id='pagination-container_category' class='pageno'><b>Page: </b>";

    for ($i = 1; $i <= $totalPages; $i++) {
        $activeClass = ($i == $currentPage) ? 'active' : '';
        echo "<a class='pagination-link $activeClass' href='?category=$category&page=$i&limit=$imagesPerPage'>$i</a>";
    }

    echo "</div> <br><br>";
    ?>
</form>

<script>
    function submitForm(action) {
        document.getElementById("myForm").action = action;
        document.getElementById("myForm").submit();
    }
</script>