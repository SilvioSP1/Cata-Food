let bodyDark = document.querySelector("body");
let colorMode = document.querySelector(".colorMode__dark");

colorMode.addEventListener("click", () => {

    bodyDark.classList.toggle("dark-mode");

});