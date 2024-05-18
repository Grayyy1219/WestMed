<style>
    .div-282 {
        /* display: flex; */
        cursor: pointer;
        margin-top: 25px;
        border-radius: 4px;
        border: 1px solid #1E9AFE;
        padding: 11px 45px;
    }

    .div-282:hover {
        background-color: #1E9AFE;
        color: white;
    }
</style>


<?php
include 'query.php';
// echo "<form action='' method='post' enctype='multipart/form-data' class='formtrend'>";
$x = 1;

$query = "SELECT * FROM items ORDER BY Solds DESC LIMIT 5";
$result = mysqli_query($con, $query);

if ($result && mysqli_num_rows($result) > 0):
    ?>
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
        <?php
        $ItemID = $row['ItemID'];
        $ItemName = $row['ItemName'];
        $category = $row['Category'];
        $ItemImage = $row['ItemImage'];
        $Price = $row['Price'];
        $Solds = $row['Solds'];
        $Quantity = $row['Quantity'];
        $shortenedTitle = (strlen($row['ItemName']) > 78) ? substr($row['ItemName'], 0, 78) . '...' : $row['ItemName'];
        ?>
        <div class="img"><img src="<?php echo $ItemImage; ?>"></div>
        <?php echo "<div class='itemcard'>
            <div><b>No.$x</b></div>
                <a href=''><img src='{$ItemImage}' width='200'></a>
                <p><strong>{$shortenedTitle}</strong></p>
                <br><br>
                <p style='font-size: small'>{$Solds} Solds!</p><br>
                <h4>₱{$Price}</h4>
                <form action='' id='myForm' method='post' enctype='multipart/form-data'>
                <div class='div-282' onclick=\"submitForm('itempage.php?Itemname=$ItemName&Category=$category&ItemImage=$ItemImage&Price=$Price&Solds=$Solds&Quantity=$Quantity&ItemID=$ItemID')\">
                </form>
            <input type='submit' style='all:unset' class='div-29' value='Add to cart'>
        </div>
            </div>";
        $x++ ?>

    <?php endwhile; ?>
<?php
else:
    echo "Error fetching the most sold items from the database: " . mysqli_error($con);
endif;
?>