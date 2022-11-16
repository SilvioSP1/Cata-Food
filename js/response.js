function getBotResponse(input) {
    // Respuestas cata food
    if(input == "Quiero comprar" || input == "quiero comprar" || input == "1"){


        return "Dirigete a la seccion de restaurantes!";

    }else if(input == "¿Como me registro?" || input == "como me registro"){

        return "Vas al apartado de inicio/registro y te puedes registrar sin ningún problema";
    
    }else if(input == "¿Que necesito para registrar un local?" || input == "que necesito para registrar un local"){

        return "Necesitas: Nombre del local, El tipo de local ,Cantidad de locales, Ubicación del local o locales y la referencia";
    
    }else {
        return "Intenta preguntando otra cosa!";
    }
}