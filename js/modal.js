const openModal = document.querySelector('.botonModal'); //seleccionamos el boton con la clase botonModal
const modal = document.querySelector('.modal'); //seleccionamos la clase modal
const closeModal = document.querySelector('.modal__close'); //seleccionamos la clase modal__close

//Cada vez que hagamos click en open modal hara lo siguiente:
openModal.addEventListener('click', (e)=>{

    e.preventDefault(); //prevenimos el comportamiento por defecto
    modal.classList.add('modal--show'); //modal entrara a sus clases y agregara la clase modal--show

});

//Cada vez que hagamos click en close modal hara lo siguiente:
closeModal.addEventListener('click', (e)=>{

    e.preventDefault(); //prevenimos el evento
    modal.classList.remove('modal--show'); //en vez de agregar la clase modal show, que me la quite 

});

const modal_title = document.querySelector(".modal__title");

function pasarId() {
    const id = document.getElementById("Prod_Id");

}

/* openModal.addEventListener('show.bs.modal', function (event) {
    // Button that triggered the modal
    var button = event.relatedTarget
    // Extract info from data-bs-* attributes
    var recipient = button.getAttribute('data-bs-whatever')
    // If necessary, you could initiate an AJAX request here
    // and then do the updating in a callback.
    //
    // Update the modal's content.
    var modalTitle = exampleModal.querySelector('.modal-title')
    var modalBodyInput = exampleModal.querySelector('.modal-body input')
  
    modalTitle.textContent = 'New message to ' + recipient
    modalBodyInput.value = recipient
  }) */