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
    gap:1.6rem;
}
</style>
<div class="user">

<div class="slider-wrapper">
    <div class="slider-container" id="slider">
      <div class="slide-item">
        <img src="https://educrm.vn/uploads/phan-mem-quan-ly-3.png" alt="Dự án 1">
        <div class="project-name">Hệ thống Quản lý Sinh viên</div>
        <p>Dự án cần thêm nhân sự</p>
        <a href="">Chi tiết dự án</a>
      </div>
      <div class="slide-item">
        <img src="https://educrm.vn/uploads/phan-mem-quan-ly.jpg" alt="Dự án 2">
        <div class="project-name">Ứng dụng Chat nội bộ</div>
        <p>Dự án cần thêm nhân sự</p>
        <a href="">Chi tiết dự án</a>
      </div>
      <div class="slide-item">
        <img src="https://websitehoctructuyen.com/wp-content/uploads/2020/10/phan-mem-quan-ly-hoc-sinh.jpg" alt="Dự án 3">
        <div class="project-name">Trang web Tuyển dụng</div>
        <p>Dự án cần thêm nhân sự</p>
        <a href="">Chi tiết dự án</a>
      </div>
      <div class="slide-item">
        <img src="https://littlevoices.littlelives.com/hubfs/su-dung-phan-mem-quan-ly-hoc-sinh.jpeg" alt="Dự án 4">
        <div class="project-name">Ứng dụng nhắn tin</div>
        <p>Dự án cần thêm nhân sự</p>
        <a href="">Chi tiết dự án</a>
      </div>
      <div class="slide-item">
        <img src="https://toantuoitho.vn/wp-content/uploads/2021/05/phan-mem-quan-ly-hoc-sinh.png" alt="Dự án 5">
        <div class="project-name">App kiểm soát nông trại</div>
        <p>Dự án cần thêm nhân sự</p>
        <a href="">Chi tiết dự án</a>
      </div>
      <div class="slide-item">
        <img src="https://toantuoitho.vn/wp-content/uploads/2021/05/quan-ly-hoc-sinh.png" alt="Dự án 6">
        <div class="project-name">Người máy hỗ trợ người khuyết tật</div>
        <p>Dự án cần thêm nhân sự</p>
        <a href="">Chi tiết dự án</a>
      </div>
    </div>
    
  </div>
  <main>
    <h1>Dash Board</h1>

    <div class="insights">
        <!--start doanh so ban hang-->
        <div class="sales">
          <span class="material-symbols-outlined">folder_off</span>
            <div class="middle">
                <div class="left">
                    <h3>Dự án chưa làm</h3>
                    <h1>1</h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle cx="40" cy="40" r="30"></circle>
                    </svg>
                    <div class="number">80%</div>
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
                    <h3>Dự án đang làm</h3>
                    <h1>2</h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle cx="40" cy="40" r="30"></circle>
                    </svg>
                    <div class="number">50%</div>
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
                    <h3>Dự án đã làm  </h3>
                    <h1>10</h1>
                </div>
                <div class="progress">
                    <svg>
                        <circle cx="40" cy="40" r="30"></circle>
                    </svg>
                    <div class="number">100%</div>
                </div>
            </div>
            <small>Tháng 11</small>
        </div>
        <!--end Loi nhuan-->


    </div>
</main>
</div>    
</div>

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