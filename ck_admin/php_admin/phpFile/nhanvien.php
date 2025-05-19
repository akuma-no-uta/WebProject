<?php
// Xử lý xóa nhân viên
if (isset($_GET['act']) && $_GET['act'] === 'deleteNhanvien' && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $check = pdo_query_one("SELECT * FROM nhanvien WHERE id = ?", $id);
    if ($check) {
        pdo_execute("DELETE FROM nhanvien WHERE id = ?", $id);
        echo "<script>alert('Xóa nhân viên thành công.'); window.location.href='indexAdmin.php?act=nhanvienAdmin';</script>";
        exit();
    } else {
        echo "<script>alert('Nhân viên không tồn tại.'); window.location.href='indexAdmin.php?act=nhanvienAdmin';</script>";
        exit();
    }
}

// Xử lý thêm nhân viên
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addNhanvien'])) {
    $ho = trim($_POST['ho']);
    $ten = trim($_POST['ten']);
    $ngaysinh = $_POST['ngaysinh'];
    $gioitinh = $_POST['gioitinh'];
    $sdt = trim($_POST['sdt']);
    $email = trim($_POST['email']);
    $diachi = trim($_POST['diachi']);
    $chucvu = trim($_POST['chucvu']);
    $hinhthuc = $_POST['hinhthuc'];

    if (!$ho || !$ten || !$ngaysinh || !$gioitinh || !$sdt || !$email || !$diachi || !$chucvu || !$hinhthuc) {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin.'); history.back();</script>";
        exit();
    }

    pdo_execute("INSERT INTO nhanvien (ho, ten, ngaysinh, gioitinh, sdt, email, diachi, chucvu, hinhthuc)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)", 
                $ho, $ten, $ngaysinh, $gioitinh, $sdt, $email, $diachi, $chucvu, $hinhthuc);

    echo "<script>alert('Thêm nhân viên thành công.'); window.location.href='indexAdmin.php?act=nhanvienAdmin';</script>";
    exit();
}

// Lấy dữ liệu nhân viên
$nhanviens = pdo_query("SELECT * FROM nhanvien");
?>

<!-- Giao diện -->
<style>
    .form-container, table {
        max-width: 1000px;
        margin: 30px auto;
        font-family: 'Segoe UI', sans-serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background: white;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    table th, table td {
        padding: 12px;
        border: 1px solid #ddd;
        text-align: left;
    }

    table th {
        background: #007bff;
        color: white;
    }

    .form-container {
        background: #f9f9f9;
        padding: 20px;
        border-radius: 10px;
    }

    .form-container h3 {
        text-align: center;
    }

    .form-container label {
        display: block;
        margin: 10px 0 5px;
    }

    .form-container input, .form-container select {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    .form-container button {
        margin-top: 15px;
        padding: 10px 20px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 6px;
        cursor: pointer;
    }

    .form-container button:hover {
        background: #0056b3;
    }

    .action-buttons a {
        margin-right: 10px;
        color: #007bff;
        text-decoration: none;
    }

    .action-buttons a:hover {
        text-decoration: underline;
    }
</style>

<div class="form-container">
    <h3>Thêm Nhân Viên</h3>
    <form method="post">
        <label>Họ: <input type="text" name="ho" required></label>
        <label>Tên: <input type="text" name="ten" required></label>
        <label>Ngày sinh: <input type="date" name="ngaysinh" required></label>
        <label>Giới tính:
            <select name="gioitinh" required>
                <option value="Nam">Nam</option>
                <option value="Nữ">Nữ</option>
                <option value="Khác">Khác</option>
            </select>
        </label>
        <label>Số điện thoại: <input type="text" name="sdt" required></label>
        <label>Email: <input type="email" name="email" required></label>
        <label>Địa chỉ: <input type="text" name="diachi" required></label>
        <label>Chức vụ: <input type="text" name="chucvu" required></label>
        <label>Hình thức làm việc:
            <select name="hinhthuc" required>
                <option value="Full-time">Full-time</option>
                <option value="Part-time">Part-time</option>
            </select>
        </label>
        <button type="submit" name="addNhanvien">Thêm Nhân Viên</button>
    </form>
</div>

<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Họ tên</th>
            <th>Ngày sinh</th>
            <th>Giới tính</th>
            <th>SDT</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Chức vụ</th>
            <th>Hình thức</th>
            <th>Thao tác</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($nhanviens as $nv): ?>
        <tr>
            <td><?= htmlspecialchars($nv['id']) ?></td>
            <td><?= htmlspecialchars($nv['ho'] . ' ' . $nv['ten']) ?></td>
            <td><?= htmlspecialchars($nv['ngaysinh']) ?></td>
            <td><?= htmlspecialchars($nv['gioitinh']) ?></td>
            <td><?= htmlspecialchars($nv['sdt']) ?></td>
            <td><?= htmlspecialchars($nv['email']) ?></td>
            <td><?= htmlspecialchars($nv['diachi']) ?></td>
            <td><?= htmlspecialchars($nv['chucvu']) ?></td>
            <td><?= htmlspecialchars($nv['hinhthuc']) ?></td>
            <td class="action-buttons">
                <a href="indexAdmin.php?act=editNhanvien&id=<?= $nv['id'] ?>">Sửa</a>
                <a href="indexAdmin.php?act=deleteNhanvien&id=<?= $nv['id'] ?>" onclick="return confirm('Xác nhận xóa nhân viên?');">Xóa</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
