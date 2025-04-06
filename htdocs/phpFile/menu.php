<?php 
include ("header.php");
include ('dao\pdo.php');
?>
<style>
    .filling-slider-bottom-image{
        margin-left:5rem;
        width:500px;
    }
    .content-section{
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
.has-background{
    background-color:#FFE7AA;
}
.filling-slider{
    
}
.footer{
    top:20rem;
}
.header__awning{
    top:20rem;
}
.toggle-button button {
    width: 30px; /* Độ rộng của button */
    height: 30px; /* Độ cao của button */
    border: 2px solid black; /* Tạo viền */
    background-color: transparent; /* Nền trong suốt */
    font-size: 18px;
    font-weight: bold;
    cursor: pointer;
    align-items: center;
    justify-content: center;
}
.food-menu-item{
    display: flex;
    flex-wrap: wrap; 
    justify-content: center; 
    gap: 20px;


}
.card-title{
    font-family: "Londrina Solid", sans-serif;

}
.card-text{
    font-family: "Londrina Solid", sans-serif;

}
@media (max-width: 768px) {
    .card-container {
        flex-direction: column; /* Trên mobile, card sẽ xếp dọc */
    }

    .card {
        width: 100%;
    }
}
.card img {
    width: 100%; 
    height: 200px; 
    object-fit: cover;
    border-top-left-radius: 10px;
    border-top-right-radius: 10px;
}
.card{
    width: calc(50% - 10px); /* Chia đôi hàng, trừ khoảng cách giữa các card */
    background: #fff;
    border-radius: 10px;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}
.a:hover{
    color:#FFE7AA;

}
@media (max-width:700px){
 .filling-slider-bottom-image{
    width:7rem;
    margin-left: 2.9rem;;
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
</style>
<main>
            <div class ="container login">
                <input type="checkbox" style="display: none;" id ="flip">

                <div class="cover">
                    <div class="front">
                        <img class ="frontImg" src ="../PicAndVid/img/Join-QDOBA-Rewards-Earn-Free-Queso-and-Chips.png">
                    </div>
                    <div class="back">
                        <img class ="backImg" src="../PicAndVid/img/Join-QDOBA-Rewards-Earn-Free-Queso-and-Chips.png">
                    </div>
                </div>
                <form action=" #">
                    <div class ="form-content">
                        
                    <div class = "login-form">
                        <div class ="title">Login</div>
                        <div class  = "input-box">
                            <i class ="fa fa-envelope"></i>
                            <input type ="text" placeholder="Enter your email" required>
                        </div>
                        <div class  = "input-box">
                            <i class ="fs fa-envelope"></i>
                            <input type ="password" placeholder="Enter your password" required>
                    </div>
                    <div class = "text"><a href=# class ="text">Forgot Password</a></div>
                    <div class  = "button input-box">
                        <i class ="fa fa-envelope"></i>
                        <input type ="submit" value ="Submit">
                    </div>
                    <div class ="text">Don't have an account ? <label for ="flip">Signup now</label></div>
                    <div class ="text" style = "left:-30px">Or Login with</div>
                    <div class ="log-option">
                    <a href="https://www.facebook.com/login.php" ><div><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="48" height="48" fill="#1877F2">
    <path d="M22.675 0h-21.35C.595 0 0 .593 0 1.326v21.348C0 23.407.595 24 1.325 24H12.82v-9.294H9.692v-3.622h3.127V8.412c0-3.1 1.894-4.785 4.662-4.785 1.325 0 2.462.099 2.793.142v3.24l-1.918.001c-1.504 0-1.794.715-1.794 1.763v2.312h3.586l-.467 3.622h-3.119V24h6.116c.73 0 1.325-.593 1.325-1.326V1.326C24 .593 23.405 0 22.675 0z"/>
</svg>
</div>
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>      <a href="https://accounts.google.com/signin" class="google-login-btn">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48">
                            <path fill="#4285F4" d="M23.49 12.27c2.69 0 5.1.97 7.02 2.56l5.21-5.21C32.16 6.3 28.1 4.5 23.49 4.5c-8.47 0-15.58 5.72-18.15 13.44l6.64 5.16c1.23-5.77 6.2-10.03 11.51-10.03z"/>
                            <path fill="#34A853" d="M42.69 20.82H24v7.71h10.71c-.97 5.04-5.48 8.82-10.71 8.82-3.32 0-6.27-1.4-8.38-3.64l-6.64 5.17c3.66 4.34 9.09 7.05 15.02 7.05 8.64 0 16.02-5.79 17.86-13.47l.83-4.44z"/>
                            <path fill="#FBBC05" d="M9.74 26.56c-.45-1.33-.7-2.75-.7-4.22s.25-2.89.7-4.22l-6.64-5.17c-1.36 2.71-2.1 5.79-2.1 9.39s.74 6.68 2.1 9.39l6.64-5.17z"/>
                            <path fill="#EA4335" d="M23.49 43.5c4.61 0 8.67-1.52 11.81-4.09l-5.21-5.21c-1.64 1.1-3.67 1.74-5.91 1.74-5.31 0-10.28-4.26-11.51-10.03l-6.64 5.17c2.57 7.72 9.68 13.44 18.15 13.44z"/>
                        </svg>
                    </a>
                              </div></div>
                    <div class = "sign-up-form">
                        <div class ="title">Sign up</div>
                        <div class  = "input-box">
                            <i class ="fas fa-envelope"></i>
                            <input type ="text" placeholder="Enter your name" required>
                        </div>
                        <div class  = "input-box">
                            <i class ="fas fa-envelope"></i>
                            <input type ="text" placeholder="Enter your email" required>
                        </div>
                        <div class  = "input-box">
                            <i class ="fa fa-envelope"></i>
                            <input type ="password" placeholder="Enter your password" required>
                    </div>
                    <div class = "text" ><a href=# class ="text">Forgot Password</a></div>
                    <div class  = "button input-box">
                        <i class ="fas fa-envelope"></i>
                        <input type ="submit" value ="Submit">
                    </div>
                    <div class ="text">Already have an account ? <label for ="flip">Login now</label>></div>

                    </div>
                    </div>
                </form>
            </div>
            
        </main>