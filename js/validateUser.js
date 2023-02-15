const user = document.querySelector("#txtNombre");

const patterns = {

    txtNombre: /[A-Z]{2,}\d*/i

}

function validate(field, regex) {

    if (regex.test(field.value)) {

        field.className = 'valid';
        console.log("Nombre inapropiado");

    } else {

        field.className = 'invalid';

    }

}

Object.keys(patterns).forEach(input => {

    input.addEventListener('keyup', (e) => {

        validate(e.target, patterns[e.target.attributes.name.value]);

    });
    
});