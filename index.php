<?php include("template/header.php"); ?>

<div class="cookie-consent-modal">

    <div class="contenido animate__animated animate__slideInUp">

        <div class="contenedorCookie">
            <h1 class="allowCookies">Política sobre cookies</h1>
            <img src="../../Cata-Food/img/index/cookie.png" alt="" class="cookie">
        </div>

        <p>Este sitio web utiliza cookies propias y de terceros, para el correcto funcionamiento y visualización del sitio web <br> Si continuas navegando, consideramos que aceptas su uso</p>

        <div class="btns">

            <button class="botonn cancel">Cancelar</button>
            <button class="botonn accept">Aceptar</button>

        </div>
            
    </div>
</div>


<div>
    <h1 class="titulo__Cata animate__animated animate__fadeInDown">Bienvenidos a Cata Food</h1>
    <p>El mejor sitio donde encontrar comida en la ciudad de Catamarca</p>
</div>

<div class="contenedorBuscador">
    <form class="d-flex containerMedias">
        <input class="form-control me-1 buscador" type="search" placeholder="🔍︎ Buscar" aria-label="Search">
        <button class="btn btn-outline-dark botonBusc text-white" type="submit">Buscar</button>
    </form>
</div>

<div class="contenedorCards animate__animated animate__fadeIn">

    
    <model-viewer src="../../Cata-food/img/index/Hamburger.glb" camera-controls auto-rotate disable-zoom disable-pan ar shadow-intensity="0.5" shadow-softness="0.25"></model-viewer>

    <model-viewer src="../../Cata-food/img/index/Fries.glb" camera-controls auto-rotate disable-zoom disable-pan ar shadow-intensity="0.5" shadow-softness="0.25"></model-viewer>

</div>

<div class="containerTop">

    <div class="mejoresTexto">

        <h1>Top de los mejores restaurantes</h1>

    </div>

    <div class="container__cardsTop">


        <div class="card1--top ">

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

        <div class="card2--top ">

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

        <div class="card3--top ">

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
                                <i id="chat-icon" style="color: #333;" class="fa fa-fw fa-send"
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


</div>

<?php include("template/footer.php"); ?>