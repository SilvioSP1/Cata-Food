function getBotResponse(input) {
    // Respuestas cata food
    if(input == "Quiero comprar" || input == "quiero comprar" || input == "1"){


        return "Dirigete a la seccion de restaurantes y <br> selecciona el restaurante que desees!.";

    }else if(input == "¿Como me registro?" || input == "como me registro" || input == "2"){

        return "Vas al apartado de inicio/registro y te puedes registrar sin ningún problema.";
    
    }else if(input == "¿Que necesito para registrar un local?" || input == "que necesito para registrar un local" || input == "3"){

        return "Necesitas 📄: <br> Nombre del local <br> El tipo de local <br> Email <br> Nombre <br> Apellido <br> Telefono <br> Contraseña <br> Cantidad de locales <br> Ubicación del local o <br> locales <br> Referencia de la ubicación";
    
    }else {
        return "Intenta preguntando otra cosa!";
    }
}