<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

get_header();
?>



<?php
/* commencement de la boucle */
while ( have_posts() ) :
    the_post();
    get_template_part( 'template-parts/content/content-page' );

    // If comments are open or there is at least one comment, load up the comment template.
    if ( comments_open() || get_comments_number() ) {
        comments_template();
    }
endwhile; // fin de la boucle.


wp_reset_postdata(); // Réinitialiser | Données de publication à leur état d'origine ?>


<div id="hero">
            <img class="imagehero" src="http://mota-version-finale.local/wp-content/uploads/2024/10/samantha-gades-fIHozNWfcvs-unsplash-1-scaled.jpg" alt="image d'un groupe">
            <h1 class="hero-header_page-title">Photographe Event</h>

        </div>
        <div id="container">
            <main id="content" role="main">





                <div class="filters-and-sort">

                    <select name="category-filter" id="category-filter" class="custom-select">
                        <option value=""> CATEGORIES </option>
                        <option value=""> Mariage </option>
                        <option value=""> Réception</option>
                        <option value=""> Concert</option>
                        <option value=""> Télévision</option>
                    </select>


                    <select name="format-filter" id="format-filter" class="custom-select">
                        <option value=""> FORMATS </option>
                        <option value=""> Portrait </option>
                        <option value=""> Paysage </option>
                    </select>


                    <select name="date-sort" id="date-sort" class="custom-select trierpar">
                        <option value="DESC">TRIER PAR</option>
                        <option value="DESC">Du plus récent au plus ancien</option>
                        <option value="ASC">Du plus ancien au plus récent</option>
                    </select>
                </div>


                <div id="photo-container">
                    <!-- Les photos filtrées seront affichées ici -->
                </div>






                <div class="photo-gallery">

                    <div class="photo-item">
                        <img src="http://mota-version-finale.local/wp-content/uploads/2024/10/nathalie-0-scaled.jpeg" alt="Photo 1">
                        <div class="overlay">
                            <div class="icons">
                                <span class="icon-eye" title="Voir les informations">👁️</span>
                                <span class="icon-fullscreen" title="Afficher en plein écran">🔍</span>
                            </div>
                        </div>
                    </div>

                    <div class="photo-item">
                        <img src="http://mota-version-finale.local/wp-content/uploads/2024/10/nathalie-1-scaled.jpeg" alt="Photo 2">
                        <div class="overlay">
                            <div class="icons">
                                <span class="icon-eye" title="Voir les informations">👁️</span>
                                <span class="icon-fullscreen" title="Afficher en plein écran">🔍</span>
                            </div>
                        </div>
                    </div>
                    <div class="photo-item">
                        <img src="http://mota-version-finale.local/wp-content/uploads/2024/10/nathalie-2-scaled.jpeg" alt="Photo 3">
                        <div class="overlay">
                            <div class="icons">
                                <span class="icon-eye" title="Voir les informations">👁️</span>
                                <span class="icon-fullscreen" title="Afficher en plein écran">🔍</span>
                            </div>
                        </div>
                    </div>
                    <div class="photo-item">
                        <img src="http://mota-version-finale.local/wp-content/uploads/2024/10/nathalie-3-scaled.jpeg" alt="Photo 4">
                        <div class="overlay">
                            <div class="icons">
                                <span class="icon-eye" title="Voir les informations">👁️</span>
                                <span class="icon-fullscreen" title="Afficher en plein écran">🔍</span>
                            </div>
                        </div>
                    </div>
                    <div class="photo-item">
                        <img src="http://mota-version-finale.local/wp-content/uploads/2024/10/nathalie-4-scaled.jpeg" alt="Photo 5">
                        <div class="overlay">
                            <div class="icons">
                                <span class="icon-eye" title="Voir les informations">👁️</span>
                                <span class="icon-fullscreen" title="Afficher en plein écran">🔍</span>
                            </div>
                        </div>
                    </div>
                    <div class="photo-item">
                        <img src="http://mota-version-finale.local/wp-content/uploads/2024/10/nathalie-5-scaled.jpeg" alt="Photo 6">
                        <div class="overlay">
                            <div class="icons">
                                <span class="icon-eye" title="Voir les informations">👁️</span>
                                <span class="icon-fullscreen" title="Afficher en plein écran">🔍</span>
                            </div>
                        </div>
                    </div>
                    <div class="photo-item">
                        <img src="http://mota-version-finale.local/wp-content/uploads/2024/10/nathalie-6-scaled.jpeg" alt="Photo 7">
                        <div class="overlay">
                            <div class="icons">
                                <span class="icon-eye" title="Voir les informations">👁️</span>
                                <span class="icon-fullscreen" title="Afficher en plein écran">🔍</span>
                            </div>
                        </div>
                    </div>
                    <div class="photo-item">
                        <img src="http://mota-version-finale.local/wp-content/uploads/2024/10/nathalie-7-scaled.jpeg" alt="Photo 8">
                        <div class="overlay">
                            <div class="icons">
                                <span class="icon-eye" title="Voir les informations">👁️</span>
                                <span class="icon-fullscreen" title="Afficher en plein écran">🔍</span>
                            </div>
                        </div>
                    </div>
                </div>


                <button id="bouton-charger-plus">Charger plus</button>


                <button
	class="js-load-comments"
    data-postid="<?php echo get_the_ID(); ?>"
    data-nonce="<?php echo wp_create_nonce('capitaine_load_comments'); ?>"
    data-action="capitaine_load_comments"
    data-ajaxurl="<?php echo admin_url( 'admin-ajax.php' ); ?>"
>
























        </div>


<?
get_footer();
?>