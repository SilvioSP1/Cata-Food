let cookieModal = document.querySelector(".cookie-consent-modal")
let cancelCookieBtn = document.querySelector(".botonn.cancel")
let acceptCookieBtn = document.querySelector(".botonn.accept")

//cuando apretemos en el boton de cancelar se quitara la clase active

cancelCookieBtn.addEventListener("click", function(){

    cookieModal.classList.remove("active");

});

//cuando apretemos en aceptar, se guardaran las cookies en el localstorage

acceptCookieBtn.addEventListener("click", function(){

    cookieModal.classList.remove("active");
    localStorage.setItem("cookieAccepted","yes");

});

//cada 2 milisegundos aparecera el modal de cookies si es que apretamos en aceptar
setTimeout(function(){
    
    let cookieAccepted = localStorage.getItem("cookieAccepted")

    //si cookieAccepted es distinto de yes, no aparecera más el modal
    if(cookieAccepted != "yes"){

        cookieModal.classList.add("active");

    }


}, 2000);