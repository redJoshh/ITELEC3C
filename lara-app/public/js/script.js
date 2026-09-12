document.addEventListener("DOMContentLoaded", () => {
    const hamburgerBtn = document.getElementById("hamburger");
    const mobileMenu = document.getElementById("mobile-menu");

    if (hamburgerBtn && mobileMenu) {
        hamburgerBtn.addEventListener("click", () => {
            mobileMenu.classList.toggle("hidden");
        });
    }
});
