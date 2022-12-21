//obtener todos los elementos

const searchWrapper = document.querySelector(".search-input");
const inputBox = searchWrapper.querySelector("input");
const icon = searchWrapper.querySelector(".icon");
const suggBox = searchWrapper.querySelector(".autocom-box");

let linkTag = searchWrapper.querySelector("a");
let webLink;

//if cuando el usuario presione cualquier tecla

inputBox.onkeyup = (e) =>{

    let userData = e.target.value; //data del usuario
    let emptyArray = [];

    if(userData){

        icon.onclick = () => {

            webLink = `https://www.google.com/search?q=${userData}`;
            linkTag.setAttribute("href", webLink);
            linkTag.click();

        }

        emptyArray = suggestions.filter((data) => {

            //filtrar el valor del array
            return data.toLocaleLowerCase().startsWith(userData.toLocaleLowerCase());

        });

        emptyArray = emptyArray.map((data) => {

            return data = `<li>${data}</li>`;

        });

        searchWrapper.classList.add("active"); //mostrar autocompletado
        showSuggestion(emptyArray);

        let allList = suggBox.querySelectorAll("li");

        for (let i = 0; i < allList.length; i++) {
           
            //añadiendo onclick

            allList[i].setAttribute("onclick", "select(this)");
            
        }

    }else{

        searchWrapper.classList.remove("active"); //sacar autocompletado

    }


}

function select(element){

    let selectData = element.textContent;
    inputBox.value = selectData; //pasamos la lista que selecciono el usuario

    icon.onclick = ()=>{

        webLink = `https://www.google.com/search?q=${selectData}`;
        linkTag.setAttribute("href", webLink);
        linkTag.click();
    }

    searchWrapper.classList.remove("active");

}

function showSuggestion(list){

    let listData;

    if(!list.length){

        userValue = inputBox.value;
        listData = `<li>${userValue}</li>`;

    }else{


        listData = list.join('');
        

    }

    suggBox.innerHTML = listData;

}