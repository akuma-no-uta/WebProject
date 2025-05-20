<?php
$host = "localhost";
$user = "root";
$password = "";
$database = "cuoiky";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
    exit;
}

// Truy vấn doanh thu theo loại món ăn
$sql_food_type = "
    SELECT pl.name AS loai_mon, SUM(ct.so_luong * ct.gia) AS doanh_thu
    FROM chi_tiet_don_hang ct
    JOIN menu m ON ct.id_menu = m.id
    JOIN category pl ON m.phan_loai = pl.id
    GROUP BY pl.name
";

$result_food_type = $conn->query($sql_food_type);
if ($result_food_type === false) {
    die("Lỗi truy vấn doanh thu theo loại: " . $conn->error);
    exit;
}

$labels = [];
$data = [];

if ($result_food_type->num_rows > 0) {
    while ($row = $result_food_type->fetch_assoc()) {
        $labels[] = $row['loai_mon'];
        $data[] = (int)$row['doanh_thu'];
    }
} else {
    $labels = ['Không có dữ liệu'];
    $data = [1];
}

// Truy vấn doanh thu theo năm
// Truy vấn doanh thu theo từng tháng của một năm cụ thể (ví dụ 2025)
$sql_monthly = "
SELECT MONTH(dh.ngay_dat) AS thang, SUM(ct.so_luong * ct.gia) AS doanh_thu
FROM don_hang dh
JOIN chi_tiet_don_hang ct ON dh.id = ct.id_don_hang
WHERE YEAR(dh.ngay_dat) = 2025
GROUP BY MONTH(dh.ngay_dat)
ORDER BY thang
";

$result_monthly = $conn->query($sql_monthly);
$monthly_data = [];
if ($result_monthly && $result_monthly->num_rows > 0) {
    while ($row = $result_monthly->fetch_assoc()) {
        $monthly_data[] = $row;
    }
}

?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Dashboard Quản Lý Nhà Hàng</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
            background-color: #f4f6f9;
            padding: 30px;
            margin: 0;
        }

        h1 {
            text-align: center;
            color: #007bff;
            margin-bottom: 30px;
        }

        .charts {
            display: flex;
            flex-wrap: wrap;
            gap: 30px;
            justify-content: center;
            margin-bottom: 40px;
        }

        .chart-card {
            background-color: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            max-width: 266px;
            width: 100%;
        }

        canvas {
            max-width: 100%;
            height: auto;
        }

        .revenue-table {
            background-color: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 20px;
            margin: 0 auto;
            max-width: 800px;
            width: 100%;
        }

        .revenue-table h3 {
            text-align: center;
            color: #007bff;
            margin-top: 0;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
            font-weight: 600;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        .total-row {
            font-weight: bold;
            background-color: #e9ecef;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>
<body>

<h1>📊 Tổng Quan Quản Lý Nhà Hàng</h1>

<div class="charts">
    <div class="chart-card">
        <h3>📦 Tình Trạng Đơn Hàng</h3>
        <canvas id="orderChart"></canvas>
    </div>

    <div class="chart-card">
        <h3>🪑 Đặt Bàn & Món Ăn</h3>
        <canvas id="summaryChart"></canvas>
    </div>

    <div class="chart-card">
        <h3>🍽️ Doanh Thu Món Ăn Theo Loại</h3>
        <canvas id="foodTypeRevenueChart"></canvas>
    </div>
</div>
<div style="width: 100%; display: flex; justify-content: center; margin-top: 30px;">
    <div class="chart-card" style="width: 100%; max-width: 850px;">
        <h3 style="text-align: center;">📆 Doanh Thu Theo Tháng (2025)</h3>
        <canvas id="monthlyRevenueChart" height="140"></canvas>
    </div>
</div>

<script>
   // Biểu đồ doanh thu theo tháng

    // Biểu đồ 1: Tình trạng đơn hàng
    const orderChart = new Chart(document.getElementById('orderChart'), {
        type: 'pie',
        data: {
            labels: ['Đã xử lý', 'Đang chờ', 'Đã hủy'],
            datasets: [{
                data: [120, 30, 10],
                backgroundColor: ['#17a2b8', '#ffc107', '#dc3545'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });

    // Biểu đồ 2: Lượt đặt bàn và món ăn
    const summaryChart = new Chart(document.getElementById('summaryChart'), {
        type: 'doughnut',
        data: {
            labels: ['Lượt đặt bàn', 'Tổng món ăn'],
            datasets: [{
                data: [75, 45],
                backgroundColor: ['#6610f2', '#20c997'],
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
    
    // Biểu đồ 3: Doanh thu theo loại món ăn
    const ctx = document.getElementById('foodTypeRevenueChart').getContext('2d');
    const foodTypeRevenueChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: <?php echo json_encode($labels); ?>,
            datasets: [{
                data: <?php echo json_encode($data); ?>,
                backgroundColor: [
                    '#ff6384', '#ffcd56', '#36a2eb',
                    '#4bc0c0', '#9966ff', '#ff9f40'
                ],
                hoverOffset: 10
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            const value = context.parsed;
                            return `${context.label}: ${value.toLocaleString()} VNĐ`;
                        }
                    }
                }
            }
        }
    });
    const monthlyLabels = <?php
        $thang_map = [1=>"Tháng 1", 2=>"Tháng 2", 3=>"Tháng 3", 4=>"Tháng 4", 5=>"Tháng 5", 6=>"Tháng 6", 7=>"Tháng 7", 8=>"Tháng 8", 9=>"Tháng 9", 10=>"Tháng 10", 11=>"Tháng 11", 12=>"Tháng 12"];
        echo json_encode(array_map(fn($row) => $thang_map[$row['thang']], $monthly_data));
    ?>;

    const monthlyRevenue = <?php echo json_encode(array_map('intval', array_column($monthly_data, 'doanh_thu'))); ?>;
    const monthlyRevenueChart = new Chart(document.getElementById('monthlyRevenueChart'), {
    type: 'line',
    data: {
        labels: monthlyLabels,
        datasets: [{
            label: 'Doanh thu (VNĐ)',
            data: monthlyRevenue,
            borderColor: '#28a745',
            backgroundColor: 'rgba(40, 167, 69, 0.1)',
            tension: 0.3,
            fill: true,
            pointBackgroundColor: '#28a745',
            pointRadius: 4
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'top'
            },
            tooltip: {
                callbacks: {
                    label: function(context) {
                        return ` ${context.dataset.label}: ${context.parsed.y.toLocaleString()} VNĐ`;
                    }
                }
            }
        },
        scales: {
            y: {
                ticks: {
                    callback: function(value) {
                        return value.toLocaleString() + ' VNĐ';
                    }
                }
            }
        }
    }
});
</script>

</body>
</html>