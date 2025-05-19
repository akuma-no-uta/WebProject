<style>
    @font-face {
    font-family: "Londrina Solid";
    src: url(../font/LondrinaSolid-Regular.ttf);
}
.body{
    font-family: "Londrina Solid", sans-serif;}
.visually-hidden{
    display:none;
}

    @media screen and (max-width:540px){
        .header-heading{
            bottom:30px;
        }
    @media (max-width:768px){
.header-heading{
    top: 5vw;

}}
@media (max-width:500px){
    .header-heading{
        top:10vw;
    }

    }
    
    .button-banner {
        flex-grow: 1;
        position: relative; 
        margin-left: auto; 
        color: hsla(195.6, 92.59259259%, 21.17647059%, 1);
        padding: 0.2rem 0.8rem;
        top:30px;
        border-radius: 2rem;
        right:500px;
        text-decoration: none;
        font-family: "Londrina Solid", sans-serif;
        gap: 2rem;
        font-size: 20px;
        display: flex;
        justify-content: center;
        align-items: flex-start;
    }
    .navbar{
        width:100%;
        height:60px;
        max-width:1200px;
        margin:0 auto;
        display:flex;
        align-items: center;
        justify-content: space-between;
    }
   
    
.a{
margin:30px;
font-family: "Londrina Solid", sans-serif;
}

.circle-card {
width: 150px;
height: 150px;
font-family: "Londrina Solid", sans-serif;
background: white;
border-radius: 50%;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
display: flex;
flex-direction: column;
align-items: center;
justify-content: center;
text-align: center;
padding: 20px;
}

.circle-card img {
width: 60px;
font-family: "Londrina Solid", sans-serif;
height: 60px;
border-radius: 50%;
object-fit: cover;
margin-bottom: 10px;
}

.circle-card h3 {
margin: 5px 0;
font-family: "Londrina Solid", sans-serif;
font-size: 16px;
}

.circle-card p {
margin: 0;
font-family: "Londrina Solid", sans-serif;
font-size: 12px;
color: gray;
}
.body{
background-color: #fbf6dc;
font-family: "Londrina Solid", sans-serif;
}



.task-bar{
font-family: "Londrina Solid", sans-serif;


}

@media (max-width:345px){
  
}
.header-icon-1{
    margin-top:-23px;
}
.header-icon-2{
font-family: "Londrina Solid", sans-serif;
cursor: pointer;
margin-top:-23px;

}
.header-item-container ul li a{
    position:relative;
    float:center;


    display: block;
    gap: 3vw;
    flex-direction: row;



}
#menu-bar{
    display: none;
}
header label{
    position: relative;
    font-size:20px;
    color:hsla(195.6, 92.59259259%, 21.17647059%, 1);
    cursor:pointer;
     display:none;
    margin-left:30vw;
}
@media  (max-width:991px){
    .header-item-container{

    }
    header label{

        display:initial;}
    header .navbar .label{
        
        position:absolute;
        left:0;
        right:0;
        border-top:1px solid rgba(0,0,0.1);

    }
}
@media  (max-width:800px){
 header label{
    display:flex;
    position: relative;
    font-size:20px;
    color:hsla(195.6, 92.59259259%, 21.17647059%, 1);
    cursor:pointer;
    left:10vw;
    top:0vw; }
}


.menu-container {
    display:flex;
  position: relative;
  left:40rem;
  bottom:2rem;
}
#menu-bar:checked ~.navbar{
    display:initial;
}
.button-banner {
  text-decoration: none;
  transition: background 0.3s;
}



.menu-toggle {
  display: none;
  font-size: 24px;
  background: none;
  border: none;
  cursor: pointer;
  top:15px;
  position: absolute;

}
@media screen and (max-width:376px){
    .header-item-container {
        display: none;
        flex-direction: column;
        position: absolute;
        top: 50px;
        left: 0;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
      }
   .menu-toggle{
    margin-right:-35vw;
    margin-top:-2vw;
   }
    
}
@media screen and (max-width: 769px) {
  .header-item-container {
    display: none;
    flex-direction: column;
    position: absolute;
    top: 50px;
    left: 0;
    width: 100%;
    box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    padding: 10px 0;
  }

  .menu-toggle {
    display: block;
  }
}
.navbar .menu-toggle-btn{
    color:black;
    font-size: 1.5rem;
    cursor:pointer;
    display:none
}
@media (max-width:992px){
    .header-item-container{
        display:none
    }
    .menu-toggle-btn{
        display:block;
    }
  
}
li{
    list-style:none;
}
a{
    text-decoration:none;
    color:#fff;
    font-size:1rem;
}
a:hover{
    color:orange
}
.title h2 {
line-height: 1;
padding-top: .25em;
font-family: "Londrina Solid", sans-serif;
padding-bottom: .25em;
color: #3c3c3c;
font-size: 4rem;
}
.hiring{
    width:100vw;
    height:1000px;
}
.slider {
width: 100%;
margin: auto;
top: -9px;
font-family: "Londrina Solid", sans-serif;
}

.slider-video {
height: 100%;
width: 100%;
font-family: "Londrina Solid", sans-serif;
}
.slick-slide img {
  width: 500px;
  height: 500px;
  font-family: "Londrina Solid", sans-serif;
}
.l-wrapper {
display: flex;
max-width: 1100px;
font-family: "Londrina Solid", sans-serif;
margin: auto;
align-items: center;
gap:100px;
justify-content: space-between;
}

.image-container img {
max-width: 100%;
height: auto;
font-family: "Londrina Solid", sans-serif;
border-radius: 10px;
}

.content-container {
max-width: 500px;
font-family: "Londrina Solid", sans-serif;
color: #3c3c3c;
}


.map-container {
font-family: "Londrina Solid", sans-serif;
width: 100%;
height: 150px;
}

.map-container iframe {
width: 100%;
font-family: "Londrina Solid", sans-serif;
height: 100%;
border: 0;
}

a {
color: white;
font-family: "Londrina Solid", sans-serif;
text-decoration: underline;
}

a:hover {
font-family: "Londrina Solid", sans-serif;
color: #fcd32c;
}


.hidden-section{
opacity:0;
transform:translateY(50px);
transition:all 1s ease-in-out;
}
.show {
        opacity: 1;
        transform: translateY(0);
    }


.content-container h2 {
font-family: "Londrina Solid", sans-serif;
font-size: 2.5rem;
color: #3c3c3c;
margin-bottom: 10px;
}

.subheader {
font-family: "Londrina Solid", sans-serif;
text-transform: uppercase;
font-size: 1rem;
font-weight: bold;
color: #7b5d44;
display: flex;
align-items: center;
}

.subheader img {
font-family: "Londrina Solid", sans-serif;
margin-left: 10px;
}


.content-container p {
font-size: 1rem;
font-family: "Londrina Solid", sans-serif;
line-height: 1.5;
color: #555;
}

.button a {
font-family: "Londrina Solid", sans-serif;
display: inline-block;
background-color: #e86229;
color: white;
padding: 10px 20px;
border-radius: 5px;
text-decoration: none;
font-weight: bold;
margin-top: 15px;
}

.button a:hover {
font-family: "Londrina Solid", sans-serif;
background-color: #d1501a;
}
.popup-box {
    display: none;
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: white;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    text-align: center;
    z-index: 1000;
  }
  .popup-box button {
    margin-top: 10px;
    padding: 8px 12px;
    border: none;
    background-color: #007bff;
    color: white;
    border-radius: 5px;
    cursor: pointer;
  }

  .popup-box button:hover {
    background-color: #0056b3;
  }
.row-footer {
font-family: "Londrina Solid", sans-serif;
display: -ms-flexbox;
display: flex;
-ms-flex-wrap: wrap;
flex-wrap: wrap;
margin-right: -15px;
margin-left: -15px;
}*/
.banner {
font-family: "Londrina Solid", sans-serif;
background-color: #f3b53b;
justify-content:center;
max-width:80%;



clip-path: polygon(0% 0%, 100% 0%, 95% 100%, 0% 100%);
}
.button-job{
    font-family: "Londrina Solid", sans-serif;
    display: inline-block;
    background-color: #e86229;
    color: white;
    padding: 10px 20px;
    border-radius: 5px;
    text-decoration: none;
    font-weight: bold;
    margin-top: 15px;
    margin-left:45vw;
    }
    
    .button-job:hover {
    font-family: "Londrina Solid", sans-serif;
    background-color: #d1501a;
    }
    /*.row {
    font-family: "Londrina Solid", sans-serif;
    display: -ms-flexbox;
    display: flex;
    -ms-flex-wrap: wrap;
    flex-wrap: wrap;
    margin-right: -15px;
    margin-left: -15px;
    }*/
.banner-right {
position: fixed;
right: -100%; /* Ẩn hoàn toàn bên phải */
size:30%;
top: 60%;
transform: translateY(-50%) skewX(-10deg); /* Tạo hiệu ứng nghiêng như hình thang */
width: 400px; /* Điều chỉnh kích thước */
transition: right 1s cubic-bezier(0.25, 1.5, 0.5, 1), transform 1s cubic-bezier(0.25, 1.5, 0.5, 1);
z-index: 1000;
border-radius: 20px;
    background: #f3b53b;
padding: 20px;
box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);
}

.banner-right.show {
right: 10px;
transform: translateY(-50%) skewX(0); 
}
@media (max-width: 768px) {
    .banner-right-mob {
        position: fixed;
        right: -100%; 
        size:5%;
        top: 60%;
        transform: translateY(-50%) skewX(-10deg); 
        width: 70vw;
        height:50vw;
        transition: right 1s cubic-bezier(0.25, 1.5, 0.5, 1), transform 1s cubic-bezier(0.25, 1.5, 0.5, 1);
        z-index: 1000;
        border-radius: 20px;
            background: #f3b53b;
        padding: 20px;
        
        box-shadow: 5px 5px 15px rgba(0, 0, 0, 0.2);    }
    }

.banner-content {
font-family: "Londrina Solid", sans-serif;
display: flex;
align-items: center;
justify-content: space-between;
flex-wrap: wrap;
width: 100%;
padding: 10px;
}

.banner img {
font-family: "Londrina Solid", sans-serif;
max-width: 120px;
padding: 10px;
}

.banner-text {
font-family: "Londrina Solid", sans-serif;
flex: 1;
text-align: left;
padding: 10px;
}

.banner h2 {
font-family: "Londrina Solid", sans-serif;
margin: 0;
font-size: 24px;
font-weight: bold;
}

.banner p {
font-family: "Londrina Solid", sans-serif;
font-size: 16px;
margin: 10px 0;
}

.cta {
font-family: "Londrina Solid", sans-serif;
padding: 10px;
}

.cta a {
font-family: "Londrina Solid", sans-serif;
text-decoration: none;
background-color: white;
color: black;
padding: 8px 15px;
border-radius: 5px;
font-weight: bold;
font-size: 14px;
border: 2px solid black;
}

.cta a:hover {
font-family: "Londrina Solid", sans-serif;
background-color: black;
color: white;
}
body    {
font-family: "Londrina Solid", sans-serif;
background-color: #f4f4f4;
margin: 0;
padding: 0;
}

h2 {
text-align: center;
color: #e6007e;
font-size: 28px;
font-family: "Londrina Solid", sans-serif;
margin: 20px 0;
}

.card-listing {
font-family: "Londrina Solid", sans-serif;
display: flex;
flex-wrap: wrap;
justify-content: center;
gap: 20px;
padding: 20px;
}

/*.card {
font-family: "Londri na Solid", sans-serif;
width: 300px;
background: #fff;
border-radius: 8px;
overflow: hidden;
box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
transition: transform 0.3s ease-in-out;
}*/
.image-thumbnail{
object-fit: cover
}
.hidden-section1{
opacity: 0;
transform: translateX(100px); /* Đẩy sang phải */
transition: all 0.8s ease-in-out;
}
/* Container chứa các logo */
.collab-logo-container {
    display: flex;
    flex-direction: row; /* Xếp theo hàng ngang */
    justify-content: center; /* Căn giữa logo */
    align-items: center; /* Canh giữa theo chiều dọc */
    gap: 20px; /* Khoảng cách giữa các logo */
    flex-wrap: wrap; /* Đảm bảo logo không bị tràn khi thu nhỏ */
    padding: 20px 0; /* Thêm khoảng cách nếu cần */
}

.collab-logo {
    max-width: 100px; /* Giới hạn kích thước logo */
    height: auto;
    transition: transform 0.5s ease-in-out;
}

.collab-logo:hover {
    transform: rotate(360deg);
}


.hidden-section1.show {
opacity: 1;
transform: translateX(0); /* Trả về vị trí cũ */
}

.card:hover {
font-family: "Londrina Solid", sans-serif;
transform: translateY(-5px);
}

.card__media {
font-family: "Londrina Solid", sans-serif;
position: relative;
height: 200px;
background-size: cover;
background-position: center;
transition: filter 0.3s ease-in-out;
}

/* Darken image on hover */
.card:hover .card__media {
font-family: "Londrina Solid", sans-serif;
filter: brightness(80%);
}

.card__heading {
font-size: 18px;
font-family: "Londrina Solid", sans-serif;
color: #e6007e;
text-align: center;
padding: 15px;
font-weight: bold;
}

.card span {
font-family: "Londrina Solid", sans-serif;
display: block;
text-align: center;
color: #666;
padding-bottom: 15px;
font-size: 14px;
text-decoration: none;
}


.header__phl-icon {
width: 50px; /* Điều chỉnh logo nhỏ hơn */
height: auto;
}

@media (max-width: 768px) {
.body {
    max-width: 200px; 
}
}
.clipped-box {
font-family: "Londrina Solid", sans-serif;
width: 50%;
height: 300px;
background-color:  #88f8e2;
clip-path: polygon(0 0, calc(100% - 25px) 24px, 100% calc(100% - 38px), 0% 100%);
margin-left:400px;

}
.logo-container{
position:relative;
}
.logo-job{
height:80px;
bottom: 20px; /* Điều chỉnh vị trí theo ý muốn */
left: 20px; 
bottom:750px;

position: absolute;
}


    .collab-logo-container {
        display: flex;
        justify-content: space-between; /* Căn đều các logo */
        align-items: center; /* Căn giữa các logo theo chiều dọc */
        flex-wrap: wrap; /* Cho phép các logo xuống dòng nếu màn hình nhỏ */
        gap: 15px; /* Khoảng cách giữa các logo */
    }
    
}

@media (max-width: 480px) {
    .footer__container {
        padding-inline: 3vw; 
    }

    .footer__top {
        padding: 3vw; 
    }
    .collab-logo-container {
        display: flex;
        justify-content: space-between; /* Căn đều các logo */
        align-items: center; /* Căn giữa các logo theo chiều dọc */
        flex-wrap: wrap; /* Cho phép các logo xuống dòng nếu màn hình nhỏ */
        gap: 5px; /* Khoảng cách giữa các logo */
    }
    
}

.content{
    padding-bottom:100 px;
}#searchLocation{
    width:700px;
    height: 80px;
    bottom: 20px; /* Điều chỉnh vị trí theo ý muốn */
    left: 13px;  
    top:2925px;
    position: absolute;
 }    
 .content1{
    position: absolute;
    top:-750px;
    margin-left: 15px; /* Điều chỉnh khoảng cách lề trái */

    font-size: 18px; /* Tùy chỉnh kích thước chữ */
    font-weight: bold;

 }
 .content2{
    position: absolute;
    top:-670px;
    margin-left: 15px; /* Điều chỉnh khoảng cách lề trái */

    font-size: 15px; /* Tùy chỉnh kích thước chữ */
    font-weight: bold;

 }
 #searchLocationSubmit{
    width: 100px;
    height: 50px;
    font-family: "Londrina Solid", sans-serif;
    background-color: #e86229;
    color: white;
    border-radius: 5px;
    top:-20vw;
    left: 14vw;
    font-weight: bold;
    border: none;
    position: absolute;
    transform: translateX(-50%);
    cursor: pointer;

}

#searchLocationSubmit:hover {
    font-family: "Londrina Solid", sans-serif;
    background-color: #d1501a;}
    @media (min-width: 500px) and (max-width: 700px) {
    }    .header-heading{
        margin-top:5px;
    }

    
    
</style>
<main>
                    <div>
                        <div class="slider-container">
        <div class="slider">
            <div class="slide"><video autoplay muted loop class="slider-video"><source src="../PicAndVid/vid/cookvid.mp4" type="video/mp4"></video></div>
            <div class="slide"><img src="../PicAndVid/img/istockphoto-1451425205-1024x1024.jpg" alt="Slide 2"></div>
            <div class="slide"><img src="../PicAndVid/img/106947904-1632763959731-ALL_PRODUCTS_ok.jpg" alt="Slide 3"></div>
            <div class="slide"><img src="../PicAndVid/img/istockphoto-1167975402-612x612.jpg" alt="Slide 4"></div>
        </div>
    </div>
            </div>

            <section
                class="content-module content-row image-content fade-active hidden-section">
                <div class="l-wrapper">
                    <div class="image-container">
                        <img width="880" height="550"
                            src="../PicAndVid/img/MOTYO-Enrique-Olvera-Pujol-.jpg"
                            class="attachment-content-row size-content-row"
                            alt="Guacamole" decoding="async"
                            fetchpriority="high"> </div>
                    <div class="content-container">
                        <h2><span class="subheader">About Wax Bodega<img
                                    src="../PicAndVid/img/subheader-embellishment.svg"
                                    alt style></span><div
                                style="text-align: start;">Food Is His
                                Passion</div></h2><p></p><p>He believe that good
                            food feeds more than just our appetites. It
                            nourishes the soul.
                            Wax Bodega was an Mexico businessman and founder of
                            fast food chicken restaurant chain Kentucky Fried
                            Chicken. </p><br>
                        <p>He believe that sitting down and sharing a meal
                            prepared with time, love and quality ingredients
                            makes us all feel like family.
                            And when that happens, the world is a better place.

                        </p>
                        <div class="button"><a
                                href="https://www.eltorito.com/loyalty-program/">Discover
                                Our History</a></div> </div>
                </div>
            </section>

            <br>
            <section
                class="content-module content-row image-content reverse-layout hidden-section ">
                <div class="l-wrapper">
                    <div class="content-container hidden-section">
                        <h2><span class="subheader">Cooking As An Art<div
                                    class="hidden-section"><img
                                        class="hidden-section"
                                        src="../PicAndVid/img/subheader-embellishment.svg"
                                        alt></div></span><div
                                style="text-align: start;">Experience Our
                                Passion</div></h2>
                        <p>At our core, we believe in the power of great food to
                            bring people together. Every dish is crafted with
                            love, using only the best ingredients.</p>
                        <br>
                        <p>Sharing a meal is more than just eating—it's about
                            connection, joy, and creating unforgettable
                            memories.</p>
                        <div class="button"><a href="#">Discover Menu</a></div>
                    </div>
                    <div class="image-container">
                        <img width="880" height="550"
                            src="../PicAndVid/img/Untitled-design-25-880x550.png"
                            class="attachment-content-row size-content-row"
                            alt="Delicious Food" decoding="async"
                            fetchpriority="high">
                    </div>
                </div>
            </section>
            <br>

            <div class="row">

            </div>
            <div
                class="banner-right  banner-4 my-5 mx-2 mx-md-0 bg-yellow  ">

                <div class="container">
                    <div
                        class="d-flex flex-column flex-lg-row justify-content-between align-items-center flex-wrap px-3 px-lg-2 py-3"
                        : ?>
                        <img style="margin-left: 40px;"
                            class="img-fluid px-4 py-3"
                            src="../PicAndVid/img/BorderRewardsLogo.webp"
                            alt="Border Rewards: On The Border's Loyalty Program">
                        <div class="banner-headers px-2">
                            <h2 class="mb-0"> $2 OFF QUESO EVERY DAY!</h2>
                        </div> <!-- /banner-headers -->
                        <div class="col">
                            <p></p><p>The first step to earning rewards is to
                                join our Border Rewards loyalty program. When
                                you sign up, you get discounts on y every
                                day!</p>
                            <p></p>
                        </div>
                        <div class="p-4">

                            <div class="cta">
                                <a class="btn btn-sm btn-light cta-button  "
                                    href="https://www.ontheborder.com/border-rewards/">
                                    Sign Up Now </a>
                            </div> </div>

                    </div>
                </div>
            </div> <!-- /banner-2 -->

        </div>
        <br>
        <br>
        <section
            class="c-one-col--text content container revealable revealed hidden-section">

            <h2>What's new</h2>
        </section>

        <aside class="c-featured--news content container" role="presentation">
            <ul class="card-listing row hidden-section"
                style="display: flex; flex-wrap: wrap; justify-content: center; gap: 30px; list-style: none; padding: 0;">

                <li
                    class="card col-md-6 col-lg-4 card--cols-three revealable revealed"
                    style="width: 300px; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
                    <a class="card__btn" href="/news-item/puesto-x-ans-gelato/"
                        style="text-decoration: none; color: inherit;">
                        <div class="card__media">
                            <div class="card__image image-thumbnail" style="
                                    background-image: url('../PicAndVid/img/92988Puesto_x_An-s_Gelato_Cones_Courtesy_of_An-s_Gelato_1_1.jpg');
                                    background-size: cover;
                                    background-position: center;
                                    height: 200px;
                                    width: 100%;">
                            </div>
                        </div>
                        <h3
                            style="font-size: 1.2em; padding: 10px; text-align: center; margin-top:100px;">Puesto
                            x An’s Gelato: A Sweet San Diego Collaboration</h3>
                        <span
                            style="display: block; text-align: center; padding-bottom: 10px; color: #ff5733;">Read
                            More</span>
                    </a>
                </li>

                <li
                    class="card col-md-6 col-lg-4 card--cols-three revealable revealed"
                    style="width: 300px; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
                    <a class="card__btn"
                        href="/news-item/fall-flavors-have-arrived/"
                        style="text-decoration: none; color: inherit;">
                        <div class="card__media">
                            <div class="card__image image-thumbnail" style="
                                    background-image: url('../PicAndVid/img/21297Enchiladas41_1_1.jpg');
                                    background-size: cover;
                                    background-position: center;
                                    height: 200px;
                                    width: 100%;">
                            </div>
                        </div>
                        <h3
                            style="font-size: 1.2em; padding: 10px; text-align: center;">Fall
                            Flavors Have Arrived! Come Taste Our New Holiday
                            Menu</h3>
                        <span
                            style="display: block; text-align: center; padding-bottom: 10px; color: #ff5733;">Read
                            More</span>
                    </a>
                </li>

                <li
                    class="card col-md-5 col-lg-4 card--cols-three revealable revealed"
                    style="width: 300px; background: white; border-radius: 10px; overflow: hidden; box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);">
                    <a class="card__btn"
                        href="/news-item/fall-flavors-have-arrived/"
                        style="text-decoration: none; color: inherit;">
                        <div class="card__media">
                            <div class="card__image image-thumbnail" style="
                                    background-image: url('../PicAndVid/img/21297Enchiladas41_1_1.jpg');
                                    background-size: cover;
                                    background-position: center;
                                    height: 200px;
                                    width: 100%;">
                            </div>
                        </div>
                        <h3
                            style="font-size: 1.2em; padding: 10px; text-align: center;">Fall
                            Flavors Have Arrived! Come Taste Our New Holiday
                            Menu</h3>
                        <span
                            style="display: block; text-align: center; padding-bottom: 10px; color: #ff5733;">Read
                            More</span>
                    </a>
                </li>

            </ul>
        </aside>

        <!-- View More Button -->
        <div class="c-embed revealable revealed"
            style="display: flex; justify-content: center; margin-top: 20px;">
            <a class="btn btn-brand button" href="/whats-new/" style="
                    padding: 10px 20px;
                    background: #ff5733;
                    color: white;
                    border-radius: 5px;
                    text-decoration: none;
                    font-weight: bold;
                    text-align: center;">
                View More
            </a>
        </div>

        <br>

        <style>

</style>
        <div class="hidden-section">
            <img class="hiring"
                src="../PicAndVid/img/M3-2021-Team-2-Hero-Tablet-1536x1120.webp"
                data-events="resize ">
            <div class="logo-container">
                <svg xmlns="http://www.w3.org/2000/svg"
                    viewBox="0 0 117.29 122.69"
                    class="logo-job tile charcoal svg  replaced-svg"><path
                        d="m81.23 39.96-3.11 6.15-1.82 6.5-2.17 6.08-5.75 2.63-.13-6.3 1.43-6.12 2.55-5.68 4.98-4-8.05 3.65-7.44 4.02-8.22 2.25 2.51-6.5 5.36-4.21 6.51-2.34 7.32-.2-7.6-1.82-5.58-1.48-5.55-2.33 7.79-3.29 7.75.95 6.08 5.97 1.26-7.04 4.83-4.87 6.83.12 6.93 2.19-6.08 2.23-5.47 2.57-3.69 4.79 5.55-4.31 6.93-1.15 6.59 2.57 5.39 4.16-6.52 1.73-6.78-1.37-10.25.99 8 2.6 3.81 7.11.82 7.49-5.32-3.42-3.96-5.55z"
                        fill="#010101"></path><path
                        d="m81.95 39.06 1.69 7.12-.04 7.56.52 7.49.59 7.49-.16 7.51.16 7.5.85 7.53-.71 7.5-.82 7.47-1.28 6.75-4.26.47.69-6.68-.06-6.97.71-6.92.44-6.94.55-6.92.45-6.95-.41-6.97 1.34-6.94-1.46-6.92.02-6.95-1.55-7.34z"
                        fill="#010101"></path><path
                        d="m117.13 119.29a5.94 5.94 0 0 1 -.87-2.72 53.77 53.77 0 0 0 -.25-7.93 93 93 0 0 1 .26-13.55c.17-2.36.18-4.73.22-7.09 0-1.17-.1-2.34-.08-3.51.06-3 .34-6.12.2-9.15s-.16-5.88-.08-8.83c.14-4.53.2-9.05 0-13.56-.06-1.47.07-3 .13-4.43 0-.79.17-1.58.17-2.36 0-5.8-.08-11.6 0-17.4a102.5 102.5 0 0 0 -.39-14.13c-.28-2.24-.36-4.5-.46-6.76a3.61 3.61 0 0 1 .32-2c.38-.63.75-1.17.47-1.9a2.81 2.81 0 0 0 -1.64-1.6c-1.17-.52-2.29-1.16-3.41-1.78-.49-.28-.92-.95-1.55-.42-.83.68 0 1.2.29 1.76.07.13 0 .33 0 .65-.47 0-1 0-1.44 0-1.7-.07-3.41-.22-5.12-.23-2.11 0-4.23.07-6.35.09-6.45.07-12.89 0-19.33.62a4.51 4.51 0 0 1 -.9 0c-3.7-.35-7.46.07-11.12-.83a4.82 4.82 0 0 0 -1.2 0c-1.2 0-2.4 0-3.6-.11s-2.59-.24-3.89-.32c-3.72-.22-7.43-.46-11.15-.61-1.6-.07-3.21 0-4.81.1-.71 0-1.4.18-2.1.2-3.63.07-7.24-.11-10.87.08-3.3.18-6.64-.19-10-.31a53.71 53.71 0 0 0 -6.94-.17 76.15 76.15 0 0 0 -8.59 1.57 3.66 3.66 0 0 0 -3.05 2.34c.68.62 1.48 1.11 1.5 2.18 0 1.73.2 3.46.28 5.2.13 2.86.13 5.72.37 8.57s-.46 5.74.33 8.56a1.66 1.66 0 0 1 0 .91 9 9 0 0 0 -.16 3.93 15.14 15.14 0 0 1 -.15 3.36 7.22 7.22 0 0 0 -.07 2.41 9.13 9.13 0 0 1 .08 2.76c-.39 2.64.33 5.33-.44 7.94a2.08 2.08 0 0 0 0 .61c0 3.07.17 6.14.08 9.21-.06 2 .06 3.86.15 5.8.19 3.88-.1 7.78.29 11.66a14.32 14.32 0 0 1 -.08 1.84v2.1c0 1.23.09 2.45.07 3.68-.13 3.58-.25 7.17-.25 10.75a50.44 50.44 0 0 1 -.65 6.73 34.88 34.88 0 0 0 -.39 8.27c.27 2.45.28 4.88.31 7.31a6.23 6.23 0 0 0 1.38 3.91c1.36-.1 2.43-.27 3.48-.25a167.56 167.56 0 0 0 21.87-1.28c2.25-.26 4.48-.37 6.72-.41 4-.06 8 0 12-.42 1.44-.17 2.88-.47 4.33-.56 2.53-.15 5.07-.13 7.61-.27s5.16 1 7.82.22a.77.77 0 0 1 .29 0c1.91.49 3.87.1 5.82.1s3.81.68 5.74.74c5.74.16 11.49.26 17.24.2 2.92 0 5.85-.62 8.77-.7 3.49-.1 7.09-.52 10.23 1.36a1.75 1.75 0 0 0 2.55-2.18zm-9.27-7.74c-2.5 0-3.21.07-5.61.14h-1a10.39 10.39 0 0 0 -4.54.72 1.89 1.89 0 0 1 -2.16-.45c-.36.51-5.92.14-10.59-.12a1.62 1.62 0 0 1 -.78.1c-3.71-.11-7.4-.15-11.09-.62a59.06 59.06 0 0 0 -14.32-.3c-2.82.33-5.66.28-8.49.43-3.13.17-6.25.37-9.38.57a10.93 10.93 0 0 1 -5.56-.7c-3.34.68-14.34 1.41-14.34 1.41a3.53 3.53 0 0 0 -.63-.6 8.41 8.41 0 0 1 -3-.36 14.25 14.25 0 0 1 -4.9.92s-.09-6.79-.29-7.71c-.86-.44-.62-1.08-.54-1.67 0-.22.06-.41.08-.59l-.63-3.16s2.28-7.78 2.34-9.87a4.17 4.17 0 0 0 -.86-2.58l-.15.1a11.29 11.29 0 0 1 -.72-4.14c-.06-1.12-.1-2.24-.11-3.36a10.16 10.16 0 0 1 .12-2.41 11.11 11.11 0 0 0 .12-3.94c-.25-2.21-.32-4.45-.39-6.69s.08-4.71-.16-7c-.57-5.41-.07-10.81 0-16.22a13.8 13.8 0 0 0 -.17-4 4.1 4.1 0 0 1 .18-2.69 9.68 9.68 0 0 0 .37-2c-.23-2.33-1.8-9.17-1.76-10.48s.67-8.28.67-8.28-1.51-4.55-.73-5 .85-2.32 2.65-2.25 5.2-.56 7.35-.1c1.89.41 10.45 1.78 14.92 2.2l-.62-.68a9.25 9.25 0 0 1 4-.46c4.1 0 8.18 0 12.28-.32a74.67 74.67 0 0 1 9.34.07c5 .21 10 .53 15.05.8a13.33 13.33 0 0 1 2.1.19 24.7 24.7 0 0 0 6.59.49s3.5-1.94 4.5-.75 9.32 1.81 9.32 1.81a4.39 4.39 0 0 1 3.92-1.2 43 43 0 0 1 5.83.24 3.39 3.39 0 0 1 2.89 3.4v2.62a6.12 6.12 0 0 1 -.18 4.52c-.18 4.06-.39 10.54-.39 10.54s1.65-1.29 1.1 3.41c0 2.06.2 4.13.08 6.2-.2 3.48-.51 7-.77 10.45-.19 5.65-.4 11.37-.69 14.9v2.46c0 .16-.19.32-.36.59a16.33 16.33 0 0 0 -.48 3.75l.3-.43c.22.46.51.78.48 1.08-.32 3.61 0 7.24-.66 10.85a.51.51 0 0 1 -.09.12c0 .56 0 1.17-.05 2-.13 2.11 1.32 7.36 2 10.68a7.82 7.82 0 0 1 .3 1.72c0 .35.08.71.1 1.06.08.82.17 1.63.17 2.45a1.21 1.21 0 0 1 -.19.55c-.08 1.4-.23 2.75-.3 4-.16 2.59 1.04 3.6-1.47 3.59z"></path><g
                        fill="#010101"><path
                            d="m33.27 59.21-3.47 9.5-6.2 6.78.26-6.59 2.14-5.77 4.43-4.43-5.91 2.84-5.66 2.79-6.09 1.8 3.15-5.99 5.87-3.27 6.64-.24-5.27-1.92-7.94-2.43 5.42-3.24 6 1.16 4 4.05 2.21-6.09 6.11-2.67 6.47 2.2-6.16 2.7-5.08 4.09 5.93-3.73 6.97.92 5.54 4.05-10.12.85-7.24.13 5.46 2.38 3.47 4.75.42 5.91-6.44-6.98z"></path><path
                            d="m34.51 58.14.21 7.22 1.02 6.89.7 6.94-.15 6.97-.3 6.96.55 6.97-1.02 6.91-.59 7.29-3.77-.33 1.03-7.08-.08-7.11.52-7.05.92-7.04.21-7.09-.39-7.08.11-7.1-1.7-6.9z"></path></g></svg>

            </div>

            <div class="col-4">
                <div class="small-4 medium-5 large-6 cell form-group zip-code">
                    <div class="logo-container"
                        style="display: flex; flex-direction: column; justify-content: flex-start;">
                        <div class="content1">
                            <h2><i>Find A Job</i></h2>
                        </div>
                        <div class="content2">
                            <p>In the past four decades, El Pollo Loco has grown
                                quite a bit. From our first location on Alvarado
                                Street in Los Angeles</p>
                            <p>to over 480 restaurants across the United
                                States.</p>
                            <p>Đưa các banner/hình ảnh/ trang web quảng cáo lên
                                nền tảng thương mại điện tử (app/ web) của
                                Shopee theo</p>
                            <p>đúng bố cục và đúng thời gian quy định.</p>
                            <p>Cập nhật các banner/ trang quảng cáo. Hỗ trợ
                                thiết lập quảng cáo (gắn link dẫn quảng cáo, gắn
                                mã giảm giá/ sản phẩm và bộ sưu tập giảm giá/
                                tắt tháo gỡ banner) theo đúng yêu cầu</p>
                        </div>
                        <button id="searchLocationSubmit" type="submit"
                            aria-label="Location search">Apply<i
                                class="icon-Search-Icon"></i></button>
                    </div>
                </div>
            </div>

        </main>
<script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js"></script>
        <script>
  $(document).ready(function () {
    var video = document.getElementById("slide-video");

    $(".slider").slick({
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
            $(".slider").slick("slickNext");
            $(".slider").slick("slickSetOption", "autoplay", true, true);
        };
    }
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
        header.style.top = "-150px"; 
        awning.style.top = "-20px";  
    } else {
        header.style.top = "0";
        awning.style.top = "130px"; 
    }

    lastScrollTop = currentScroll <= 0 ? 0 : currentScroll;
    document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const menuContainer = document.querySelector(".header-item-container");

    menuToggle.addEventListener("click", function () {
        menuContainer.classList.toggle("show");
    });

});}
);
function toggleMenu() {
    document.querySelector(".header-item-container").classList.toggle("active");
    document.querySelector(".menu-toggle-btn").classList.toggle("active");
}
//nút x để tắt bảng popup
document.getElementById("close-banner").addEventListener("click", function () {
        document.getElementById("popup-banner").style.display = "none";
    });
</script>