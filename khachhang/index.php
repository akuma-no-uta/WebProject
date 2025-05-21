
    <?php
    session_start();
    include_once("dao/pdo.php");
    include_once("dao/taikhoan.php");
    include 'phpFile/header.php';

    if (isset($_GET['act'])) {
        $act = $_GET['act'];
        switch ($act) {
            case 'dangky':
                if (isset($_POST['dangky']) && $_POST['dangky']) {
                    $email = $_POST['email'];
                    $username = $_POST['username'];
                    $ten = $_POST['ten'];
                    $password = $_POST['password'];
                    $birthdate = $_POST['birthdate']; // Lưu ý thêm $birthdate ở đây

                    if (check_username_exists($username)) {
                        echo "Username đã tồn tại. Vui lòng chọn tên khác.";
                    } else {
                        account_insert($username, $password, $ten, $email, $birthdate);
                        echo "Đăng ký thành công!";
                    }
                }
                include 'phpFile/dangky.php';
                break;

                case 'dangnhap':
                    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['dangnhap'])) {
                        $username = $_POST['username'];
                        $password = $_POST['password'];
                        $get_user = get_user($username, $password);
                
                        if (is_array($get_user)) {
                            $_SESSION['user'] = $get_user;
                            header('Location: index.php'); // hoặc mainpage.php tùy bạn
                            exit();
                        } else {
                            $thongbao = 'Tài khoản không tồn tại hoặc mật khẩu sai';
                        }
                    }
                    include 'phpFile/dangky.php'; // vẫn dùng chung form
                    break;
                case 'datban':
                    include 'phpFile/datban.php';
                    break;
        }
    } else {
        include 'phpFile/mainpage.php';
    }

    include 'phpFile/footer.php';
    ?>
