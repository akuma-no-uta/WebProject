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
     .modal {
        display: none;
        position: fixed;
        z-index: 999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0,0,0,0.5);
    }

    .modal-content {
        background-color: #ffffff;
        margin: 5% auto;
        padding: 30px;
        border-radius: 12px;
        width: 90%;
        max-width: 600px;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.2);
        animation: fadeIn 0.3s ease-in-out;
        font-family: 'Segoe UI', sans-serif;
    }

    .modal-content h3 {
        text-align: center;
        margin-bottom: 20px;
        font-size: 24px;
        color: #007bff;
    }

    .modal-content label {
        display: block;
        margin-bottom: 15px;
        font-weight: 500;
        color: #333;
    }

    .modal-content input,
    .modal-content select {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
        margin-top: 5px;
        box-sizing: border-box;
        transition: border-color 0.2s;
    }

    .modal-content input:focus,
    .modal-content select:focus {
        border-color: #007bff;
        outline: none;
    }

    .modal-content button {
        display: block;
        width: 100%;
        padding: 12px;
        background: #007bff;
        color: white;
        border: none;
        border-radius: 8px;
        font-size: 16px;
        margin-top: 10px;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .modal-content button:hover {
        background-color: #0056b3;
    }

    .close {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        cursor: pointer;
    }

    .close:hover,
    .close:focus {
        color: #000;
    }

    @keyframes fadeIn {
        from {opacity: 0;}
        to {opacity: 1;}
    }
</style>

<!-- Nút mở popup -->
<div class="form-container" style="text-align:center;">
    <button onclick="openModal()">+ Thêm Nhân Viên</button>
</div>

<!-- Modal popup -->
<div id="modalForm" class="modal">
    <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
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

<script>
    function openModal() {
        document.getElementById("modalForm").style.display = "block";
    }

    function closeModal() {
        document.getElementById("modalForm").style.display = "none";
    }

    // Đóng modal nếu click ra ngoài nội dung
    window.onclick = function(event) {
        let modal = document.getElementById("modalForm");
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

