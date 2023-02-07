const nombre = document.getElementById("nombre");
const botonPagar = document.getElementById("botonPagar").getElementsByTagName('*');


if (nombre.empty()) {
    for(var i of botonPagar){
        i.disabled = true;
    }
}