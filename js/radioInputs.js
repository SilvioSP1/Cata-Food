let nombre = document.getElementById('nombre');
let apellido = document.getElementById('apellido');
let telefono = document.getElementById('telefono');
let boton = document.getElementById('divPagar');
let radio1 = document.getElementById('hide');
let radio2 = document.getElementById('show');
boton.hidden = true;
let aux = 1;


//funcion para validacion

function validar() {

    /*creo una variable de tipo booleano que en principio tendrá un valor true(verdadero),
    y que se convertirá en false(falso) cuando la condición no se cumpla*/
    var todo_correcto = true;

    /*El primer campo a comprobar es el del nombre. Lo traemos por id y verificamos
    la condición, en este caso, por ejemplo, le decimos que tiene que tener más de dos dígitos
    para que sea un nombre válido. Si no tiene más de dos dígitos, la variable todo_correcto
    devolverá false.*/


    if (document.getElementById('nombre').value.length < 2) {
        todo_correcto = false;
    } else {
        todo_correcto = true;
    }
    if (document.getElementById('apellido').value.length < 2) {
        todo_correcto = false;
    } else {
        todo_correcto = true;
    }
    if (document.getElementById('telefono').value.length < 2) {
        todo_correcto = false;
    } else {
        todo_correcto = true;
    }

    /*Por último, y como aviso para el usuario, si no está todo bién, osea, si la variable
    todo_correcto ha devuelto false al menos una vez, generaremos una alerta advirtiendo
    al usuario de que algunos datos ingresados no son los que esperamos.*/
    if (!todo_correcto) {
        boton.hidden = true;
    } else {
        boton.hidden = false;
    }
    return todo_correcto;
}

//keyups

nombre.addEventListener("keyup", validar);
apellido.addEventListener("keyup", validar);
telefono.addEventListener("keyup", validar);
