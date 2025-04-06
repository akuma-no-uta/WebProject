<?php
include 'phpFile/header.php';

if (isset($_GET['login']) && $_GET['login'] == '1') {
    include 'phpFile/login.php'; // Bao gồm trang login.php nếu login=1
} else {
    include 'phpFile/mainpage.php'; // Bao gồm trang mainpage.php nếu không có login
}

include 'phpFile/footer.php';
?>
