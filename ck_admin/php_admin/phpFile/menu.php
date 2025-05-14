<?php
require_once("adminDAO/pdo.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ten_mon'], $_POST['phan_loai'], $_POST['gia'])) {
    $ten = trim($_POST['ten_mon']);
    $mo_ta = trim($_POST['mo_ta'] ?? '');
    $gia = trim($_POST['gia']);
    $phan_loai = intval($_POST['phan_loai']); // Category ID

    // Kiểm tra nếu có ảnh được tải lên
    $imageData = null;
    if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['hinh_anh']['tmp_name']);
    }

    if (empty($ten) || empty($gia) || empty($phan_loai)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin.'); window.history.back();</script>";
        exit;
    }

    try {
        pdo_execute("INSERT INTO menu (ten_mon, mo_ta, gia, hinh_anh, phan_loai) VALUES (?, ?, ?, ?, ?)", $ten, $mo_ta, $gia, $imageData, $phan_loai);
        echo "<script>alert('Thêm món ăn thành công.'); window.location.href='indexAdmin.php?act=menu';</script>";
        exit;
    } catch (Exception $e) {
        echo "<script>alert('Lỗi khi thêm món ăn: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['ten_mon'], $_POST['phan_loai'], $_POST['gia'])) {
    $id = intval($_POST['id']);
    $ten = trim($_POST['ten_mon']);
    $mo_ta = trim($_POST['mo_ta'] ?? '');
    $gia = trim($_POST['gia']);
    $phan_loai = intval($_POST['phan_loai']); // Category ID

    // Kiểm tra nếu có ảnh mới được tải lên
    $imageData = null;
    if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] === UPLOAD_ERR_OK) {
        $imageData = file_get_contents($_FILES['hinh_anh']['tmp_name']);
    }

    if (empty($ten) || empty($gia) || empty($phan_loai)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin.'); window.history.back();</script>";
        exit;
    }

    try {
        if ($imageData) {
            pdo_execute("UPDATE menu SET ten_mon = ?, mo_ta = ?, gia = ?, hinh_anh = ?, phan_loai = ? WHERE id = ?", $ten, $mo_ta, $gia, $imageData, $phan_loai, $id);
        } else {
            pdo_execute("UPDATE menu SET ten_mon = ?, mo_ta = ?, gia = ?, phan_loai = ? WHERE id = ?", $ten, $mo_ta, $gia, $phan_loai, $id);
        }
        echo "<script>alert('Cập nhật món ăn thành công.'); window.location.href='indexAdmin.php?act=menu';</script>";
        exit;
    } catch (Exception $e) {
        echo "<script>alert('Lỗi khi cập nhật món ăn: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
        exit;
    }
}

if (isset($_GET['delete'])) {
    $id = intval($_GET['delete']);
    try {
        pdo_execute("DELETE FROM menu WHERE id = ?", $id);
        echo "<script>alert('Xóa món ăn thành công.'); window.location.href='indexAdmin.php?act=menu';</script>";
        exit;
    } catch (Exception $e) {
        echo "<script>alert('Lỗi khi xóa món ăn: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
        exit;
    }
}

$menus = pdo_query("SELECT m.*, c.name AS category_name FROM menu m LEFT JOIN category c ON m.phan_loai = c.id");

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Menu</title>
</head>
<body>
    <h1>Quản Lý Menu</h1>

    <!-- Nút mở popup -->
    <button id="openFormBtn">➕ Thêm Món Mới</button>

    <!-- Popup Form -->
    <div id="popupForm" class="modal">
        <div class="modal-content">
            <h2>Thêm Món Mới</h2>
            <form method="POST" enctype="multipart/form-data">
                <label for="ten_mon">Tên Món:</label>
                <input type="text" id="ten_mon" name="ten_mon" required>

                <label for="mo_ta">Mô Tả:</label>
                <textarea id="mo_ta" name="mo_ta"></textarea>

                <label for="gia">Giá:</label>
                <input type="text" id="gia" name="gia" required>

                <label for="phan_loai">Danh Mục:</label>
                <select name="phan_loai" id="phan_loai" required>
                    <?php
                    $categories = pdo_query("SELECT * FROM category");
                    foreach ($categories as $category) {
                        echo "<option value='{$category['id']}'>{$category['name']}</option>";
                    }
                    ?>
                </select>

                <label for="hinh_anh">Hình Ảnh:</label>
                <input type="file" name="hinh_anh" id="hinh_anh">

                <input type="submit" value="Thêm Món">
            </form>
        </div>
    </div>

    <!-- Danh sách món ăn -->
    <h2>Danh Sách Món Ăn</h2>
    <table border="1">
        <thead>
            <tr>
                <th>Tên Món</th>
                <th>Mô Tả</th>
                <th>Giá</th>
                <th>Danh Mục</th>
                <th>Hình Ảnh</th>
                <th>Thao Tác</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($menus as $menu): ?>
                <tr>
                    <td><?= htmlspecialchars($menu['ten_mon']) ?></td>
                    <td><?= htmlspecialchars($menu['mo_ta']) ?></td>
                    <td><?= number_format($menu['gia'], 2) ?> VND</td>
                    <td><?= htmlspecialchars($menu['category_name']) ?></td>
                    <td><img src="data:image/jpeg;base64,<?= base64_encode($menu['hinh_anh']) ?>" alt="image" width="100"></td>
                    <td>
                        <a href="indexAdmin.php?act=menu&id=<?= $menu['id'] ?>">Chỉnh Sửa</a> |
                        <a href="indexAdmin.php?act=menu&delete=<?= $menu['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa món ăn này không?')">Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- CSS cho popup -->
    <style>
        .modal {
            display: none;
            position: fixed;
            z-index: 1000;
            left: 0; top: 0;
            width: 100%; height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
        }
        .modal-content {
            background-color: #fff;
            margin: 5% auto;
            padding: 20px;
            border-radius: 8px;
            width: 400px;
            position: relative;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
        }
        .close {
            color: #aaa;
            position: absolute;
            top: 10px; right: 15px;
            font-size: 24px;
            cursor: pointer;
        }
        .modal-content input[type="text"],
        .modal-content textarea,
        .modal-content select,
        .modal-content input[type="file"] {
            width: 100%;
            padding: 8px;
            margin: 6px 0 12px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .modal-content input[type="submit"] {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px 15px;
            border-radius: 4px;
            cursor: pointer;
        }
        .modal-content input[type="submit"]:hover {
            background-color: #218838;
        }
        #openFormBtn {
            padding: 10px 20px;
            font-size: 16px;
            margin-bottom: 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        #openFormBtn:hover {
            background-color: #0056b3;
        }
    </style>

    <!-- JavaScript để điều khiển popup -->
   <script>
    const modal = document.getElementById("popupForm");
    const btn = document.getElementById("openFormBtn");
    const closeBtn = document.getElementById("closeBtn");

    btn.onclick = function() {
        modal.style.display = "block";
    }

    closeBtn.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }
</script>

</body>

</html>
