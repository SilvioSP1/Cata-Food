function getBotResponse(input) {
    // Respuestas cata food
    if (input == "Hola" || input == "hola") {
        return "Hola usuario!";
    } else if (input == "Adios" || input == "adios") {
        return "Nos vemos pronto!";
    } else if (input == "Quiero comprar" || input == "quiero comprar") {

        return "Dirigete a la seccion de restaurantes!";

    } else if (input == "❤") {

        return "❤";

    }
    else if(input == "¿Como me registro?" || input == "como me registro"){

        return "Vas al apartado de inicio/registro y te puedes registrar sin ningún problema";

    } 
    else {
        return "Intenta preguntando otra cosa!";
    }
}