<?php include("template/header.php"); ?>


<div class="cookie-consent-modal">

    <div class="contenido animate__animated animate__slideInUp">

        <div class="contenedorCookie">
            <h1 class="allowCookies">Política sobre cookies</h1>
            <img src="../../Cata-Food/img/index/cookie.png" alt="" class="cookie">
        </div>

        <p>Este sitio web utiliza cookies propias y de terceros, para el correcto funcionamiento y visualización del
            sitio web <br> Si continuas navegando, consideramos que aceptas su uso</p>

        <div class="btns">

            <button class="botonn cancel">Cancelar</button>
            <button class="botonn accept">Aceptar</button>

        </div>

    </div>
</div>


<div>
    <h1 class="titulo__Cata animate__animated animate__fadeInDown">Bienvenidos a Cata Food</h1>
    <p>Empieza tus compras en los mejores restaurantes de la provincia.</p>
</div>

<!-- <div class="contenedorBuscador">
    <form class="d-flex containerMedias">
        <input class="form-control me-1 buscador" type="search" placeholder="🔍︎ Buscar" aria-label="Search">
        <button class="btn btn-outline-dark botonBusc text-white" type="submit">Buscar</button>
    </form>
</div> -->

<div class="buttonFlex">
    <a href="../../Cata-Food/secciones/restaurantes.php?pagina=1">
        <button class="cssbuttons-io-button"> Restaurantes
            <div class="icon">
                <svg height="24" width="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M16.172 11l-5.364-5.364 1.414-1.414L20 12l-7.778 7.778-1.414-1.414L16.172 13H4v-2z"
                        fill="currentColor"></path>
                </svg>
            </div>
        </button>
    </a>
</div>

<div class="contenedorCards animate__animated animate__fadeIn">


    <model-viewer src="img/index/Hamburger.glb" camera-controls auto-rotate disable-zoom disable-pan ar
        shadow-intensity="0.5" shadow-softness="0.25"></model-viewer>

    <model-viewer src="img/index/Fries.glb" camera-controls auto-rotate disable-zoom disable-pan ar
        shadow-intensity="0.5" shadow-softness="0.25"></model-viewer>

</div>

<div class="containerTop">

    <div class="mejoresTexto">

        <h1>Ultimas noticias de comida en el pais</h1>

    </div>

    <!-- <div class="container__cardsTop">


        <div class="card1--top" data-tilt data-tilt-glare data-tilt-max-glare="0.2">

            <img src="./img/index/topMejores.png" alt="" class="imgTop">
            <h1>Zona Norte</h1>
            <div class="stars">

                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>

            </div>



        </div>

        <div class="card2--top" data-tilt data-tilt-glare data-tilt-max-glare="0.2">

            <img src="./img/index/topMejores.png" alt="" class="imgTop">
            <h1>Zona Sur</h1>

            <div class="stars">

                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>

            </div>


        </div>

        <div class="card3--top" data-tilt data-tilt-glare data-tilt-max-glare="0.2">

            <img src="./img/index/topMejores.png" alt="" class="imgTop">
            <h1>Zona Centro</h1>

            <div class="stars">

                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>
                <i class="fa-solid fa-star"></i>

            </div>


        </div>

    </div> -->

    <div class="contenedorIndexI">
        <div class="containerIndex">
            <div class="cardIndex" data-tilt data-tilt-glare data-tilt-max-glare=".5">
                <div class="card-headerIndex">
                    <img src="./img/index/mostazaDibu.jpg" alt="dibu" class="imagenCards" />
                </div>
                <div class="card-bodyIndex">
                    <span class="tag tag-teal">Mostaza</span>
                    <h4>
                        El Dibu lo hizo: Tras su campaña, Mostaza invertirá US$20 millones y se espera la llegada a
                        Misiones
                    </h4>
                    <div class="user">
                        <img src="./img/index/noticiasComunes.ico" alt="user" class="imagenCards" />
                        <div class="user-infoIndex">
                            <h5>Noticias Comunes</h5>
                            <small>2h ago</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cardIndex" data-tilt data-tilt-glare data-tilt-max-glare=".5">
                <div class="card-headerIndex">
                    <img src="./img/index/lomitosFotos.webp" alt="ballons" class="imagenCards" />
                </div>
                <div class="card-bodyIndex">
                    <span class="tag tag-purple">Popular</span>
                    <h4>
                        Semana del lomito: en estos locales hay 25 por ciento de descuento este miércoles por toda la
                        semana entera
                    </h4>
                    <div class="user">
                        <img src="./img/index/redaccionVos.webp" alt="user" class="imagenCards" />
                        <div class="user-infoIndex">
                            <h5>Redacción Vos</h5>
                            <small>Yesterday</small>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cardIndex" data-tilt data-tilt-glare data-tilt-max-glare=".5">
                <div class="card-headerIndex">
                    <img src="./img/index/alfajoresNoticias.webp" alt="city" class="imagenCards" />
                </div>
                <div class="card-bodyIndex">
                    <span class="tag tag-pink">Alfajores</span>
                    <h4>
                        De Havanna a Guaymallen: los secretos del negocio que mueve 1000 millones de alfajores por año
                    </h4>
                    <div class="user">
                        <img src="./img/index/javierLedesma.webp" alt="user" class="imagenCards" />
                        <div class="user-infoIndex">
                            <h5>Javier Ledesma</h5>
                            <small class="small">1w ago</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <div class="chat-bar-collapsible animate__animated animate__backInRight">
            <button id="chat-button" type="button" class="collapsible">¿Necesitas ayuda?
                <i id="chat-icon" style="color: #fff;" class="fa fa-fw fa-comments-o"></i>
            </button>

            <div class="content">
                <div class="full-chat-block">
                    <!-- Message Container -->
                    <div class="outer-container">
                        <div class="chat-container">
                            <!-- Messages -->
                            <div id="chatbox">
                                <h5 id="chat-timestamp"></h5>
                                <p id="botStarterMessage" class="botText"><span>Loading...</span></p>
                            </div>

                            <!-- User input box -->
                            <div class="chat-bar-input-block">
                                <div id="userInput">
                                    <input id="textInput" class="input-box" type="text" name="msg"
                                        placeholder="Presiona 'Enter' para enviar">
                                    <p></p>
                                </div>

                                <div class="chat-bar-icons">
                                    <i id="chat-icon" style="color: crimson;" class="fa fa-fw fa-heart"
                                        onclick="heartButton()"></i>
                                    <i id="chat-icon" class="fa fa-fw fa-send"
                                        onclick="sendButton()"></i>
                                </div>
                            </div>

                            <div id="chat-bar-bottom">
                                <p></p>
                            </div>

                        </div>
                    </div>

                </div>
            </div>

        </div>

        <script type="text/javascript" src="../../Cata-Food/js/vanilla-tilt.js">
            VanillaTilt.init(document.querySelector(".card"), {
                max: 15,
                speed: 600,
                perspective: 1000,
                transition: true,
                reverse: false,
            });
        </script>


    </div>

    <div class="flexContacto">

        <div class="backgroundForm__Contacto">
            
            <div class="containerForm__Contacto">

                <div class="textoContacto">
                    <h1>¿Tienes alguna duda? No olvides en dejarnos la duda que tengas</h1>
                </div>

                <div class="screen">
                    <div class="screen-header">
                        <div class="screen-header-left">
                            <div class="screen-header-button close"></div>
                            <div class="screen-header-button maximize"></div>
                            <div class="screen-header-button minimize"></div>
                        </div>
                        <div class="screen-header-right">
                            <div class="screen-header-ellipsis"></div>
                            <div class="screen-header-ellipsis"></div>
                            <div class="screen-header-ellipsis"></div>
                        </div>
                    </div>
                    <div class="screen-body">
                        <div class="screen-body-item left">
                            <div class="app-title">
                                <span>CONTACTÉNOS</span>
                            </div>
                            <div class="app-contact">CATA FOOD - CATAMARCA</div>

                            <form class="app-form" id="form">

                                <div class="field">

                                    <label for="from_name" class="labels">Email</label>
                                    <input type="text" name="from_name" class="app-form-control" id="from_name" required>

                                </div>

                                <div class="field">

                                    <label for="message" class="labels mensajeLabel">Mensaje</label>
                                    <textarea type="text" name="message" class="app-form-control messageInput" id="message"></textarea>

                                </div>

                                <div class="app-form-group buttons">

                                    <input class="app-form-button" type="submit" id="button" value="Enviar mensaje"></input>

                                </div>

                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</section>

<!-- CONTEINER -->

<!-- FOOTER -->
<div class="row featurette footer">
  <footer style="background-color: #1a1e21" class="text-center text-white">
    <!-- Grid container -->
    <div class="container p-4">
      <!-- Section: Social media -->
      <section class="mb-4 logoFooter">
        
      <div class="divFooter">
          <img src="../img/index/logo_small.png" alt="logo cata food" class="logoFooter">
        </div>

      </section>

     
      <!-- Section: Social media -->

      <!-- Section: Form -->

      <!-- Section: Form -->

      <!-- Section: Text -->
      <section class="mb-4">
        <p>
          Cata Food el mejor sitio que puedes encontrar para conocer nuevos locales gastronomicos de la
          Ciudad de San Fernando del Valle de Catamarca. <br>
          Ven a ver todos los locales que tenemos
        </p>
      </section>
      <!-- Section: Text -->

      <!-- Section: Links -->

      <!-- Section: Links -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      Copyright © 2022 Cata Food, Todos los derechos reservados.
    </div>
    <!-- Copyright -->
  </footer>
</div>
<!-- FOOTER -->
</div>



</main>


<!-- scripts funcionalidad -->
<script src="js/chat.js?v=<?php echo time();?>"></script>
<script src="js/response.js?v<?php echo time();?>"></script>
<script type="module" src="js/mail.js?v=<?php echo time(); ?>"></script>
<script src="../../Cata-Food/js/boiler.js"></script>
<script src="../../Cata-Food/js/loader.js?v=<?php echo time(); ?>"></script>
<script src="../../Cata-Food/js/toast.js"></script>
<script src="../../Cata-Food/js/mouse.js"></script>
<script src="../../Cata-Food/js/cookies.js"></script>
<script src="../../Cata-Food/js/filtrado.js?v=<?php echo time(); ?>"></script>
<script src="../../Cata-Food/js/suggestions.js?v=<?php echo time(); ?>"></script>
<script src="../../Cata-Food/js/buscadorIndex.js?v=<?php echo time(); ?>"></script>
<script src="../../Cata-Food/js/rating.js?v=<?php echo time(); ?>"></script>
<script src="../../Cata-Food/js/modalRestaurante.js?v=<?php echo time(); ?>"></script>
<script src="../../Cata-Food/js/rate.js?v=<?php echo time(); ?>"></script>
<script src="../../Cata-Food/js/filtradoComidas.js?v=<?php echo time(); ?>"></script>
<script src="../../Cata-Food/js/darkMode.js?v=<?php echo time(); ?>"></script>



<!-- JavaScript Bundle with Popper -->
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" 
integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" 
crossorigin="anonymous"></script>

<!-- Font awesome -->
<script src="https://kit.fontawesome.com/0dcf698896.js" crossorigin="anonymous"></script>

<!-- Anime.js -->
<script src="../../Cata-Food/node_modules/animejs/lib/anime.min.js"></script>

<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>



<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/notyf@3/notyf.min.js"></script>

</body>


</html>