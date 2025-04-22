<?php
require_once 'adminDAO/pdo.php';

// Xử lý khi người dùng gửi bài viết
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $tieude = trim($_POST['tieude']);
    $noidung = trim($_POST['noidung']);
    $nguoitao = 'Giáo viên A'; // Sau này có thể thay bằng session đăng nhập

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
      
        .post-form, .post {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
            box-shadow: 0 0 5px rgba(0,0,0,0.1);
        }
        .post-form input, .post-form textarea {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .post-form button {
            padding: 10px 20px;
            background-color: #0284c7;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .post-form button:hover{
            background-color:blue;
        }
        .post h3 {
            margin-top: 0;
        }
        .post small {
            color: #666;
        }
    </style>
</head>
<body>

<h2>Bảng Tin Lớp Học</h2>

<div class="post-form">
    <form method="POST">
        <label>Tiêu đề:</label>
        <input type="text" name="tieude" placeholder="Nhập tiêu đề bài viết" required>

        <label>Nội dung:</label>
        <textarea name="noidung" placeholder="Nhập nội dung bài viết..." rows="5" required></textarea>

        <button type="submit">Đăng bài</button>
    </form>
</div>

<?php foreach ($posts as $post): ?>
    <div class="post">
        <h3><?= htmlspecialchars($post['tieude']) ?></h3>
        <p><?= nl2br(htmlspecialchars($post['noidung'])) ?></p>
        <small>Đăng bởi: <?= htmlspecialchars($post['nguoitao']) ?> | <?= date('d/m/Y H:i', strtotime($post['ngaydang'])) ?></small>
    </div>
<?php endforeach; ?>

</body>
</html>
