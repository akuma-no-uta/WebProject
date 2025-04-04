<?php
    include 'phpFile/header.php';  // nhúng phần header
    include '../dao/pdo.php';

    // Kiểm tra xem URL có tham số 'login' không
    if (isset($_GET['login']) && $_GET['login'] == 1) {
        include 'phpFile/login.php';  // nếu có, nhúng phần login
    }
    
    include 'phpFile/mainpage.php';  // nhúng phần nội dung chính
    include 'phpFile/footer.php';    // nhúng phần footer
?>
