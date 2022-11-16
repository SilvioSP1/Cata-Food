let pass1 = document.querySelector("#txtContrasena");
let pass2 = document.querySelector("#txtContrasenaRepe");
let resultado = document.querySelector(".contraseniaMatching");

function checkpassword (){

    resultado.innerText = pass1.value == pass2.value ? 'Las contraseñas coinciden ✔️' : 'Las contraseñas no coinciden ​⛔​'

}

pass2.addEventListener("keyup", checkpassword);