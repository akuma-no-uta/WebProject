<?php
ob_start();
require_once 'adminDAO/pdo.php';

$data = pdo_query_one("SELECT * FROM thongtin WHERE id = 1");
$is_editing = isset($_GET['edit']) && $_GET['edit'] == 1;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
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
ob_end_flush();
?>

<script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

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
                    <textarea name="hero_description" id="hero_description"><?= htmlspecialchars($data['hero_description']) ?></textarea><br>
                <?php else: ?>
                    <h4><?= htmlspecialchars($data['hero_title']) ?></h4>
                    <h2><?= htmlspecialchars($data['hero_subtitle']) ?></h2>
                    <p><?= $data['hero_description'] ?></p>
                <?php endif; ?>
            </div>

            <div class="image">
                <?php if ($is_editing): ?>
                    <div class="drop-zone" id="hero-drop-zone">
                     click để chọn
                        <input type="file" id="hero-image-input" name="hero_image_file" hidden>
                    </div>
                    <div style="position: relative; display: inline-block;">
                        <img id="hero-preview" src="<?= htmlspecialchars($data['hero_image_url']) ?>" alt="Hero Image" style="max-width: 300px;">
                        <button type="button" id="delete-hero-image" style="position: absolute; top: 0; right: 0;">❌</button>
                    </div>
                    <input type="hidden" name="hero_image_url" id="hero-image-url" value="<?= htmlspecialchars($data['hero_image_url']) ?>">
                <?php else: ?>
                    <img src="<?= htmlspecialchars($data['hero_image_url']) ?>" alt="Ảnh Hero">
                <?php endif; ?>
            </div>
        </section>

        <!-- About Section -->
        <section class="about-section" id="about">
            <div class="image">
                <?php if ($is_editing): ?>
                    <div class="drop-zone" id="about-drop-zone">
                        Kéo & thả ảnh vào đây hoặc click để chọn
                        <input type="file" id="about-image-input" name="about_image_file" hidden>
                    </div>
                    <div style="position: relative; display: inline-block;">
                        <img id="about-preview" src="<?= htmlspecialchars($data['about_image_url']) ?>" alt="About Image" style="max-width: 300px;">
                        <button type="button" id="delete-about-image" style="position: absolute; top: 0; right: 0;">❌</button>
                    </div>
                    <input type="hidden" name="about_image_url" id="about-image-url" value="<?= htmlspecialchars($data['about_image_url']) ?>">
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
                    <textarea name="about_description" id="about_description"><?= htmlspecialchars($data['about_description']) ?></textarea><br>
                <?php else: ?>
                    <h4><?= htmlspecialchars($data['about_title']) ?></h4>
                    <h2><?= htmlspecialchars($data['about_subtitle']) ?></h2>
                    <p><?= $data['about_description'] ?></p>
                <?php endif; ?>
            </div>
        </section>

        <?php if ($is_editing): ?>
            <button type="submit" style="margin: 10px 0; padding: 10px 20px;">Lưu</button>
            <a href="indexAdmin.php?act=thongtinAdmin" style="margin-left: 10px;">Hủy</a>
        <?php endif; ?>
    </form>
</div>

<!-- ✅ JavaScript xử lý ảnh và CKEditor -->
<script>
    // Hero image upload
    const dropZone = document.getElementById('hero-drop-zone');
    const fileInput = document.getElementById('hero-image-input');
    const preview = document.getElementById('hero-preview');
    const imageUrlInput = document.getElementById('hero-image-url');

    dropZone.addEventListener('click', () => fileInput.click());
    dropZone.addEventListener('dragover', (e) => { e.preventDefault(); dropZone.classList.add('dragover'); });
    dropZone.addEventListener('dragleave', () => dropZone.classList.remove('dragover'));
    dropZone.addEventListener('drop', (e) => {
        e.preventDefault(); dropZone.classList.remove('dragover');
        const file = e.dataTransfer.files[0]; handleFile(file);
    });
    fileInput.addEventListener('change', () => handleFile(fileInput.files[0]));
    function handleFile(file) {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => { preview.src = e.target.result; imageUrlInput.value = e.target.result; };
            reader.readAsDataURL(file);
        }
    }

    // ✅ Nút xóa ảnh Hero
    document.getElementById('delete-hero-image').addEventListener('click', () => {
        preview.src = "";
        imageUrlInput.value = "";
    });

    // About image upload
    const aboutDropZone = document.getElementById('about-drop-zone');
    const aboutFileInput = document.getElementById('about-image-input');
    const aboutPreview = document.getElementById('about-preview');
    const aboutImageUrlInput = document.getElementById('about-image-url');

    aboutDropZone.addEventListener('click', () => aboutFileInput.click());
    aboutDropZone.addEventListener('dragover', (e) => { e.preventDefault(); aboutDropZone.classList.add('dragover'); });
    aboutDropZone.addEventListener('dragleave', () => aboutDropZone.classList.remove('dragover'));
    aboutDropZone.addEventListener('drop', (e) => {
        e.preventDefault(); aboutDropZone.classList.remove('dragover');
        const file = e.dataTransfer.files[0]; handleAboutFile(file);
    });
    aboutFileInput.addEventListener('change', () => handleAboutFile(aboutFileInput.files[0]));
    function handleAboutFile(file) {
        if (file && file.type.startsWith('image/')) {
            const reader = new FileReader();
            reader.onload = (e) => { aboutPreview.src = e.target.result; aboutImageUrlInput.value = e.target.result; };
            reader.readAsDataURL(file);
        }
    }

    // ✅ Nút xóa ảnh About
    document.getElementById('delete-about-image').addEventListener('click', () => {
        aboutPreview.src = "";
        aboutImageUrlInput.value = "";
    });

    // ✅ Khởi tạo CKEditor nếu đang chỉnh sửa
    <?php if ($is_editing): ?>
    ClassicEditor
        .create(document.querySelector('#hero_description'))
        .catch(error => console.error('CKEditor Hero error:', error));

    ClassicEditor
        .create(document.querySelector('#about_description'))
        .catch(error => console.error('CKEditor About error:', error));
    <?php endif; ?>
</script>
