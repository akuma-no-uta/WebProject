<?php
// Tạo thư mục uploads nếu chưa có
$uploadDir = 'uploads/';
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$message = '';

// ✅ KẾT NỐI DATABASE
try {
    $pdo = new PDO("mysql:host=localhost;dbname=giuaky;charset=utf8", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Không thể kết nối DB: " . $e->getMessage());
}

// ✅ XỬ LÝ UPLOAD ẢNH CHO DỰ ÁN ĐÃ CÓ
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['act']) && $_GET['act'] === 'uploadImage') {
    $id = intval($_POST['project_id']);
    if (isset($_FILES['anh_du_an']) && $_FILES['anh_du_an']['error'] === UPLOAD_ERR_OK) {
        $fileType = $_FILES['anh_du_an']['type'];
        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];

        if (!in_array($fileType, $allowedTypes)) {
            echo "<script>alert('Chỉ chấp nhận ảnh JPEG, PNG, GIF.'); window.history.back();</script>";
            exit;
        }

        $imageData = file_get_contents($_FILES['anh_du_an']['tmp_name']);
        $stmt = $pdo->prepare("UPDATE duan SET Anh = ?, AnhMimeType = ? WHERE ID = ?");
        $stmt->execute([$imageData, $fileType, $id]);

        echo "<script>alert('Upload ảnh thành công!'); window.location.href='indexAdmin.php?act=duan';</script>";
        exit;
    } else {
        echo "<script>alert('Lỗi khi tải ảnh lên.'); window.history.back();</script>";
        exit;
    }
}

// ✅ XỬ LÝ THÊM DỰ ÁN
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ten_du_an'], $_POST['trang_thai'])) {
    $ten = trim($_POST['ten_du_an']);
    $trangthai = trim($_POST['trang_thai']);
    $mota = trim($_POST['mo_ta'] ?? '');

    $imageData = null;
    $fileType = null;
    $uploadSuccess = false;

    if (isset($_FILES['anh_du_an'])) {
        error_log("File upload error code: " . $_FILES['anh_du_an']['error']);
        if ($_FILES['anh_du_an']['error'] === UPLOAD_ERR_OK) {
            error_log("File received: " . $_FILES['anh_du_an']['name']);
            $allowedTypes = ['image/jpeg', 'image/png', 'image/gif'];
            $fileType = $_FILES['anh_du_an']['type'];

            if (!in_array($fileType, $allowedTypes)) {
                echo "<script>alert('Chỉ chấp nhận file ảnh (JPEG, PNG, GIF)'); window.history.back();</script>";
                exit;
            }

            if ($_FILES['anh_du_an']['size'] > 2 * 1024 * 1024) {
                echo "<script>alert('Kích thước ảnh tối đa là 2MB'); window.history.back();</script>";
                exit;
            }

            $imageData = file_get_contents($_FILES['anh_du_an']['tmp_name']);
            if ($imageData === false) {
                error_log("Failed to read file contents");
                echo "<script>alert('Không thể đọc file ảnh.'); window.history.back();</script>";
                exit;
            }
            $uploadSuccess = true;
        } else {
            error_log("Upload error: " . $_FILES['anh_du_an']['error']);
            echo "<script>alert('Lỗi khi tải ảnh lên: " . $_FILES['anh_du_an']['error'] . "'); window.history.back();</script>";
            exit;
        }
    } else {
        error_log("No file uploaded");
        echo "<script>alert('Vui lòng chọn một file ảnh.'); window.history.back();</script>";
        exit;
    }

    if (empty($ten) || empty($trangthai)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin.'); window.history.back();</script>";
        exit;
    }

    try {
        $sql = "INSERT INTO duan (Ten, TrangThai, MoTa, Anh, AnhMimeType) VALUES (?, ?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);

        if ($uploadSuccess && $imageData !== null) {
            $stmt->execute([$ten, $trangthai, $mota, $imageData, $fileType]);
        } else {
            $stmt->execute([$ten, $trangthai, $mota, null, null]);
        }

        echo "<script>alert('Thêm dự án thành công.'); window.location.href='indexAdmin.php?act=duan';</script>";
        exit;
    } catch (Exception $e) {
        error_log("Database error: " . $e->getMessage());
        echo "<script>alert('Lỗi khi thêm dự án: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
        exit;
    }
}

// ✅ XỬ LÝ XÓA DỰ ÁN
if (isset($_GET['act']) && $_GET['act'] === 'deleteDuan' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    $check = $pdo->prepare("SELECT * FROM duan WHERE id = ?");
    $check->execute([$id]);
    $duan = $check->fetch(PDO::FETCH_ASSOC);

    if ($duan) {
        $del = $pdo->prepare("DELETE FROM duan WHERE id = ?");
        $del->execute([$id]);
        echo "<script>alert('Xóa dự án thành công.'); window.location.href='indexAdmin.php?act=duan';</script>";
        exit;
    } else {
        echo "<script>alert('Dự án không tồn tại hoặc đã bị xóa.'); window.location.href='indexAdmin.php?act=duan';</script>";
        exit;
    }
}

// ✅ LẤY DỮ LIỆU
$hoanThanh = $pdo->query("SELECT COUNT(*) FROM duan WHERE TrangThai = 'Đã hoàn thành'")->fetchColumn();
$chuaHoanThanh = $pdo->query("SELECT COUNT(*) FROM duan WHERE TrangThai = 'Chưa hoàn thành'")->fetchColumn();
$tongDuAn = $pdo->query("SELECT COUNT(*) FROM duan")->fetchColumn();
$duAnList = $pdo->query("SELECT id, Ten, MoTa, TrangThai, Anh, AnhMimeType FROM duan")->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <title>Quản lý Dự án</title>
    <link rel="stylesheet" href="css/duan.css" />
    <style>
        /* Style popup */
        .popup-overlay {
            position: fixed;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0,0,0,0.5);
            display: none;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }
        .popup-content {
            background: white;
            padding: 20px 30px;
            border-radius: 10px;
            position: relative;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 5px 15px rgba(0,0,0,0.3);
        }
        .close-btn {
            position: absolute;
            top: 10px;
            right: 15px;
            font-size: 24px;
            cursor: pointer;
            color: #333;
        }

        .tailieu_edit {
            cursor: pointer;
            background-color: #007bff;
            border: none;
            border-radius: 50%;
            width: 45px;
            height: 45px;
            color: white;
            font-size: 30px;
            display: flex;
            justify-content: center;
            align-items: center;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            transition: background-color 0.3s ease;
        }
        .tailieu_edit:hover {
            background-color: #0056b3;
        }

        .slider-wrapper {
            display: flex;
            justify-content: center;
            padding: 30px 0;
            background-color: #f8f9fa;
            border-radius: 20px;
            margin: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
            position: relative;
        }

        .slider-container {
            display: flex;
            gap: 20px;
            overflow-x: auto;
            scroll-behavior: smooth;
            padding-bottom: 10px;
            max-width: 1000px;
        }

        .slider-container::-webkit-scrollbar {
            display: none;
        }

        .slide-item {
            flex: 0 0 300px;
            background-color: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            text-align: center;
            transition: transform 0.3s ease;
            padding-bottom: 15px;
        }

        .slide-item:hover {
            transform: translateY(-5px);
        }

        .slide-item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .no-image {
            width: 100%;
            height: 180px;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #666;
        }

        .slider-btn {
            background-color: #007bff;
            color: white;
            border: none;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            font-size: 20px;
            cursor: pointer;
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            z-index: 10;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: background-color 0.3s ease, transform 0.2s;
        }

        .slider-btn:hover {
            background-color: #0056b3;
            transform: translateY(-50%) scale(1.05);
        }

        .slider-btn.left {
            left: 10px;
        }

        .slider-btn.right {
            right: 10px;
        }

        .project-name {
            padding: 15px;
            font-weight: bold;
            font-size: 1.1rem;
            color: #333;
        }

        .project-description {
            padding: 0 15px;
            color: #666;
            font-size: 0.9rem;
        }

        main {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }
        .insights {
            display: flex;
            gap: 20px;
            justify-content: center;
            margin-top: 20px;
        }
        .insights > div {
            background: #f0f4f8;
            border-radius: 15px;
            padding: 20px;
            width: 250px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        }
        .insights h1, .insights h3, .insights h1 {
            margin: 0 0 10px;
        }
        .popup-content form {
    display: flex;
    flex-direction: column;
    gap: 12px;
    margin-top: 15px;
}

.popup-content input[type="text"],
.popup-content textarea,
.popup-content select,
.popup-content input[type="file"] {
    padding: 10px 12px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
    transition: border-color 0.3s;
}

.popup-content input[type="text"]:focus,
.popup-content textarea:focus,
.popup-content select:focus {
    border-color: #007bff;
    outline: none;
}

.popup-content button[type="submit"] {
    background-color: #007bff;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 8px;
    font-weight: bold;
    cursor: pointer;
    transition: background-color 0.3s;
}

.popup-content button[type="submit"]:hover {
    background-color: #0056b3;
}

    </style>
</head>
<body>

<div class="user">
    <div class="edit">
        <button class="tailieu_edit" title="Thêm Dự Án" id="btnOpenPopup">
            <span class="material-symbols-outlined">add</span>
        </button>

    
    </div>

    <!-- Popup Thêm Dự Án -->
    <div id="popupForm" class="popup-overlay">
        <div class="popup-content">
            <span class="close-btn" id="btnClosePopup">×</span>
            <h2>Thêm Dự Án Mới</h2>
            <form action="indexAdmin.php?act=add_delete_duan" method="POST" enctype="multipart/form-data">
                <input type="text" name="ten_du_an" placeholder="Tên dự án" required>
                <textarea name="mo_ta" placeholder="Mô tả dự án"></textarea>
                <select name="trang_thai" required>
                    <option value="Chưa hoàn thành">Chưa hoàn thành</option>
                    <option value="Đã hoàn thành">Đã hoàn thành</option>
                </select>

                <button type="submit">Thêm</button>
            </form>
        </div>
    </div>

    <div class="slider-wrapper">
        <button class="slider-btn left" onclick="scrollSlider('left')">❮</button>
        <div class="slider-container" id="slider">
            <?php foreach ($duAnList as $duAn): ?>
               <div class="slide-item">
           <form action="indexAdmin.php?act=uploadImage" method="POST" enctype="multipart/form-data">
    <input type="hidden" name="project_id" value="<?= $duAn['id'] ?>">

    <div class="dropZone" id="dropZone-<?= $duAn['id'] ?>">
        <?php if (!empty($duAn['Anh'])): ?>
            <img src="data:<?= htmlspecialchars($duAn['AnhMimeType']) ?>;base64,<?= base64_encode($duAn['Anh']) ?>" alt="<?= htmlspecialchars($duAn['Ten']) ?>" style="max-width: 100%; height: 180px; object-fit: cover;">
            <p>Kéo thả hoặc click để thay ảnh mới</p>
        <?php else: ?>
            <p>Kéo thả ảnh vào đây hoặc nhấp để chọn file</p>
        <?php endif; ?>
    </div>

    <input type="file" name="anh_du_an" id="image-<?= $duAn['id'] ?>" style="display:none;" accept="image/jpeg, image/png, image/gif" required>
    <button type="submit">Upload Ảnh</button>
</form>


    <div class="project-name"><?= $duAn['id'] ?>. <?= htmlspecialchars($duAn['Ten']) ?></div>
    <p><?= htmlspecialchars($duAn['TrangThai']) ?></p>
    <p class="project-description"><?= htmlspecialchars($duAn['MoTa']) ?></p>

    <form action="indexAdmin.php" method="GET" onsubmit="return confirm('Bạn có chắc muốn xóa dự án này?');" class="delete-form">
        <input type="hidden" name="act" value="deleteDuan">
        <input type="hidden" name="id" value="<?= $duAn['id'] ?>">
        <button type="submit" class="delete-btn">Xóa</button>
    </form>
</div>

            <?php endforeach; ?>
        </div>
        <button class="slider-btn right" onclick="scrollSlider('right')">❯</button>
    </div>

    <main style>
    <h1>TRẠNG THÁI</h1>
    <div class="insights">
        <div class="sales">
            <span class="material-symbols-outlined">folder_off</span>
            <div class="middle">
                <div class="left">
                    <h3>Dự án Chưa Hoàn Thành</h3>
                    <h1><?= $chuaHoanThanh ?></h1>
                </div>
            </div>
            <small>Tháng 11</small>
        </div>
        
        <div class="expenses">
            <span class="material-symbols-outlined">folder_eye</span>
            <div class="middle">
                <div class="left">
                    <h3>Dự Án Hoàn Thành</h3>
                    <h1><?= $hoanThanh ?></h1>
                </div>
            </div>
            <small>Tháng 11</small>
        </div>
        
        <div class="income">
            <span class="material-symbols-outlined">folder_check_2</span>
            <div class="middle">
                <div class="left">
                    <h3>Tổng Dự Án</h3>
                    <h1><?= $tongDuAn ?></h1>
                </div>
            </div>
            <small>Tháng 11</small>
        </div>
    </div>
</main>

</div>

<script>

    // Popup mở/đóng
    document.getElementById('btnOpenPopup').addEventListener('click', function() {
        document.getElementById('popupForm').style.display = 'flex';
    });

    document.getElementById('btnClosePopup').addEventListener('click', function() {
        document.getElementById('popupForm').style.display = 'none';
    });

    window.addEventListener('click', function(e) {
        const popup = document.getElementById('popupForm');
        if (e.target === popup) {
            popup.style.display = 'none';
        }
    });



    function scrollSlider(direction) {
        const slider = document.getElementById('slider');
        const scrollAmount = 320;
        if (direction === 'left') {
            slider.scrollBy({left: -scrollAmount, behavior: 'smooth'});
        } else {
            slider.scrollBy({left: scrollAmount, behavior: 'smooth'});
        }
    }

   window.onload = function () {
    // Gắn sự kiện cho từng form upload
    document.querySelectorAll(".slide-item").forEach(function (slideItem) {
        const dropZone = slideItem.querySelector(".dropZone");
        const fileInput = slideItem.querySelector("input[type='file']");

        if (dropZone && fileInput) {
            // Sự kiện drag/drop
            dropZone.ondragover = function (e) {
                e.preventDefault();
                dropZone.classList.add("hover");
            };
            dropZone.ondragleave = function (e) {
                e.preventDefault();
                dropZone.classList.remove("hover");
            };
            dropZone.ondrop = function (e) {
                e.preventDefault();
                dropZone.classList.remove("hover");
                fileInput.files = e.dataTransfer.files;
            };

            // Sự kiện click
            dropZone.onclick = function () {
                fileInput.click();
            };
        }
    });
    
};

</script>
</body>
</html>