    <?php
include_once '../phpFile/header.php';   
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Kết nối database
    $conn = new mysqli("localhost", "root", "", "cuoiky");
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    // Lấy dữ liệu từ form
    $hoten = $_POST['fullname'];
    $sdt = $_POST['phone'];
    $email = $_POST['email'];
    $kinhnghiem = $_POST['kinhnghiem'];
    $congviec = $_POST['congviec'];

    // Xử lý file upload
    if (isset($_FILES['cv']) && $_FILES['cv']['error'] == 0) {
        $cvData = file_get_contents($_FILES['cv']['tmp_name']);

        // Sử dụng prepared statement để tránh SQL Injection
       $stmt = $conn->prepare("INSERT INTO ungtuyen (hoten, sdt, email, kinhnghiem, congviec, filecv) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->send_long_data(5, $cvData);
$stmt->bind_param("sssssb", $hoten, $sdt, $email, $kinhnghiem, $congviec, $cvData);


        if ($stmt->execute()) {
            echo "Đăng ký thành công!";
        } else {
            echo "Lỗi khi lưu dữ liệu: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Lỗi khi upload file CV.";
    }

    $conn->close();
}
?>
    <!doctype html>
<html lang="en">
  <head>
    <title>Title</title>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1, shrink-to-fit=no"
    />

<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
      <link href="../css/bootstrap.css" rel = "stylesheet">
      <link href="../css/tuyen_dung.css" rel ="stylesheet">

      <link href="../css/mainpage.css" rel ="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

</head>
    <style>
.container-job {
    width: 50%;
    margin: 50px auto;
    background-color: #fff;
    padding: 30px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    border-radius: 10px;
    margin-top: 100px;
}

h2 {
    text-align: center;
    margin-bottom: 30px;
    color: #2c3e50;
    font-size: 28px;
}

form.job-search-form {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.form-group {
    margin-bottom: 15px;
}

label {
    font-weight: 600;
    margin-bottom: 8px;
    display: block;
    color: #34495e;
}

input[type="text"], 
input[type="email"],
input[type="tel"],
input[type="file"],
select {
    width: 100%;
    padding: 12px;
    border: 1px solid #ddd;
    border-radius: 6px;
    box-sizing: border-box;
    font-size: 16px;
    transition: border-color 0.3s;
}

input:focus, select:focus {
    border-color: #3498db;
    outline: none;
    box-shadow: 0 0 0 2px rgba(52, 152, 219, 0.2);
}

button.btn-search {
    background-color: #3498db;
    color: white;
    padding: 14px 24px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    font-size: 16px;
    font-weight: 600;
    transition: background-color 0.3s;
    margin-top: 10px;
}

button.btn-search:hover {
    background-color: #2980b9;
}

.cv-upload {
    border: 2px dashed #bdc3c7;
    padding: 20px;
    text-align: center;
    border-radius: 6px;
    background-color: #f8f9fa;
    cursor: pointer;
    transition: all 0.3s;
}

.cv-upload:hover {
    border-color: #3498db;
    background-color: #f0f7ff;
}

.cv-upload i {
    font-size: 24px;
    color: #7f8c8d;
    margin-bottom: 10px;
}

.cv-upload p {
    margin: 0;
    color: #7f8c8d;
}

.form-row {
    display: flex;
    gap: 20px;
}

.form-row .form-group {
    flex: 1;
}

@media (max-width: 768px) {
    .container-job {
        width: 90%;
        margin-top: 50px;
        padding: 20px;
    }
    
    .form-row {
        flex-direction: column;
        gap: 15px;
    }
}
select {
    z-index: 10;
    position: relative;
}.input{
    height:20px;
}
</style>

<div class="container container-job">
    <h2>Đăng ký Tìm việc làm</h2>
    <form class="job-search-form" method="post" enctype="multipart/form-data">
        <!-- Thông tin cá nhân -->
        <div class="form-row">
            <div class="form-group">
                <label for="fullname">Họ và tên:</label>
                <input style="color:black" type="text" id="fullname" name="fullname" placeholder="Nhập họ và tên đầy đủ" required>
            </div>
            <div class="form-group">
                <label for="phone">Số điện thoại:</label>
                <input type="tel" id="phone" name="phone" placeholder="Nhập số điện thoại" required>
            </div>
        </div>
        
        <div class="form-row">
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Nhập địa chỉ email" required>
            </div>
            
        </div>
        
       <!-- Kinh nghiệm -->
<div class="form-group">
    <label for="kinhnghiem">Kinh nghiệm làm việc:</label>
    <select id="kinhnghiem" name="kinhnghiem">
        <option value="">Chọn mức kinh nghiệm</option>
        <option value="fresh">Mới tốt nghiệp/Chưa có kinh nghiệm</option>
        <option value="0-1">Dưới 1 năm</option>
        <option value="1-3">1-3 năm</option>
        <option value="3-5">3-5 năm</option>
        <option value="5+">Trên 5 năm</option>
    </select>
</div>

<!-- Công việc -->
<div class="form-group">
    <label for="congviec">Chọn công việc:</label>
    <select id="congviec" name="congviec">
        <option value="phụ bếp">Phụ bếp</option>
        <option value="tạp vụ">Tạp vụ</option>
        <option value="đầu bếp">Đầu Bếp</option>
        <option value="quản lý">Quản lý</option>
    </select>
</div>

        
        <!-- Upload CV -->
        <div class="form-group">
            <label>Upload CV (PDF/DOC/DOCX):</label>
            <div class="cv-upload">
                <i class="fas fa-cloud-upload-alt"></i>
                <p>Kéo thả file vào đây hoặc click để chọn file</p>
                <input type="file" id="cv" name="cv" accept=".pdf,.doc,.docx" style="display: none;" required>
            </div>
        </div>
        
        <div class="form-group">
            <button type="submit" class="btn-search">Gửi thông tin</button>
        </div>
    </form>
</div>

<script>
// Xử lý upload CV
document.querySelector('.cv-upload').addEventListener('click', function() {
    document.getElementById('cv').click();
});

document.getElementById('cv').addEventListener('change', function(e) {
    if (this.files.length > 0) {
        const fileName = this.files[0].name;
        document.querySelector('.cv-upload p').textContent = fileName;
        document.querySelector('.cv-upload i').className = 'fas fa-file-alt';
    }
});
</script>

<?php
include_once '../phpFile/footer.php';
?>