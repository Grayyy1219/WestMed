<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Project</title>
    <link rel="stylesheet" href="css/swiftieshopper.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
</head>
<?php
include("connect.php");
include("query.php");
echo "<style>
        body {
            background-color: $backgroundcolor;
        }
        .color, p,h2,h1, h3, h4, .subtitle, input{
            color: $color;
        }
        .fade-overlay {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0), $backgroundcolor);
    </style>";
?>
<body>
    <?php 
    if ($username != 0 && $block == 1) {
        echo '<script>alert("Your account has been blocked. \n Please contact your administrator for assistance.");</script>';
        echo"<script>window.location.href = 'logout.php';</script>";
 } ?>
    <?php include("header.php");?>
    <div class="slideshow-container">

        <div class="mySlides fade">
            <div class="numbertext"></div>
            <img src="<?= $slide1 ?>" style="width:100%">
        </div>

        <div class="mySlides fade">
            <div class="numbertext"></div>
            <img src="<?= $slide2 ?>" style="width:100%">
        </div>

        <div class="mySlides fade">
            <div class="numbertext"></div>
            <img src="<?= $slide3 ?>" style="width:100%">
        </div>

    </div>

    <div style="text-align:center">
        <span class="dot"></span>
        <span class="dot"></span>
        <span class="dot"></span>
    </div>

    <script>
        let slideIndex = 0;
        showSlides();

        function showSlides() {
            let i;
            let slides = document.getElementsByClassName("mySlides");
            let dots = document.getElementsByClassName("dot");
            for (i = 0; i < slides.length; i++) {
                slides[i].style.display = "none";
            }
            slideIndex++;
            if (slideIndex > slides.length) { slideIndex = 1 }
            for (i = 0; i < dots.length; i++) {
                dots[i].className = dots[i].className.replace(" active", "");
            }
            slides[slideIndex - 1].style.display = "block";
            dots[slideIndex - 1].className += " active";
            setTimeout(showSlides, 2000);
        }
    </script>
    <div id="shop">
        <div class="categories">
            <h1>Categories</h1>
        </div>
        <?php include("categories.php"); ?>
    </div>
    <div class="trenddiv">
        <div class="text-wrapper">Featured Products</div>
        <div class="imgtrend">
            <?php include("trend.php"); ?>
        </div>
    </div>
    
    <?php include("footer.php"); ?>
</body>
 <script>
        function submitForm(action) {
            document.getElementById("myForm").action = action;
            document.getElementById("myForm").submit();
        }
    </script>
</html>