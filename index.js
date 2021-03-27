window.onscroll = function() {
    var topbar = document.getElementById("topbar");
    var sticky = topbar.offsetTop;
    if (window.pageYOffset >= sticky) {
        topbar.classList.add("sticky")
    } else {
        topbar.classList.remove("sticky");
    }
}
