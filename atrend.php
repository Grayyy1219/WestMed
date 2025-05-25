        <h1 class="dash_h1" style="font-size: 50px">Most Solds Products</h1>
        <?php
        include 'query.php';
        echo "<form action='' method='post' enctype='multipart/form-data' class='formtrend'>";
        $x = 1;

        $query = "SELECT * FROM items ORDER BY Solds DESC LIMIT 10";
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
                            <?php echo "$x. $shortenedTitle";
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