const user = document.getElementById("txtNombre");

const patterns = {

    txtNombre: /\D{2,0}\d*/

}

function validate(field, regex) {

    if (regex.test(field.value)) {

        field.className = 'valid';

    } else {

        field.className = 'invalid';

    }

}

user.forEach((input) => {

    input.addEventListener('keyup', (e) => {

        validate(e.target, patterns[e.target.attributes.name.value]);

    });


})