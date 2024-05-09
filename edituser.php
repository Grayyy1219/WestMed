<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <title></title>
    <link rel="stylesheet" href="css/WestMed.css">
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/edituser.css">
    <link rel="stylesheet" href="css/footer.css">
    <?php
    include("connect.php");
    include("query.php");
    ?>
</head>

<body>
    <?php
    include("header.php");
    ?>
    <section></a>
        <form action="" method="post" enctype="multipart/form-data">
            <div class="wrapper" id="w1">
                <div class="infodiv">
                    <div class="divmyprofile">
                        <div class="my-profile">My Profile</div>
                        <p class="text-wrapper">Manage and protect your account</p>
                    </div>
                    <div class="div">
                        <div class="profle">
                            <div class="inprofile">
                                <div class="file">
                                    <div class="file-2">
                                        <div class="div-wrapper">
                                            <p class="text-wrapper-2">File size: maximum 1 MB</p>
                                        </div>
                                        <div class="file-3">
                                            <div class="text-wrapper-2">File extension: .JPEG, .PNG</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="divprofileimg">
                                    <div class="profileimg"><img class="div-lonmg" id="profileImage"
                                            src="<?php echo $location ?>" /></div>
                                </div>
                                <label class="profilebutton">
                                    <div class="text-wrapper-3">Select Image <input type="file" id="img" name="img"
                                            accept="image/*" style="display: none;"></div>
                                </label>
                            </div>
                        </div>
                        <div class="infos">
                            <div class="form">
                                <div class="table">
                                    <div class="row">
                                        <div class="text-wrapper-4">Username</div>
                                        <div class="data">
                                            <div class="forminput">
                                                <input type="text" class="input" name="username" value="<?php echo $username ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-2">
                                        <div class="text-wrapper-4">Name</div>
                                        <div class="forminput-wrapper">
                                            <div class="forminput">
                                                <input type="text" class="input" name="name" value="<?php echo $FName ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-2">
                                        <div class="text-wrapper-4">Email</div>
                                        <div class="data-2">
                                            <div class="forminput">
                                                <input type="text" class="input" name="email" value="<?php echo $email ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-2">
                                        <div class="text-wrapper-4">Phone Number</div>
                                        <div class="data">
                                            <div class="forminput">
                                                <input type="text" class="input" name="phone" value="<?php echo $phone ?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row-2">
                                        <div class="text-wrapper-4">Address</div>
                                        <div class="data">
                                            <div class="forminput">
                                                <input type="text" class="input" name="address" value="<?php echo $address ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" value="Save" name="submit" class="button" formaction="updateuser.php">
                    </div>
                </div>
            </div>
        </form>

    </section>
    <?php include("footer.php"); ?>
</body>
<script>
    document.getElementById('img').addEventListener('change', function (event) {
        const fileInput = event.target;
        const profileImage = document.getElementById('profileImage');

        const file = fileInput.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                profileImage.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });
</script>

</html>