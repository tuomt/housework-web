let loginModal = document.getElementById("loginModal");
let openModalBtn = document.getElementById("openLoginModalBtn");
let closeModalBtn = document.getElementById("closeLoginModalBtn");

openModalBtn.onclick = function() {
    loginModal.style.display = "block";
}

window.onclick = function(event) {
    if (event.target == loginModal || event.target == closeModalBtn) {
        loginModal.style.display = "none";
    }
}
