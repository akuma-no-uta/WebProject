<?php
 include '../phpFile/header.php';
 error_reporting(E_ALL);
ini_set('display_errors', 1);

// Kết nối cơ sở dữ liệu
$host = 'localhost';
$db = 'cuoiky'; // <--- đổi thành tên CSDL của bạn
$user = 'root';
$pass = '';
$conn = new PDO("mysql:host=$host;dbname=$db;charset=utf8", $user, $pass);

// Xử lý khi submit
$message = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoten = $_POST['hoten'];
    $sdt = $_POST['sdt'];
    $chinhanh = $_POST['chinhanh'];
    $ngaydat = $_POST['ngaydat'];
    $giodat = $_POST['giodat'];
    $sochongoi = $_POST['sochongoi'];
    $loaiban = $_POST['loaiban'];
    $ghichu = $_POST['ghichu'];

    // Lưu vào database
    $stmt = $conn->prepare("INSERT INTO datban (hoten, sdt, chinhanh, ngaydat, giodat, sochongoi, loaiban, ghichu)
                            VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    if ($stmt->execute([$hoten, $sdt, $chinhanh, $ngaydat, $giodat, $sochongoi, $loaiban, $ghichu])) {
        $message = "✅ Đặt bàn thành công!";
    } else {
        $message = "❌ Lỗi khi đặt bàn.";
    }
}
?>
    <style>
       .container {
    background: white;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
}

h2 {
    text-align: center;
    color: #333;
    font-size: 20px;
}
  .banner-db img {
      border-radius:  50 50 50;
      width: 100vw;
      max-height: 70vw; /* Giới hạn chiều cao để không chiếm quá nhiều không gian */
      object-fit: cover;
      margin-top: 135px;
  }
  

input, select, button {
    width: 90%;
    padding: 8px;
    margin: 5px auto;
    border: 1px solid #ccc;
    border-radius: 4px;
    font-size: 14px;
    display: block;
}

.time-slots {
    display: flex;
    flex-wrap: wrap;
    gap: 5px;
    justify-content: center;
}

.time-slots button {
    flex: 1 1 30%;
    background: #eee;
    border: none;
    padding: 8px;
    cursor: pointer;
    font-size: 14px;
}

.time-slots button:hover {
    background: #ff4500;
    color: white;
}

.submit-btn {
    background: #ff4500;
    color: white;
    font-weight: bold;
    border: none;
    cursor: pointer;
    font-size: 14px;
    padding: 10px;
    width: 100%;
}

.submit-btn:hover {
    background: #d63c00;
}

select, input[type="date"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border-radius: 4px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

input[type="text"] {
    width: 100%;
    padding: 10px;
    font-size: 16px;
    border-radius: 4px;
    border: 1px solid #ccc;
    box-sizing: border-box;
}

.ad-box img {
    width: 100%;  
    height: 100%; 
    object-fit: cover; 
}

.gif-container {
    width: 60px;
    height: 60px;
    border-radius: 70%;
    overflow: hidden;
    display: flex;
    justify-content: center;
    align-items: center;
    background-color: white;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    
    position: fixed;
    bottom: 30px; 
    right: 70px; 
    z-index: 1000; 
}

.gif-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

@media (max-width: 768px) {
    .wrapper {
        flex-direction: column;
        gap: 10px;
    }

    .ad-box {
        width: 100%;
        max-height: 250px;
    }

    .container {
        width: 95%;
        padding: 15px;
    }

    .time-slots {
        flex-direction: column;
    }

    .time-slots button {
        width: 100%;
    }

    .gif-container {
        width: 50px;
        height: 50px;
        bottom: 15px; 
        right: 15px;
    }
}

.form-group {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 20px; /* Khoảng cách giữa ngày đặt và khung giờ */
}
    </style>
<body class="bodydatban">
    <div class="header__awning-top" style="z-index: 10000;"></div>
    <div class="banner-db">
        <img src="../PicAndVid/img/banner_header-2.jpg" alt="Quảng cáo đặc biệt" />
        <div class="wrapper">
            <br>
            <div class="container">
                <h2>Đặt bàn</h2>
               <form method="post" action="datban.php">
    <label>Nhập họ và tên</label>
    <input type="text" name="hoten" placeholder="Nhập tên của bạn" required>

    <label>Nhập số điện thoại</label>
    <input type="text" name="sdt" placeholder="Số điện thoại" required>

    <label>Chi nhánh</label>
    <select name="chinhanh" required>
        <option>Chi nhánh Đà Nẵng</option>
        <option>Chi nhánh Cần Thơ</option>
        <option>Chi nhánh Hà Nội</option>
        <option>Chi nhánh TP.HCM</option>
    </select>

    <div class="form-group">
        <label for="ngaydat">Ngày đặt</label>
        <input type="date" id="ngaydat" name="ngaydat" required>

        <label for="giodat">Giờ đặt</label>
        <select name="giodat" id="giodat" required>
            <option>10:00:00</option>
            <option>11:00:00</option>
            <option>17:30:00</option>
            <option>19:00:00</option>
            <option>20:15:00</option>
        </select>
    </div>

    <label>Số chỗ ngồi</label>
    <select name="sochongoi" required>
        <option>2</option>
        <option>3</option>
        <option>4</option>
        <option>6</option>
        <option>8</option>
    </select>

    <label>Loại bàn</label>
    <select name="loaiban" required>
        <option>Bàn ngoài trời</option>
        <option>Bàn trong nhà</option>
        <option>Bàn VIP</option>
        <option>Bàn tiệc</option>
    </select>

    <label>Ghi chú</label>
    <input type="text" name="ghichu" placeholder="Ghi chú yêu cầu thêm">

    <button class="submit-btn" style="border-radius:5px;">Đặt bàn</button>
</form>

            </div>
        </div>
    </div>
     <div class="header__awning-top" style="z-index: 10000;"></div>
    <?php
        include '../phpFile/footer.php';
        ?>
