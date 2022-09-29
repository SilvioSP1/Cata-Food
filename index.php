<?php include("template/header.php"); ?>

<div>
    <h1 class="titulo__Cata animate__animated animate__flash">Bienvenidos a Cata Food</h1>
    <p>El mejor sitio donde encontrar comida en la ciudad de Catamarca</p>
</div>

<div class="contenedorBuscador">
    <form class="d-flex containerMedias">
    <input class="form-control me-1 buscador" type="search" placeholder="🔍︎ Buscar" aria-label="Search">
    <button class="btn btn-outline-dark botonBusc text-white" type="submit">Buscar</button>
    </form>
</div>

<div class="contenedorCards">

    <div class="card">
    <div class="header">
        <div class="img-box">
        <img src="./img/index/friesCards.png" alt="" class="imgPapas">
        </div>
        <h1 class="title">Papas</h1>
    </div>

    <div class="content">
        <p>
        Las mejores papas
        </p>

    </div>

    </div>

    <div class="card">
    <div class="header">
        <div class="img-box">
        <img src="./img/index/burgerCards.png" alt="" class="imgBurger">
        </div>
        <h1 class="title">Burger</h1>
    </div>

    <div class="content">
        <p>
        Las mejores burgers
        </p>


    </div>

    </div>

    <div class="card">
    <div class="header">
        <div class="img-box">
        <img src="./img/index/pizzaCards.png" alt="" class="imgPizza">
        </div>
        <h1 class="title">Pizzas</h1>
    </div>

    <div class="content">
        <p>
        Las mejores pizzas
        </p>


    </div>

    </div>



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
    
</div>

<?php include("template/footer.php"); ?>