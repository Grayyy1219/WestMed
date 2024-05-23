<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Category Information</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/stylemain.css">
    <link rel="stylesheet" href="css/edititem.css">
</head>

<body>
    <header>
        <a href="javascript:history.go(-1);" class="ahead">
            <img src="Image\left-arrow.png" width="22">
            <h4>Go Back</h4>
        </a>
    </header>

    <?php
    include 'connect.php';

    function getBookDetails($con, $bookId)
    {
        $sql = "SELECT * FROM items WHERE ItemID = ?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("i", $bookId);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    function updateBookDetails($con, $bookId, $title, $genre, $bookImage, $price, $solds)
    {
        $sql = "UPDATE items SET ItemName=?, Category=?, ItemImage=?,  Price=?, Solds=? WHERE ItemID =?";
        $stmt = $con->prepare($sql);
        $stmt->bind_param("sssidi", $title, $genre, $bookImage, $price, $solds, $bookId);
        $stmt->execute();

        if ($stmt->errno) {
            echo "Error updating record: " . $stmt->error;
        } else {
            echo "<script>alert('Item updated successfully!');</script>";
            echo "<script>window.location.href = 'admin.php#inventory';</script>";
        }

        $stmt->close();
    }

    // Handle form submission
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $bookId = isset($_POST["bookId"]) ? $_POST["bookId"] : '';
        $title = isset($_POST["title"]) ? $_POST["title"] : '';
        $genre = isset($_POST["genre"]) ? $_POST["genre"] : '';
        $price = isset($_POST["price"]) ? $_POST["price"] : '';
        $solds = isset($_POST["solds"]) ? $_POST["solds"] : '';

        if (isset($_FILES['bookImage']) && $_FILES['bookImage']['size'] > 0) {
            $name = $_FILES['bookImage']['name'];
            $tmp_name = $_FILES['bookImage']['tmp_name'];
            $location = "upload/items/$name";
            if (move_uploaded_file($tmp_name, $location)) {
                $bookImage = $location;  // Update $bookImage with the new file path
            } else {
                echo "Error uploading file.";
                exit;
            }
        } else {
            // No new image uploaded, retain the previous image path
            $bookDetails = getBookDetails($con, $bookId);
            $bookImage = $bookDetails['ItemImage'];
        }

        // Additional validation can be added here for other form fields.

        updateBookDetails($con, $bookId, $title, $genre, $bookImage, $price, $solds);
    }

    $bookId = isset($_GET["bookId"]) ? $_GET["bookId"] : '';
    $bookDetails = getBookDetails($con, $bookId);

    if ($bookDetails) {
        $genreQuery = "SELECT DISTINCT ItemCategory  FROM category";
        $genreResult = mysqli_query($con, $genreQuery);
        $genres = [];
        while ($genreRow = mysqli_fetch_assoc($genreResult)) {
            $genres[] = $genreRow['ItemCategory'];
        }
    ?>
        <section>
            <div class="wrapper" id="w3">
                <h2 style="font-size: 30px;">Edit Category Information</h2><br>
                <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" enctype="multipart/form-data">
                    <div class="weditimg" style="width: unset">
                        <?php
                        echo "<img id='profileImage' style='width: unset' src='" . htmlspecialchars($bookDetails['ItemImage']) . "' alt=''>";
                        ?>
                        <label class="btn-upload-img">
                            Upload Item Image <input type="file" id="img" name="bookImage" accept="image/*">
                        </label>
                    </div>
                    <input type="hidden" name="bookId" value="<?php echo htmlspecialchars($bookDetails['ItemID']); ?>">
                    Name: <input type="text" name="title" value="<?php echo htmlspecialchars($bookDetails['ItemName']); ?>"><br>
                    Description: <input type="text" name="title" value="<?php echo htmlspecialchars($bookDetails['description']); ?>"><br>
                    Category: <select name="genre" id="genre">
                        <?php foreach ($genres as $genre) : ?>
                            <option value="<?= htmlspecialchars($genre) ?>" <?php echo ($bookDetails['Category'] == $genre) ? 'selected' : ''; ?>>
                                <?= htmlspecialchars($genre) ?>
                            </option>
                        <?php endforeach; ?>
                    </select><br>

                    Price: <input type="text" name="price" value="<?php echo htmlspecialchars($bookDetails['Price']); ?>"><br>
                    Solds: <input type="text" name="solds" value="<?php echo htmlspecialchars($bookDetails['Solds']); ?>"><br>
                    <input type="submit" value="Update">
                </form>
            </div>
        </section>
        <script>
            document.getElementById('img').addEventListener('change', function(event) {
                const fileInput = event.target;
                const profileImage = document.getElementById('profileImage');

                const file = fileInput.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        profileImage.src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                }
            });
        </script>
    <?php
    } else {
        echo "Book not found";
    }
    ?>
</body>

</html>