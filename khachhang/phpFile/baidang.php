 <?php
include '../phpFile/header.php';
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>
 <!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Bootstrap News Template - Free HTML Templates</title>
        <meta content="width=device-width, initial-scale=1.0" name="viewport">
        <meta content="Bootstrap News Template - Free HTML Templates" name="keywords">
        <meta content="Bootstrap News Template - Free HTML Templates" name="description">
        <!-- Favicon -->
        <link href="img/favicon.ico" rel="icon">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,600&display=swap" rel="stylesheet"> 
        <!-- CSS Libraries -->
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
		<!-- Bootstrap Bundle with Popper -->
		<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
        <link href="../css/slick.css" rel="stylesheet">
        <link href="../css/slick-theme.css" rel="stylesheet">
        <!-- Template Stylesheet -->
        <link href="../css/news2.css" rel="stylesheet">
		<link rel="stylesheet" href="../css/mainpage.css">
    </head> 
        <!-- Main News Start-->
        <div class="main-news" style="margin-top: 150px;">
            <div class="container">
                <div class="row">
<div class="col-lg-9">
    <div class="row">
        <?php
        // Kết nối CSDL
        $conn = new mysqli('localhost', 'root', '', 'cuoiky');
        mysqli_set_charset($conn, 'utf8');
        
        // Kiểm tra kết nối
        if ($conn->connect_error) {
            die("Kết nối thất bại: " . $conn->connect_error);
        }

        // Truy vấn dữ liệu bài đăng mới nhất
        $sql = "SELECT * FROM posts ORDER BY created_at DESC";
        $result = $conn->query($sql);

        if (!$result) {
            die("Lỗi truy vấn: " . $conn->error);
        }
while ($row = $result->fetch_assoc()) {
    $title = $row['title'];
    $content = $row['content'];
    $created_at = $row['created_at'];
    $imgPath = !empty($row['image']) ? 'data:image/jpeg;base64,' . base64_encode($row['image']) : '../PicAndVid/img/default.jpg';

    echo '<div class="col-md-4">
                <div class="mn-img">
                    <img src="' . $imgPath . '" style="width: 100%; height: 200px; object-fit: cover;" />
                    <div class="mn-title">
                        <a href="chitietbaidang.php?id=' . $row['id'] . '">
                            ' . htmlspecialchars($row['title']) . '
                        </a>
                        <p style="font-size: 12px;">' . $content . '</p>
                        <small>🕒 ' . $row['created_at'] . ' | 👁 ' . $row['click_count'] . '</small>
                    </div>
                </div>
            </div>';
        }

        $conn->close();
        ?>
    </div>
</div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <div class="mn-list">
                            <h2>Read More</h2>
                            <ul>
                                <li><a href="">Lorem ipsum dolor sit amet</a></li>
                                <li><a href="">Pellentesque tincidunt enim libero</a></li>
                                <li><a href="">Morbi id finibus diam vel pretium enim</a></li>
                                <li><a href="">Duis semper sapien in eros euismod sodales</a></li>
                                <li><a href="">Vestibulum cursus lorem nibh</a></li>
                                <li><a href="">Morbi ullamcorper vulputate metus non eleifend</a></li>
                                <li><a href="">Etiam vitae elit felis sit amet</a></li>
                                <li><a href="">Nullam congue massa vitae quam</a></li>
                                <li><a href="">Proin sed ante rutrum</a></li>
                                <li><a href="">Curabitur vel lectus</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

         <?php
include '../phpFile/footer.php';
?>