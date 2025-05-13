<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>    
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined&family=Material+Symbols+Sharp&display=swap">
    <link rel="stylesheet" href="css/Admin.css" >
    <link rel="stylesheet" href="css/duan.css">


</head>
<body>
    
    <div class="container">
        <!--aside start-->
        <aside>
            <!--start top-->
            <div class="top">
                <div class="logo">
                    <a href="indexAdmin.php?act=mainpageAdmin"><img src="https://tdtu.edu.vn/sites/www/files/logo-dh_0.png" alt="Trang chủ" fetchpriority="high"></a>
                </div>
                <div class="close" id="close_btn">
                    <span class="material-symbols-outlined">close</span>
                </div>
            </div>

              <!--end top-->
              <!--end top-->
            <div class="sidebar">

                <a href="indexAdmin.php?act=tailieuAdmin">
                    <span class="material-symbols-outlined"> account_circle</span>
                    <h3>Tài liệu</h3>
                </a>
                
                <a href="indexAdmin.php?act=thongtinAdmin">
                    <span class="material-symbols-outlined"> Person </span>
                    <h3>Thông tin</h3>
                </a>

                <a href="indexAdmin.php?act=lienheAdmin">
                    <span class="material-symbols-outlined"> mail_outline</span>
                    <h3>Đánh giá
                    </h3>
                </a>

                <a href="indexAdmin.php?act=lichday">
                    <span class="material-symbols-outlined"> Paid </span>
                    <h3>Lịch dạy</h3>
                </a>
               
                <a href="indexAdmin.php?act=duan">
                    <span class="material-symbols-outlined">trophy</span>
                    <h3>Dự án</h3>
                </a>

                <a href="hoidap.html">
                    <span class="material-symbols-outlined"> logout</span>
                    <h3>Đăng Xuất</h3>
                </a>
        </div>
        </aside>

        <div class="right">
            <div class="top">

                <button id="menu_bar">
                    <span class="material-symbols-outlined">menu</span>
                </button>

                <div class="profile">
                    <div class="info">
                        <p><b>Khoa</b></p>
                        <p>Giảng viên</p>
                        <small class="text-muted"></small>
                    </div>
                     <div class="profile-photo">
                        <img src="../img/antony_admin.jpg" alt="">
                     </div>
                </div>

            </div>