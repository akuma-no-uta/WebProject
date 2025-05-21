<?php
  include("adminDAO/pdo.php");
    session_start(); // Bắt buộc phải gọi trước bất kỳ HTML nào
    $account_id = $_SESSION['username']; // Lấy id account từ session
    $sql = "SELECT * FROM account WHERE username = ?";
    $account = pdo_query_one($sql, $account_id);  // Không dùng mảng



$profile = null;
if ($account_id) {
    // Truy vấn thông tin người dùng từ bảng profilegv dựa trên account_id
    $profile = pdo_query_one("SELECT tenht, chucvu, avatar FROM account WHERE username= ?", $account_id);
}
?>

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

                <a href="indexAdmin.php?act=dangxuat">
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
        <p><b><?= htmlspecialchars($profile['tenht'] ?? 'dsadas') ?></b></p>
        <p><?= htmlspecialchars($profile['chucvu'] ?? 'Chưa có chức vụ') ?></p>
    </div>

    <a href="indexAdmin.php?act=chinhsua" class="profile-photo">
        <?php if (!empty($profile['avatar']) && file_exists("uploads/" . $profile['avatar'])): ?>
            <img src="uploads/<?= htmlspecialchars($profile['avatar']) ?>" alt="">
        <?php else: ?>
            <img src="../img/1516228133024.jpg" alt="">
        <?php endif; ?>
    </a>
</div>


            </div>