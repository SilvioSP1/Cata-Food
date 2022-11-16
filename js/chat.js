//Collapsible

var coll = document.getElementsByClassName("collapsible");

for (let i = 0; i < coll.length; i++) {

    coll[i].addEventListener("click", function () {


        this.classList.toggle("active")

        var content = this.nextElementSibling;

        if (content.style.maxHeight) {

            content.style.maxHeight = null;

        } else {

            content.style.maxHeight = content.scrollHeight + "px"

        }

    })

}

//Obtener la hora actual
function getTime() {

    let today = new Date();
    hours = today.getHours();
    minutes = today.getMinutes();


    if (hours < 10) {

        hours = "0" + hours //05:19

    }

    if (minutes < 10) {

        minutes = "0" + minutes //05:19

    }


    let time = hours + ":" + minutes;
    return time;

}


//El mensaje del bot
function firstBotMessage() {

    let firstMessage = "Hola soy el bot Amadeo, ¿En que puedo ayudarte? Podes escribir las siguientes opciones para chatear conmigo: <br> 1) Quiero comprar <br> 2) ¿Como me registro? 3) ¿Que necesito para registrar un local?"
    document.getElementById("botStarterMessage").innerHTML = '<p class="botText"><span>' + firstMessage + '</span></p>'

    let time = getTime();

    $("#chat-timestamp").append(time)
    document.getElementById("userInput").scrollIntoView(false);


}

firstBotMessage();

function getHardResponse(userText) {

    let botResponse = getBotResponse(userText);

    let botHtml = '<p class="botText"><span>' + botResponse + '</span></p>'

    $("#chatbox").append(botHtml);

    document.getElementById("chat-bar-bottom").scrollIntoView(true);

}

function getResponse() {

    let userText = $("#textInput").val();

    if (userText == "") {

        userText = "I love code palace!"

    }

    let userHtml = '<p class="userText"><span>' + userText + '</span></p>'

    $("#textInput").val("");
    $("#chatbox").append(userHtml);
    document.getElementById("chat-bar-bottom").scrollIntoView(true);

    setTimeout(() => {

        getHardResponse(userText)

    }, 1000);

}

function buttonSendText(sampleText) {

    let userHtml = '<p class="userText"><span>' + sampleText + '</span></p>'

    $("#textInput").val("");
    $("#chatbox").append(userHtml);
    document.getElementById("chat-bar-bottom").scrollIntoView(true);

}

function sendButton() {

    getResponse();

}

function heartButton() {

    buttonSendText("❤")

}

//Al pressionar enter se va a enviar el mensaje
$("#textInput").keypress(function (e) {

    if (e.which == 13) {

        getResponse();

    }

})