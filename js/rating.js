const btn = document.querySelector(".btnSubmit")
const post = document.querySelector(".postRating")
const widget = document.querySelector(".star-widget")
const editBtn = document.querySelector(".edit")

btn.onclick = () =>{

    widget.style.display = "none";
    post.style.display = "block";
    return false;


}

editBtn.onclick = () => {

    widget.style.display = "block";
    post.style.display = "none";
    return false;

}