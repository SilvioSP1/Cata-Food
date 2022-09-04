//Boiler mi app

/*
    Variables
*/

const toggle = document.querySelector(".menu_toggle");
const nav = document.querySelector("nav");
const nav_children = document.querySelectorAll("nav li");

let toggle_opened = false;
let animation4;

/*
  Metodos
*/

  /*
      Toggle open
  */

const animation_Toggle_Open = () => {
  console.log("Abriendo Menu");

  // necesitamos algun css
  //anime.set sirve inicializar una animacion en un objeto
  // ademas que anime.js tiene complicaciones para animar elementos que no tiene inicializado un estilo ya se
  // dentro de la etiqeuta o de la declaracion css, por eso usamos anim.set para poder dar la primera animacion que funcione sin problemas
  anime.set([nav],{
      translateX: "-100%",
      opacity: 0
  });
  anime.set([nav_children],{
      translateX: "-100%",
      opacity: 0
  });

  // creamos el timeline
  animation4 = anime.timeline({
      duration:350,
      easing:"easeInOutSine",

      //algo que suceda cuando se termine la animacion
      complete(){
          console.log("Menu abierto");
      }
  });

  //añadimos los bloques del timeline
  animation4
      .add({
          targets:[nav],
          translateX:0,
          opacity:1,
      })
      .add({
          targets:[nav_children],
          translateX:0,
          opacity:1,
          // esta es una funcion de delay escalonada que cuando se termine uno espera tanto tiempo y sige el otro
          delay: anime.stagger(100),
      },"-=200");
      
};

  /*
      Toggle close
  */
const animation_Toggle_Close = () => {
  console.log("Cerrando Menu");

  anime.set([nav],{
      translateX: "0%",
      opacity: 1,
  });
  anime.set([nav_children],{
      translateX: 0,
      opacity: 1,
  });

  animation4 = anime.timeline({
      duration:350,
      easing:"easeInOutSine",

      complete(){
          console.log("Menu cerrado");
      },
  });

  animation4
      .add({
          targets:[nav_children],
          translateX:"-100%",
          opacity:0,
          delay: anime.stagger(100),
      })
      .add({
          targets:[nav],
          translateX:"-100%",
      },"-=50");
}

/*
  Eventos
*/

toggle.addEventListener("click", () => {
  if (toggle_opened) {
      animation_Toggle_Close();
      //sin una promesa
      toggle_opened = false;
  }else{
      animation_Toggle_Open();
      //con una promesa cuando se finalice la animacion 
      animation4.finished.then(() => {
          toggle_opened = true;
      });
  }
});