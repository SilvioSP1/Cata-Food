const openModal = document.querySelectorAll('.botonModal'); //seleccionamos el boton con la clase botonModal
const modal = document.querySelector('.modal'); //seleccionamos la clase modal
const closeModal = document.querySelector('.modal__close'); //seleccionamos la clase modal__close

const nose = document.querySelector('.nose');

//Cada vez que hagamos click en open modal hara lo siguiente:
const tama = openModal.length;

for (i = 0; i < tama; i++) {
    openModal[i].addEventListener('click', (e)=>{
    
        e.preventDefault(); //prevenimos el comportamiento por defecto
        modal.classList.add('modal--show'); //modal entrara a sus clases y agregara la clase modal--show
    
    });
}

//Cada vez que hagamos click en close modal hara lo siguiente:
closeModal.addEventListener('click', (e)=>{

    e.preventDefault(); //prevenimos el evento
    modal.classList.remove('modal--show'); //en vez de agregar la clase modal show, que me la quite 

});

