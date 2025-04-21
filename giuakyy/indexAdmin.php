<?php
include("phpFile/headerAdmin.php");
include("adminDAO/pdo.php");

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'them_lichday':
            // Kiểm tra xem có phải form POST để thêm lịch dạy không
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                // Lấy dữ liệu từ form
                $ngay = $_POST['ngay'];
                $monhoc_id = $_POST['monhoc_id'] ?? null;
                $lop_id = $_POST['lop_id'] ?? null;
                $phong = $_POST['phong'];
                $gio_batdau = $_POST['gio_batdau'];
                $gio_ketthuc = $_POST['gio_ketthuc'];
            
                // Kiểm tra dữ liệu bắt buộc
                if (!$monhoc_id || !$lop_id) {
                    echo "Thiếu thông tin môn học hoặc lớp học.";
                    exit;
                }
            
                // Xử lý ngày -> tuần và thứ
                $timestamp = mktime(0, 0, 0, 4, (int)$ngay, 2025);
                $thu = date('w', $timestamp); // 0 = Chủ Nhật
                $tuan = ceil(((int)$ngay + date('w', mktime(0,0,0,4,1,2025)) - 1) / 7);
            
                // Chèn vào bảng thời khóa biểu
                $sql = "INSERT INTO thoikhoabieu (tuan_id, thu, monhoc_id, lop_id, phong, gio_batdau, gio_ketthuc)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                pdo_execute($sql, $tuan, $thu, $monhoc_id, $lop_id, $phong, $gio_batdau, $gio_ketthuc);
            
                header("Location: indexAdmin.php?act=lichday");
                exit();
            
            
            }

            include('phpFile/them_lichday.php');
            break;

        case 'tailieuAdmin':
            include('phpFile/tailieuAdmin.php');
            break;

        case 'deleteTailieu':
            // Xử lý xóa tài liệu
            $id = $_GET['id'];
            pdo_execute("DELETE FROM tailieu WHERE ID = ?", $id);
            header("Location: index.php?act=tailieuAdmin");
            exit();
            break;

        case 'thongtinAdmin':
            include('phpFile/thongtinAdmin.php');
            break;

        case 'lienheAdmin':
            include('phpFile/lienheAdmin.php');
            break;

        case 'lichday':
            include('phpFile/lichday.php');
            break;

        case 'duan':
            include('phpFile/duan.php');
            break;
        
        default:
            include('phpFile/mainpageAdmin.php');
            break;
    }
} else {
    include("phpFile/mainpageAdmin.php");
}

include("phpFile/footerAdmin.php");
?>
