<div class="user">
    <div class="user_header">
        <span>Danh sách tài liệu</span>
        <form method="GET" action="index.php">
            <input type="hidden" name="act" value="tailieuAdmin">
            <div class="user_search">
                <span class="material-symbols-outlined">search</span>
                <input type="text" id="searchInput" placeholder="Tìm kiếm..." onkeyup="searchTable()">
                </div>
        </form>
    </div>

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
</script>
