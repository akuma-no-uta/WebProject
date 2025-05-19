<?php
// Kết nối tới cơ sở dữ liệu
require_once 'adminDAO/pdo.php';

// Truy vấn cơ sở dữ liệu để lấy tất cả đánh giá
$sql = "SELECT * FROM danh_gia ORDER BY ngay_danh_gia DESC";
$reviews = pdo_query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xem Đánh Giá</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f1f3f4;
            margin: 20px;
        }

        h2 {
            color: #202124;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: #fff;
            box-shadow: 0 1px 3px rgb(60 64 67 / 0.3);
            border-radius: 8px;
            overflow: hidden;
        }

        thead {
            background-color: #f8f9fa;
            border-bottom: 1px solid #dadce0;
        }

        thead th {
            text-align: left;
            padding: 12px 15px;
            font-weight: 600;
            font-size: 14px;
            color: #3c4043;
            border-right: 1px solid #dadce0;
        }

        thead th:last-child {
            border-right: none;
        }

        tbody tr {
            border-bottom: 1px solid #dadce0;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }

        tbody tr:hover {
            background-color: #f1f3f4;
        }

        tbody td {
            padding: 12px 15px;
            vertical-align: top;
            font-size: 14px;
            color: #202124;
            border-right: 1px solid #e8eaed;
        }

        tbody td:last-child {
            border-right: none;
        }

        .rating {
            font-weight: 700;
            color: #fbbc04; /* màu vàng */
        }

        .datetime {
            color: #5f6368;
            font-size: 12px;
            white-space: nowrap;
        }

        .review-text {
            white-space: pre-wrap; /* giữ nguyên xuống dòng */
        }
    </style>
</head>
<body>

<h2>Các Đánh Giá</h2>

<table>
    <thead>
        <tr>
            <th>Họ Tên</th>
            <th>Lớp</th>
            <th>Chất Lượng Bài Giảng</th>
            <th>Chất Lượng Bài Tập</th>
            <th>Thái Độ Giảng Viên</th>
            <th>Nội Dung Góp Ý</th>
            <th>Ngày Đánh Giá</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reviews as $review): ?>
        <tr>
            <td><?= htmlspecialchars($review['ho_ten']) ?></td>
            <td><?= htmlspecialchars($review['lop']) ?></td>
            <td class="rating"><?= htmlspecialchars($review['chat_luong_bai_giang']) ?>/5</td>
            <td class="rating"><?= htmlspecialchars($review['chat_luong_bai_tap']) ?>/5</td>
            <td class="rating"><?= htmlspecialchars($review['thai_do_giang_vien']) ?>/5</td>
            <td class="review-text"><?= nl2br(htmlspecialchars($review['noi_dung_gop_y'])) ?></td>
            <td class="datetime"><?= date('d/m/Y H:i', strtotime($review['ngay_danh_gia'])) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

</body>
</html>
