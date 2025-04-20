<?php
// Xử lý xóa tài liệu
if (isset($_GET['act']) && $_GET['act'] === 'deleteTailieu' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Kiểm tra tài liệu có tồn tại
    $check = pdo_query_one("SELECT * FROM tailieu WHERE ID = ?", $id);
    if ($check) {
        // Xóa tài liệu
        pdo_execute("DELETE FROM tailieu WHERE ID = ?", $id);
        // Thông báo thành công
        echo "<script>alert('Xóa tài liệu thành công.'); window.location.href='indexAdmin.php?act=tailieuAdmin';</script>";
        exit();
    } else {
        echo "<script>alert('Tài liệu không tồn tại hoặc đã bị xóa.'); window.location.href='indexAdmin.php?act=tailieuAdmin';</script>";
        exit();
    }
}


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $author = trim($_POST['author']);
    $description = trim($_POST['description']);
    $link = trim($_POST['link']);

    if (empty($title) || empty($author) || empty($description) || empty($link)) {
        echo "<script>alert('Vui lòng điền đầy đủ thông tin.'); window.history.back();</script>";
        exit();
    }

    if (!filter_var($link, FILTER_VALIDATE_URL)) {
        echo "<script>alert('Link tài liệu không hợp lệ.'); window.history.back();</script>";
        exit();
    }

    $ngaydang = date('Y-m-d'); // Ngày hiện tại

    try {
        pdo_execute("INSERT INTO tailieu(Ten, NgayDang, TacGia, MoTa, Link) VALUES (?, ?, ?, ?, ?)", 
                    $title, $ngaydang, $author, $description, $link);

        echo "<script>alert('Thêm tài liệu thành công.'); window.location.href='indexAdmin.php?act=tailieuAdmin';</script>";
        exit();
    } catch (Exception $e) {
        echo "<script>alert('Có lỗi xảy ra khi thêm tài liệu: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
        exit();
    }
}
?>

<div class="user">
    <div class="user_header">
        <span>Danh sách tài liệu</span>
        <form method="GET" action="indexAdmin.php">
            <input type="hidden" name="act" value="tailieuAdmin">
            <div class="user_search">
                <span class="material-symbols-outlined">search</span>
                <input type="text" id="searchInput" placeholder="Tìm kiếm..." onkeyup="searchTable()">
            </div>
        </form>
        <div class="edit">
            <button class="tailieu_edit">
                <span class="material-symbols-outlined">add</span>
            </button>
            <button class="tailieu_edit">
                <span class="material-symbols-outlined">remove</span>
            </button>
    
        </div>
    </div>

    <!-- Form Thêm Tài Liệu -->
    <div id="addDocumentForm" style="display:none;">
        <h3>Thêm Tài Liệu Mới</h3>
        <form method="post">
        <label>Tiêu đề: <input type="text" name="title" required></label><br>
    <label>Tác giả: <input type="text" name="author" required></label><br>
    <label>Mô tả: <textarea name="description" required></textarea></label><br>
    <label>Link: <input type="url" name="link" required></label><br>
    <button type="submit">Thêm Tài Liệu</button>
</form>
    </div>

    <!-- Bảng Danh Sách Tài Liệu -->
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên tài liệu</th>
                <th>Ngày đăng</th>
                <th>Tác giả</th>
                <th>Mô tả</th>
                <th>Link</th>
            </tr>
        </thead>

        <?php
        // Lấy từ khóa tìm kiếm
        $keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

        // Truy vấn CSDL
        if (!empty($keyword)) {
            $sql = "SELECT * FROM tailieu WHERE Ten LIKE ? OR MoTa LIKE ? OR TacGia LIKE ?";
            $search_data = pdo_query($sql, "%$keyword%", "%$keyword%", "%$keyword%");
        } else {
            $sql = "SELECT * FROM tailieu";
            $search_data = pdo_query($sql);
        }
        ?>

        <tbody>
        <?php if (!empty($search_data)): ?>
            <?php foreach ($search_data as $tl): ?>
                <tr>
                    <td><?= htmlspecialchars($tl['ID']) ?></td>
                    <td><?= htmlspecialchars($tl['Ten']) ?></td>
                    <td><?= htmlspecialchars($tl['NgayDang']) ?></td>
                    <td><?= htmlspecialchars($tl['TacGia']) ?></td>
                    <td><?= htmlspecialchars($tl['MoTa']) ?></td>
                    <td><a href="<?= htmlspecialchars($tl['Link']) ?>" target="_blank">Chi tiết</a></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="6" style="text-align:center;">Không tìm thấy tài liệu nào.</td>
            </tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
    function searchTable() {
    var input, filter, table, tr, td, i, j, txtValue, found;
    input = document.getElementById("searchInput");
    filter = input.value.toLowerCase();
    table = document.querySelector("table");
    tr = table.getElementsByTagName("tr");

    for (i = 1; i < tr.length; i++) { // Bỏ qua dòng tiêu đề
        tr[i].style.display = "none";
        td = tr[i].getElementsByTagName("td");
        found = false;

        for (j = 0; j < td.length; j++) {
            if (td[j]) {
                txtValue = td[j].textContent || td[j].innerText;
                if (txtValue.toLowerCase().indexOf(filter) > -1) {
                    found = true;
                    break;
                }
            }
        }

        if (found) {
            tr[i].style.display = "";
        }
    }
}

// Hiển thị form khi nhấn nút "add"
document.querySelectorAll(".tailieu_edit")[0].addEventListener("click", function () {
    document.getElementById("addDocumentForm").style.display = "block";
});

// Đóng form khi nhấn "Hủy"
function closeAddForm() {
    document.getElementById("addDocumentForm").style.display = "none";
}

// Xử lý xóa tài liệu
document.querySelectorAll(".tailieu_edit")[1].addEventListener("click", function () {
    var id = prompt("Nhập ID của tài liệu bạn muốn xóa:");
    if (id !== null && id.trim() !== "") {
        if (confirm("Bạn có chắc chắn muốn xóa tài liệu với ID: " + id + "?")) {
            window.location.href = "indexAdmin.php?act=deleteTailieu&id=" + encodeURIComponent(id);
                window.location.href = "indexAdmin.php?act=tailieuAdmin";

        }
    }
});

</script>