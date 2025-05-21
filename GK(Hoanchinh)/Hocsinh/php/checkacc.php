<?php
require_once("pdo.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Câu lệnh SQL kiểm tra tài khoản
    $sql = "SELECT * FROM account WHERE username = :username";
    $account = pdo_query_one($sql, ['username' => $username]);

    if ($account && password_verify($password, $account['password'])) {
        // Lưu account_id vào session sau khi đăng nhập thành công
        $_SESSION['account_id'] = $account['ID'];  // ID từ bảng account

        // Chuyển sang trang admin
        header("Location: /Admin/indexAdmin.php");
        exit();
    } else {
        echo "<p style='color:red;'>Tên đăng nhập hoặc mật khẩu không đúng.</p>";
    }
}
?>