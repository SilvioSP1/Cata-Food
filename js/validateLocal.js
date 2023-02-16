var notyf = new Notyf();

const userLocal = document.querySelectorAll("input[name='txtNombreDue']");

const array = Array.from(userLocal);

const patterns = {

    txtNombre: /^[a-z\d]{5,12}$/i,

};

function validate(field, regex) {

    if (regex.test(field.value)) {

        field.className = 'valid';
        console.log("Nombre valido");

    } else {

        field.className = 'invalid';
        notyf.success({

            message: "Mensaje enviado!",
            duration: 5000,
            ripple: true,
            position: {
                x:'right',
                y:'top'
            }

        })

    }

}

array.forEach((inputLoc) => {

    inputLoc.addEventListener('keyup',(e) => {

        validate(e.target,patterns[e.target.attributes.name.value]);

    });
    
});