<style>
/* Container chính của form */
.edit-form {
    display: flex;
    flex-direction: column;
    gap: 40px;
    padding: 40px;
    max-width: 1000px;
    margin: 40px auto;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    font-family: 'Segoe UI', sans-serif;
}

/* Các phần hero và about hiển thị thành 2 cột */
.form-section, .hero-section, .about-section {
    display: flex;
    gap: 30px;
    align-items: flex-start;
    flex-wrap: wrap;
    margin-bottom: 40px;
}

.form-content, .form-image {
    flex: 1;
    min-width: 350px; /* tăng độ rộng */
}

/* Input & textarea styling */
.form-content input[type="text"],
.form-content textarea {
    width: 100%;
    padding: 16px 20px; /* Tăng padding để ô nhập liệu rộng hơn */
    margin-bottom: 18px;
    border-radius: 12px; /* Góc bo tròn đẹp mắt */
    border: 1px solid #ccc;
    font-size: 18px; /* Tăng kích thước font */
    transition: border 0.2s ease;
}

.form-content input[type="text"]:focus,
.form-content textarea:focus {
    border-color: #007BFF;
    outline: none;
}

.form-content textarea {
    height: 180px; /* Tăng chiều cao cho textarea */
    resize: vertical;
}

/* Ảnh preview */
.form-image img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    margin-top: 15px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    display: block;
}

/* Drag & Drop zone */
.drop-zone {
    border: 2px dashed #aaa;
    border-radius: 12px;
    padding: 50px 20px;
    text-align: center;
    color: #666;
    font-size: 18px;
    font-weight: 500;
    background-color: #fafafa;
    transition: all 0.3s ease;
    cursor: pointer;
}

.drop-zone.dragover {
    border-color: #007BFF;
    background-color: #e8f4ff;
    color: #007BFF;
}

.drop-zone:hover {
    background-color: #f0f0f0;
    border-color: #888;
}

/* Nút submit & hủy */
.submit-buttons,
form > button,
form > a {
    display: inline-block;
    margin-top: 20px;
}

form > button,
form > a {
    padding: 14px 28px;
    font-size: 18px;
    border-radius: 8px;
    border: none;
    cursor: pointer;
    text-decoration: none;
    transition: background-color 0.3s ease;
}

form > button {
    background-color: #007BFF;
    color: white;
    margin-right: 15px;
}

form > button:hover {
    background-color: #0056b3;
}

form > a {
    background-color: #ccc;
    color: #333;
}

form > a:hover {
    background-color: #bbb;
}

/* Nút chỉnh sửa */
.tailieu_edit {
    background-color: #007BFF;
    color: white;
    padding: 12px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin-bottom: 20px;
    display: inline-flex;
    align-items: center;
    gap: 6px;
}

.tailieu_edit:hover {
    background-color: #0056b3;
}

.material-symbols-outlined {
    font-size: 22px;
}
</style>
<?php
require_once 'adminDAO/pdo.php';

$data = pdo_query_one("SELECT * FROM thongtin WHERE id = 1");
$is_editing = isset($_GET['edit']) && $_GET['edit'] == 1;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Cập nhật thông tin
    $sql = "UPDATE thongtin SET 
        hero_title = ?, 
        hero_subtitle = ?, 
        hero_description = ?, 
        hero_image_url = ?, 
        about_title = ?, 
        about_subtitle = ?, 
        about_description = ?, 
        about_image_url = ?
        WHERE id = 1";

    pdo_execute($sql,
        $_POST['hero_title'],
        $_POST['hero_subtitle'],
        $_POST['hero_description'],
        $_POST['hero_image_url'],
        $_POST['about_title'],
        $_POST['about_subtitle'],
        $_POST['about_description'],
        $_POST['about_image_url']
    );

    header("Location: indexAdmin.php?act=thongtinAdmin");
    exit;
}
?>

<div class="user">
    <?php if (!$is_editing): ?>
        <a href="indexAdmin.php?act=thongtinAdmin&edit=1">
            <button class="tailieu_edit">
                <span class="material-symbols-outlined">edit</span>
            </button>
        </a>
    <?php endif; ?>

    <form method="post">
        <!-- Hero Section -->
        <section class="hero-section" id="home">
            <div class="content">
                <?php if ($is_editing): ?>
                    <label>Tiêu đề Hero:</label>
                    <input type="text" name="hero_title" value="<?= htmlspecialchars($data['hero_title']) ?>"><br>

                    <label>Phụ đề Hero:</label>
                    <input type="text" name="hero_subtitle" value="<?= htmlspecialchars($data['hero_subtitle']) ?>"><br>

                    <label>Mô tả Hero:</label>
                    <textarea name="hero_description"><?= htmlspecialchars($data['hero_description']) ?></textarea><br>
                <?php else: ?>
                    <h4><?= htmlspecialchars($data['hero_title']) ?></h4>
                    <h2><?= htmlspecialchars($data['hero_subtitle']) ?></h2>
                    <p><?= htmlspecialchars($data['hero_description']) ?></p>
                <?php endif; ?>
            </div>

            <div class="image">
                <?php if ($is_editing): ?>
                    <div class="drop-zone" id="hero-drop-zone">
    Kéo & thả ảnh vào đây hoặc click để chọn
    <input type="file" id="hero-image-input" name="hero_image_file" hidden>
</div>
<img id="hero-preview" src="<?= htmlspecialchars($data['hero_image_url']) ?>" alt="Hero Image">
<input  type="hidden" name="hero_image_url" id="hero-image-url" value="<?= htmlspecialchars($data['hero_image_url']) ?>">
                <?php else: ?>
                    <img src="<?= htmlspecialchars($data['hero_image_url']) ?>" alt="Ảnh Hero">
                <?php endif; ?>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section" id="about">
            <div class="image">
                <?php if ($is_editing): ?>
                    <label>Link ảnh About:</label>
                    <input type="text" name="about_image_url" value="<?= htmlspecialchars($data['about_image_url']) ?>"><br>
                <?php else: ?>
                    <img src="<?= htmlspecialchars($data['about_image_url']) ?>" alt="Ảnh About" style="width: 350px;">
                <?php endif; ?>
            </div>

            <div class="content">
                <?php if ($is_editing): ?>
                    <label>Tiêu đề About:</label>
                    <input type="text" name="about_title" value="<?= htmlspecialchars($data['about_title']) ?>"><br>

                    <label>Phụ đề About:</label>
                    <input type="text" name="about_subtitle" value="<?= htmlspecialchars($data['about_subtitle']) ?>"><br>

                    <label>Mô tả About:</label>
                    <textarea name="about_description"><?= htmlspecialchars($data['about_description']) ?></textarea><br>
                <?php else: ?>
                    <h4><?= htmlspecialchars($data['about_title']) ?></h4>
                    <h2><?= htmlspecialchars($data['about_subtitle']) ?></h2>
                    <p><?= htmlspecialchars($data['about_description']) ?></p>
                <?php endif; ?>
            </div>
        </section>

        <?php if ($is_editing): ?>
            <button type="submit" style="margin: 10px 0; padding: 10px 20px;">Lưu</button>
            <a href="indexAdmin.php?act=thongtinAdmin" style="margin-left: 10px;">Hủy</a>
        <?php endif; ?>
    </form>
</div>
<script>
    const dropZone = document.getElementById('hero-drop-zone');
    const fileInput = document.getElementById('hero-image-input');
    const preview = document.getElementById('hero-preview');
    const imageUrlInput = document.getElementById('hero-image-url');

    dropZone.addEventListener('click', () => fileInput.click());

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('dragover');
    });

    dropZone.addEventListener('dragleave', () => {
        dropZone.classList.remove('dragover');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragover');
        const file = e.dataTransfer.files[0];
        handleFile(file);
    });

    fileInput.addEventListener('change', () => {
        const file = fileInput.files[0];
        handleFile(file);
    });

    function handleFile(file) {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => {
                preview.src = e.target.result;
                imageUrlInput.value = e.target.result; // bạn có thể thay bằng logic upload ảnh lên server rồi lấy URL
            };
            reader.readAsDataURL(file);
        }
    }
</script>
