document.addEventListener("DOMContentLoaded", function () {
    if (typeof $ === "undefined") {
        console.error("Lỗi: jQuery chưa được tải.");
        return;
    }

    var video = document.getElementById("slide-video");

    var slider = $(".slider");
    if (slider.length > 0) {
        slider.slick({
            infinite: true,
            slidesToShow: 1,
            slidesToScroll: 1,
            autoplay: true,
            autoplaySpeed: 10000,
            dots: true,
            arrows: true,
            adaptiveHeight: true
        });

        if (video) {
            video.onended = function () {
                slider.slick("slickNext");
                slider.slick("slickSetOption", "autoplay", true, true);
            };
        }
    }

    function checkScroll() {
        const hiddenSections = document.querySelectorAll('.hidden-section');
        const screenHeight = window.innerHeight / 1.2;

        hiddenSections.forEach(section => {
            const sectionPosition = section.getBoundingClientRect().top;
            section.classList.toggle('show', sectionPosition < screenHeight);
        });
    }

    const banner = document.querySelector(".banner-right");
    const footer = document.querySelector("footer");

    if (banner && footer) {
        function handleScroll() {
            const footerRect = footer.getBoundingClientRect();
            banner.classList.toggle("show", window.scrollY > (banner.offsetTop - window.innerHeight / 2) && footerRect.top > window.innerHeight);
        }

        window.addEventListener("scroll", handleScroll);
        handleScroll();
    }

    let lastScrollY = window.scrollY;
    let timeout = null;
    const header = document.getElementById("header");

    window.addEventListener("scroll", function () {
        const currentScrollY = window.scrollY;
        header?.classList.toggle("hidden", currentScrollY > lastScrollY);
        lastScrollY = currentScrollY;

        clearTimeout(timeout);
        timeout = setTimeout(() => {
            header?.classList.add("hidden");
        }, 1000);
    });

    let lastScrollTop = 0;
    const awning = document.querySelector(".header__awning-top");

    window.addEventListener("scroll", function () {
        let currentScroll = window.pageYOffset || document.documentElement.scrollTop;
        if (header && awning) {
            header.style.top = currentScroll > lastScrollTop ? "-150px" : "0";
            awning.style.top = currentScroll > lastScrollTop ? "-20px" : "130px";
        }
        lastScrollTop = Math.max(0, currentScroll);
    });

    window.addEventListener('scroll', checkScroll);
    checkScroll();
});
