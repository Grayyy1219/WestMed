<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Account Management</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/blockuser.css">
    <link rel="icon" href="Image/logo.ico">
</head>
<?php
include("connect.php");
include("query.php");

$query = "SELECT UserID, FName, LName, username, block FROM users WHERE admin != 1";

$result = mysqli_query($con, $query);
?>

<body>
    <?php include 'aheader.php'; ?>

    <section>
        <div class="wrapper" id="page">
            <h1 style="font-size: 50px">User Account Management</h1>

            <table class="user-table">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Full Name</th>

                        <th>Username</th>
                        <th>Status</th>
                        <th>Action</th>
                        <th>Select</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <?php $userId = $row['UserID']; ?>
                        <tr id="user-row-<?= $userId ?>">
                            <td>
                                <?= $userId ?>
                            </td>
                            <td>
                                <?= $row['FName'] ?>
                            </td>
                            <td>
                                <?= $row['username'] ?>
                            </td>
                            <td>
                                <?php if ($row["block"] == 1): ?>
                                    <a class="unblock-btn" href="unblock.php?userid=<?= $userId ?>">Unblock</a>
                                <?php else: ?>
                                    <a class="block-btn" href="block.php?userid=<?= $userId ?>">Block</a>
                                <?php endif; ?>
                            </td>
                            <td>
                                <a href="edituser2.php?UserID=<?= $userId ?>"><button class="edit"
                                        type="submit">Edit</button></a>
                            </td>
                            <td style="min-width: 86px;">
                                <input type="checkbox" class="delete-checkbox" data-userid="<?= $userId ?>">
                            </td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>

            <div id="delete">
                <a href="signup.php"><button class="Signup">Add User</button></a>
                <button class="delete" onclick="deleteSelectedRows()">Delete Selected</button>
            </div>
        </div>
    </section>

    <script>
        function handleBlockUnblock(userId, action) {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    var rowId = "user-row-" + userId;
                    document.getElementById(rowId).innerHTML = this.responseText;
                }
            };
            if (action === 'block') {
                xhttp.open("GET", "block.php?userid=" + userId, true);
            } else if (action === 'unblock') {
                xhttp.open("GET", "unblock.php?userid=" + userId, true);
            }
            xhttp.send();
        }

        function deleteSelectedRows() {
            const selectedCheckboxes = document.querySelectorAll('.delete-checkbox:checked');
            const selectedUserIds = Array.from(selectedCheckboxes).map(checkbox =>
                checkbox.getAttribute('data-userid')
            );

            if (selectedUserIds.length === 0) {
                alert("Please select at least one user to delete.");
                return;
            }

            const confirmed = confirm("Are you sure you want to delete the selected users?");
            if (!confirmed) return;

            const adminPassword = prompt("Enter admin password to confirm deletion:");
            if (!adminPassword) {
                alert("Admin password is required.");
                return;
            }

            const xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4) {
                    if (this.status === 200) {
                        alert(this.responseText);
                        location.reload();
                    } else {
                        alert("Error: " + this.responseText);
                    }
                }
            };

            const requestData =
                "user_ids=" + encodeURIComponent(selectedUserIds.join(',')) +
                "&admin_password=" + encodeURIComponent(adminPassword);

            xhttp.open("POST", "delete_users.php", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send(requestData);
        }
    </script>
</body>

</html>