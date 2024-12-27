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
while (have_posts()) :
    the_post();
    get_template_part('template-parts/content/content-page');

    // If comments are open or there is at least one comment, load up the comment template.
    if (comments_open() || get_comments_number()) {
        comments_template();
    }
endwhile; // fin de la boucle.


wp_reset_postdata(); // Réinitialiser | Données de publication à leur état d'origine 
?>


<div id="hero">
    <img class="imagehero" src="http://mota-version-finale.local/wp-content/uploads/2024/10/samantha-gades-fIHozNWfcvs-unsplash-1-scaled.jpg" alt="image d'un groupe">
    <h1 class="hero-header_page-title">Photographe Event</h>

</div>
<div id="container">
    <main id="content" role="main">





        <div class="filters-and-sort">
            <!-- Filtre | Categorie -->

            <select name="category-filter" id="category-filter" class="custom-select">
                <option value="ALL">CATÉGORIES</option>
                <?php
                $photo_categories = get_terms('cateegories');
                foreach ($photo_categories as $category) {
                    echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
                }
                ?>
            </select>




            <!-- Filtre | Formats -->

            <select name="format-filter" id="format-filter" class="custom-select">
                <option value="ALL">FORMATS</option>
                <?php

                $photo_formats = get_terms('formats');

                foreach ($photo_formats as $format) {
                    echo '<option value="' . esc_attr($format->slug) . '">' . esc_html($format->name) . '</option>';
                }
                ?>
            </select>



            <select name="date-sort" id="date-sort" class="custom-select">
                <option value="DESC">TRIER PAR</option>
                <option value="DESC">Du plus récent au plus ancien</option>
                <option value="ASC">Du plus ancien au plus récent</option>
            </select>
        </div>


        <div class="accueil-content">
            <?php

            // Récupère 8 photos aléatoires
            $args_related_photos = array(
                'post_type' => 'photos',
                'posts_per_page' => 8,
                'orderby' => 'rand',

            );

            $related_photos_query = new WP_Query($args_related_photos);

            while ($related_photos_query->have_posts()) :
                $related_photos_query->the_post();

                $image_id = get_field('image'); // On récupère cette fois l'ID

                if ($image_id) {
                    echo wp_get_attachment_image($image_id, 'full');
                    
                    
                    $post_permalink = get_permalink(); // Exemple pour obtenir un lien permanent WordPress
                    
                    echo "<a href=\"" . esc_url($post_permalink) . "\"><img src=\"$image_id\" alt=\"\"></a>";
                    
                    
                }
            endwhile;
            wp_reset_postdata(); // Réinitialise la requête globale
            ?>
        </div>




        <div class="photos-container">
    <!-- Les images apparaîtront ici -->
</div>







<button id="bouton-charger-plus" 
        class="js-load-photos" 
        data-nonce="<?php echo wp_create_nonce('load_images_nonce'); ?>" 
        data-ajaxurl="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
    Charger plus
</button>







</div>


<?
get_footer();
?>