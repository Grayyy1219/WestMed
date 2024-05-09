<style>
    * {
    padding: 0px;
    margin: 0px;
    font-family: Arial, Helvetica, sans-serif;
}
    .settings {
        max-width: 400px;
        margin: 0 auto;
        padding: 20px;
        background-color: #f4f4f4;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .settings input {
        width: 100%;
        margin-bottom: 10px;
        padding: 8px;
        box-sizing: border-box;
    }

    .settings input[type="submit"] {
        background-color: #9e22ff;
        color: #fff;
        cursor: pointer;
    }

    .settings input[type="submit"]:hover {
        background-color: #9e22ff;
    }
</style>

<?php $email = $_GET['email']; ?>
<form action="updateresetpassword.php" class="settings" method="post" enctype="multipart/form-data">
    <input type="hidden" name="email" value="<?php echo $email; ?>">
    New Password: <input type="password" name="password">
    Confirm Password: <input type="password" name="cpassword">
    <input type="submit" value="Change">
</form>