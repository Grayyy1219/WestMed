<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title></title>
    <link rel="stylesheet" href="css/WestMed.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/editpass.css">
    <link rel="stylesheet" href="css/footer.css">
    <?php
    include("connect.php");
    include("query.php");
    ?>
    <style>
        .password-mismatch {
            border: 2px solid red;
        }
    </style>
</head>

<body>
    <?php include("header.php");?>
    <div class="te">
        <?php
        echo "<div class='profileimg'><p><img  src='$location' width='200 height='200'></p><br><br>";
        echo "<p class='name'><b>" . $FName . "</b></p>";
        echo "<p class='emaillink'>" . $address . "</p>";
        echo "<p class='emaillink'>" . $phone . "</p></div>";
        ?>
        <section></a>
            <div class="wrapper" id="w1">
                <form action="changepass.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <div class="wedit">
                        <div class="weform">
                            <div class="inweform">
                                <div>
                                    <p>Current Password:</p>
                                    <div class="weitem">
                                        <input type='password' name='currentpass' value='' required>
                                    </div>
                                </div>
                                <div>
                                    <p>New Password:</p>
                                    <div class="weitem">
                                        <input type='password' id='newpass' name='newpass' class="password-input" value=''
                                            required>
                                    </div>
                                </div>
                                <div>
                                    <p>Confirm Password:</p>
                                    <div class="weitem">
                                        <input type='password' id='confirmpass' name='confirmpass' class="password-input"
                                            value='' required>
                                    </div>
                                </div>
                                <label class="btn-save">
                                    <div class="btnsave">
                                        Save Changes <input type="submit" name="submit" style="display: none;">
                                    </div>
                                </label>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>
    <script>
        function validateForm() {
            var newPassword = document.getElementById('newpass').value;
            var confirmPassword = document.getElementById('confirmpass').value;
            var passwordInputs = document.querySelectorAll('.password-input');

            if (newPassword !== confirmPassword) {
                alert("New Password and Confirm Password must match!");
                passwordInputs.forEach(function (element) {
                    element.classList.add('password-mismatch');
                });
                return false; // prevent form submission
            } else {
                passwordInputs.forEach(function (element) {
                    element.classList.remove('password-mismatch');
                });
            }
            return true;
        }
    </script>
    <?php include("footer.php"); ?>
</body>

</html>