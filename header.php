<header>
    <div class="header">
        <a href="Landing page.php">
            <div class="heading">
                <div class="logo-png"><img src="<?= $logo ?>" width="50"></div>
                <div class="text-wrapper"><?= $companyname ?></div>
            </div>
        </a>
        <div class="search">
            <div class="overlap-group">
                <div class="div-shopee-searchbar">
                    <input class="searchbox" id="searchbar" type="text" placeholder="Search">
                </div>
                <img class="button" src="img\button.svg" />
            </div>
        </div>
        <div class="frame1">
            <a href="cart.php"><img class="button-link-SVG" src="img\button-link-svg.svg" /></a>
            <?php
            if ($username == "0") {
                echo "<div class='list'>
                    <div class='link'>
                        <div class='text-wrapper-2'><a href='Signup.php'>Sign In</a></div>
                    </div>
                    <div class='div-navbar-link'></div>
                    <div class='div-wrapper'>
                        <div class='text-wrapper-2'><a href='Login.php'>Log In</a></div>
                    </div>
                </div>";
            } else {
                echo "<a href='#' onclick='showSettingsPopup()'><div class='profile'>
                    <img src='$location' width='40' height='40' id='currentuser'>
                    <div id='inout'>
                       <p class='name'><b>$FName</b></p>
                    </div>
                </div></a>";
                if ($verification != 1) {
                    echo " <a href='mail.php'>
                                    <div class='inbtn'>
                                        <p>Verifiy Account</p>
                                    </div>
                                    </a>";
                }
            }
            ?>
        </div>
    </div>
    <div class="output" style="display: none;">
        <div id="demo">
        </div>
    </div>
</header>



<div class="popup-overlay"></div>
<div id="spopup-overlay"></div>
<div id="SettingsPopup" class="spopup">
    <div class="popup-content">
        <span class="close" onclick="closeSettingsPopup()"><b>&times;</b></span>
        <div class="sdiv">
            <form action="" class="settings" method="post" enctype="multipart/form-data">
                <?php
                echo "<div class='profileimg'><p><img  src='$location' width='200 height='200'></p><br><br>";
                echo "<p class='name'><b>" . $FName . "</b></p>";
                echo "<p class='emaillink'>" . $address . "</p>";
                echo "<p class='emaillink'>" . $phone . "</p></div>";
                ?>

                <div class="ssbuttons">
                    <a href="edituser.php">
                        <div class="inbtn">
                            <p>Edit Basic Information</p>
                        </div>
                    </a>
                    <a href="editpass.php">
                        <div class="inbtn">
                            <p>Change Password</p>
                        </div>
                    </a>
                    <a href="history.php">
                        <div class="inbtn">
                            <p>Purchase history </p>
                        </div>
                    </a>
                    <br><br>
                    <a href="logout.php">
                        <div class="inbtn">
                            <input type="submit" formaction="logout.php" name="submit" value="Log Out">
                        </div>
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    function openPopup(popupId) {
        // Close any open popups and overlay with fade-out effect
        var openElements = document.querySelectorAll('.popup, .popup-overlay');
        openElements.forEach(function(element) {
            element.style.opacity = 0;
            setTimeout(function() {
                element.style.display = 'none';
            }, 150);
        });

        // Open the selected popup and overlay with fade-in effect
        var overlay = document.querySelector('.popup-overlay');
        var popup = document.getElementById(popupId);
        setTimeout(function() {
            overlay.style.display = 'block';
            popup.style.display = 'block';
            setTimeout(function() {
                overlay.style.opacity = 1;
                popup.style.opacity = 1;
            }, 10);
        }, 150);
    }

    function closePopup(popupId) {
        // Close the popup and overlay with fade-out effect
        var elementsToClose = document.querySelectorAll('.popup, .popup-overlay');
        elementsToClose.forEach(function(element) {
            element.style.opacity = 0;
            setTimeout(function() {
                element.style.display = 'none';
            }, 300);
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        var loginBtn = document.querySelector('.loginb');
        var signupBtn = document.querySelector('.signupb');
        var sloginBtn = document.querySelector('.sloginb');
        var ssignupBtn = document.querySelector('.ssignupb');
        loginBtn.addEventListener('click', function() {
            openPopup('LoginPopup');

        });

        signupBtn.addEventListener('click', function() {
            openPopup('SignupPopup');
        });
        sloginBtn.addEventListener('click', function() {
            openPopup('LoginPopup');

        });
        ssignupBtn.addEventListener('click', function() {
            openPopup('SignupPopup');
        });
    });

    function closeLoginPopup() {
        document.getElementById('LoginPopup').style.display = 'none';
        var overlay = document.querySelector('.popup-overlay');
        overlay.style.opacity = 0;
        setTimeout(function() {
            overlay.style.display = 'none';
        }, 300);
    }

    function closeSignupPopup() {
        document.getElementById('SignupPopup').style.display = 'none';
        var overlay = document.querySelector('.popup-overlay');
        overlay.style.opacity = 0;
        setTimeout(function() {
            overlay.style.display = 'none';
        }, 300);
    }

    function closeSettingsPopup() {
        document.getElementById('SettingsPopup').style.display = 'none';
        var overlay = document.querySelector('.popup-overlay');
        overlay.style.opacity = 0;
        setTimeout(function() {
            overlay.style.display = 'none';
        }, 300);
    }

    function showSettingsPopup() {
        document.getElementById("SettingsPopup").style.display = "block";
        setTimeout(function() {
            document.getElementById("spopup-overlay").style.display = "block";
        }, 10); // Adjust the delay (in milliseconds) as needed
    }

    function closeSettingsPopup() {
        document.getElementById("spopup-overlay").style.display = "none";
        document.getElementById("SettingsPopup").style.display = "none";
    }
</script>
<script>
    var searchValue;

    document.getElementById('searchbar').addEventListener('keyup', function() {
        searchValue = document.getElementById("searchbar").value;
        loadXMLDoc("search");

        if (searchValue.trim() === "") {
            document.querySelector(".output").style.display = "none";
        } else {
            document.querySelector(".output").style.display = "flex";
        }
    });

    function loadXMLDoc(use) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                getSearch(this);
            }
        };
        xmlhttp.open("GET", "product.php?search=" + searchValue, true);
        xmlhttp.send();
    }

    function getSearch(xml) {
        var searchResults = xml.responseText;
        document.getElementById("demo").innerHTML = searchResults;
    }
</script>