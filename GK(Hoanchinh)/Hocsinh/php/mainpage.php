<?php
require_once 'Hocsinh/php/pdo.php';

// Xử lý khi người dùng gửi bài viết
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tieude = trim($_POST['tieude']);
    $noidung = trim($_POST['noidung']);
    $nguoitao = ''; // Sau này có thể thay bằng session đăng nhập

    if ($tieude !== '' && $noidung !== '') {
        $sql_insert = "INSERT INTO baidang (tieude, noidung, nguoitao) VALUES (?, ?, ?)";
        pdo_execute($sql_insert, $tieude, $noidung, $nguoitao);
        header("Location: " . $_SERVER['PHP_SELF']); // Tránh submit lại khi reload
        exit;
    }
}

$sql = "SELECT * FROM baidang ORDER BY ngaydang DESC";
$posts = pdo_query($sql);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Bảng Tin Lớp Học</title>
    <style>

    body {
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        line-height: 1.6;
        color: #333;
        background-color: #f5f5f5;
        padding: 20px;
    }

    h2 {
        font-size: 28px;
        color: #2c3e50;
        margin-top: 20px;
        margin-bottom: 20px;
        padding-bottom: 5px;
        border-bottom: 2px solid #0284c7;   
    }

    .post {
        background-color: #fff;
        padding: 25px;
        border-radius: 10px;
        margin-bottom: 25px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border-left: 4px solid #26f1ff;
    }

    .post:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .post h3 {
        font-size: 22px;
        color: #2c3e50;
        margin-top: 0;
        margin-bottom: 15px;
    }

    .post p {
        font-size: 16px;
        color: #555;
        margin-bottom: 15px;
        line-height: 1.7;
    }

    .post small {
        display: block;
        font-size: 14px;
        color: #7f8c8d;
        margin-top: 15px;
        padding-top: 10px;
        border-top: 1px dashed #ecf0f1;
    }

    .post-form, .post {
        max-width: 800px;
    }

    .post-form input, .post-form textarea {
        width: 100%;
        padding: 12px;
        margin-top: 8px;
        margin-bottom: 15px;
        border: 1px solid #ddd;
        border-radius: 6px;
        font-size: 16px;
        transition: border 0.3s;
    }

    .post-form input:focus, 
    .post-form textarea:focus {
        border-color: #0284c7;
        outline: none;
        box-shadow: 0 0 0 3px rgba(2, 132, 199, 0.1);
    }

    .post-form button {
        padding: 12px 25px;
        background-color: #0284c7;
        color: #fff;
        border: none;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        font-weight: 500;
        transition: background-color 0.3s;
    }

    .post-form button:hover {
        background-color: #0369a1;
    }
</style>
</head>
<body>

<h2>Bảng Tin Lớp Học</h2>   
<div class="baidang" style="width:100%;
    max-width: auto;
    padding: 30px;
    border: 1px solid #cbd5e0;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    background-color: #d5d2da;">
<?php foreach ($posts as $post): ?>
    <div class="post">
        <h3><?= htmlspecialchars($post['tieude']) ?></h3>
        <p><?= nl2br(htmlspecialchars($post['noidung'])) ?></p>
        <small>Đăng bởi: <?= htmlspecialchars($post['nguoitao']) ?> | <?= date('d/m/Y H:i', strtotime($post['ngaydang'])) ?></small>
    </div>
<?php endforeach; ?>
</div>
</body>
</html>
