<!-- login.php -->
<?php
    include 'header.php';  // Hiển thị phần đầu trang
    include '../dao/pdo.php';
    $message = ''; // Hiển thị lỗi nếu có

    if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['form_type']) && $_POST['form_type'] === 'login') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        $sql = "SELECT * FROM users WHERE tentaikhoan = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['user'] = $user;

            if ($user[''] === 'admin') {
                echo "abccc";
                exit;
            } else {
                echo "abc";
                exit;
            }
        } else {
            $message = "Sai tên đăng nhập hoặc mật khẩu!";
        }
    }
?>
<style>
    body{
        min-height: 100vh;
        background-color:#fbf6dc;
        padding:30px;
        align-items: center;
        justify-self: center;
    }
    .container{
        border-radius:15px;
        top:160px;
        position:relative;
        width:860px;
        height:500px;
        justify-content: center;
        background:  #f3b53b;
        padding:40px 30px;
        box-shadow: 0 5px 10px rgba(0,0,0,0.2);
        perspective: 2800px;
    }
    *{
        margin:0;
        padding:0;
        box-sizing: border-box;
    }
    .footer{
        top:200px;
    }
    .header__awning{
        top:200px;
    }
    .container .form-content{
        display:flex;
        align-items: center;
        justify-content: space-between;
    }
    .container .form{
        height:100%;
        width:100%;
        background:white;
    }
    .form-content .login-form{
        width: 45%;
    }
    .form-content .signup-form{
        width: 45%;
    }
    form .form-content .title{
        position:relative;
        font-size:24px;
        font-weight:500;
        color:black;
    }
    form .form-content .title:before{
        content:'';
        position: absolute;
        height:3px;
        bottom:0;
        left:0;
        width:25px;
        background: black;                     
    }
    form .signup-form .form-content .title:before{
        width:20px;
    }
    form .form-content .input-boxes{
        margin-top:30px;
    } 
    form .form-content .input-box{
        display:flex;
        align-items: center;
        height:50px;
        width:100%;
        margin: 10px 0;
        position:relative;
    }
    .form-content .input-box input{
        height:100%;
        width:100%;
        outline:none;
        padding:0 30px;
        border:none;
        font-size:16px;
        font-weight:500;
        border-bottom:2px solid rgba(0,0,0,0.2);
    }
    .form-content .input-box input:focus{ }
    .form-content .input-box input:valid{
        border:yellow;
    }
    .form-content .input-box i{
        position:absolute;
        color:yellow;
        font-size:17px;
    }
    form .form-content .button{
        color:#fff;
        margin-top:40px;
    }
    form .form-content .button input{
        font-family: "Londrina Solid", sans-serif;
        display: inline-block;
        background-color: #e86229;
        color: white;
        margin-top:-50px;
        padding: 10px 20px;
        border-radius: 5px;
        text-decoration: none;
        font-weight: bold;
        margin-bottom: 1px;
    }
    form .form-content .button input:hover{
        background:black;
    }
    form .form-content .text{
        font-size:14px;
        font-weight:500;
        color:black;
    }
    form .form-content .text a{
        text-decoration: none;
    }
    form .form-content .text a:hover{
        text-decoration: underline;
    }
    form .form-content label{
        color:blue;
        cursor:pointer;
    }
    form .form-content label:hover{
        color: paleturquoise;
    }
    .container .cover{
        border-radius:20px;
        position:absolute;
        height:100%;
        width: 50%;
        top:0;
        left:50%;
        background:red;
        z-index:100;
        transition: all 1s ease;
        transform-origin: left;
        transform-style:preserve-3d;
    }
    .container  #flip:checked ~ .cover{
        transform:rotateY(-180deg);
    }
    .container .cover  .backImg{
        transform: rotateY(180deg);
    }
    .container .cover::before{
        content:'';
        height: 100%;
        width:100%;
        position:absolute;
        opacity:0.5;
        z-index: 100;
    }
    .container .cover img{
        height:100%;
        border-radius:15px;
        width:100%;
        position: absolute;
        object-fit:cover;
        z-index:10;
        backface-visibility: hidden;
    }
    .container .cover::after{
        content:'';
        position:absolute;
        height:100%;
        width:100%;
        opacity:0.5;
        z-index: 100;
    }
    .container .cover .text{
        position: absolute;
        z-index:111;
        height:100%;
        width:100%;
        display:flex;
        flex-direction: column;
        align-items:center;
        justify-content:center;
    }
    .cover .text .text1{
        font-size:26px;
        font-weight:600;
        color:#fff;
    }
    .cover .text .text-2{
        font-size:20px;
    }
    .container .cover .back .frontImg{
        transform: rotateY(-180deg);
    }
    .facebook-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-color: #1877f2;
        color: white;
        font-size: 24px;
        border: none;
        outline: none;
        cursor: pointer;
        transition: 0.3s;
        text-decoration: none;
    }
    .facebook-btn:hover {
        background-color: #165ad9;
    }
    .log-option {
        display: flex;
        align-items: center;
        gap: 20px; 
    }
    .google-login-btn, .facebook-login-btn {
        width: 60px; 
        height: 60px;
    }
</style>
<main>
    <div class="container login">
        <input type="checkbox" style="display: none;" id="flip">
        <div class="cover">
            <div class="front">
                <img class="frontImg" src="../PicAndVid/img/Join-QDOBA-Rewards-Earn-Free-Queso-and-Chips.png">
            </div>
            <div class="back">
                <img class="backImg" src="../PicAndVid/img/Join-QDOBA-Rewards-Earn-Free-Queso-and-Chips.png">
            </div>
        </div>
        <div class="form-content">
            <!-- Form đăng nhập -->
            <form class="login-form" action="login.php" method="POST">
                <div class="title">Login</div>
                <?php if(!empty($message)): ?>
                    <div style="color:red; margin-bottom:10px;"><?= htmlspecialchars($message) ?></div>
                <?php endif; ?>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Enter your username" required>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="text"><a href="#" class="text">Forgot Password</a></div>
                <div class="button input-box">
                    <input type="hidden" name="form_type" value="login">
                    <input type="submit" value="Login">
                </div>
                <div class="text">Don't have an account ? <label for="flip">Signup now</label></div>
                <div class="text" style="left:-30px">Or Login with</div>
                <div class="log-option">
                    <a href="https://www.facebook.com/login.php">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48" fill="#1877F2">
                                <path d="M22.675 0h-21.35C.595 0 0 .593 0 1.326v21.348C0 23.407.595 24 1.325 24H12.82v-9.294H9.692v-3.622h3.127V8.412c0-3.1 1.894-4.785 4.662-4.785 1.325 0 2.462.099 2.793.142v3.24l-1.918.001c-1.504 0-1.794.715-1.794 1.763v2.312h3.586l-.467 3.622h-3.119V24h6.116c.73 0 1.325-.593 1.325-1.326V1.326C24 .593 23.405 0 22.675 0z"/>
                            </svg>
                        </div>
                    </a>
                    <a href="https://accounts.google.com/signin" class="google-login-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                            <path fill="#4285F4" d="M23.49 12.27c2.69 0 5.1.97 7.02 2.56l5.21-5.21C32.16 6.3 28.1 4.5 23.49 4.5c-8.47 0-15.58 5.72-18.15 13.44l6.64 5.16c1.23-5.77 6.2-10.03 11.51-10.03z"/>
                            <path fill="#34A853" d="M42.69 20.82H24v7.71h10.71c-.97 5.04-5.48 8.82-10.71 8.82-3.32 0-6.27-1.4-8.38-3.64l-6.64 5.17c3.66 4.34 9.09 7.05 15.02 7.05 8.64 0 16.02-5.79 17.86-13.47l.83-4.44z"/>
                            <path fill="#FBBC05" d="M9.74 26.56c-.45-1.33-.7-2.75-.7-4.22s.25-2.89.7-4.22l-6.64-5.17c-1.36 2.71-2.1 5.79-2.1 9.39s.74 6.68 2.1 9.39l6.64-5.17z"/>
                            <path fill="#EA4335" d="M23.49 43.5c4.61 0 8.67-1.52 11.81-4.09l-5.21-5.21c-1.64 1.1-3.67 1.74-5.91 1.74-5.31 0-10.28-4.26-11.51-10.03l-6.64 5.17c2.57 7.72 9.68 13.44 18.15 13.44z"/>
                        </svg>
                    </a>
                </div>
            </form>
            <!-- Form đăng ký -->
            <form class="sign-up-form" action="signup.php" method="POST">
                <div class="title">Sign up</div>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Enter your username" required>
                </div>
                <div class="input-box">
                    <input type="text" name="name" placeholder="Enter your name" required>
                </div>  
                <div class="input-box">
                    <input type="text" name="birthyear" placeholder="Enter your birthyear" required>
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Enter your email" required>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Enter your password" required>
                </div>
                <div class="text"><a href="#" class="text">Forgot Password</a></div>
                <div class="button input-box">
                    <input type="submit" value="Submit">
                </div>
                <div class="text">Already have an account ? <label for="flip">Login now</label></div>
            </form>
        </div>
    </div>
</main>
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"
></script>
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"
></script>
<?php
    include 'footer.php';  // Hiển thị phần chân trang
?>