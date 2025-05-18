<?php
// Kết nối cơ sở dữ liệu
require_once('php/pdo.php');

// Nếu có từ khóa tìm kiếm trong URL, thực hiện truy vấn tìm kiếm
$keyword = isset($_GET['keyword']) ? trim($_GET['keyword']) : '';

// Truy vấn cơ sở dữ liệu
if (!empty($keyword)) {
    $sql = "SELECT * FROM tailieu WHERE Ten LIKE ? OR MoTa LIKE ? OR TacGia LIKE ?";
    $search_data = pdo_query($sql, "%$keyword%", "%$keyword%", "%$keyword%");
} else {
    $sql = "SELECT * FROM tailieu";
    $search_data = pdo_query($sql);
}

?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Danh sách tài liệu</title>
    <link rel="stylesheet" href="css/Admin.css"> <!-- Thêm link tới file CSS nếu có -->
</head>
<body>

<div class="user">
    <div class="user_header">
        <span>Danh sách tài liệu</span>
        <form method="GET" action="index.php">
            <div class="user_search">
                <span class="material-symbols-outlined">search</span>
                <input type="text" id="searchInput" name="keyword" placeholder="Tìm kiếm..." value="<?= htmlspecialchars($keyword) ?>" onkeyup="searchTable()">
            </div>
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
</script>

</body>
</html>
