<?php
if (isset($_POST['reference_number'])) {
    $referenceNumber = $_POST['reference_number'];

    $curl = curl_init();

    curl_setopt_array($curl, [
        CURLOPT_URL => "https://api.paymongo.com/v1/links?reference_number=" . $referenceNumber,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => "GET",
        CURLOPT_HTTPHEADER => [
            "accept: application/json",
            "authorization: Basic c2tfdGVzdF9CUmp3eW8xdmZHOE00Rzg1bUF1VHdtZXo6" 
        ],
    ]);

    $response = curl_exec($curl);
    $err = curl_error($curl);
    curl_close($curl);

    if ($err) {
        echo json_encode(['status' => 'error', 'message' => $err]);
    } else {
        $result = json_decode($response, true);
        if (isset($result['data'][0]['attributes']['status'])) {
            $status = $result['data'][0]['attributes']['status'];
            echo json_encode(['status' => 'success', 'payment_status' => $status]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Payment status not found']);
        }
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'No reference number provided']);
}
