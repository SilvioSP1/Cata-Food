function getBotResponse(input) {
    // Respuestas cata food
    if(input == "Quiero comprar" || input == "quiero comprar" || input == "1"){


        return "1) Dirigete a la seccion de restaurantes de nuestro sitio web. <br> 2) Selecciona el restaurante que desees. <br> 3) Una vez dentro del restaurante, navega por su menú y elige los productos que te gusten. <br> 4) Agrega los productos al carrito de compras. <br> 5) Revisa los productos de tu carrito para verificar que sean los correctos. <br> 6) Completa el proceso de pago proporcionando la información necesaria, como la dirección de entrega y los detalles de pago. <br> 7) Confirma tu pedido y ¡listo! Nuestro equipo se encargará de procesarlo y enviarlo a la dirección especificada. ";

    }else if(input == "¿Como me registro como usuario?" || input == "como me registro como usuario" || input == "2"){

        return "1) Haz clic en la opción de Inicio/Registro en la barra de navegación. <br> 2) Completa el formulario de registro con los datos con tu nombre, apellido, dirección de correo electrónico y contraseña. <br> 3) Haz clic en el botón de registrar. <br> 4) Listo! Ahora puedes acceder a todas las funcionalidades de nuestro sitio web.";
    
    }else if(input == "¿Que necesito para registrar un local?" || input == "que necesito para registrar un local" || input == "3"){

        return "Necesitas 📄: <br> Nombre del local <br> El tipo de local <br> Email <br> Nombre <br> Apellido <br> Telefono <br> Contraseña <br> Cantidad de locales <br> Ubicación del local o <br> locales <br> Referencia de la ubicación";
    
    }else if(input == "¿Que hago si tengo una duda?" || input == "que hago si tengo una duda" || input == "4"){

        return "Dirigite al formulario de <br> contacto introduciendo tu email y la duda que tengas al respecto, te responderemos al instante!";
    
    }else if(input == "El sitio no carga correctamente" || input == "el sitio no carga correctamente" || input == "5"){

        return "Te recomendamos: <br> <br> Actualizar la página. <br> Cambiar de navegador. <br> Eliminar cookies del sitio web. <br> Contactar mediante el formulario de contacto. <br> <br> E intentar nuevamente 😁.";
    
    }
    else {
        return "Intenta preguntando otra cosa!";
    }
}