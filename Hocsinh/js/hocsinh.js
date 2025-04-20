function toggleDropdown() {
    const dropdown = document.getElementById("dropdownProfile");
    dropdown.style.display = dropdown.style.display === "block" ? "none" : "block";
}

function logout() {
    alert("Đăng xuất thành công!");
    window.location.href = "login.html"; // thay nếu bạn có trang login
}

// Đóng menu nếu click ra ngoài
window.onclick = function(event) {
    const dropdown = document.getElementById("dropdownProfile");
    const profile = document.querySelector(".info_user");

    if (!profile.contains(event.target) && !dropdown.contains(event.target)) {
        dropdown.style.display = "none";
    }
};
