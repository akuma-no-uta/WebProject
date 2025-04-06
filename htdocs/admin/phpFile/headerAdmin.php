<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&family=Material+Symbols+Sharp&display=swap">
    <link rel="stylesheet" href="../CSS/Admin.css" class="hr">
</head>
<body>
    
    <div class="container">
        <!--aside start-->
        <aside>
            <!--start top-->
            <div class="top">
                <div class="logo">
                    <h2>W<span class="danger">abage</span></h2>
                </div>
                <div class="close" id="close_btn">
                    <span class="material-symbols-outlined">close</span>
                </div>
            </div>

              <!--end top-->
            <div class="sidebar">

                <a href="Nguoidung.html" onclick="window.location.href='Nguoidung.html'">
                    <span class="material-symbols-outlined"> account_circle</span>
                    <h3>Khách Hàng</h3>
                </a>
                
                <a href="nhansu.html">
                    <span class="material-symbols-outlined"> Person </span>
                    <h3>Nhân Sự</h3>
                </a>

                <a href="dat_ban.html">
                    <span class="material-symbols-outlined"> mail_outline</span>
                    <h3>Đặt bàn</h3>
                    <span class="msg_count">10 </span>
                </a>

                <a href="#">
                    <span class="material-symbols-outlined"> Paid </span>
                    <h3>Chi Tiêu</h3>
                </a>
               
                <a href="#">
                    <span class="material-symbols-outlined">settings</span>
                    <h3>Cài Đặt</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined"> logout</span>
                    <h3>Đăng Xuất</h3>
                </a>
        </div>
        </aside>
        <!--aside end-->

        <!--main section start-->