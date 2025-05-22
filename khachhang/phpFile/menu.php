<?php
include '../phpFile/header.php';
$host = "localhost";
$user = "root";
$password = ""; // or "123456" if you set one
$dbname = "cuoiky";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Menu categories mapping
$menu_categories = [
    1 => "BURRITOS",
    2 => "Tacos",
    3 => "Drinks",
    4 => "Fruits",
    5 => "Ice Cream",
    6 => "Vietnamese Traditional Food"
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Title</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <link href="//netdna.bootstrapcdn.com/twitter-bootstrap/2.3.2/css/bootstrap-combined.no-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css"/>
    <link href="../css/bootstrap.css" rel="stylesheet">
    <link href="../css/mainpage.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/js-cookie@3.0.1/dist/js.cookie.min.js"></script>

    <style>
        .filling-slider-bottom-image {
            margin-left:5rem;
            width:500px;
        }
        .content-section {
            border-radius:50px;
            top:10rem;
            box-sizing: border-box;
            width: 842px;
            max-width: 90%;
            min-height: 420px;
            margin: 0 auto;
            padding: 25px 96px 0;
            position: relative;
            z-index: 4;
        }
        .has-background {
            background-color:#FFE7AA;
        }
        .footer {
            top:20rem;
        }
        .header__awning {
            top:20rem;
        }
        .toggle-button button {
            width: 30px;
            height: 30px;
            border: 2px solid black;
            background-color: transparent;
            font-size: 18px;
            font-weight: bold;
            cursor: pointer;
            align-items: center;
            justify-content: center;
        }
        .food-menu-item {
            display: flex;
            flex-wrap: wrap; 
            justify-content: center; 
            gap: 20px;
        }
        .card-title {
            font-family: "Londrina Solid", sans-serif;
        }
        .card-text {
            font-family: "Londrina Solid", sans-serif;
        }
.card {
     position: relative;
    width: 100%;
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
    margin-bottom: 20px;
    aspect-ratio: 1/1.2; /* Điều chỉnh tỷ lệ cho phù hợp với nội dung dài */
    display: flex;
    flex-direction: column;
}
.card-description-hover {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(244, 201, 92, 0.95);
    color: #333;
    padding: 20px;
    font-size: 1rem;
    font-family: "Londrina Solid", sans-serif;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    opacity: 0;
    visibility: hidden;
    transition: opacity 0.3s ease;
    z-index: 10;
    border-radius: 10px 10px 0 0;
    box-sizing: border-box;
}
.card-img-container {
    position: relative;
    width: 100%;
    height: 60%;
}
.card:hover .card-description-hover {
    opacity: 1;
    visibility: visible;
}
.card-img-top {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
.card-body {
    height: 40%;
    padding: 15px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

.card-title {
    font-family: "Londrina Solid", sans-serif;
    font-size: 1.1rem;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    overflow: hidden;
    min-height: 2.4em; /* Đảm bảo đủ chỗ cho 2 dòng */
}
.card-description {
    font-family: "Londrina Solid", sans-serif;
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 8px;
    display: -webkit-box;
    -webkit-line-clamp: 3; /* Giới hạn số dòng hiển thị */
    -webkit-box-orient: vertical;
    overflow: hidden;
    text-overflow: ellipsis;
    flex-grow: 1;
}

.card-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 40px;
    width: 100%;
}

.card-price {
    font-weight: bold;
    color: #e63946;
    flex-grow: 1;
    /* Thêm text-align nếu cần */
    text-align: left;
}

/* Responsive cho mobile */
@media (max-width: 768px) {
    .food-menu-item .col {
        flex: 0 0 100%;
        max-width: 100%;
    }
    
    .card {
        aspect-ratio: 1/1.3;
    }
    
    .card-description {
        -webkit-line-clamp: 2; /* Giảm số dòng trên mobile */
    }
}
        .a:hover {
            color:#FFE7AA;
        }
        @media (max-width: 768px) {
            .filling-slider-bottom-image {
                width:7rem;
                margin-left: 2.9rem;
            }
            .food-menu-item .col {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
        #cart-icon-bubble {
            position: relative; 
            display: inline-block;
        }
        #cart-count {
            position: absolute;
            top: -5px;  
            right: -5px;
            background-color: red;  
            color: white;  
            font-size: 12px;
            font-weight: bold;
            width: 20px;  
            height: 20px;
            line-height: 20px;
            text-align: center;
            border-radius: 50%;  
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.2);
        }
        .btn {
    width: 30px;         /* Giảm kích thước */
    height: 30px;        /* Giảm kích thước */
    border-radius: 50%;  /* Bo tròn hoàn toàn */
    padding: 0;          /* Loại bỏ padding mặc định */
    display: flex;       /* Sử dụng flex để căn giữa nội dung */
    align-items: center; /* Căn giữa theo chiều dọc */
    justify-content: center; /* Căn giữa theo chiều ngang */
    font-size: 1rem;     /* Giảm kích thước chữ */
    margin-left: 10px;   /* Thêm khoảng cách với giá */
    margin-bottom: 1.5rem;
}#cart-section {
    position: fixed;
    top: 100px;
    right: 20px;
    width: 300px;
    max-height: 80vh;
    overflow-y: auto;
    background: #fff;
    border: 1px solid #ccc;
    box-shadow: 0 0 10px rgba(0,0,0,0.2);
    padding: 15px;
    z-index: 9999;
    border-radius: 8px;
}

#cart-section h4 {
    font-size: 18px;
    margin-bottom: 10px;
    text-align: center;
}

#cart-items .list-group-item {
    padding: 10px;
    border-bottom: 1px solid #eee;
}

@media (max-width: 768px) {
    #cart-section {
        position: static;
        width: 100%;
        max-height: none;
        box-shadow: none;
        border: none;
        padding: 10px 0;
    }
}

    </style>
</head>
<body>
<main>
        
    <div class="content-section has-background">
        <!-- INTRODUCTION -->
         <section id="cart-section" class="container mt-5">
    <h4>🛒 Giỏ hàng của bạn</h4>
    <div id="cart-items" class="list-group">
        <!-- Các món sẽ được thêm vào đây bằng JavaScript -->
    </div>
</section>
        <section class="component-row text-row">
            <div class="text-content">
                <h2><strong>Craving Boston's best Mexican Food? Build your perfect burrito, taco, quesadilla, bowl, or salad.</strong></h2>
                <p>Once you've discovered your ideal combination of fresh ingredients that give you the warm and fuzzies, you'll have the benefit of knowing that on any given day when you need a hug, you can just call Anna's Taqueria for the Mexican food you love!</p>
            </div>
        </section>

        <!-- DISPLAY MENU FROM DATABASE -->
        <?php
        foreach ($menu_categories as $phan_loai => $category_name) {
            echo '<section class="component-row menu">
                    <h3 class="accordion-title toggle-button"><button>+</button>' . $category_name . '</h3>
                    <div class="toggle-content hide">
                        <div class="food-menu-item row row-cols-1 row-cols-md-3 g-4">';

            // Query for each category
            $sql = "SELECT id, ten_mon, mo_ta, gia, hinh_anh FROM menu WHERE phan_loai = $phan_loai";
            $result = $conn->query($sql);

            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $imageSrc = !empty($row['hinh_anh']) ? 
                        'data:image/jpeg;base64,'.base64_encode($row['hinh_anh']) : 
                        'https://via.placeholder.com/300x200';
                    
        echo '<div class="col-md-4 col-sm-6 col-12 mb-4">
        <div class="card h-100">
            <div class="card-img-container">
                <img src="'.$imageSrc.'" class="card-img-top" alt="'.htmlspecialchars($row['ten_mon']).'">
                <div class="card-description-hover">
                    ' . htmlspecialchars($row['mo_ta']) . '
                </div>
            </div>
            <div class="card-body">
                <h5 class="card-title">' . htmlspecialchars($row['ten_mon']) . '</h5>
                <div class="card-footer">
                    <span class="card-price">' . number_format($row['gia'], 0) . ' VND</span>
                    <a href="#" class="btn btn-primary btn-add-to-cart">+</a>
                </div>
            </div>
        </div>
      </div>';
                }
            } else {
                echo "<p>No items available for this category.</p>";
            }

            echo '      </div>
                    </div>
                  </section>';
        }
        ?>

        <!-- ALLERGY NOTICE -->
        <section class="component-row text-row">
            <div class="text-content">
                <p>Before placing your order, please inform your server if you or anyone in your party has a food allergy.</p>
                <p>For specific information, <a style="text-decoration: none; color:blue" href="../PicAndVid/img/Allegy.png">see our allergen table.</a></p>
                <hr>
            </div>
        </section>
    </div>
</main>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
<script>
    // Handle scroll effects
    function checkScroll() {
        const hiddenSections = document.querySelectorAll('.hidden-section');
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
        const footer = document.querySelector("footer");
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

        handleScroll();
    });
  
    window.addEventListener('scroll', checkScroll);
    checkScroll();

    // Header scroll behavior
    let lastScrollY = window.scrollY;
    let timeout = null;

    window.addEventListener("scroll", () => {
        const header = document.getElementById("header");
        const currentScrollY = window.scrollY;

        if (currentScrollY > lastScrollY) {
            header.classList.add("hidden");
        } else {
            header.classList.remove("hidden");
        }

        lastScrollY = currentScrollY;

        clearTimeout(timeout);
        timeout = setTimeout(() => {
            header.classList.add("hidden");
        }, 1000);
    });

    // Accordion toggle functionality
    document.addEventListener("DOMContentLoaded", function () {
        const toggleButtons = document.querySelectorAll(".toggle-button button");

        toggleButtons.forEach(button => {
            button.addEventListener("click", function () {
                const content = this.closest(".accordion-title").nextElementSibling;
                content.classList.toggle("hide");
                
                if (content.classList.contains("hide")) {
                    this.textContent = "+";
                } else {
                    this.textContent = "-";
                }
            });
        });
    });

   document.addEventListener("DOMContentLoaded", function() {
    let cart = Cookies.get('cart') ? JSON.parse(Cookies.get('cart')) : [];

    updateCartCount();
    renderCartItems();

    document.querySelectorAll('.btn-add-to-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const card = this.closest('.card');
            const itemId = card.querySelector('.card-title').textContent.trim();
            const itemPrice = parseFloat(card.querySelector('.card-price').textContent.replace(/[^\d]/g, ''));

            const existingItem = cart.find(item => item.name === itemId);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    name: itemId,
                    price: itemPrice,
                    quantity: 1
                });
            }

            Cookies.set('cart', JSON.stringify(cart), { expires: 7 });
            updateCartCount();
            renderCartItems();

            alert('Đã thêm vào giỏ hàng!');
        });
    });

    function updateCartCount() {
        const count = cart.reduce((total, item) => total + item.quantity, 0);
        const cartCount = document.getElementById('cart-count');
        if (cartCount) cartCount.textContent = count;
    }

    function renderCartItems() {
        const cartContainer = document.getElementById('cart-items');
        cartContainer.innerHTML = ''; // Xóa cũ trước khi render mới

        if (cart.length === 0) {
            cartContainer.innerHTML = '<p class="text-muted">Chưa có sản phẩm nào trong giỏ hàng.</p>';
            return;
        }

        cart.forEach(item => {
            const itemDiv = document.createElement('div');
            itemDiv.className = 'list-group-item d-flex justify-content-between align-items-center';

            itemDiv.innerHTML = `
                <span><strong>${item.name}</strong> x ${item.quantity}</span>
                <span>${(item.price * item.quantity).toLocaleString()} VND</span>
            `;

            cartContainer.appendChild(itemDiv);
        });
    }
});
document.addEventListener("DOMContentLoaded", function() {
    let cart = Cookies.get('cart') ? JSON.parse(Cookies.get('cart')) : [];

    updateCartCount();
    renderCartItems();

    document.querySelectorAll('.btn-add-to-cart').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const card = this.closest('.card');
            const itemName = card.querySelector('.card-title').textContent.trim();
            const itemPrice = parseFloat(card.querySelector('.card-price').textContent.replace(/[^\d]/g, ''));
            const itemImage = card.querySelector('.card-img-top').src;

            const existingItem = cart.find(item => item.name === itemName);

            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({
                    name: itemName,
                    price: itemPrice,
                    quantity: 1,
                    image: itemImage
                });
            }

            Cookies.set('cart', JSON.stringify(cart), { expires: 7 });
            updateCartCount();
            renderCartItems();

            // Hiển thị thông báo nhẹ nhàng thay vì alert
            showToast('Đã thêm vào giỏ hàng!');
        });
    });

    function updateCartCount() {
        const count = cart.reduce((total, item) => total + item.quantity, 0);
        const cartCount = document.getElementById('cart-count');
        if (cartCount) cartCount.textContent = count;
    }

    function renderCartItems() {
        const cartContainer = document.getElementById('cart-items');
        cartContainer.innerHTML = '';

        if (cart.length === 0) {
            cartContainer.innerHTML = '<p class="text-muted">Chưa có sản phẩm nào trong giỏ hàng.</p>';
            return;
        }

        let total = 0;
        cart.forEach(item => {
            total += item.price * item.quantity;
            const itemDiv = document.createElement('div');
            itemDiv.className = 'list-group-item d-flex justify-content-between align-items-center';

            itemDiv.innerHTML = `
                <div class="d-flex align-items-center">
                    <img src="${item.image}" width="50" height="50" class="rounded me-3" alt="${item.name}">
                    <span><strong>${item.name}</strong> x ${item.quantity}</span>
                </div>
                <span>${(item.price * item.quantity).toLocaleString()} VND</span>
            `;

            cartContainer.appendChild(itemDiv);
        });

        // Thêm tổng cộng
        const totalDiv = document.createElement('div');
        totalDiv.className = 'list-group-item d-flex justify-content-between align-items-center fw-bold';
        totalDiv.innerHTML = `<span>Tổng cộng:</span><span>${total.toLocaleString()} VND</span>`;
        cartContainer.appendChild(totalDiv);
    }

    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = 'position-fixed bottom-0 end-0 p-3';
        toast.style.zIndex = '11';
        toast.innerHTML = `
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Thông báo</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    ${message}
                </div>
            </div>
        `;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }
});
    </script>
</body>
</html>

<?php 
$conn->close();
include '../phpFile/footer.php';
?>