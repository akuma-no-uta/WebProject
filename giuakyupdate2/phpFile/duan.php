<?php
require_once 'adminDAO/pdo.php';

// Xử lý thêm dự án
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ten_du_an'], $_POST['trang_thai'])) {
    $ten = trim($_POST['ten_du_an']);
    $trangthai = trim($_POST['trang_thai']);
    $mota = trim($_POST['mo_ta'] ?? ''); // Thêm trường mô tả

    if (empty($ten) || empty($trangthai)) {
        echo "<script>alert('Vui lòng nhập đầy đủ thông tin.'); window.history.back();</script>";
        exit;
    }

    try {
        pdo_execute("INSERT INTO duan (ten, TrangThai, MoTa) VALUES (?, ?, ?)", $ten, $trangthai, $mota);
        echo "<script>alert('Thêm dự án thành công.'); window.location.href='indexAdmin.php?act=dua';</script>";
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
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
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
    
    main .insights {
      display: grid;
      grid-template-columns: repeat(3,1fr); 
    }
    
    /* Popup overlay */
    .popup-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0,0,0,0.4);
      display: none;
      justify-content: center;
      align-items: center;
      z-index: 999;
    }
    
    /* Popup content */
    .popup-content {
      background: white;
      padding: 30px 20px;
      border-radius: 10px;
      width: 300px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
      animation: fadeIn 0.3s ease;
      text-align: center;
      position: relative;
    }
    
    .popup-content h2 {
      margin-bottom: 20px;
      font-size: 1.3rem;
      color: #333;
    }
    
    .popup-content input,
    .popup-content select,
    .popup-content textarea {
      width: 100%;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid #ccc;
    }
    
    .popup-content textarea {
      height: 80px;
      resize: vertical;
    }
    
    .popup-content button {
      width: 100%;
      padding: 10px;
      background-color: #007bff;
      border: none;
      color: white;
      font-weight: bold;
      border-radius: 8px;
      cursor: pointer;
      transition: background-color 0.2s ease;
    }
    
    .popup-content button:hover {
      background-color: #0056b3;
    }
    
    .close-btn {
      position: absolute;
      top: 8px;
      right: 12px;
      font-size: 24px;
      cursor: pointer;
      color: #999;
    }
    
    @keyframes fadeIn {
      from { transform: scale(0.9); opacity: 0; }
      to { transform: scale(1); opacity: 1; }
    }
</style>

<?php
require_once 'adminDAO/pdo.php';

$hoanThanh = pdo_query_value("SELECT COUNT(*) FROM duan WHERE trangthai = 'Đã hoàn thành'");
$chuaHoanThanh = pdo_query_value("SELECT COUNT(*) FROM duan WHERE trangthai = 'Chưa hoàn thành'");
$tongDuAn = pdo_query_value("SELECT COUNT(*) FROM duan");
$duAnList = pdo_query("SELECT id, ten, MoTa, trangthai FROM duan");
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
                <form action="indexAdmin.php?act=add_delete_duan.php" method="POST">
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
        
        <button class="tailieu_edit">
            <span class="material-symbols-outlined">remove</span>
        </button>
        
        <button class="tailieu_edit">
            <span class="material-symbols-outlined">edit</span>
        </button>
    </div>
    
    <div class="slider-wrapper">
        <div class="slider-container" id="slider">
            <?php foreach ($duAnList as $duAn): ?>
                <div class="slide-item">
                  
                    <img src="https://educrm.vn/uploads/phan-mem-quan-ly-3.png" alt="<?= $duAn['ten'] ?>">
                    <div class="project-name">
                        <?= $duAn['id'] ?>. <?= $duAn['ten'] ?>
                    </div>
                    <p><?= $duAn['trangthai'] ?></p>
                    <p class="project-description"><?= $duAn['MoTa'] ?></p>
                </div>
            <?php endforeach; ?>
        </div>
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
</script>