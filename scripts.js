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




// Attendez que le DOM soit prêt
document.addEventListener("DOMContentLoaded", function() {
    // Sélectionner les éléments de la lightbox
    const lightboxLinks = document.querySelectorAll('.lightbox');
    const lightboxOverlay = document.createElement('div');
    lightboxOverlay.classList.add('lightbox-overlay');

    // Créez un élément d'image dans la lightbox
    const lightboxImage = document.createElement('img');
    lightboxImage.classList.add('lightbox-image');

    // Ajoutez l'image et la couche à la page
    lightboxOverlay.appendChild(lightboxImage);
    document.body.appendChild(lightboxOverlay);

    // Lorsque l'on clique sur une image de la lightbox
    lightboxLinks.forEach(link => {
        link.addEventListener('click', function(event) {
            event.preventDefault(); // Empêche le comportement par défaut (le lien)
            const imageUrl = this.getAttribute('href'); // Récupère l'URL de l'image
            lightboxImage.src = imageUrl; // Définir l'image dans la lightbox
            lightboxOverlay.style.display = 'flex'; // Afficher la lightbox
        });
    });

    // Fermeture de la lightbox en cliquant sur le fond sombre
    lightboxOverlay.addEventListener('click', function(event) {
        if (event.target === lightboxOverlay) {
            lightboxOverlay.style.display = 'none'; // Cacher la lightbox
        }
    });

    // Ajouter un bouton pour fermer la lightbox
    const closeButton = document.createElement('button');
    closeButton.classList.add('lightbox-close');
    closeButton.textContent = '×'; // Le symbole de fermeture
    lightboxOverlay.appendChild(closeButton);

    // Ajouter un événement de fermeture au bouton
    closeButton.addEventListener('click', function() {
        lightboxOverlay.style.display = 'none'; // Cacher la lightbox
    });
});



document.addEventListener("DOMContentLoaded", function () {
    // Vérifiez si la variable est définie
    if (typeof acfReferencePhoto !== "undefined") {
        // Sélectionnez le champ REF. PHOTO et définissez sa valeur
        var refPhotoField = document.getElementById("refphoto");
        if (refPhotoField) {
            refPhotoField.value = acfReferencePhoto; // Injecte la référence
        }
    }
});



