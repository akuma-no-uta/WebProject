<style>
.hero-section, .about-section {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 80px 5%;
    flex-wrap: wrap;
    gap: 50px;
    background-color: #f9f9f9;
}

.hero-section .content,
.about-section .content {
    flex: 1 1 50%;
    min-width: 300px;
}

.hero-section .image,
.about-section .image {
    flex: 1 1 45%;
    display: flex;
    justify-content: center;
    align-items: center;
}

.hero-section .image img,
.about-section .image img {
    max-width: 100%;
    height: auto;
    border-radius: 12px;
    box-shadow: 0 5px 25px rgba(0,0,0,0.1);
}

/* === Text Style === */
.hero-section h4,
.about-section h4 {
    font-size: 1.2rem;
    color: #666;
    margin-bottom: 10px;
}

.hero-section h2,
.about-section h2 {
    font-size: 2.5rem;
    font-weight: 700;
    margin-bottom: 20px;
}

.hero-section span,
.about-section span {
    color: #007bff;
}

.hero-section p,
.about-section p {
    font-size: 1rem;
    line-height: 1.6;
    color: #444;
}

/* === Buttons === */
.hero-buttons,
.about-section .btn {
    margin-top: 20px;
}

.btn {
    padding: 12px 24px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s ease;
    font-size: 1rem;
}

.btn-primary {
    background-color: #007bff;
    color: #fff;
}

.btn-primary:hover {
    background-color: #0056b3;
}

.btn-dark-outlined {
    background-color: transparent;
    color: #007bff;
    border: 2px solid #007bff;
    margin-left: 10px;
}

.btn-dark-outlined:hover {
    background-color: #007bff;
    color: white;
}

.btn-dark-outlined a {
    color: inherit;
    text-decoration: none;
}

.social-icons {
    display: flex;
    list-style: none;
    gap: 15px;
    margin-top: 20px;
    padding-left: 0;
}

.social-icons a {
    font-size: 1.4rem;
    color: #333;
    transition: color 0.3s ease;
}

.social-icons a:hover {
    color: #007bff;
}

/* Responsive Mobile */
@media (max-width: 768px) {
    .hero-section, .about-section {
        flex-direction: column;
        text-align: center;
    }

    .btn-dark-outlined {
        margin-left: 0;
        margin-top: 10px;
    }
}
</style>
<div class="user">

<section class="hero-section" id="home">
    <div class="content">
        <h4 title="Hello, How are you?">Hi, There!</h4>
        <h2>I'm <span>Kevin</span></h2>
        <p>I am a Web Developer skilled in Frontend Technologies, such as HTML,
            CSS, and JavaScript. I'm passionate about blending design aesthetics with functionality.</p>

        
        <div class="hero-buttons">
            <button class="btn btn-dark-outlined">
                <a href="../img/screen-shot-2023-02-28-at-00.01.51.png" download>Download CV</a>
            </button>
        </div>
    </div>

    <div class="image" >
        <img src="../img/vaclavsnasel.jpg" alt="Sudharsan-portfolio">
    </div>
</section>

<section class="about-section" id="about">
    <div class="image" >
        <img src="../img/1516228133024.jpg" alt="Sudharsan-portfolio" style="width: 350px; ">
    </div>

    <div class="content">
        <h4>About Me</h4>
        <h2>I am UI Designer & <br><span>Web Developer</span></h2>
        <p>Hello there! I'm Sudharsan, a first-year student at Anna University,
            majoring in Computer Science. I'm passionate about leveraging technology to solve real-world problems and
            building projects that matter.</p>

        <button class="btn btn-primary" >
            <a href="https://github.com/danielace1" target="_blank" style="color:white">Know More</a>
        </button>
    </div>
</section>

</div>

</div>


</div>