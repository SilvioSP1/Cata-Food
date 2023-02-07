const nombre = document.getElementById("nombre");
const botonPagar = document.getElementsByClassName("mercadopago-button");


if (nombre.empty()) {
    botonPagar.disabled = true;
}