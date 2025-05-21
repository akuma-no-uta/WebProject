<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = [
        'id' => $_POST['id'],
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'quantity' => 1
    ];

    // Tạo giỏ hàng nếu chưa có
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    // Kiểm tra nếu món đã có trong giỏ
    $found = false;
    foreach ($_SESSION['cart'] as &$cartItem) {
        if ($cartItem['id'] == $item['id']) {
            $cartItem['quantity']++;
            $found = true;
            break;
        }
    }
    if (!$found) {
        $_SESSION['cart'][] = $item;
    }

    // Chuyển hướng tới cart.php
    header('Location: cart.php');
    exit();
}
?>
