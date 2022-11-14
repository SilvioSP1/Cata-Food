let pass = document.getElementById("txtContrasena");
let msg = document.getElementById("message");
let str = document.getElementById("strenght");

pass.addEventListener("input", () => {

    if(pass.value.length > 0){

        msg.style.display = "block";

    }else{

        msg.style.display = "none";

    }
    if(pass.value.length < 4){

        str.innerHTML = "no segura";
        str.style.fontWeight = "bolder";
        pass.style.borderColor = "#ff5925";
        msg.style.color = "#ff5925";

    }
    else if(pass.value.length >= 4 && pass.value.length < 8){

        str.innerHTML = "debil";
        pass.style.borderColor = "#FFD600";
        msg.style.color = "#FFD600";

    }
    else if(pass.value.length >= 8){

        str.innerHTML = "fuerte";
        pass.style.borderColor = "#26d730";
        msg.style.color = "#26d730";

    }

})
