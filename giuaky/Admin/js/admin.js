const sideMenu = document.querySelector('aside');
const menuBtn = document.querySelector('#menu_bar');
const closeBtn = document.querySelector('#close_btn');

const themeToggler = document.querySelector('.theme-toggler');

menuBtn.addEventListener('click', () => {
    sideMenu.style.display = 'block';
});

closeBtn.addEventListener('click', () => {
    sideMenu.style.display = 'none';
});

themeToggler.addEventListener('click',()=>{

    document.body.classList.toggle('dark-theme-variables');
    
    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');
})

function loadPage(page) {
    fetch(page)
    .then(response => response.text())
    .then(data => {
        document.getElementById('main-content').innerHTML = data;
    })
    .catch(error => console.error('Lỗi tải trang:', error));
}
document.addEventListener('DOMContentLoaded', function () {
    const confirmButtons = document.querySelectorAll('.btn');

    confirmButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (button.textContent === 'Xác nhận') {
                button.textContent = 'Đã xác nhận';
                button.style.backgroundColor = 'green';
            }
        });
    });
});