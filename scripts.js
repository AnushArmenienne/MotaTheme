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





//boutonchargerplus


(function ($) {
    $(document).ready(function () {
        let currentPage = 1; // Page actuelle pour la pagination

        // Événement clic sur le bouton "Charger plus"
        $('.js-load-photos').click(function (e) {
            e.preventDefault();

            const ajaxurl = $(this).data('ajaxurl'); // URL pour Ajax
            const nonce = $(this).data('nonce'); // Nonce pour la sécurité

            const data = {
                action: 'load_images',
                nonce: nonce,
                paged: currentPage,
            };

            // Requête Ajax
            fetch(ajaxurl, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: new URLSearchParams(data),
            })
                .then(response => response.json())
                .then(body => {
                    if (!body.success) {
                        alert(body.data);
                        return;
                    }

                    // Ajouter les nouvelles photos au conteneur
                    $('.photos-container').append(body.data.html);

                    // Incrémenter la page actuelle
                    currentPage = body.data.paged;
                })
                .catch(error => {
                    console.error('Erreur lors du chargement des images :', error);
                });
        });
    });
})(jQuery);
