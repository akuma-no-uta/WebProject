<?php
// Kết nối tới cơ sở dữ liệu
require_once 'adminDAO/pdo.php';

// Xử lý cập nhật trạng thái nếu có request
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id'])) {
    $order_id = $_POST['order_id'];
    $sql = "UPDATE don_hang SET trang_thai = 'da hoan thanh' WHERE id = ?";
    pdo_execute($sql, $order_id);
    
    // Refresh trang để hiển thị thay đổi
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

// Lấy danh sách đơn hàng và tính tổng tiền từ chi tiết đơn hàng
$sql = "SELECT d.*, 
               SUM(ct.so_luong * ct.gia) AS tong_tien
        FROM don_hang d
        LEFT JOIN chi_tiet_don_hang ct ON d.id = ct.id_don_hang
        GROUP BY d.id
        ORDER BY d.id ASC";
$orders = pdo_query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh Sách Đơn Hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #fafafa;
            color: #333;
            margin: 20px;
        }
        button[disabled] {
            cursor: default;
            opacity: 0.6;
        }

        h2 {
            margin-bottom: 20px;
            color: #2c3e50;
        }

        .order-list {
            width: 100%;
            border-collapse: collapse;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            background-color: #fff;
        }

        .order-list th, .order-list td {
            padding: 12px 16px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .order-list th {
            background-color: #2980b9;
            color: white;
            font-weight: 600;
            text-transform: uppercase;
        }

        .order-list tr:hover {
            background-color: #f1f9ff;
        }

        .order-list td small {
            color: #777;
        }

        .price {
            color: #27ae60;
            font-weight: bold;
        }

        .status {
            padding: 6px 12px;
            border-radius: 4px;
            font-weight: bold;
            text-align: center;
            display: inline-block;
        }

        .status-pending {
            background-color: #f39c12;
            color: white;
            cursor: pointer;
        }

        .status-completed {
            background-color: #2ecc71;
            color: white;
        }
        .details-row {
            background-color: #f9f9f9;
        }

        .details-row ul {
            margin: 8px 0;
            padding-left: 20px;
        }
        .status-pending:hover {
    background-color: #e67e22; /* Màu sáng hơn của #f39c12 */
    box-shadow: 0 0 8px rgba(243, 156, 18, 0.5);
    transition: all 0.2s ease;
}

.status-completed:hover {
    background-color: #27ae60; /* Màu sáng hơn một chút */
    box-shadow: 0 0 8px rgba(46, 204, 113, 0.5);
    transition: all 0.2s ease;
}

    </style>
</head>
<body>

<h2>Danh Sách Đơn Hàng</h2>

<table class="order-list">
    <thead>
        <tr>
            <th>Mã Đơn</th>
            <th>Tên Khách Hàng</th>
            <th>SĐT</th>
            <th>Địa Chỉ</th>
            <th>Ngày Đặt</th>
            <th>Tổng Tiền</th>
            <th>Trạng Thái</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
            <tr>
                <td>#<?= $order['id'] ?></td>
                <td><?= htmlspecialchars($order['ten_khach_hang']) ?></td>
                <td><?= htmlspecialchars($order['sdt']) ?></td>
                <td><?= htmlspecialchars($order['dia_chi']) ?></td>
                <td><small><?= date('d/m/Y H:i', strtotime($order['ngay_dat'])) ?></small></td>
                <td class="price"><?= number_format($order['tong_tien'] ?? 0, 0, ',', '.') ?>₫</td>
                <td>
                    <form class="action-form" method="POST">
                        <input type="hidden" name="order_id" value="<?= $order['id'] ?>">
                        <button 
                            type="<?= $order['trang_thai'] === 'dang xu ly' ? 'submit' : 'button' ?>" 
                            class="status action-btn <?= $order['trang_thai'] === 'dang xu ly' ? 'status-pending' : 'status-completed' ?>"
                            <?= $order['trang_thai'] !== 'dang xu ly' ? 'disabled' : '' ?>
                            onclick="return <?= $order['trang_thai'] === 'dang xu ly' ? 'confirm(\'Bạn chắc chắn muốn cập nhật trạng thái đơn hàng này?\')' : 'false' ?>;"
                        >
                            <?= $order['trang_thai'] === 'dang xu ly' ? 'Đang xử lý' : 'Đã hoàn thành' ?>
                        </button>
                    </form>
                </td>

            </tr>

            <?php
            // Truy vấn chi tiết món ăn trong đơn hàng
            $chi_tiet_sql = "SELECT ct.*, m.ten_mon 
                             FROM chi_tiet_don_hang ct
                             JOIN menu m ON ct.id_menu = m.id
                             WHERE ct.id_don_hang = ?";
            $chi_tiet = pdo_query($chi_tiet_sql, $order['id']);
            ?>

            <tr class="details-row">
                <td colspan="7">
                    <strong>Chi tiết món:</strong>
                    <ul>
                        <?php foreach ($chi_tiet as $ct): ?>
                            <li><?= htmlspecialchars($ct['ten_mon']) ?> × <?= $ct['so_luong'] ?> = 
                                <?= number_format($ct['so_luong'] * $ct['gia'], 0, ',', '.') ?>₫
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </td>
            </tr>

        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
