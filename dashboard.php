<?php

$salesResult = $con->query("SELECT SUM(total_amount) AS total_sales FROM orders");
$totalSales = $salesResult->fetch_assoc()['total_sales'] ?? 0;

$ordersResult = $con->query("SELECT COUNT(*) AS total_orders FROM orders");
$totalOrders = $ordersResult->fetch_assoc()['total_orders'] ?? 0;

$customersResult = $con->query("SELECT COUNT(*) AS new_customers FROM users");
$newCustomers = $customersResult->fetch_assoc()['new_customers'] ?? 0;

$soldQuery = "
    SELECT ItemName AS name, Solds AS sold 
    FROM items where Solds != 0
    ORDER BY Solds DESC 
    LIMIT 10";
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
        <div class="num_count"><?= $newCustomers - 1 ?></div>
        <div class="num_titlee">New Customers</div>
    </div>
    <div class="dashboard_count">
        <div class="num_count"><?= $itemNames[0] ?></div>
        <div class="num_titlee">Top Solds</div>
    </div>

</div>
<div class="graphs_group">
    <div class="canvas_fastmoving">
        <canvas id="salesChart"></canvas>
    </div>
    <div class="canvas_fastmoving">
        <canvas id="salesChart"></canvas>
    </div>
</div>


<script>
    const ctx = document.getElementById('salesChart').getContext('2d');
    const salesChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode($itemNames) ?>,
            datasets: [{
                label: 'Solds',
                data: <?= json_encode($itemSolds) ?>,
                backgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                    '#9966FF', '#FF9F40', '#C9CBCF', '#8DD1E1',
                    '#FF7F50', '#90EE90'
                ],
                borderColor: '#333',
                borderWidth: 1,
                hoverBackgroundColor: [
                    '#FF6384', '#36A2EB', '#FFCE56', '#4BC0C0',
                    '#9966FF', '#FF9F40', '#C9CBCF', '#8DD1E1',
                    '#FF7F50', '#90EE90'
                ],
            }]
        },
        options: {
            responsive: true,
            indexAxis: 'y',
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        color: '#333',
                        font: {
                            size: 12,
                            weight: 'bold'
                        }
                    },
                    grid: {
                        display: false
                    }
                },
                y: {
                    ticks: {
                        color: '#333',
                        font: {
                            size: 9,
                            weight: 'bold'
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: false,
                    position: 'top',
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let label = context.dataset.label || '';
                            let value = context.parsed.x || 0;
                            return `${label}: ${value}`;
                        }
                    }
                }
            }
        }
    });
</script>