document.addEventListener("DOMContentLoaded", function () {
    const page = '<!DOCTYPE html><h4 style="color: #FFFFFF; font-family: sans, arial; padding-top: 50px; text-align: center">Loading...</h4>';
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





//referencedinamiquedans modale


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
                    ////////////////////////////// Cacher le bouton si aucune photo supplémentaire
                    if (!body.data.has_more) {
                        $('.js-load-photos').hide();
                    }

                })
                .catch(error => {
                    console.error('Erreur lors du chargement des images :', error);
                });
        });
    });
})(jQuery);




document.addEventListener('DOMContentLoaded', function () {
    // Récupérer les éléments
    const arrowLinks = document.querySelectorAll('.arrow-link');
    const thumbnailPreview = document.getElementById('thumbnail-preview');

    arrowLinks.forEach(link => {
        link.addEventListener('mouseover', function () {
            
            // Récupérer l'URL de la miniature depuis l'attribut data-thumbnail
            const thumbnailUrl = link.hasAttribute('data-thumbnail') ? link.getAttribute('data-thumbnail') : null;
           
                // Afficher la miniature
                thumbnailPreview.style.display = 'flex';
                if (thumbnailUrl) {
                    
                thumbnailPreview.style.backgroundImage = `url(${thumbnailUrl})`;
                
            } else {
                console.error('thumbnailUrl est vide ou invalide.');
            }

                // Positionner la miniature dynamiquement par rapport à la flèche
                const rect = link.getBoundingClientRect();
                thumbnailPreview.style.left = `${rect.left + window.scrollX}px`;
                thumbnailPreview.style.top = `${rect.top + window.scrollY }px`; // Ajustez la hauteur si nécessaire
            
        });

       link.addEventListener('mouseout', function () {
            // Cacher la miniature lorsque la souris quitte la flèche
           thumbnailPreview.style.display = 'none';
           thumbnailPreview.style.backgroundImage = '';
        }); 
    });
});


//lightbox