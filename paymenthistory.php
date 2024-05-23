<?php
include 'connect.php';
include 'query.php';

// Function to search with date
function searchWithout($con, $search)
{
    $search = mysqli_real_escape_string($con, $search);
    $sql = "SELECT payment_id, order_id, customer_id, payment_date, amount_paid, payment_mode FROM payment";
    $sql .= " WHERE customer_id IN (SELECT UserID FROM users WHERE FName LIKE '%$search%')";
    return $sql;
}

// Function to search by payment date only
function searchByPaymentDate($con)
{
    $sql = "SELECT payment_id, order_id, customer_id, payment_date, amount_paid, payment_mode FROM payment";
    return $sql;
}

// Check which function to call based on the provided parameters
if (isset($_GET['search'])) {
    $search = $_GET['search'];
    $sql = searchWithout($con, $search);
    if (!empty($_GET['start_date']) && !empty($_GET['end_date'])) {
        $start_date = mysqli_real_escape_string($con, $_GET['start_date']);
        $end_date = mysqli_real_escape_string($con, $_GET['end_date']);
        $sql .= " AND payment_date BETWEEN '$start_date' AND '$end_date'";
    }
} else {
    $sql = searchByPaymentDate($con);
}

$sql .= " ORDER BY payment_date ASC";

$result = mysqli_query($con, $sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment History</title>
    <link rel="stylesheet" href="css/admin.css">
    <link rel="stylesheet" href="css/paymenthistory.css">
</head>

<body>
    <?php include 'aheader.php'; ?>
    <div class="wrapper" id="page">
        <h2>Payment History</h2>

        <!-- Add search form with start date and end date fields -->
        <form action="" method="get">
            <label for="search">Search:</label>
            <input type="text" id="search" name="search" placeholder="Enter search Name">
            <label for="start_date">Start Date:</label>
            <input type="date" id="start_date" name="start_date">
            <label for="end_date">End Date:</label>
            <input type="date" id="end_date" name="end_date">
            <button type="submit" name="submit">Search</button>
        </form>
        <form action="paymentprint.php">
            <input type="hidden" name="search" value="<?php echo $_GET['search']; ?>">
            <input type="hidden" name="start_date" value="<?php echo $_GET['start_date']; ?>">
            <input type="hidden" name="end_date" value="<?php echo $_GET['end_date']; ?>">
            <button type="submit" name="print">Print</button>

        </form>
        <form action="addpayment.php" class="form1" method="post">
            <button type="submit" name="method">Manage Method</button>
        </form>
        <table>
            <tr>
                <th>Reference No.</th>
                <th>Order ID</th>
                <th>Name</th>
                <th>Payment Date</th>
                <th>Amount Paid</th>
                <th>Payment Mode</th>
            </tr>


            <?php
            if ($result && mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    $sql2 = "SELECT FName, LName FROM users WHERE UserID = " . $row['customer_id'];
                    $result2 = mysqli_query($con, $sql2);
                    $userRow = mysqli_fetch_assoc($result2);

                    echo "<tr>";
                    echo "<td>" . $row['payment_id'] . "</td>";
                    echo "<td>" . $row['order_id'] . "</td>";
                    echo "<td>" . htmlspecialchars($userRow['FName']) . " " . htmlspecialchars($userRow['LName']) . "</td>";
                    echo "<td>" . date('F j, Y', strtotime($row['payment_date'])) . "</td>";
                    echo "<td>" . $row['amount_paid'] . "</td>";
                    echo "<td>" . $row['payment_mode'] . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No payment history found.</td></tr>";
            }
            ?>
        </table>

    </div>

</body>

</html>