<?php
include ("phpFile/headerAdmin.php");
if (isset($_GET['act'])) {
    $act = $_GET['act'];
    switch ($act) {
        case 'tailieuAdmin':
            include ('phpFile/tailieuAdmin.php');
            break;}
        }
        else{

include ("phpFile/mainpageAdmin.php");
        }
include("phpFile/footerAdmin.php");
?>