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
                        <img src="upload/page/logo.png"width="30" alt="Logo" />
                        <h2 class="Swiftie Shopper">Swiftie Shopper</h2>
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
    <footer>
        <div class="footer">
            <div class="all-footer">
                <div class="CUSTOMER-SERVICE">
                    <div class="text-wrapper">CUSTOMER SERVICE</div>
                    <div class="frame3">
                        <div class="list-item-link">
                            <div class="div">Payment Methods</div>
                        </div>
                        <div class="return-refund-wrapper">
                            <div class="return-refund">Return &amp; Refund</div>
                        </div>
                        <div class="div-wrapper">
                            <a href="contact.php">
                                <div class="text-wrapper-2">Contact Us</div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="div-2">
                    <div class="text-wrapper-3">ABOUT SWIFTIE SHOPPER</div>
                    <div class="frame-2">
                        <div class="list-item-link-2">
                            <a href="about.php">
                                <div class="text-wrapper-4">About Us</div>
                            </a>
                        </div>
                        <div class="list-item-link-3">
                            <div class="text-wrapper-5">Privacy Policy</div>
                        </div>
                        <div class="list-item-link-4">
                            <div class="text-wrapper-6">Flash Deals</div>
                        </div>
                    </div>
                </div>
                <div class="div-2">
                    <div class="text-wrapper-7">PAYMENT</div>
                    <div class="frame-3">
                        <div class="list-item">
                            <div class="link"></div>
                        </div>
                        <div class="list-item">
                            <div class="link-2"></div>
                        </div>
                        <div class="list-item">
                            <div class="link-3"></div>
                        </div>
                        <div class="list-item">
                            <div class="link-4"></div>
                        </div>
                        <div class="list-item">
                            <div class="link-5"></div>
                        </div>
                    </div>
                </div>
                <div class="LOGISTICS">
                    <div class="text-wrapper-8">LOGISTICS</div>
                    <div class="frame-4">
                        <div class="list-item">
                            <div class="link-ph"></div>
                        </div>
                        <div class="list-item">
                            <div class="link-6"></div>
                        </div>
                        <div class="list-item">
                            <div class="link-7"></div>
                        </div>
                        <div class="list-item">
                            <div class="link-8"></div>
                        </div>
                        <div class="list-item">
                            <div class="link-9"></div>
                        </div>
                        <div class="list-item">
                            <div class="link-10"></div>
                        </div>
                    </div>
                </div>
                <div class="FOLLOW-US">
                    <div class="text-wrapper-9">FOLLOW US</div>
                    <div class="facebook">
                        <div class="eabe"></div>
                        <div class="span-facebook">
                            <a href="https://www.facebook.com/leoneilmae.reyes">
                                <div class="text-wrapper-10">Facebook</div>
                            </a>
                        </div>
                    </div>
                    <div class="instagram">
                        <div class="e"></div>
                        <div class="span-instagram">
                            <a href="https://www.instagram.com/_mae_reyes_/">
                                <div class="text-wrapper-11">Instagram</div>
                            </a>
                        </div>
                    </div>
                    <div class="twitter">
                        <div class="c"></div>
                        <div class="span-twitter">
                            <div class="text-wrapper-12">Twitter</div>
                        </div>
                    </div>
                    <div class="linked-in">
                        <div class="element"></div>
                        <div class="span-linkedin">
                            <div class="text-wrapper-13">LinkedIn</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="div-dmgodq">
                <p class="p">COPYRIGHT 2023 © Swiftie Shopper</p>
            </div>
        </div>
    </footer>
</body>

</html>