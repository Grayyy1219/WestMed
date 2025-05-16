<?php

$salesResult = $con->query("SELECT SUM(total_amount) AS total_sales FROM orders");
$totalSales = $salesResult->fetch_assoc()['total_sales'] ?? 0;

$ordersResult = $con->query("SELECT COUNT(*) AS total_orders FROM orders");
$totalOrders = $ordersResult->fetch_assoc()['total_orders'] ?? 0;

$customersResult = $con->query("SELECT COUNT(*) AS new_customers FROM users");
$newCustomers = $customersResult->fetch_assoc()['new_customers'] ?? 0;

$soldQuery = "
    SELECT ItemName AS name, Solds AS sold 
    FROM items 
    ORDER BY Solds DESC 
    LIMIT 20";
$soldResult = $con->query($soldQuery);

$itemNames = [];
$itemSolds = [];

while ($row = $soldResult->fetch_assoc()) {
    $itemNames[] = $row['name'];
    $itemSolds[] = $row['sold'];
}
?>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="dashboard_con">
    <div class="dashboard_count">
        <div class="slideleft">₱<div class="num_count"><?= number_format($totalSales, 2) ?></div>
        </div>
        <div class="num_titlee">Total Sales</div>
    </div>
    <div class="dashboard_count">
        <div class="num_count"><?= $totalOrders ?></div>
        <div class="num_titlee">Total Orders</div>
    </div>
    <div class="dashboard_count">
        <div class="num_count"><?= $newCustomers ?></div>
        <div class="num_titlee">New Customers</div>
    </div>
</div>

<canvas id="salesChart"></canvas>

<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($itemNames) ?>,
            datasets: [{
                label: 'Most Sold Items',
                data: <?= json_encode($itemSolds) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.7)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1,
            }]
        },
        options: {
            responsive: false,
            scales: {
                y: {
                    beginAtZero: true,
                    precision: 0
                }
            }
        }
    });
</script>