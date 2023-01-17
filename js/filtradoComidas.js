document.addEventListener("keyup", e=> {


    if(e.target.matches("#buscadorComida")){

        document.querySelectorAll(".container__CardProd").forEach(restaurantes => {


            const encontrados = restaurantes.textContent.toLowerCase().includes(e.target.value.toLowerCase())

            if(encontrados > 0){

                restaurantes.classList.remove("filtroComida")

            }
            else{

                restaurantes.classList.add("filtroComida")

            }


        })

    }


})