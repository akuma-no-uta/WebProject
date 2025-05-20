<?php
// Kết nối đến cơ sở dữ liệu MySQL
$servername = "localhost"; // Máy chủ cơ sở dữ liệu
$username = "root";        // Tên người dùng MySQL
$password = "";            // Mật khẩu MySQL
$dbname = "giuaky"; // Tên cơ sở dữ liệu

// Kết nối
$conn = new mysqli($servername, $username, $password, $dbname);

// Kiểm tra kết nối
if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Biến để kiểm tra kết quả khi gửi form
$successMessage = '';

// Xử lý khi form được submit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $hoTen = $_POST['ho_ten'];
    $lop = $_POST['lop'];
    $chatLuongBaiGiang = $_POST['chat_luong_bai_giang'];
    $chatLuongBaiTap = $_POST['chat_luong_bai_tap'];
    $thaiDoGiangVien = $_POST['thai_do_giang_vien'];
    $noiDungGopY = $_POST['noi_dung_gop_y'];

    // Chuẩn bị câu lệnh SQL để chèn dữ liệu vào bảng
    $sql = "INSERT INTO danh_gia (ho_ten, lop, chat_luong_bai_giang, chat_luong_bai_tap, thai_do_giang_vien, noi_dung_gop_y)
            VALUES ('$hoTen', '$lop', '$chatLuongBaiGiang', '$chatLuongBaiTap', '$thaiDoGiangVien', '$noiDungGopY')";

    // Thực thi câu lệnh SQL
    if ($conn->query($sql) === TRUE) {
        // Cập nhật thông báo thành công
        $successMessage = "Đánh giá của bạn đã được gửi thành công!";
    } else {
        $successMessage = "Lỗi: " . $conn->error;
    }
}

// Đóng kết nối
$conn->close();
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đánh giá Giảng viên</title>
    <style>
        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"], input[type="radio"], textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            height: 150px;
        }

        button {
            background-color:rgb(4, 103, 208); /* Màu nền nút */
            color: white; /* Màu chữ */
            padding: 12px 20px; /* Padding cho nút */
            border: none; /* Không viền */
            border-radius: 4px; /* Bo góc cho nút */
            cursor: pointer; /* Hiển thị con trỏ khi hover */
            width: 100%; /* Để nút chiếm 100% chiều rộng của form */
            font-size: 16px; /* Kích thước chữ */
            font-weight: bold; /* Làm đậm chữ */
            text-align: center; /* Canh giữa chữ trong nút */
        }

        button:hover {
            background-color:rgb(46, 170, 232); /* Màu nền khi hover */
            transition: background-color 0.3s ease; /* Hiệu ứng chuyển màu khi hover */
        }

        .rating-group {
            display: flex;
             gap: 10px;
        }

        input[type="radio"]:checked {
            background-color: rgb(46, 108, 232); /* Màu nền khi được chọn */
            border-color: rgb(46, 114, 232); /* Đổi màu viền khi chọn */
        }

        input[type="radio"]:hover {
            border-color:rgb(93, 129, 166); /* Đổi màu viền khi hover */
        }

        /* CSS cho Toast */
        .toast {
            visibility: hidden;
            min-width: 250px;
            margin-left: -125px;
            background-color: #4CAF50;
            color: white;
            text-align: center;
            border-radius: 2px;
            padding: 16px;
            position: fixed;
            z-index: 1;
            left: 50%;
            bottom: 30px;
            font-size: 17px;
            transition: visibility 0s, opacity 0.5s linear;
        }

        .toast.show {
            visibility: visible;
            opacity: 1;
        }
         h2 {
        font-size: 28px;
        color: #2c3e50;
        margin-bottom: 15px;
        padding-bottom: 5px;
        border-bottom: 2px solid #0284c7;  
        margin-top: 40px; 
    }
    .rating-option {
    display: flex;
    flex-direction: column;
    align-items: center;
    font-size: 14px;
    color: #334155;
}

input[type="radio"] {
    width: 18px;
    height: 18px;
    appearance: none;
    border: 2px solid rgb(4, 103, 208);
    border-radius: 50%;
    outline: none;
    cursor: pointer;
    transition: background-color 0.3s, border-color 0.3s;
    margin-bottom: 5px;
}
    </style>
</head>
<body>  
    <h2>Đánh Giá Chất Lượng</h2>
    <div class="baidang" style="width: 60%;
    max-width: 700px;
    padding: 30px;
    border: 1px solid #cbd5e0;
    border-radius: 12px;
    box-shadow: 0 4px 16px rgba(0, 0, 0, 0.1);
    background-color: #fff;
    margin: 0 auto 25px;">
        <form action="" method="POST">
            <div class="form-group">
                <label for="ho_ten">Họ và tên:</label>
                <input type="text" id="ho_ten" name="ho_ten" required>
            </div>

            <div class="form-group">
                <label for="lop">Lớp:</label>
                <input type="text" id="lop" name="lop" required>
            </div>
            <div class="form-group" >
                <label>Chất lượng bài giảng (1-5):</label>
                <div class="rating-group">
                    <input type="radio" id="chat_luong_bai_giang_1" name="chat_luong_bai_giang" value="1" required>.1
                    <input type="radio" id="chat_luong_bai_giang_2" name="chat_luong_bai_giang" value="2" style="margin-left: 30px;"> .2
                    <input type="radio" id="chat_luong_bai_giang_3" name="chat_luong_bai_giang" value="3" style="margin-left: 30px;"> .3
                    <input type="radio" id="chat_luong_bai_giang_4" name="chat_luong_bai_giang" value="4" style="margin-left: 30px;"> .4
                    <input type="radio" id="chat_luong_bai_giang_5" name="chat_luong_bai_giang" value="5" style="margin-left: 30px;"> .5
                </div>
            </div>

            <div class="form-group">
                <label>Chất lượng bài tập (1-5):</label>
                <div class="rating-group">
                    <input type="radio" id="chat_luong_bai_tap_1" name="chat_luong_bai_tap" value="1" required> .1
                    <input type="radio" id="chat_luong_bai_tap_2" name="chat_luong_bai_tap" value="2"  style="margin-left: 30px;"> .2
                    <input type="radio" id="chat_luong_bai_tap_3" name="chat_luong_bai_tap" value="3"  style="margin-left: 30px;"> .3
                    <input type="radio" id="chat_luong_bai_tap_4" name="chat_luong_bai_tap" value="4"  style="margin-left: 30px;"> .4
                    <input type="radio" id="chat_luong_bai_tap_5" name="chat_luong_bai_tap" value="5"  style="margin-left: 30px;"> .5
                </div>
            </div>

            <div class="form-group">
                <label>Thái độ giảng viên (1-5):</label>
                <div class="rating-group">
                    <input type="radio" id="thai_do_giang_vien_1" name="thai_do_giang_vien" value="1" required> .1
                    <input type="radio" id="thai_do_giang_vien_2" name="thai_do_giang_vien" value="2" style="margin-left: 30px;"> .2
                    <input type="radio" id="thai_do_giang_vien_3" name="thai_do_giang_vien" value="3" style="margin-left: 30px;"> .3
                    <input type="radio" id="thai_do_giang_vien_4" name="thai_do_giang_vien" value="4" style="margin-left: 30px;"> .4
                    <input type="radio" id="thai_do_giang_vien_5" name="thai_do_giang_vien" value="5" style="margin-left: 30px;"> .5
                </div>
            </div>

            <div class="form-group">
                <label for="noi_dung_gop_y">Nội dung góp ý:</label>
                <textarea id="noi_dung_gop_y" name="noi_dung_gop_y" required></textarea>
            </div>

            <button type="submit">Gửi đánh giá</button>
        </form>
    </div>
    <!-- Toast Message -->
    <div id="toast" class="toast"><?php echo $successMessage; ?></div>

    <script>
        // Hiển thị thông báo toast khi đánh giá thành công
        <?php if ($successMessage): ?>
            var toast = document.getElementById("toast");
            toast.className = "toast show";
            setTimeout(function () {
                toast.className = toast.className.replace("show", "");
            }, 3000); // Toast sẽ biến mất sau 3 giây
        <?php endif; ?>
    </script>
</body>
</html>
