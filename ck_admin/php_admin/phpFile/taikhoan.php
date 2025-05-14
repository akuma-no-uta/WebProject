<?php
ob_start();
require_once 'adminDAO/pdo.php';

// Lấy toàn bộ người dùng
$data = pdo_query("SELECT * FROM users");

// Kiểm tra chế độ chỉnh sửa
$edit_id = isset($_GET['edit']) ? (int)$_GET['edit'] : null;

// Xử lý lưu chỉnh sửa
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['id'];
    $sql = "UPDATE users SET ten = ?, email = ?, vaitro = ? WHERE id = ?";
    pdo_execute($sql, $_POST['ten'], $_POST['email'], $_POST['vaitro'], $id);
    header("Location: indexAdmin.php?act=thongtinUser");
    exit;
}
ob_end_flush();
?>

<style>
.table-wrapper {
    max-width: 1000px;
    margin: 40px auto;
    background: #f9f9f9;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    font-family: 'Segoe UI', sans-serif;
}

.table-wrapper h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
}

table thead {
    background-color: #f0f2f5;
}

table th, table td {
    padding: 12px 15px;
    border: 1px solid #ddd;
    text-align: left;
}

.action-buttons a {
    margin-right: 10px;
    text-decoration: none;
    color: #007bff;
    font-weight: 500;
}

.action-buttons button {
    background-color: #28a745;
    color: white;
    padding: 6px 12px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

input[type="text"], input[type="email"] {
    width: 100%;
    padding: 6px 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}
</style>

<div class="table-wrapper">
    <h2>Thông Tin Người Dùng</h2>
    <form method="post">
        <table>
            <thead>
                <tr>
                    <th>Tên</th>
                    <th>Email</th>
                    <th>Vai Trò</th>
                    <th>Thao Tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data as $user): ?>
                    <tr>
                        <?php if ($edit_id == $user['id']): ?>
                            <input type="hidden" name="id" value="<?= $user['id'] ?>">
                            <td><input type="text" name="ten" value="<?= htmlspecialchars($user['ten']) ?>"></td>
                            <td><input type="email" name="email" value="<?= htmlspecialchars($user['email']) ?>"></td>
                            <td><input type="text" name="vaitro" value="<?= htmlspecialchars($user['vaitro']) ?>"></td>
                            <td class="action-buttons">
                                <button type="submit">💾 Lưu</button>
                                <a href="indexAdmin.php?act=thongtinUser">Hủy</a>
                            </td>
                        <?php else: ?>
                            <td><?= htmlspecialchars($user['ten']) ?></td>
                            <td><?= htmlspecialchars($user['email']) ?></td>
                            <td><?= htmlspecialchars($user['vaitro']) ?></td>
                            <td class="action-buttons">
                                <a href="indexAdmin.php?act=thongtinUser&edit=<?= $user['id'] ?>">Chỉnh Sửa</a>
                            </td>
                        <?php endif; ?>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </form>
</div>
