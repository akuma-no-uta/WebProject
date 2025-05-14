<?php
include("phpFile/headerAdmin.php");
include("adminDAO/pdo.php");

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
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
            
                $sql = "INSERT INTO thoikhoabieu (tuan_id, thu,monhoc_id, lop_id, phong, gio_batdau, gio_ketthuc)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
                pdo_execute($sql, $tuan, $thu, $monhoc_id, $lop_id, $phong, $gio_batdau, $gio_ketthuc);
            
                header("Location: indexAdmin.php?act=datban");
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

        case 'taikhoan':
            include('phpFile/taikhoan.php');
            break;

        case 'lienheAdmin':
            include('phpFile/lienheAdmin.php');
            break;

        case 'lichdatban':
            include('phpFile/lichdatban.php');
            break;

        case 'menu':
            include('phpFile/menu.php');
            break;
         switch ($act) {
    case 'add_menu':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ten_mon'], $_POST['phan_loai'], $_POST['gia'])) {
            $ten = trim($_POST['ten_mon']);
            $mo_ta = trim($_POST['mo_ta'] ?? '');
            $gia = trim($_POST['gia']);
            $phan_loai = trim($_POST['phan_loai']);
            
            // Kiểm tra nếu có ảnh được tải lên
            $imageData = null;
            if (isset($_FILES['hinh_anh']) && $_FILES['hinh_anh']['error'] === UPLOAD_ERR_OK) {
                // Đọc nội dung ảnh vào biến $imageData
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
        break;

    case 'edit_menu':
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'], $_POST['ten_mon'], $_POST['phan_loai'], $_POST['gia'])) {
            $id = intval($_POST['id']);
            $ten = trim($_POST['ten_mon']);
            $mo_ta = trim($_POST['mo_ta'] ?? '');
            $gia = trim($_POST['gia']);
            $phan_loai = trim($_POST['phan_loai']);

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
                // Cập nhật món ăn vào cơ sở dữ liệu (nếu có ảnh mới thì cập nhật ảnh, nếu không thì không cập nhật ảnh)
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
        break;

    case 'delete_menu':
        if (isset($_GET['id'])) {
            $id = intval($_GET['id']);

            try {
                pdo_execute("DELETE FROM menu WHERE id = ?", $id);
                echo "<script>alert('Xóa món ăn thành công.'); window.location.href='indexAdmin.php?act=menu';</script>";
                exit;
            } catch (Exception $e) {
                echo "<script>alert('Lỗi khi xóa món ăn: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
                exit;
            }
        }
        break;

}

        default:
            include('phpFile/mainpageAdmin.php');
            break;
    }
} else {
    include("phpFile/mainpageAdmin.php");
}

include("phpFile/footerAdmin.php");
?>
