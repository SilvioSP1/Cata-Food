let body = document.querySelector("body");
let colorMode = document.querySelector(".color-mode");

colorMode.addEventListener("click", () => {

    body.classList.toggle("dark-mode");

});