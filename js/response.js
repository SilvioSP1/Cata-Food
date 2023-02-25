function getBotResponse(input) {
    // Respuestas cata food
    if(input == "Quiero comprar" || input == "quiero comprar" || input == "1"){


        return "Dirigete a la seccion de restaurantes y <br> selecciona el restaurante que desees!.";

    }else if(input == "¿Como me registro?" || input == "como me registro" || input == "2"){

        return "Vas al apartado de inicio/registro y te puedes registrar sin ningún problema.";
    
    }else if(input == "¿Que necesito para registrar un local?" || input == "que necesito para registrar un local" || input == "3"){

        return "Necesitas 📄: <br> Nombre del local <br> El tipo de local <br> Email <br> Nombre <br> Apellido <br> Telefono <br> Contraseña <br> Cantidad de locales <br> Ubicación del local o <br> locales <br> Referencia de la ubicación";
    
    }else if(input == "¿Que hago si tengo una duda?" || input == "que hago si tengo una duda" || input == "4"){

        return "Dirigite al formulario de <br> contacto introduciendo tu email y la duda que tengas al respecto, te responderemos al instante!";
    
    }else if(input == "El sitio no carga correctamente" || input == "el sitio no carga correctamente" || input == "5"){

        return "En ese caso te recomendamos que actualices la pagina , que cambies de navegador o que elimines las cookies del sitio.";
    
    }
    else {
        return "Intenta preguntando otra cosa!";
    }
}