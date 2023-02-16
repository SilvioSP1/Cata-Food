const userRegex = document.querySelectorAll("input[name='txtNombre']");

const arr = Array.from(userRegex);

const patterns = {

    txtNombre: /^[a-z\d]{5,12}$/i,

};

function validate(field, regex) {

    if (regex.test(field.value)) {

        field.className = 'valid';
        console.log("Nombre valido");

    } else {

        field.className = 'invalid';
        console.log("Nombre invalido");

    }

}

arr.forEach((inputReg) => {

    inputReg.addEventListener('keyup',(e) => {

        validate(e.target,patterns[e.target.attributes.name.value]);

    });
    
});