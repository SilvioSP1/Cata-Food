const searchWrapper = document.querySelector(".search-input");
const inputBox = document.querySelector(".inputBuscador");
const suggBox = document.querySelector(".autocom-box");
const icon = document.querySelector(".icon");

let linkTag = searchWrapper.querySelector(".buscadorList");
let enlaces;

inputBox.onkeyup= (e) => {

    let userData = e.target.value;
    let emptyArray = [];

    if(userData){

        icon.onClick = () =>{

            webLink = "https://www.google.es/search?q=${userData}";
            linkTag.setAttribute("href", webLink);
            linkTag.click();

        }

        emptyArray = suggestions.filter((data) => {

            return data.toLocalLowerCase().startsWith(userData.toLocalLowerCase());

        });

        emptyArray = emptyArray.map((data) => {

            return data = "<li>${data}</li>";

        });

        searchWrapper.classList.add("active");
        showSuggestions(emptyArray);
        let allList = suggBox.querySelectorAll("li");

        for(let i=0; i<allList.length;i++){

            allList[i].setAttribute("onclick", "select(this)")

        }

    }else{

        searchWrapper.classList.remove("active")

    }

    function select(element){

        let selectData = element.textContent;

        inputBox.value = selectData;

        icon.onClick = () =>{

            webLink = "https://www.google.es/search?q=${userData}";
            linkTag.setAttribute("href", webLink);
            linkTag.click();

        }

        searchWrapper.classList.remove("active");

        

    }

    function showSuggestions(list){

        let listData;

        if(!list.length){

            userValue = inputBox.value;

            listData = "<li>${userValue}</li>"

        }else{

            listData = list.join("");

        }

        suggBox.innerHTML = listData;

    }

}