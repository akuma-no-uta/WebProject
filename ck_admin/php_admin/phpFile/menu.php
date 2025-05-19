<?php
require_once("adminDAO/pdo.php");

// Thêm món
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ten_mon'], $_POST['phan_loai'], $_POST['gia']) && empty($_POST['id'])) {
    $ten = trim($_POST['ten_mon']);
    $mo_ta = trim($_POST['mo_ta'] ?? '');
    $gia = trim($_POST['gia']);
    $phan_loai = intval($_POST['phan_loai']);

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

// Cập nhật món
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['ten_mon'], $_POST['phan_loai'], $_POST['gia'])) {
    $id = intval($_POST['id']);
    $ten = trim($_POST['ten_mon']);
    $mo_ta = trim($_POST['mo_ta'] ?? '');
    $gia = trim($_POST['gia']);
    $phan_loai = intval($_POST['phan_loai']);

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

// Xóa món
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

// Lấy dữ liệu menu
$menus = pdo_query("SELECT m.*, c.name AS category_name FROM menu m LEFT JOIN category c ON m.phan_loai = c.id");

// Lấy dữ liệu để sửa
$editItem = null;
if (isset($_GET['id'])) {
    $editItem = pdo_query_one("SELECT * FROM menu WHERE id = ?", intval($_GET['id']));
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Menu</title>
<script src="https://cdn.ckeditor.com/4.25.1-lts/full/ckeditor.js"></script>


    <style>
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.5); }
        .modal-content { background: #fff; margin: 5% auto; padding: 20px; border-radius: 8px; width: 500px; position: relative; }
        input, select, textarea { width: 100%; padding: 8px; margin: 5px 0 12px; border: 1px solid #ccc; border-radius: 4px; }
        input[type="submit"] { background: #28a745; color: #fff; border: none; cursor: pointer; }
        input[type="submit"]:hover { background: #218838; }
        .close-btn { position: absolute; top: 10px; right: 15px; font-size: 24px; color: #aaa; cursor: pointer; }
        .close-btn:hover { color: #000; }
        #openFormBtn { margin-bottom: 20px; padding: 10px 20px; background: #007bff; color: white; border-radius: 4px; border: none; cursor: pointer; }
        .thumbnail { width: 120px; height: 120px; object-fit: cover; }
    </style>
</head>
<body>

<h1>Quản Lý Menu</h1>
<button id="openFormBtn">➕ Thêm Món Mới</button>

<!-- Form Thêm Mới hoặc Chỉnh Sửa -->
<div id="popupForm" class="modal" style="<?= $editItem ? 'display:block' : '' ?>">
    <div class="modal-content">
        <span class="close-btn" id="closeModalBtn">&times;</span>
        <h2><?= $editItem ? 'Chỉnh Sửa Món Ăn' : 'Thêm Món Mới' ?></h2>
        <form method="POST" enctype="multipart/form-data">
            <?php if ($editItem): ?>
                <input type="hidden" name="id" value="<?= $editItem['id'] ?>">
            <?php endif; ?>

            <label for="ten_mon">Tên Món:</label>
            <input type="text" id="ten_mon" name="ten_mon" required value="<?= $editItem['ten_mon'] ?? '' ?>">

            <label for="mo_ta">Mô Tả:</label>
            <textarea id="mo_ta" name="mo_ta"><?= $editItem['mo_ta'] ?? '' ?></textarea>

            <label for="gia">Giá:</label>
            <input type="text" id="gia" name="gia" required value="<?= $editItem['gia'] ?? '' ?>">

            <label for="phan_loai">Danh Mục:</label>
            <select name="phan_loai" id="phan_loai" required>
                <?php
                $categories = pdo_query("SELECT * FROM category");
                foreach ($categories as $category) {
                    $selected = ($editItem && $editItem['phan_loai'] == $category['id']) ? "selected" : "";
                    echo "<option value='{$category['id']}' $selected>{$category['name']}</option>";
                }
                ?>
            </select>

            <label for="hinh_anh">Hình Ảnh:</label>
            <input type="file" name="hinh_anh" id="hinh_anh">
            <?php if ($editItem && !empty($editItem['hinh_anh'])): ?>
                <p>Ảnh hiện tại:</p>
                <img src="data:image/jpeg;base64,<?= base64_encode($editItem['hinh_anh']) ?>" class="thumbnail">
            <?php endif; ?>

            <input type="submit" value="<?= $editItem ? 'Cập Nhật Món' : 'Thêm Món' ?>">
        </form>
    </div>
</div>

<!-- Danh sách món ăn -->
<h2>Danh Sách Món Ăn</h2>
<table border="1" cellpadding="10">
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
                <td><?= number_format($menu['gia'], 0) ?> VND</td>
                <td><?= htmlspecialchars($menu['category_name']) ?></td>
                <td>
                    <?php if (!empty($menu['hinh_anh'])): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($menu['hinh_anh']) ?>" class="thumbnail">
                    <?php else: ?>
                        Không có ảnh
                    <?php endif; ?>
                </td>
                <td>
                    <a href="indexAdmin.php?act=menu&id=<?= $menu['id'] ?>">Chỉnh Sửa</a> |
                    <a href="indexAdmin.php?act=menu&delete=<?= $menu['id'] ?>" onclick="return confirm('Bạn có chắc chắn muốn xóa món ăn này không?')">Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<!-- JS xử lý modal và CKEditor -->
<script>
    const modal = document.getElementById("popupForm");
    const btn = document.getElementById("openFormBtn");
    const closeBtn = document.getElementById("closeModalBtn");

    btn.onclick = function () {
        modal.style.display = "block";
    }
    closeBtn.onclick = function () {
        modal.style.display = "none";
        window.location.href = "indexAdmin.php?act=menu"; // Reset URL nếu đang ở chế độ edit
    }
    window.onclick = function (event) {
        if (event.target == modal) {
            modal.style.display = "none";
            window.location.href = "indexAdmin.php?act=menu";
        }
    }

    // Kích hoạt CKEditor
    CKEDITOR.replace('mo_ta');
</script>

</body>
</html>
