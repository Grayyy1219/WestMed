<h2>Least Solds Products</h2>
<?php
include 'query.php';
echo "<form action='' method='post' enctype='multipart/form-data' class='formtrend'>";
$x = 1;

$query = "SELECT * FROM items ORDER BY Solds ASC , ItemID DESC LIMIT 5";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0):
    ?>
    <div class='books'>
        <?php while ($row = mysqli_fetch_assoc($result)): ?>
            <?php
            $Title = $row['ItemName'];
            $Genre = $row['Category'];
            $BookImage = $row['ItemImage'];
            $Price = $row['Price'];
            $Solds = $row['Solds'];
            $Quantity = $row['Quantity'];
            $shortenedTitle = (strlen($row['ItemName']) > 78) ? substr($row['ItemName'], 0, 78) . '...' : $row['ItemName'];
            ?>
            <div class='book'>
                <img class='book-image' src='<?php echo $row['ItemImage']; ?>'>
                <h2 class='book-title'>
                    <?php echo "$shortenedTitle";
                    $x++; ?>
                </h2>
                <p class='book-author'>
                    <!-- <?php echo $row['Author']; ?> -->
                </p>
                <p class='book-author'>
                    <?= "Solds"; ?>
                    <?php echo $row['Solds']; ?>
                </p>
            </div>
        <?php endwhile; ?>
    </div>
    <?php
else:
    echo "Error fetching the most sold books from the database: " . mysqli_error($con);
endif;
echo "</form>";
?>