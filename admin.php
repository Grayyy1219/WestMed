<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Admin</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/inventory.css">
    <link rel="stylesheet" href="css/dashboard.css">
    <link rel="icon" href="Image/logo.ico">


</head>
<?php
include("connect.php");
include("query.php");
echo "<style>
        body {
            background-color: $backgroundcolor;
        }
        .fade-overlay {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0), $backgroundcolor);
    </style>";
?>

<body>
    <?php include 'aheader.php'; ?>
    <section id="a_dashboard">
        <h1 class="dash_h1" style="font-size: 50px">Dashboard</h1>
        <?php include("dashboard.php"); ?>

    </section>
    <section id="page a_dashboard" style="min-height: 90vh;">
        <h1 class="dash_h1" style="font-size: 50px">Modify Page</h1>
        <dic class="center">

            <div class="wrapper1" id="page">

                <div class="pagetab">
                    <?php include("admineditpage.php"); ?>
                </div>
                <div class="ss1">
                    <div class="ss">
                        <?php
                        $slideNumbers = [1, 2, 3];
                        foreach ($slideNumbers as $slideNumber) {
                            $_SESSION["slide$slideNumber"] = "slide$slideNumber";
                            $slide = $_SESSION["slide$slideNumber"];
                            $query = mysqli_query($con, "select * from slideshow where imagename = '$slide'");
                            $row = mysqli_fetch_assoc($query);
                            $location = $row["imagelocation"];
                            echo "<p><img src='$location' width='500' onclick='openModal($slideNumber)'><br>Slide: $slideNumber</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </dic>

        <div id="myModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal()">&times;</span>
                <h2>Upload Image</h2>
                <form id="uploadForm" action="slide.php" method="post" enctype="multipart/form-data"
                    onsubmit="return adminpass2()">
                    <p>Slide number<input type=" text" name="slideindex" readonly style="border: none; font-size: 30px">
                    </p>
                    <p>New image: <img id="previewImage" src=""><input type="file" name="myfile" id="fileInput"
                            onchange="fileInputChanged()" style="display: none;"></p>
                    <input type="submit" name="submit" value="UPLOAD">
                </form>
            </div>
        </div>
        <div id="myModalpagetab" class="modal">
            <div class="modal-content">
                <span class="close" onclick="closeModal2()">&times;</span>
                <h2>Upload Image</h2>
                <form id="uploadFormPagetab" action="editpage.php" method="post" enctype="multipart/form-data"
                    onsubmit="return adminpass2()">
                    <p>Logo<input type="text" name="ItemID" readonly style="border: none; font-size: 30px ">
                    <p>New image:</p> <img id="previewImage2" src="" width="200"><input type="file" name="logo"
                        id="fileInput2" onchange="fileInputChanged2()" style="display: none;">
                    <input type="submit" name="logof" value="UPLOAD">
                </form>
            </div>
        </div>
    </section>
    <section id="inventory" style="min-height: 100vh;">
        <div class="wrapper" id="page">
            <?php include 'inventory.php'; ?>
        </div>
    </section>
    <section id="dashboard" class="wrapper">
        <?php include 'atrend.php'; ?>
        <br><br>
        <?php include 'atrend2.php'; ?>
        <br><br>
    </section>
    <script>
        function adminpass2() {
            var result = checkAdminPassword();

            if (result === true) {
                return true;
            } else if (result === "canceled") {
                alert("You Canceled.");
                return false;
            } else {
                // Code to execute if the password is incorrect
                alert("Incorrect password.");
                return false;
            }
        }

        function checkAdminPassword() {
            // Prompt the user for the admin password
            var enteredPassword = prompt("Enter Admin Password:");
            // Check if the entered password is correct
            if (enteredPassword === "<?php echo "$hashedadminpassword" ?>") {
                return true; // Password is correct
            } else if (enteredPassword === null) {
                return "canceled"; // User canceled the prompt
            } else {
                return false; // Incorrect password
            }
        }
    </script>
    <script src="acode.js"></script>
</body>