const productos = document.getElementById("containerFiltro")

document.addEventListener("keyup", e=> {


    if(e.target.matches("#buscador")){

        document.querySelectorAll(".container__CardRest").forEach(restaurantes => {


            const encontrados = restaurantes.textContent.toLowerCase().includes(e.target.value.toLowerCase())

            if(encontrados > 0){

                restaurantes.classList.remove("filtro")

            }
            else{

                restaurantes.classList.add("filtro")

            }


        })

    }


})