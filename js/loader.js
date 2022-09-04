function loader() {
    document.querySelector(".loader-container").classList.add("fade-out");
}

function fadeOut() {
    setInterval(loader, 1000);
}

window.onload = fadeOut();