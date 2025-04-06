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

}
.form-content .signup-form{
    width: calc(100/2 - 25px);


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
.form-content .input-box input:focus{

}.form-content .input-box input:valid{
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
form .form-content .button{
 color:#fff;
 margin-top:40px;
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
    background:red ;
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
    content:'';
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
        <img class="frontImg" src="layout/PicAndVid/img/Join-QDOBA-Rewards-Earn-Free-Queso-and-Chips.png">
      </div>
      <div class="back">
        <img class="backImg" src="layout/PicAndVid/img/Join-QDOBA-Rewards-Earn-Free-Queso-and-Chips.png">
      </div>
    </div>

    <div class="form-content">
        <?php
        if (isset($_SESSION['user'])){
extract($_SESSION['user']);
        
        ?>
    
        <?php
         }else{}
        ?>
      <form action="index.php?act=dangnhap" method="post" class="login-form">
        <div class="title">Login</div>
        <div class="input-box">
          <i class="fa fa-envelope"></i>
          <input type="text" name="username" placeholder="Enter your username" required>
        </div>
        <div class="input-box">
          <i class="fa fa-lock"></i>
          <input type="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="button input-box">
          <input type="submit" value="Login" name="dangnhap">
        </div>
        <div class="text">Don't have an account? <label for="flip">Signup now</label></div>
        <div class="text" style="left:-30px">Or Login with</div>
        <div class="log-option">
          <a href="https://www.facebook.com/login.php">
            <div class="facebook-btn"><i class="fa fa-facebook"></i></div>
          </a>
          <a href="https://accounts.google.com/signin" class="google-login-btn"><i class="fa fa-google"></i></a>
        </div>
      </form>

      <!-- Signup Form -->
      <form action="index.php?act=dangky" method="post" class="signup-form">
        <div class="title">Sign up</div>
        <div class="input-box">
          <i class="fas fa-user"></i>
          <input type="text" name="username" placeholder="Enter your username" required>
        </div>
        <div class="input-box">
          <i class="fa fa-lock"></i>
          <input type="password" name="password" placeholder="Enter your password" required>
        </div>
        <div class="input-box">
          <i class="fas fa-user"></i>
          <input type="text" name="ten" placeholder="Enter your name" required>
        </div>
        <div class="input-box">
          <i class="fas fa-envelope"></i>
          <input type="email" name="email" placeholder="Enter your email" required>
        </div>
        <div class="input-box">
          <i class="fas fa-user"></i>
          <input type="date" name="birthdate" placeholder="Enter your birthday" required>
        </div>
     
        <div class="button input-box">
          <input type="submit" value="Sign up" name ="dangky">
        </div>
        <div class="text">Already have an account? <label for="flip">Login now</label></div>
      </form>
    </div>
  </div>
</main>
