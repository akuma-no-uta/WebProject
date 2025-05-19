<?php
include("phpFile/headerAdmin.php");
include("adminDAO/pdo.php");

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'chinhsua':
            include('phpFile/suaprofile.php');
            break;


        case 'them_lichday':
            if ($_SERVER["REQUEST_METHOD"] === "POST") {
                $ngay = $_POST['ngay'];
                $monhoc_id = $_POST['monhoc_id'] ?? null;
                $lop_id = $_POST['lop_id'] ?? null;
                $phong = $_POST['phong'];
                $gio_batdau = $_POST['gio_batdau'];
                $gio_ketthuc = $_POST['gio_ketthuc'];
                if (!$monhoc_id || !$lop_id) {
                    echo "Thiếu thông tin môn học hoặc lớp học.";
                    exit;
                }
            
                $timestamp = mktime(0, 0, 0, 4, (int)$ngay, 2025);
                $thu = date('w', $timestamp); // 0 = Chủ Nhật
                $tuan = ceil(((int)$ngay + date('w', mktime(0,0,0,4,1,2025)) - 1) / 7);
            
                $sql = "INSERT INTO thoikhoabieu (tuan_id, thu, monhoc_id, lop_id, phong, gio_batdau, gio_ketthuc)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                pdo_execute($sql, $tuan, $thu, $monhoc_id, $lop_id, $phong, $gio_batdau, $gio_ketthuc);
            
                header("Location: indexAdmin.php?act=lichday");
                exit();
            
            
            }

            include('phpFile/them_lichday.php');
            break;
            case 'xoa_lichday':
                if (isset($_GET['id'])) {
                    $id = intval($_GET['id']);
                    pdo_execute("DELETE FROM thoikhoabieu WHERE id = ?", $id);
                }
                header("Location: indexAdmin.php?act=lichday");
                exit();
                break;
                case 'deleteDuan':
                    if (isset($_GET['id'])) {
                        $id = intval($_GET['id']);
                        pdo_execute("DELETE FROM duan WHERE id = ?", $id);
                    }
                    header("Location: indexAdmin.php?act=duan");
                    exit();
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
            case 'add_delete_duan':
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ten_du_an'], $_POST['trang_thai'])) {
                    $ten = trim($_POST['ten_du_an']);
                    $trangthai = trim($_POST['trang_thai']);
                    $mota = trim($_POST['mo_ta'] ?? '');
            
                    if (empty($ten) || empty($trangthai)) {
                        echo "<script>alert('Vui lòng nhập đầy đủ thông tin.'); window.history.back();</script>";
                        exit;
                    }
            
                    try {
                        pdo_execute("INSERT INTO duan (ten, TrangThai, MoTa) VALUES (?, ?, ?)", $ten, $trangthai, $mota);
                        echo "<script>alert('Thêm dự án thành công.'); window.location.href='indexAdmin.php?act=duan';</script>";
                        exit;
                    } catch (Exception $e) {
                        echo "<script>alert('Lỗi khi thêm dự án: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
                        exit;
                    }
                }
                break;
            case 'uploadImage':
                include('phpFile/duan.php'); // nơi chứa code xử lý ảnh
                break;


        case 'dangxuat':
              session_start();
    session_destroy();

    header("Location: ../indexhs.php");
exit;
        default:
            include('phpFile/mainpageAdmin.php');
            break;
    }
} else {
    include("phpFile/mainpageAdmin.php");
}

include("phpFile/footerAdmin.php");
?>
