<?php
// Lấy danh sách đơn đặt bàn từ cơ sở dữ liệu
$datbanList = pdo_query("SELECT * FROM datban ORDER BY ngaydat, giodat");
?>

<!DOCTYPE html>

<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Danh sách đơn đặt bàn</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 30px;
            background-color: #f0f4f8;
        }
    h2 {
        color: #007bff;
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        background-color: #fff;
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    th, td {
        padding: 14px 16px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }

    th {
        background-color: #007bff;
        color: white;
    }

    tr:hover {
        background-color: #f1f1f1;
    }

    .delete-btn {
        color: red;
        text-decoration: none;
        font-weight: bold;
    }

    .delete-btn:hover {
        text-decoration: underline;
    }
</style>
```

</head>
<body>

```
<h2>Danh sách đơn đặt bàn</h2>

<table>
    <thead>
        <tr>
            <th>STT</th>
            <th>Khách hàng</th>
            <th>Số người</th>
            <th>Thời gian</th>
            <th>Ngày đặt</th>
            <th>Ghi chú</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $stt = 1;
        foreach ($datbanList as $row) {
            echo "<tr>";
            echo "<td>" . $stt++ . "</td>";
            echo "<td>{$row['hoten']}</td>";
            echo "<td>{$row['sochongoi']}</td>";
            echo "<td>{$row['giodat']}</td>";
            echo "<td>" . date('d/m/Y', strtotime($row['ngaydat'])) . "</td>";
            echo "<td>{$row['ghichu']}</td>";
            echo "<td><a class='delete-btn' href='indexAdmin.php?act=xoa_datban&id={$row['id']}' onclick=\"return confirm('Bạn có chắc chắn muốn xóa đơn đặt bàn này?');\">Hủy</a></td>";
            echo "</tr>";
        }

        if (count($datbanList) == 0) {
            echo "<tr><td colspan='7' style='text-align:center;'>Không có đơn đặt bàn nào.</td></tr>";
        }
        ?>
    </tbody>
</table>
```

</body>
</html>

