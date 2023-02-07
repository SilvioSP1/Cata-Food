const nombre = document.getElementById("nombre");
const botonPagar = document.getElementById("botonPagar")


if (nombre.empty()) {
    botonPagar.hidden = true;
}