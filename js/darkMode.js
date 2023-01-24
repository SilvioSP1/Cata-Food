let bodyDark = document.querySelector("body");
let colorMode = document.querySelector(".colorMode__dark");

load();

colorMode.addEventListener("click", () => {

    bodyDark.classList.toggle("dark-mode");

    store(body.classList.contains("dark-mode")); //si contiene el dark mode (devuelve true) y si no (false)

});

function load(){

    const darkMode = localStorage.getItem('dark-mode');

    if(!darkMode){

        store('false');

    }else if(darkMode == 'true'){

        bodyDark.classList.add('dark-mode')

    }

}

//esta funcion indica un valor como parametro que lo pasamos al localStorage y con setItem le damos un nombre al valor que guardamos
function store(value){

    localStorage.setItem('dark-mode', value)

}