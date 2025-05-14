<?php
include("pdo.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $ngay = $_POST['ngay'];
    $monhoc = $_POST['monhoc'];
    $lop = $_POST['lop'];
    $phong = $_POST['phong'];
    $gio_batdau = $_POST['gio_batdau'];
    $gio_ketthuc = $_POST['gio_ketthuc'];

    $timestamp = mktime(0, 0, 0, 4, (int)$ngay, 2025);
    $thu = date('w', $timestamp);
    $tuan = ceil(((int)$ngay + date('w', mktime(0,0,0,4,1,2025)) - 1) / 7);

    $monhoc_id = pdo_query_value("SELECT id FROM monhoc WHERE ten_monhoc = ?", $monhoc);
    if (!$monhoc_id) {
        pdo_execute("INSERT INTO monhoc (ten_monhoc) VALUES (?)", $monhoc);
        $monhoc_id = pdo_query_value("SELECT LAST_INSERT_ID()");
    }

    $lop_id = pdo_query_value("SELECT id FROM lop WHERE ten_lop = ?", $lop);
    if (!$lop_id) {
        pdo_execute("INSERT INTO lop (ten_lop) VALUES (?)", $lop);
        $lop_id = pdo_query_value("SELECT LAST_INSERT_ID()");
    }

    $sql = "INSERT INTO thoikhoabieu (tuan_id, thu, monhoc_id, lop_id, phong, gio_batdau, gio_ketthuc)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
    pdo_execute($sql, $tuan, $thu, $monhoc_id, $lop_id, $phong, $gio_batdau, $gio_ketthuc);

    header("Location: indexAdmin.php?act=lichday");
    exit();
}
?>
