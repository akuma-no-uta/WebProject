<?php
require_once("adminDAO/pdo.php");

// Thêm hoặc cập nhật khuyến mãi
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['menu_id'], $_POST['giam_phan_tram'])) {
    $menu_id = intval($_POST['menu_id']);
    $giam = intval($_POST['giam_phan_tram']);
    $start = $_POST['ngay_bat_dau'];
    $end = $_POST['ngay_ket_thuc'];

    // Kiểm tra nếu đã có khuyến mãi cho món này thì cập nhật
    $existing = pdo_query_one("SELECT id FROM discounts WHERE menu_id = ?", $menu_id);
    if ($existing) {
        pdo_execute("UPDATE discounts SET giam_phan_tram = ?, ngay_bat_dau = ?, ngay_ket_thuc = ? WHERE menu_id = ?", $giam, $start, $end, $menu_id);
    } else {
        pdo_execute("INSERT INTO discounts (menu_id, giam_phan_tram, ngay_bat_dau, ngay_ket_thuc) VALUES (?, ?, ?, ?)", $menu_id, $giam, $start, $end);
    }

    echo "<script>alert('Đã lưu khuyến mãi.'); window.location.href='indexAdmin.php?act=khuyenmai';</script>";
    exit;
}

// Lấy danh sách món ăn và khuyến mãi
$menus = pdo_query("SELECT m.*, d.giam_phan_tram, d.ngay_bat_dau, d.ngay_ket_thuc
    FROM menu m
    LEFT JOIN discounts d ON m.id = d.menu_id");
?>

<!DOCTYPE html>
<html>
<head>
    <title>Khuyến Mãi Món Ăn</title>
    <style>
        table { border-collapse: collapse; width: 100%; margin-top: 20px; }
        th, td { border: 1px solid #ccc; padding: 10px; }
        input, select { padding: 5px; width: 100%; }
    </style>
</head>
<body>

<h2>Quản Lý Khuyến Mãi</h2>

<table>
    <thead>
        <tr>
            <th>Tên Món</th>
            <th>Giá Gốc</th>
            <th>Giảm (%)</th>
            <th>Giá Sau Giảm</th>
            <th>Ngày Bắt Đầu</th>
            <th>Ngày Kết Thúc</th>
            <th>Hành Động</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($menus as $menu): 
            $giaGoc = $menu['gia'];
            $giam = $menu['giam_phan_tram'] ?? 0;
            $giaMoi = $giam ? $giaGoc * (1 - $giam / 100) : $giaGoc;
        ?>
        <tr>
            <form method="POST">
                <input type="hidden" name="menu_id" value="<?= $menu['id'] ?>">
                <td><?= htmlspecialchars($menu['ten_mon']) ?></td>
                <td><?= number_format($giaGoc, 0) ?> VND</td>
                <td><input type="number" name="giam_phan_tram" value="<?= $giam ?>" min="0" max="100"></td>
                <td><?= number_format($giaMoi, 0) ?> VND</td>
                <td><input type="date" name="ngay_bat_dau" value="<?= $menu['ngay_bat_dau'] ?? '' ?>"></td>
                <td><input type="date" name="ngay_ket_thuc" value="<?= $menu['ngay_ket_thuc'] ?? '' ?>"></td>
                <td><input type="submit" value="Lưu"></td>
            </form>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
