<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title>Project</title>
    <link rel="stylesheet" href="css/WestMed.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/header.css">

    <style>
    * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: "open sans", sans-serif;
} 
body{
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            padding: 0 10px;
        }
        body::before{
            content: "";
            position: absolute;
            width: 100%;
            height: 100%;     
            background: url(css/img/bglog.jpg); 
            background-position: center;    
            background-size: cover;  
        }
.container{
   width: 400px;
    border-radius: 8px;
    padding: 30px;
    text-align: center;
    border: 1px solid rgba(255,255,255,0.15);
    backdrop-filter: blur(15px);
    --webkit- -webkit-backdrop-filter: blur(15px);
}
   .product-item {
  display: flex;
  align-items: center;
  margin-bottom: 20px;
}

.product-item img {
  width: 143px;
  height: 410px;
  object-fit: cover;
  margin-right: 15px;
}

.product-info {
  flex-grow: 1;
}

.product-info h3 {
  font-size: 18px;
  margin-bottom: 5px;
  color: #fff;
}

.product-info p {
  font-size: 14px;
  color: #b9a0d1;
}

.price {
  font-weight: bold;
  color: #fff;
}

.add-to-cart {
  background-color: #fff;
  color: #b9a0d1;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
}
  </style>
</head>
<?php
include("connect.php");
include("query.php");?>
<body>
    <?php include("header.php");?>
    <div class="slideshow-container">
        <div class="container">
        <div class="product-item">
        <img src="img/dress1.png" alt="Product image">
        <div class="product-info">
          <h3>Fur Fringe Dress</h3>
          <p>SKU: 3F844AAFDFA9B7GS 
          <br> Color: Fuchsia
          <br>Neck: One Shoulder
<br>Pattern: Solid
<br>Length: Midi
<br>Type: Shift
<br>Fitting: Slim fit
<br>Style: Sexy</p>
          <h4 class="price">₱3,769</h4>
          <button class="add-to-cart">Add to Cart</button>
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