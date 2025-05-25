<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
require_once('TCPDF/tcpdf.php');
include 'connect.php';
include 'query.php';

function fetchPaymentData($con, $search, $start_date, $end_date)
{
    $search = mysqli_real_escape_string($con, $search);

    $sql = "SELECT payment_id, order_id, customer_id, payment_date, amount_paid, payment_mode 
            FROM payment 
            WHERE customer_id IN (SELECT UserID FROM users WHERE FName LIKE '%$search%')";

    if (!empty($start_date) && !empty($end_date)) {
        $start_date = mysqli_real_escape_string($con, $start_date);
        $end_date = mysqli_real_escape_string($con, $end_date);
        $sql .= " AND payment_date BETWEEN '$start_date' AND '$end_date'";
    }

    $sql .= " ORDER BY payment_date ASC";

    $result = mysqli_query($con, $sql);

    $data = array();

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $sql2 = "SELECT FName, LName FROM users WHERE UserID = " . $row['customer_id'];
            $result2 = mysqli_query($con, $sql2);
            $userRow = mysqli_fetch_assoc($result2);

            $data[] = array(
                'payment_id' => $row['payment_id'],
                'order_id' => $row['order_id'],
                'customer_name' => htmlspecialchars($userRow['FName']) . " " . htmlspecialchars($userRow['LName']),
                'payment_date' => date('F j, Y', strtotime($row['payment_date'])),
                'amount_paid' => $row['amount_paid'],
                'payment_mode' => $row['payment_mode'],
            );
        }
    }

    return $data;
}

// Get filtered data
$search = isset($_GET['search']) ? $_GET['search'] : '';
$start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
$end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

$data = fetchPaymentData($con, $search, $start_date, $end_date);

// TCPDF settings
$pdf = new TCPDF();
$pdf->SetAutoPageBreak(true, PDF_MARGIN_BOTTOM);
$pdf->AddPage();

// Add a table to the PDF
$html = '<table border="1">
            <tr>
                <th>Reference No.</th>
                <th>Order ID</th>
                <th>Name</th>
                <th>Payment Date</th>
                <th>Amount Paid</th>
                <th>Payment Mode</th>
            </tr>';

foreach ($data as $row) {
    $html .= "<tr>
                <td>{$row['payment_id']}</td>
                <td>{$row['order_id']}</td>
                <td>{$row['customer_name']}</td>
                <td>{$row['payment_date']}</td>
                <td>{$row['amount_paid']}</td>
                <td>{$row['payment_mode']}</td>
            </tr>";
}

$html .= '</table>';

// Output the PDF
$pdf->writeHTML($html, true, false, true, false, '');
$pdf->Output('payment_history.pdf', 'I'); // 'I' to open the PDF in the browser
