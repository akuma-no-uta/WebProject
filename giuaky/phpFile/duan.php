<?php
require_once 'adminDAO/pdo.php';

// Xử lý thêm dự án
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ten_du_an'], $_POST['trang_thai'])) {
    $ten = trim($_POST['ten_du_an']);
    $trangthai = trim($_POST['trang_thai']);
    $mota = trim($_POST['mo_ta'] ?? ''); // Thêm trường mô tả

    // Kiểm tra nếu có ảnh được tải lên
    $imageData = null;
    if (isset($_FILES['anh_du_an']) && $_FILES['anh_du_an']['error'] === UPLOAD_ERR_OK) {
        // Đọc nội dung ảnh vào biến $imageData
        $imageData = file_get_contents($_FILES['anh_du_an']['tmp_name']);
    }

    if (empty($ten) || empty($trangthai)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin.'); window.history.back();</script>";
        exit;
    }

    try {
        // Thêm dự án vào cơ sở dữ liệu (bao gồm cả dữ liệu ảnh dưới dạng BLOB)
        pdo_execute("INSERT INTO duan (Ten, TrangThai, MoTa, Anh) VALUES (?, ?, ?, ?)", $ten, $trangthai, $mota, $imageData);
        echo "<script>alert('Thêm dự án thành công.'); window.location.href='indexAdmin.php?act=duan';</script>";
        exit;
    } catch (Exception $e) {
        echo "<script>alert('Lỗi khi thêm dự án: " . addslashes($e->getMessage()) . "'); window.history.back();</script>";
        exit;
    }
}

// Xử lý xóa dự án
if (isset($_GET['act']) && $_GET['act'] === 'deleteDuan' && isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Kiểm tra dự án có tồn tại không
    $check = pdo_query_one("SELECT * FROM duan WHERE id_du_an = ?", $id);
    if ($check) {
        pdo_execute("DELETE FROM duan WHERE id_du_an = ?", $id);
        echo "<script>alert('Xóa dự án thành công.'); window.location.href='indexAdmin.php?act=duan';</script>";
        exit;
    } else {
        echo "<script>alert('Dự án không tồn tại hoặc đã bị xóa.'); window.location.href='indexAdmin.php?act=duan';</script>";
        exit;
    }
}
?>

<link rel="stylesheet" href="css/duan.css">

<style>
    /* Các phần style khác giữ nguyên */
    .slider-wrapper {
        display: flex;
        justify-content: center;
        padding: 30px 0;
        background-color: #f8f9fa;
        border-radius: 20px;
        margin: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05);
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

    .slider-wrapper {
        position: relative;
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

    /* Các phần style khác */
</style>

<?php
$hoanThanh = pdo_query_value("SELECT COUNT(*) FROM duan WHERE trangthai = 'Đã hoàn thành'");
$chuaHoanThanh = pdo_query_value("SELECT COUNT(*) FROM duan WHERE trangthai = 'Chưa hoàn thành'");
$tongDuAn = pdo_query_value("SELECT COUNT(*) FROM duan");
$duAnList = pdo_query("SELECT id, ten, MoTa, trangthai, Anh FROM duan");
?>

<div class="user">
    <div class="edit">
        <button class="tailieu_edit" title="Thêm Dự Án" onclick="openPopup()">
            <span class="material-symbols-outlined">add</span>
        </button>

        <!-- Popup Thêm Dự Án -->
        <div id="popupForm" class="popup-overlay">
            <div class="popup-content">
                <span class="close-btn" onclick="closePopup()">&times;</span>
                <h2>Thêm Dự Án Mới</h2>
                <form action="indexAdmin.php?act=add_delete_duan" method="POST" enctype="multipart/form-data">
                    <input type="text" name="ten_du_an" placeholder="Tên dự án" required>
                    <textarea name="mo_ta" placeholder="Mô tả dự án"></textarea>
                    <select name="trang_thai" required>
                        <option value="Chưa hoàn thành">Chưa hoàn thành</option>
                        <option value="Đã hoàn thành">Đã hoàn thành</option>
                    </select>
                    <label for="anh_du_an">Tải ảnh dự án:</label>
                    <input type="file" name="anh_du_an" accept="image/*" required>
                    <button type="submit">Thêm</button>
                </form>
            </div>
        </div>

    </div>

    <div class="slider-wrapper">
        <button class="slider-btn left" onclick="scrollSlider('left')">
            &#10094;
        </button>

        <div class="slider-container" id="slider">
            <?php foreach ($duAnList as $duAn): ?>
                <div class="slide-item">
                    <!-- Kiểm tra nếu dự án có ảnh -->
                    <?php if ($duAn['Anh']): ?>
                        <img src="data:image/jpeg;base64,<?= base64_encode($duAn['Anh']) ?>" alt="<?= htmlspecialchars($duAn['ten']) ?>" style="max-width: 100%; height: 180px; object-fit: cover;">
                    <?php else: ?>
                        <p>Ảnh không có</p>
                    <?php endif; ?>
                    <div class="project-name">
                        <?= $duAn['id'] ?>. <?= $duAn['ten'] ?>
                    </div>
                    <p><?= $duAn['trangthai'] ?></p>
                    <p class="project-description"><?= $duAn['MoTa'] ?></p>

                    <form action="indexAdmin.php" method="GET" onsubmit="return confirm('Bạn có chắc muốn xóa dự án này?');" class="delete-form">
                        <input type="hidden" name="act" value="deleteDuan">
                        <input type="hidden" name="id" value="<?= $duAn['id'] ?>">
                        <button type="submit" class="delete-btn">Xóa</button>
                    </form>
                </div>
            <?php endforeach; ?>
        </div>

        <button class="slider-btn right" onclick="scrollSlider('right')">
            &#10095;
        </button>
    </div>

    <main>
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
    const slider = document.getElementById('slider');
    let isDown = false;
    let startX;
    let scrollLeft;
    
    slider.addEventListener('mousedown', (e) => {
        isDown = true;
        slider.classList.add('active');
        startX = e.pageX - slider.offsetLeft;
        scrollLeft = slider.scrollLeft;
    });
    
    slider.addEventListener('mouseleave', () => {
        isDown = false;
    });
    
    slider.addEventListener('mouseup', () => {
        isDown = false;
    });
    
    slider.addEventListener('mousemove', (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - slider.offsetLeft;
        const walk = (x - startX) * 2;
        slider.scrollLeft = scrollLeft - walk;
    });
    
    function openPopup() {
        document.getElementById("popupForm").style.display = "flex";
    }
    
    function closePopup() {
        document.getElementById("popupForm").style.display = "none";
    }

    function scrollSlider(direction) {
        const slider = document.getElementById('slider');
        const scrollAmount = 320;

        if (direction === 'left') {
            slider.scrollLeft -= scrollAmount;
        } else {
            slider.scrollLeft += scrollAmount;
        }
    }
</script>
