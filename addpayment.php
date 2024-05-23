<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Management</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/blockuser.css">
    <link rel="icon" href="Image/logo.ico">
</head>
<?php
include("connect.php");
include("query.php");

$query = "SELECT * FROM paymethod";

$result = mysqli_query($con, $query);
?>

<body>
    <?php include 'aheader.php'; ?>

    <section>
        <div class="wrapper" id="page">
            <h1 style="font-size: 50px">Payment Management</h1>

            <table class="user-table">
                <thead>
                    <tr>
                        <th>Method</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)) : ?>
                        <?php $userId = $row['method_name']; ?>
                        <tr id="user-row-<?= $userId ?>">
                            <td>
                                <?= $userId ?>
                            </td>
                            <td style="min-width: 86px;">
                                <input type="checkbox" class="delete-checkbox" data-userid="<?= $userId ?>">
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <div id="delete">
                <a href="addmethod.php"><button class="Signup">Add Method</button></a>
                <button class="delete" onclick="deleteSelectedRows()">Delete Selected</button>
            </div>
        </div>
    </section>

    <script>
        function deleteSelectedRows() {
            var selectedCheckboxes = document.querySelectorAll('.delete-checkbox:checked');
            var selectedUserIds = Array.from(selectedCheckboxes).map(function(checkbox) {
                return checkbox.getAttribute('data-userid');
            });

            if (selectedUserIds.length > 0) {
                var confirmed = confirm("Are you sure you want to delete the selected users?");
                if (confirmed) {
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function() {
                        if (this.readyState == 4) {
                            if (this.status == 200) {
                                location.reload();
                            } else {
                                console.error('Error:', this.status, this.statusText);
                            }
                        }
                    };

                    var requestData = "user_ids=" + encodeURIComponent(selectedUserIds.join(','));

                    xhttp.open("POST", "delete_method.php");
                    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
                    xhttp.send(requestData);
                }
            } else {
                alert("Please select at least one user to delete.");
            }
        }
    </script>
</body>

</html>