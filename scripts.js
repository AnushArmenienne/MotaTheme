alert ();


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

// Durée de l'apparition et disparition de l'image en millisecondes
const duree = 300;

// Création de la balise <div id="grande"> en fin de page
const divgrande = document.createElement("div");
divgrande.id = "grande";
document.body.appendChild(divgrande);

// Application de la durée de transition
divgrande.style.transitionDuration = duree + "ms";

// Si clic sur les vignettes
function clic_vignettes() {
    // On récupère la source de la vignette sur laquelle l'utilisateur a cliqué
    let source_vignette = this.getAttributeNode("src").value;
    // On récupère le nom de la grande image à partir de la source de la vignette (retrait des 16 premiers caractères : "images/vignette-")
    let nom_grande = source_vignette.substr(16);
    // On insère la grande image dans la balise div
    divgrande.innerHTML = "<img src='images/" + nom_grande + "'>";
    // Div au premier plan
    divgrande.style.zIndex = 1;
    // Div opaque (progressivement grâce à la propriété CSS transition)
    divgrande.style.opacity = 1;
    // Curseur avec la petite main pour inviter au clic de sortie
    divgrande.style.cursor = 'pointer';
    // On greffe un évènement click pour fermer la grande image
    divgrande.addEventListener("click", clic_grande);
}

// Si clic sur la grande image
function clic_grande() {
    // On enlève l'écoute du click sur la grande image pour éviter les bugs
    divgrande.removeEventListener("click", clic_grande);
    // Transparence progressive
    divgrande.style.opacity = 0;
    // Une fois que l'image est transparente, on masque le div en arrière plan
    setTimeout(masque_grande, duree);
}

// Div en arrière plan et curseur normal
function masque_grande() {
    divgrande.style.zIndex = -1;
    divgrande.style.cursor = 'initial';
}

// On lance l'écoute des clics sur les vignettes
const vignettes = document.querySelectorAll("img[src*=vignette]");

vignettes.forEach(function (element) {
    element.addEventListener("click", clic_vignettes);
});