<?php
include("php/header.php"); // Bao gồm phần đầu trang (header.php)
require_once ("../Hocsinh/php/pdo.php"); // Bao gồm tệp kết nối cơ sở dữ liệu

// Kiểm tra xem có tham số 'act' trong URL hay không
if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
       
        case 'tailieu':
            include('php/tailieu.php'); // Bao gồm tệp tài liệu
            break;
        case 'thongtingv':
            include('php/thongtingv.php'); // Bao gồm tệp thông tin giảng viên
            break;
        case 'lichday':
            include('php/lichday.php'); // Bao gồm tệp lịch dạy
            break;
        case 'duan':
            include('php/duan.php'); // Bao gồm tệp dự án
            break;
        case 'danhgiagv':
            include('php/danhgiagv.php'); // Bao gồm tệp đánh giá giảng viên

            break;
        case 'dangnhap':
            include('php/dangnhap.php'); // Bao gồm tệp đăng nhập
            break;

            case 'checkacc.php':
                include('php/checkacc.php'); // Bao gồm tệp kiểm tra tài khoản
                break;
        default:
            include('php/mainpage.php'); // Bao gồm trang chính nếu không có tham số 'act'
            break;
    }
}

include("php/footer.php"); // Bao gồm phần chân trang (footer.php)
?>
