<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Project</title>
    <link rel="stylesheet" href="css/swiftieshopper.css">
    <link rel="stylesheet" href="css/loginsignup.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">
</head>
<?php
include("connect.php");
?>

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
    <div class="bgdiv">
        <div class="frame">
            <div class="create-acxount-bg">
                <form action="" class="loginsignup" method="post" enctype="multipart/form-data">
                    <div class="login">
                        <div class="text-wrapper">Login</div>
                        <div class="name1">
                            <input class="input" placeholder="Username" name="user" type="text" />
                            <img class="img-2" src="img/user.svg" />
                        </div>
                        <div class="password1">
                            <input class="input" placeholder="Password" type="password" name="pass" />
                            <img class="img-2" src="img/lock.svg" />
                        </div>
                        <a href="forget password.php">
                            <div class="forget">
                                <div>Forget Password?</div>
                            </div>
                        </a>
                        <div class="div-wrapper">
                            <input class="text-wrapper-5" formaction="checkuser.php" type="submit" name="submit" value="LOG IN">
                        </div>
                    </div>
                </form>
            </div>
            <div class="sign-in">
                <div class="sign-content-wrapper">
                    <div class="sign-content">
                        <div class="text">
                            <div class="text-wrapper-4">Welcome Back!</div>
                            <p class="p">To keep connected with us please Login with your personal info</p>
                        </div>

                    </div>
                </div>
            </div>
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