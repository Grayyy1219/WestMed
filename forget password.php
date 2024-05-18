<html>

<head>
    <meta charset="UTF-8" />
    <title>Project</title>
    <link rel="stylesheet" href="css/swiftieshopper.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/forget password.css">

</head>
<?php
include("connect.php");
include("query.php"); ?>

<body>
    <div class="header">
        <div class="navigation">
            <div class="nav">
                <a href="Landing page.php">
                    <div id="asd">
                        <img src="upload/page/logo.png" width="30" alt="Logo" />
                        <h2 class="Swiftie Shopper">WestMed</h2>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <div class="slideshow-container">
        <div class="container">
            <form action="forget.php" method="post">
                <h2>Forget Password</h2>
                <div class="input-text">
                    <input type="email" name="email" pattern=".*\.com" required>
                    <label>Enter your Email</label>
                </div>
                <button type="submit">Send Email</button>
                <div class="register">
                    <p>Don't have an account? <a href="Signup.php">Register</a></p>
                </div>
            </form>
        </div>
    </div>
   
</body>

</html>