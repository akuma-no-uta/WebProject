<div class="right">
            <div class="top">

                <button id="menu_bar">
                    <span class="material-symbols-outlined">menu</span>
                </button>

                <div class="theme-toggler">
                    <span class="material-symbols-outlined active">light_mode</span>
                    <span class="material-symbols-outlined">dark_mode</span>
                </div>

                <div class="profile">
                    <div class="info">
                        <p><b>Khoa</b></p>
                        <p>Admin</p>
                        <small class="text-muted"></small>
                    </div>
                     <div class="profile-photo">
                        <img src="../img/antony_admin.jpg" alt="">
                     </div>
                </div>

            </div>
            <!--end top-->

            <!--start cap nhat-->
          

            <!--end cap nhat-->

            <!--Start Phan tich doanh thu-->
           

             
            <div style="margin: 20px 0;">
            <?php
require_once 'adminDAO/pdo.php';

$tuan = isset($_GET['tuan']) ? (int)$_GET['tuan'] : 1;

$sql = "
    SELECT tkb.*, mh.ten_monhoc, l.ten_lop 
    FROM thoikhoabieu tkb
    JOIN monhoc mh ON tkb.monhoc_id = mh.id
    JOIN lop l ON tkb.lop_id = l.id
    WHERE tkb.tuan_id = ?
ORDER BY FIELD(tkb.thu, 'Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy', 'Chủ Nhật')
";
$data = pdo_query($sql, $tuan);

// Nhóm theo thứ
$schedule = [];
foreach ($data as $row) {
    $thu = $row['thu'];
    if (!isset($schedule[$thu])) $schedule[$thu] = [];
    $schedule[$thu][] = $row;
}

// Danh sách thứ cố định để đảm bảo thứ nào cũng có cột
$ds_thu = ['Thứ Hai', 'Thứ Ba', 'Thứ Tư', 'Thứ Năm', 'Thứ Sáu', 'Thứ Bảy', 'Chủ Nhật'];
?>

<form method="get">
    <label>Chọn tuần:</label>
    <select name="tuan" onchange="this.form.submit()">
        <?php for ($i = 1; $i <= 5; $i++): ?>
            <option value="<?= $i ?>" <?= ($tuan == $i ? 'selected' : '') ?>>Tuần <?= $i ?></option>
        <?php endfor; ?>
    </select>
</form>

<section class="schedule-section">
    <div class="schedule-container">
        <h2>Thời khóa biểu - Tuần <?= $tuan ?></h2>
        <table class="schedule-table">
            <thead>
                <tr>
                    <?php foreach ($ds_thu as $t): ?>
                        <th><?= $t ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($ds_thu as $t): ?>
                        <td>
                            <?php if (isset($schedule[$t])): ?>
                                <?php foreach ($schedule[$t] as $item): ?>
                                    <div class="day-cell">
                                        <span><?= $item['ten_monhoc'] ?> <?= $item['ten_lop'] ?></span><br>
                                        <span><?= date('H:i', strtotime($item['gio_batdau'])) ?> - <?= date('H:i', strtotime($item['gio_ketthuc'])) ?></span><br>
                                        <span>Phòng: <?= $item['phong'] ?></span>
                                    </div>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </td>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>
</section>