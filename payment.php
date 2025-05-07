<?php
session_start();
include 'connect.php';
include 'query.php';

if (!isset($_SESSION['selectedItems'])) {
    echo "No items selected for purchase.";
    exit();
}

$selectedItems = $_SESSION['selectedItems'];
$totalPurchaseValue = 0;
$descriptionParts = [];

$query = "
    SELECT items.ItemID, items.ItemName, items.price, cart.quantity 
    FROM cart 
    INNER JOIN items ON cart.ItemID = items.ItemID 
    WHERE cart.customer_id = ? AND cart.cart_id IN ($selectedItems)";

$stmt = mysqli_prepare($con, $query);
mysqli_stmt_bind_param($stmt, "i", $UserID);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (!$result) {
    echo "Error retrieving items: " . mysqli_error($con);
    exit();
}

while ($row = mysqli_fetch_assoc($result)) {
    $totalPurchaseValue += $row['quantity'] * $row['price'];
    $descriptionParts[] = "{$row['ItemName']} x {$row['quantity']}";
}

$description = implode(", ", $descriptionParts);

// Setting the amount and remark with item details
$amountInCents = (int) ($totalPurchaseValue * 100);

$paymongoData = [
    'data' => [
        'attributes' => [
            'amount' => $amountInCents,
            'description' => $description,
            'remarks' => "Items Ordered: $description" // Reflecting item details in remarks
        ]
    ]
];

$curl = curl_init();
curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.paymongo.com/v1/links",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_CUSTOMREQUEST => "POST",
    CURLOPT_POSTFIELDS => json_encode($paymongoData),
    CURLOPT_HTTPHEADER => [
        "accept: application/json",
        "authorization: Basic c2tfdGVzdF9CUmp3eW8xdmZHOE00Rzg1bUF1VHdtZXo6",
        "content-type: application/json"
    ],
]);

$response = curl_exec($curl);
$err = curl_error($curl);
curl_close($curl);

if ($err) {
    echo "cURL Error #:" . $err;
    exit();
}

$result = json_decode($response, true);

if (!isset($result['data']['attributes']['checkout_url'])) {
    echo "Failed to get checkout URL. Response: " . $response;
    exit();
}

$checkoutUrl = $result['data']['attributes']['checkout_url'];
$referenceNumber = $result['data']['attributes']['reference_number'];
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redirecting to Payment</title>
    <script>
        window.open("<?php echo $checkoutUrl; ?>", "_blank");

        function showModal(message, isSuccess) {
            const modal = document.getElementById('paymentModal');
            const modalMessage = document.getElementById('modalMessage');
            const modalHeader = document.getElementById('modalHeader');
            const closeButton = document.getElementById('closeButton');

            modal.style.display = "block";
            modalMessage.innerHTML = message;
            if (isSuccess) {
                modalHeader.textContent = "Payment Success";
                closeButton.classList.remove("btn-close");
                closeButton.classList.add("btn");
                closeButton.textContent = "Close";
            } else {
                modalHeader.textContent = "Pending Payment";
                closeButton.classList.remove("btn");
                closeButton.classList.add("btn-close");
                closeButton.textContent = "Try Again";
            }
        }

        function checkPaymentStatus() {
            const referenceNumber = "<?php echo $referenceNumber; ?>";

            const xhr = new XMLHttpRequest();
            xhr.open("GET", `https://api.paymongo.com/v1/links?reference_number=${referenceNumber}`, true);
            xhr.setRequestHeader("accept", "application/json");
            xhr.setRequestHeader("authorization", "Basic c2tfdGVzdF9CUmp3eW8xdmZHOE00Rzg1bUF1VHdtZXo6");

            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    const response = JSON.parse(xhr.responseText);

                    if (response.data && response.data.length > 0) {
                        const paymentStatus = response.data[0].attributes.status;
                        const referenceNumber = response.data[0].attributes.reference_number;

                        let message = `Reference Number: ${referenceNumber}<br>`;

                        if (paymentStatus === "paid") {
                            window.location.href = "orderdone.php";
                            return;
                        } else {
                            message += "Payment not completed yet. Please complete the payment.";
                            showModal(message, false);
                        }
                    } else {
                        showModal("Error: Payment status not found.", false);
                    }
                } else if (xhr.readyState === 4) {
                    showModal("Error: " + xhr.statusText, false);
                }
            };

            xhr.send();
        }

        function closeModal() {
            document.getElementById('paymentModal').style.display = "none";
        }
    </script>
</head>

<body>
    <h2>Redirecting to Payment...</h2>
    <p>The payment page has opened in a new tab. Once you've completed the payment, click the button below to confirm.</p>
    <button onclick="checkPaymentStatus()">Check Payment Status</button>

    <!-- Modal -->
    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <div class="modal-header" id="modalHeader">Payment Status</div>
            <div class="modal-body" id="modalMessage"></div>
            <div class="modal-footer">
                <button id="closeButton" class="btn btn-close" onclick="closeModal()">Close</button>
            </div>
        </div>
    </div>
</body>

</html>