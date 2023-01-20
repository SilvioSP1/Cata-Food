var notyf = new Notyf();

const btn = document.getElementById('button');

document.getElementById('form').addEventListener('submit', function (event) {
    event.preventDefault();

    btn.value = 'Enviando...';

    const serviceID = 'default_service';
    const templateID = 'template_ltoqg56';

    emailjs.sendForm(serviceID, templateID, this)
        .then(() => {
            btn.value = 'Send Email';
            notyf.success({

                message: "Mensaje enviado!",
                duration: 5000,
                ripple: true,
                position: {
                    x:'right',
                    y:'top'
                }

            })
        }, (err) => {
            btn.value = 'Enviar mensaje';
            alert(JSON.stringify(err));
    });
});