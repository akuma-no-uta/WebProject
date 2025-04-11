<?php
include("phpFile/headerAdmin.php");

if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'tailieuAdmin':
            include('phpFile/tailieuAdmin.php');
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


        default:
            include('phpFile/mainpageAdmin.php');
            break;
    }
} else {
    include("phpFile/mainpageAdmin.php");
}

include("phpFile/footerAdmin.php");
?>
