const userRegex = document.getElementById("txtNombre");

const patterns = {

    txtNombre: /[A-Z]{2,}\d*/i

}

function validate(field, regex) {

    if (regex.test(field.value)) {

        field.className = 'valid';

    } else {

        field.className = 'invalid';
        alert("Nombre inapropiado")

    }

}

userRegex.forEach((inputReg) => {

    inputReg.addEventListener('keyup',(e) => {

        validate(e.target,patterns[e.target.attributes.name.value]);

    });
    
});