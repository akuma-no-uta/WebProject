<?php
$monhocList = pdo_query("SELECT id, ten_monhoc FROM monhoc");
$lopList = pdo_query("SELECT id, ten_lop FROM lop");

// Truy vấn thời khóa biểu với chuyển đổi số thứ thành tên thứ
$sql = "SELECT tkb.*, mh.ten_monhoc, l.ten_lop, 
        CASE tkb.thu
            WHEN 0 THEN 'Chủ Nhật'
            WHEN 1 THEN 'Thứ Hai'
            WHEN 2 THEN 'Thứ Ba'
            WHEN 3 THEN 'Thứ Tư'
            WHEN 4 THEN 'Thứ Năm'
            WHEN 5 THEN 'Thứ Sáu'
            WHEN 6 THEN 'Thứ Bảy'
        END AS thu_text
        FROM thoikhoabieu tkb
        JOIN monhoc mh ON tkb.monhoc_id = mh.id
        JOIN lop l ON tkb.lop_id = l.id";
$data = pdo_query($sql);

// Gom dữ liệu theo tuần và thứ (sử dụng thu_text)
$schedule = [];
foreach ($data as $row) {
    $schedule[$row['tuan_id']][$row['thu_text']][] = $row;
}

$thu = ['Chủ Nhật', 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy'];
?>


<style>
    .modal {
    display: none; /* Ẩn ban đầu */
    position: fixed;
    z-index: 999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    overflow: auto;
    background-color: rgba(0,0,0,0.4);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #fff;
    margin: auto;
    padding: 30px;
    border-radius: 12px;
    max-width: 500px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    animation: fadeIn 0.3s ease;
}

@keyframes fadeIn {
    from {opacity: 0;}
    to {opacity: 1;}
}

.modal-content h3 {
    margin-bottom: 20px;
    font-size: 1.5em;
    color: #007bff;
}

.modal-content input,
.modal-content button {
    width: 100%;
    padding: 10px 12px;
    margin-bottom: 15px;
    border-radius: 8px;
    border: 1px solid #ccc;
    font-size: 1em;
}

.modal-content button {
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.2s;
}

.modal-content button:hover {
    background-color: #0056b3;
}

.close-btn {
    position: absolute;
    top: 16px;
    right: 20px;
    font-size: 24px;
    color: #aaa;
    cursor: pointer;
}

.close-btn:hover {
    color: #000;
}
</style><head>
    <meta charset="UTF-8">
    <title>Thời khóa biểu tháng 4/2025</title>
    <style>
    .modal {
    display: none; /* Hidden by default */
    position: fixed;
    z-index: 999;
    left: 0;
    top: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.5);
    justify-content: center;
    align-items: center;
}

.modal-content {
    background-color: #fff;
    margin: auto;
    padding: 30px;
    border-radius: 16px;
    max-width: 500px;
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.1);
    animation: fadeIn 0.4s ease;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.modal-content h3 {
    margin-bottom: 25px;
    font-size: 1.6em;
    color: #007bff;
    text-align: center;
}

.modal-content input,
.modal-content select,
.modal-content button {
    width: 100%;
    padding: 12px 15px;
    margin-bottom: 20px;
    border-radius: 10px;
    border: 1px solid #ccc;
    font-size: 1em;
    box-sizing: border-box;
}

.modal-content input[type="time"] {
    padding-left: 12px;
}

.modal-content select {
    background-color: #f7f7f7;
    border: 1px solid #ddd;
}

.modal-content button {
    background-color: #007bff;
    color: white;
    border: none;
    cursor: pointer;
    font-weight: bold;
    transition: background-color 0.3s ease;
}

.modal-content button:hover {
    background-color: #0056b3;
}

.close-btn {
    position: absolute;
    top: 10px;
    right: 12px;
    font-size: 28px;
    color: #bbb;
    cursor: pointer;
    transition: color 0.3s ease;
}

.close-btn:hover {
    color: #000;
}

/* Add focus effect on input fields */
.modal-content input:focus,
.modal-content select:focus,
.modal-content button:focus {
    outline: none;
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
}

/* Schedule Table */
.schedule-section {
    padding: 40px 10%;
    background-color: #f4f9fc;
}

.schedule-container {
    overflow-x: auto;
    border-radius: 12px;
    background-color: #fff;
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
}

.schedule-table {
    width: 100%;
    border-collapse: collapse;
    text-align: center;
}

.schedule-table thead {
    background-color: #007bff;
    color: white;
    font-size: 1.1em;
}

.schedule-table th,
.schedule-table td {
    padding: 15px;
    border: 1px solid #ddd;
    vertical-align: top;
    min-width: 120px;
}

.schedule-table td {
    position: relative;
}

.day-cell {
    font-weight: bold;
    color: #333;
    cursor: pointer;
    padding: 10px;
    background-color: #e9f3ff;
    border-radius: 6px;
    transition: background-color 0.3s;
}

.day-cell:hover {
    background-color: #cce4ff;
}

.day-cell span {
    display: block;
    font-weight: normal;
    font-size: 0.9em;
    color: #555;
}

.schedule-table td .day-cell:active {
    background-color: #99c2ff;
}

/* Mobile responsive */
@media (max-width: 768px) {
    .schedule-table {
        font-size: 0.9rem;
    }

    .modal-content {
        padding: 20px;
    }

    .schedule-section {
        padding: 20px 5%;
    }
}

    </style>
</head>
<body>
<div id="addScheduleModal" class="modal">
    <div class="modal-content">
        <span class="close-btn" onclick="closeModal()">&times;</span>
        <h3>Thêm lịch dạy</h3>
        <form action="indexAdmin.php?act=them_lichday" method="post">
            <input type="hidden" name="ngay" id="selected-day">
            
            <!-- Thêm trường chọn thứ -->

            
            <label>Môn học:</label>
            <select name="monhoc_id" class="form-control" required>
                <option value="">-- Chọn môn học --</option>
                <?php foreach ($monhocList as $mh): ?>
                    <option value="<?= htmlspecialchars($mh['id']) ?>">
                        <?= htmlspecialchars($mh['ten_monhoc']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <label>Lớp:</label>
            <select name="lop_id" class="form-control" required>
                <option value="">-- Chọn lớp --</option>
                <?php foreach ($lopList as $lop): ?>
                    <option value="<?= htmlspecialchars($lop['id']) ?>">
                        <?= htmlspecialchars($lop['ten_lop']) ?>
                    </option>
                <?php endforeach; ?>
            </select>
            
            <label>Phòng:</label>
            <input type="text" name="phong" class="form-control" required>
            
            <label>Giờ bắt đầu:</label>
            <input type="time" name="gio_batdau" class="form-control" required>
            
            <label>Giờ kết thúc:</label>
            <input type="time" name="gio_ketthuc" class="form-control" required>
            
            <button type="submit" class="btn btn-primary">Thêm</button>
        </form>
    </div>
</div>

<div class="user">
    <section class="schedule-section">
        <div class="schedule-container">
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

$firstDayTimestamp = mktime(0, 0, 0, 4, 1, 2025);
$totalDays = date('t', $firstDayTimestamp); // Số ngày trong tháng 4
$startWeekday = date('w', $firstDayTimestamp); // Thứ bắt đầu (0 = Chủ Nhật)

echo "<tr>";
// In ra các ô trống nếu ngày 1 không phải Chủ Nhật
for ($i = 0; $i < $startWeekday; $i++) {
    echo "<td></td>";
}

for ($day = 1; $day <= $totalDays; $day++) {
    $currentTimestamp = mktime(0, 0, 0, 4, $day, 2025);
    $weekday = date('w', $currentTimestamp); // Thứ của ngày hiện tại
    $tuan = ceil(($day + $startWeekday - 1) / 7); // Tính tuần dựa trên ngày

    echo "<td>";
    echo "<div class='day-cell' onclick=\"openModal($day)\">$day</div>";

    $thuTrongTuan = $thu[$weekday];

    if (!empty($schedule[$tuan][$thuTrongTuan])) {
        echo "<div style='margin-top: 8px;'>";
        foreach ($schedule[$tuan][$thuTrongTuan] as $row) {
            echo "<div style='background:#e9f3ff; border-left: 4px solid #007bff; margin-bottom:6px; padding:6px; border-radius:6px; text-align:left; font-size:0.9em; position: relative;'>";
            echo "<strong>{$row['ten_monhoc']}</strong> ({$row['ten_lop']})<br>";
            echo "Phòng: {$row['phong']}<br>";
            echo "Giờ: {$row['gio_batdau']} - {$row['gio_ketthuc']}";
            echo "<a href='indexAdmin.php?act=xoa_lichday&id={$row['id']}' onclick=\"return confirm('Bạn có chắc muốn xóa lịch dạy này?')\" style='position:absolute; top:6px; right:8px; color:#d00; font-weight:bold; text-decoration:none;'>×</a>";
            echo "</div>";
        }
        echo "</div>";
    }

    echo "</td>";

    // Nếu là thứ Bảy thì xuống dòng
    if ($weekday == 6 && $day != $totalDays) {
        echo "</tr><tr>";
    }
}

// In thêm ô trống nếu kết thúc không phải thứ Bảy
$endWeekday = date('w', mktime(0, 0, 0, 4, $totalDays, 2025));
if ($endWeekday != 6) {
    for ($i = $endWeekday + 1; $i <= 6; $i++) {
        echo "<td></td>";
    }
}
echo "</tr>";

?>
</tbody>
            </table>
        </div>
    </section>
</div>

</body>
<script>
    
    function openModal(ngay) {
        document.getElementById("selected-day").value = ngay;
        document.getElementById("addScheduleModal").style.display = "flex"; // dùng flex để canh giữa
    }

    function closeModal() {
        document.getElementById("addScheduleModal").style.display = "none";
    }

    // Đóng modal khi click ra ngoài nội dung
    window.onclick = function(event) {
        let modal = document.getElementById("addScheduleModal");
        if (event.target === modal) {
            closeModal();
        }
    }
</script>
