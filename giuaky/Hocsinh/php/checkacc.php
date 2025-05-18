<?php
require_once("pdo.php"); // Gọi file kết nối PDO

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Câu lệnh SQL kiểm tra tài khoản
    $sql = "SELECT * FROM account WHERE username = :username";
    $account = pdo_query_one($sql, ['username' => $username]);

    if ($account && password_verify($password, $account['password'])) {
        // Đăng nhập thành công
        header("Location: Admin/indexAdmin.php"); // Chuyển sang trang welcome
        exit();
    } else {
        echo "<p style='color:red;'>Tên đăng nhập hoặc mật khẩu không đúng.</p>";
    }
}
?>
