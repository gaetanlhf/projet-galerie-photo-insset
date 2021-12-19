function showSpinner() {
    document.getElementById("main").style.transition = "opacity 0.4s";
    document.getElementById("main").style.opacity = "0.35";
    document.getElementById("main").style.pointerEvents = "none";
    document.getElementsByClassName("spinner-container")[0].style.transition = "opacity 0.4s";
    document.getElementsByClassName("spinner-container")[0].style.visibility = "visible";
    document.getElementsByClassName("spinner-container")[0].style.opacity = "1";
}

function removeSpinner() {
    document.getElementById("main").style.transition = "opacity 0.4s";
    document.getElementById("main").style.opacity = "1";
    document.getElementById("main").style.pointerEvents = "all";
    document.getElementsByClassName("spinner-container")[0].style.transition = "opacity 0.4s";
    document.getElementsByClassName("spinner-container")[0].style.opacity = "0";
    document.getElementsByClassName("spinner-container")[0].style.visibility = "hidden";
}

window.onbeforeunload = function () {
    showSpinner();
}

window.onload = function () {
    removeSpinner();
}