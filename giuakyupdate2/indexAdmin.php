<?php
include("phpFile/headerAdmin.php");
include("adminDAO/pdo.php");

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
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
            include('phpFIle/lichday.php');
            break;

        case 'duan':
            include('phpFile/duan.php');
            break;
            case 'add_delete_duan.php':
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $ten = $_POST['ten_du_an'];
                    $trangthai = $_POST['trang_thai'];
                    $mota = $_POST['mo_ta'];
            
                    pdo_execute("INSERT INTO duan (ten, trangthai, MoTa) VALUES (?, ?, ?)", $ten, $trangthai, $mota);
                }
                header("Location: indexAdmin.php?act=duan");
                exit();
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
