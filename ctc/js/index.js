$(document).ready(function () {
    var video = document.getElementById("slide-video");

    var slider = $(".slider").slick({
        infinite: true,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 10000,
        dots: true,
        arrows: true,
        adaptiveHeight: true
    });

    // Khi video kết thúc, chuyển sang slide tiếp theo và bật autoplay
    video.onended = function () {
        $(".slider").slick("slickNext"); // Chuyển đến slide tiếp theo
        $(".slider").slick("slickSetOption", "autoplay", true, true); // Bật autoplay lại
    };
    
});

  
    // Xử lý hiển thị nội dung khi cuộn cho nhiều phần tử
    function checkScroll() {
        const hiddenSections = document.querySelectorAll('.hidden-section'); // Chọn tất cả phần tử
        const screenHeight = window.innerHeight / 1.2;
  
        hiddenSections.forEach(section => {
            const sectionPosition = section.getBoundingClientRect().top;
            if (sectionPosition < screenHeight) {
                section.classList.add('show');
                section.classList.remove('hide');
            } else {
                section.classList.remove('show');
                section.classList.add('hide');
            }
        });
    }
    document.addEventListener("DOMContentLoaded", function () {
    const banner = document.querySelector(".banner-right");
    const footer = document.querySelector("footer"); // Lấy footer để kiểm tra
    const triggerPosition = banner.offsetTop - window.innerHeight / 2;

    function handleScroll() {
        const bannerRect = banner.getBoundingClientRect();
        const footerRect = footer.getBoundingClientRect();

        if (window.scrollY > triggerPosition && footerRect.top > window.innerHeight) {
            banner.classList.add("show");
        } else {
            banner.classList.remove("show");
        }
    }

    // Lắng nghe sự kiện cuộn với "requestAnimationFrame" để tối ưu hiệu suất
    let ticking = false;
    window.addEventListener("scroll", function () {
        if (!ticking) {
            window.requestAnimationFrame(function () {
                handleScroll();
                ticking = false;
            });
            ticking = true;
        }
    });

    handleScroll(); // Gọi 1 lần để kiểm tra khi tải trang
});
  
    window.addEventListener('scroll', checkScroll);
    checkScroll();
    let lastScrollY = window.scrollY;
        let timeout = null;

        window.addEventListener("scroll", () => {
            const header = document.getElementById("header");
            const currentScrollY = window.scrollY;

            if (currentScrollY > lastScrollY) {
                // Cuộn xuống thì ẩn header
                header.classList.add("hidden");
            } else {
                // Cuộn lên thì hiển thị header
                header.classList.remove("hidden");
            }

            lastScrollY = currentScrollY;

            // Nếu không cuộn sau 1 giây, ẩn header
            clearTimeout(timeout);
            timeout = setTimeout(() => {
                header.classList.add("hidden");
            }, 1000);
        });
        let lastScrollTop = 0;
const header = document.querySelector("header");
const awning = document.querySelector(".header__awning-top");

window.addEventListener("scroll", function () {
    let currentScroll = window.pageYOffset || document.documentElement.scrollTop;

    if (currentScroll > lastScrollTop) {
        // Cuộn xuống → Ẩn header và awning
        header.style.top = "-150px"; // 130px (header-banner) + 20px (awning)
        awning.style.top = "-20px";  // Cùng ẩn theo header
    } else {
        // Cuộn lên → Hiện header và awning
        header.style.top = "0";
        awning.style.top = "130px"; // Đặt lại vị trí awning ngay dưới header-banner
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const menuContainer = document.querySelector(".header-item-container");

    menuToggle.addEventListener("click", function () {
        menuContainer.classList.toggle("show");
    });

});}