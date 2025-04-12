<?php

// Truy vấn thời khóa biểu kèm tên môn học và lớp
$sql = "SELECT tkb.*, mh.ten_monhoc, l.ten_lop 
        FROM thoikhoabieu tkb
        JOIN monhoc mh ON tkb.monhoc_id = mh.id
        JOIN lop l ON tkb.lop_id = l.id";
$data = pdo_query($sql);

// Gom dữ liệu theo tuần và thứ
$schedule = [];
foreach ($data as $row) {
    $schedule[$row['tuan_id']][$row['thu']][] = $row;
}

$thu = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'];
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Thời khóa biểu tháng 4/2025</title>
    <style>
        .schedule-section {
            padding: 30px 5%;
            background-color: #fff;
        }

        .schedule-container {
            overflow-x: auto;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            border-radius: 12px;
            background-color: #fefefe;
        }

        .schedule-table {
            width: 100%;
            border-collapse: collapse;
            text-align: center;
        }

        .schedule-table thead {
            background-color: #007bff;
            color: white;
        }

        .schedule-table th,
        .schedule-table td {
            border: 1px solid #ccc;
            padding: 12px;
            vertical-align: top;
            height: 100px;
            min-width: 100px;
        }

        .day-cell {
            font-weight: bold;
            color: #333;
            text-align: left;
        }

        .day-cell span {
            display: block;
            font-weight: normal;
            font-size: 0.9em;
            margin-top: 5px;
            color: #555;
        }

        @media (max-width: 768px) {
            .schedule-table {
                font-size: 0.8rem;
            }
        }
    </style>
</head>
<body>
<div class="user">
    <section class="schedule-section">
        <div class="schedule-container">
            <h2>Thời khóa biểu tháng 4/2025</h2>
            <table class="schedule-table">
                <thead>
                <tr>
                    <?php foreach ($thu as $t) echo "<th>$t</th>"; ?>
                </tr>
                </thead>
                <tbody>
<?php
$firstDay = mktime(0, 0, 0, 4, 1, 2025);
$startWeekday = date('w', $firstDay); // 0 = Chủ Nhật
$day = 1;
$totalDays = 30;
$tuan = 1;

while ($day <= $totalDays) {
    echo "<tr>";
    for ($i = 0; $i < 7; $i++) {
        echo "<td>";
        if ($tuan == 1 && $i < $startWeekday) {
            echo ""; // Các ô trống trước ngày 1
        } elseif ($day <= $totalDays) {
            echo "<div class='day-cell'>$day</div>";

            $thuTrongTuan = $thu[$i];

            if (!empty($schedule[$tuan][$thuTrongTuan])) {
                echo "<div style='margin-top: 8px;'>";
                foreach ($schedule[$tuan][$thuTrongTuan] as $row) {
                    echo "<div style='background:#e9f3ff; border-left: 4px solid #007bff; margin-bottom:6px; padding:6px; border-radius:6px; text-align:left; font-size:0.9em;'>";
                    echo "<strong>{$row['ten_monhoc']}</strong> ({$row['ten_lop']})<br>";
                    echo "Phòng: {$row['phong']}<br>";
                    echo "Giờ: {$row['gio_batdau']} - {$row['gio_ketthuc']}";
                    echo "</div>";
                }
                echo "</div>";
            }

            $day++;
        }
        echo "</td>";
    }
    echo "</tr>";
    $tuan++;
}
?>
</tbody>
            </table>
        </div>
    </section>
</div>
</body>
</html>
