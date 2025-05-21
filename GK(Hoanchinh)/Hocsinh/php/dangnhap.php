<?php
session_start(); // Bắt đầu session

require_once 'pdo.php'; // File chứa hàm pdo_query_one()

$error = ""; // Biến lưu thông báo lỗi

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Truy vấn kiểm tra tài khoản
    $sql = "SELECT * FROM account WHERE username = :username";
    $account = pdo_query_one($sql, ['username' => $username]);

    // Kiểm tra mật khẩu
    if ($account && $password === $account['password']) {
        $_SESSION['username'] = $account['username'];


    header("Location: Admin/indexAdmin.php");
        exit();
        
   
    } else {
        $error = "Tên đăng nhập hoặc mật khẩu không đúng.";
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
    <style>
body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    background-color: #f0f0f0;
}

.login-container {
    background-color: #fff;
    margin-left:20rem;
    margin-top:13rem;
    padding: 40px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    border-radius: 8px;
    width: 800px; /* Tăng chiều rộng của form */
    height:auto;
    text-align: center;
}

h2 {
    margin-bottom: 20px;
    font-size: 28px; /* Tăng kích thước chữ của tiêu đề */
    color: #333;
}

input[type="text"], input[type="password"], button {
    width: 100%;
    padding: 14px; /* Tăng chiều cao của input và button */
    margin: 10px 0;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    box-sizing: border-box;
}

button {
    background-color: #4285f4;
    color: white;
    border: none;
    cursor: pointer;
    transition: background-color 0.3s;
    font-size: 18px; /* Tăng kích thước font của button */
}

button:hover {
    background-color: #357ae8;
}

.error {
    color: red;
    margin-top: 10px;
}

.footer {
    margin-top: 20px;
    font-size: 14px;
    color: #666;
}

.footer a {
    color: #4285f4;
    text-decoration: none;
}

.footer a:hover {
    text-decoration: underline;
}
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Đăng Nhập</h2>
        <?php if (!empty($error)): ?>
            <p class="error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>
        <form method="POST">
            <input type="text" name="username" placeholder="Tên đăng nhập" required><br>
            <input type="password" name="password" placeholder="Mật khẩu" required><br>
            <button type="submit">Đăng Nhập</button>
        </form>
    </div>
</body>
</html>
