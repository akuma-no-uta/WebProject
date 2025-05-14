<?php
// Kết nối tới cơ sở dữ liệu
require_once 'adminDAO/pdo.php';

// Truy vấn cơ sở dữ liệu để lấy tất cả đánh giá
$sql = "SELECT * FROM danhgia ORDER BY created_at DESC";
$reviews = pdo_query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Xem Đánh Giá</title>
    <style>
        /* Cấu trúc kiểu dữ liệu đã được chỉnh sửa */
        .review-container {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        
        .review-container h3 {
            font-size: 20px;
            color: #007bff;
        }
        
        .review-container p {
            font-size: 16px;
            color: #555;
        }

        .review-container small {
            font-size: 12px;
            color: #888;
        }
        
        .rating {
            font-weight: bold;
            color: #f39c12;
        }
    </style>
</head>
<body>

<h2>Xem Các Đánh Giá</h2>

<?php foreach ($reviews as $review): ?>
    <div class="review-container">
        <h3><?= htmlspecialchars($review['user_name']) ?> (<?= $review['rating'] ?>/5)</h3>
        <p><?= nl2br(htmlspecialchars($review['review_text'])) ?></p>
        <small>Đánh giá vào: <?= date('d/m/Y H:i', strtotime($review['created_at'])) ?></small>
    </div>
<?php endforeach; ?>

</body>
</html>
