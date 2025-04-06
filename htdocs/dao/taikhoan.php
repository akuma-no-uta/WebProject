<?php
function account_insert($username, $password, $ten, $email, $birthdate){
    // Không mã hóa mật khẩu — LƯU Ý: không an toàn
    $sql = "INSERT INTO account(username, password, ten, email, birthdate) VALUES (?, ?, ?, ?, ?)";
    pdo_execute($sql, $username, $password, $ten, $email, $birthdate);
}

function check_username_exists($username): bool {
    $sql = "SELECT COUNT(*) FROM account WHERE username = ?";
    $result = pdo_query_value($sql, $username);
    return $result > 0;
}

function get_user($username, $password){
    $sql = "SELECT * FROM account WHERE username = ? AND password = ?";
    $user = pdo_query_one($sql, $username, $password);
    return $user; 
}
?>
