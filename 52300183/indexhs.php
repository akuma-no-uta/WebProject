<?php
// Gọi header
include("Hocsinh/php/header.php");

// Gọi file kết nối CSDL
require_once("Hocsinh/php/pdo.php"); // Đã nằm cùng cấp nên không cần ../

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'tailieu':
            include('Hocsinh/php/tailieu.php');
            break;
        case 'thongtingv':
            include('Hocsinh/php/thongtingv.php');
            break;
        case 'lichday':
            include('Hocsinh/php/lichday.php');
            break;
        case 'duan':
            include('Hocsinh/php/duan.php');
            break;
        case 'danhgiagv':
            include('Hocsinh/php/danhgiagv.php');
            break;
        case 'dangnhap':
            include('Hocsinh/php/dangnhap.php');
            break;
        case 'checkacc':
            include('Hocsinh/php/checkacc.php');
            break;
        default:
            include('Hocsinh/php/mainpage.php');
            break;
    }
} else {
    include('Hocsinh/php/mainpage.php');
}

// Gọi footer
include("Hocsinh/php/footer.php");
?>
