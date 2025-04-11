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
    main .insights{
    display:grid;
    grid-template-columns: repeat(3,1fr); 
}
</style>
<?php
require_once 'adminDAO//pdo.php'; // đổi lại đường dẫn nếu cần

$hoanThanh = pdo_query_value("SELECT COUNT(*) FROM duan WHERE trangthai = 'Đã hoàn thành'");
$chuaHoanThanh = pdo_query_value("SELECT COUNT(*) FROM duan WHERE trangthai = 'Chưa hoàn thành'");
$tongDuAn = pdo_query_value("SELECT COUNT(*) FROM duan");
$duAnList = pdo_query("SELECT Ten, trangthai FROM duan");
?>
<div class="user">

<div class="slider-wrapper">
<div class="slider-container" id="slider">
<?php foreach ($duAnList as $duAn): ?>
    <div class="slide-item">
      <img src="https://educrm.vn/uploads/phan-mem-quan-ly-3.png" alt="<?= $duAn['Ten'] ?>">
      <div class="project-name"><?= $duAn['Ten'] ?></div>
      <p><?= $duAn['trangthai'] ?></p>
    </div>
  <?php endforeach; ?>
</div>

    </div>
    <main>
    <h1>TRẠNG THÁI</h1>

    <div class="insights">
        <!--start doanh so ban hang-->
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
        <!--end doanh so ban hang-->

        <!--start Khoan chi-->
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

        <!--end khoan chi-->

        <!--start Loi nhuan-->
        <div class="income">
          <span class="material-symbols-outlined">folder_check_2</span>
            <div class="middle">
                <div class="left">
                <h3>Tổng Dự Án </h3>
<h1><?= $tongDuAn ?></h1>

                </div>
               
            </div>
            <small>Tháng 11</small>
        </div>
        <!--end Loi nhuan-->


    </div>
</main>
  </div>
 
</div>    
</div>
<script>
document.getElementById('weekSelect').addEventListener('change', function() {
    const selectedWeek = this.value.replace('week', '');

    fetch(`get_schedule.php?week=${selectedWeek}`)
        .then(response => response.text())
        .then(data => {
            const tbody = document.querySelector('table tbody');
            tbody.innerHTML = data;
        })
        .catch(error => console.error('Lỗi khi tải thời khóa biểu:', error));
});
</script>

    <script src="../JS/Admin.js"></script>
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
          const walk = (x - startX) * 2; // tốc độ kéo
          slider.scrollLeft = scrollLeft - walk;
        });
      </script> 