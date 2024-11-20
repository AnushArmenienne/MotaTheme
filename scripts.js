document.addEventListener("DOMContentLoaded", function () {
    const page   = '<!DOCTYPE html><h4 style="color: #FFFFFF; font-family: sans, arial; padding-top: 50px; text-align: center">Loading...</h4>';
    const iframe = this.getElementById("videoplayer");
    const videos = this.querySelectorAll(".menu-item-18 ");
    iframe.style.width = "100%";
    iframe.style.aspectRatio = "16 / 9";
    iframe.srcdoc = page;
    videos.forEach(element => {
       
        element.setAttribute("src", "https://img.youtube.com/vi/" +
        element.id + "/mqdefault.jpg");
        element.setAttribute("data-bs-toggle", "modal");
        element.setAttribute("data-bs-target", "#videoModal");
        element.style.cursor = "pointer";
        element.addEventListener("click", function (e) {
            iframe.removeAttribute("srcdoc");
            iframe.src = "https://www.youtube.com/embed/" +
                         e.target.getAttribute("id");
        });
    });
    this.getElementById("videoModal")
    .addEventListener("hidden.bs.modal", e => {
        iframe.removeAttribute("src");
        iframe.srcdoc = page;
    });
});




