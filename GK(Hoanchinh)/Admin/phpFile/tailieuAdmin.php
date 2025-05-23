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
<style>
  .user {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    padding: 20px;
  }
  
  .user_header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }
  
  .user_header span {
    font-size: 24px;
    font-weight: 600;
    color: #333;
  }
  
  .user_search {
    display: flex;
    align-items: center;
    background: #f5f7fa;
    padding: 8px 15px;
    border-radius: 20px;
    box-shadow: 0 2px 5px rgba(0,0,0,0.1);
  }
  
  .user_search input {
    border: none;
    background: transparent;
    margin-left: 10px;
    outline: none;
    width: 200px;
  }
  
  /* CSS cho bảng - với đường kẻ rõ ràng */
  table {
    width: 100%;
    border-collapse: separate;
    border-spacing: 0;
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    margin-top: 20px;
    border: 1px solid #e0e0e0;
  }
  
  thead {
    background: linear-gradient(135deg, #1976d2, #2196f3);
    color: white;
  }
  
  th {
    padding: 15px;
    text-align: left;
    font-weight: 500;
    letter-spacing: 0.5px;
    border-right: 1px solid rgba(255,255,255,0.2);
  }
  
  th:last-child {
    border-right: none;
  }
  
  th:first-child {
    border-top-left-radius: 12px;
  }
  
  th:last-child {
    border-top-right-radius: 12px;
  }
  
  tbody tr {
    transition: background 0.2s;
    border-bottom: 1px solid #e0e0e0;
  }
  
  tbody tr:last-child {
    border-bottom: none;
  }
  
  tbody tr:nth-child(even) {
    background-color: #f9f9f9;
  }
  
  tbody tr:hover {
    background-color: #f1f8ff;
  }
  
  td {
    padding: 12px 15px;
    border-right: 1px solid #e0e0e0;
    color: #555;
  }
  
  td:last-child {
    border-right: none;
  }
  
  td a {
    color: #1976d2;
    text-decoration: none;
    transition: color 0.2s;
  }
  
  td a:hover {
    color: #0d47a1;
    text-decoration: underline;
  }
  
  /* CSS cho form thêm tài liệu */
  #addDocumentForm {
    display: none;
    max-width: 500px;
    margin: 40px auto;
    padding: 25px 30px;
    background: #ffffff;
    border-radius: 15px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    border: 1px solid #e0e0e0;
  }
  
  #addDocumentForm h3 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
  }
  
  #addDocumentForm form {
    display: flex;
    flex-direction: column;
    gap: 15px;
  }
  
  #addDocumentForm label {
    font-size: 15px;
    color: #444;
    display: flex;
    flex-direction: column;
  }
  
  #addDocumentForm input[type="text"],
  #addDocumentForm input[type="url"],
  #addDocumentForm textarea {
    padding: 10px 14px;
    border: 1px solid #ddd;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.3s, box-shadow 0.3s;
    background: #f9f9f9;
  }
  
  #addDocumentForm input:focus,
  #addDocumentForm textarea:focus {
    border-color: #1976d2;
    box-shadow: 0 0 6px rgba(25, 118, 210, 0.2);
    outline: none;
    background: white;
  }
  
  #addDocumentForm textarea {
    resize: vertical;
    min-height: 80px;
  }
  
  #addDocumentForm button[type="submit"] {
    padding: 12px;
    background: #1976d2;
    color: white;
    border: none;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    transition: background 0.3s;
  }
  
  #addDocumentForm button[type="submit"]:hover {
    background: #1565c0;
  }
  .table-scroll-wrapper {
  max-height: 400px; /* Chiều cao tối đa, bạn có thể chỉnh tùy ý */
  overflow-y: auto;
  border: 1px solid #ddd;
  border-radius: 12px;
}
</style>
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