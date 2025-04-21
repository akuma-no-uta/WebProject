<?php
require_once 'adminDAO/pdo.php';

// Lấy dữ liệu hiện tại
$data = pdo_query_one("SELECT * FROM thongtin WHERE id = 1");

// Nếu có submit form thì xử lý cập nhật
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sql = "UPDATE thongtin SET 
        hero_title = ?, 
        hero_subtitle = ?, 
        hero_description = ?, 
        hero_image_url = ?, 
        about_title = ?, 
        about_subtitle = ?, 
        about_description = ?, 
        about_image_url = ?
        WHERE id = 1";

    pdo_execute($sql, 
        $_POST['hero_title'], 
        $_POST['hero_subtitle'], 
        $_POST['hero_description'], 
        $_POST['hero_image_url'], 
        $_POST['about_title'], 
        $_POST['about_subtitle'], 
        $_POST['about_description'], 
        $_POST['about_image_url']
    );

    header("Location: index.php"); // Quay lại trang chính
    exit;
}
?>

<h2>Chỉnh sửa Thông tin</h2>
<form method="POST">
    <h3>Hero Section</h3>
    Tiêu đề nhỏ: <input type="text" name="hero_title" value="<?= htmlspecialchars($data['hero_title']) ?>"><br>
    Tiêu đề lớn: <input type="text" name="hero_subtitle" value="<?= htmlspecialchars($data['hero_subtitle']) ?>"><br>
    Mô tả: <textarea name="hero_description"><?= htmlspecialchars($data['hero_description']) ?></textarea><br>
    Link ảnh Hero: <input type="text" name="hero_image_url" value="<?= htmlspecialchars($data['hero_image_url']) ?>"><br>

    <h3>About Section</h3>
    Tiêu đề nhỏ: <input type="text" name="about_title" value="<?= htmlspecialchars($data['about_title']) ?>"><br>
    Tiêu đề lớn: <input type="text" name="about_subtitle" value="<?= htmlspecialchars($data['about_subtitle']) ?>"><br>
    Mô tả: <textarea name="about_description"><?= htmlspecialchars($data['about_description']) ?></textarea><br>
    Link ảnh About: <input type="text" name="about_image_url" value="<?= htmlspecialchars($data['about_image_url']) ?>"><br>

    <button type="submit">Lưu thay đổi</button>
</form>
