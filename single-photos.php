<?php
get_header();
while (have_posts()):
    the_post();
?>

    <div class="pagesingle">
        <div class="blocgauche">
            <h1 class="titre"> <?php the_title(); ?> </h1>

            <div class="reference">REFERENCE: <?php the_field('reference'); ?>
            </div>




            <div class="categorie">
                CATEGORIE:
                <?php
                $categories = get_the_terms(get_the_ID(), 'cateegories'); // Utiliser 'categorie', pas 'categories'
                if (!empty($categories) && !is_wp_error($categories)) {
                    $categorie_names = wp_list_pluck($categories, 'name');
                    echo implode(', ', $categorie_names); // Affiche les noms des catégories
                } else {
                    echo 'Aucune catégorie'; // Affichage si aucune catégorie n'est assignée
                }
                ?>
            </div>


            <div class="format">
                FORMAT:
                <?php

                $formats = get_the_terms(get_the_ID(), 'formats');
                if (!empty($formats) && !is_wp_error($formats)) {
                    $format_names = wp_list_pluck($formats, 'name');
                    echo implode(', ', $format_names);
                } else {
                    echo 'Aucun format'; // Affichage si aucun format n'est assigné
                }
                ?>
            </div>

            <div class="type">TYPE: <?php the_field('type'); ?></div>

            <div class="annee">
                ANNEE:
                <?php the_date("Y"); ?>
            </div>
            <div class="barre">
                <hr>
            </div>
            <div class="bloccontact">
                <div class="texte-contact">
                    <p>Cette photo vous intéresse ?</p>
                </div>
                <!-- Bouton Contact -->
                <button type="button" class="bouton" data-bs-toggle="modal" data-bs-target="#videoModal">
                    Contact
                </button>
                <?php include get_template_directory() . '/templates_part/modale.php'; ?>
                <?php
                // Récupérer la valeur ACF pour la référence
                $reference = get_field('reference');
                if ($reference) {
                    echo '<script type="text/javascript">';
                    echo 'var acfReferencePhoto = "' . esc_js($reference) . '";'; // Transmettre la référence à JS
                    echo '</script>';
                }
                ?>

            </div>
        </div>



        <div class="blocdroit">
            <?php
            $image_id = get_field('image'); // On récupère cette fois l'ID

            if ($image_id) {
                echo wp_get_attachment_image($image_id, 'full');
                echo '<img class="images" src="' . esc_url($image_id) . '" alt="">';
            }

            ?>



            <?php
            // Récupère l'ID de la publication actuelle.
            $current_post_id = get_the_ID();

            // Récupère toutes les publications de type 'photo'.
            $args = array(
                'post_type' => 'photos',
                'posts_per_page' => -1,
                'order' => 'ASC',
            );
            $all_photo_posts = get_posts($args);

            // Trouve l'index de la publication actuelle dans le tableau de toutes les publications de photos.
            $current_post_index = array_search($current_post_id, array_column($all_photo_posts, 'ID'));

            // Calcule les index des publications précédentes et suivantes.
            $prev_post_index = $current_post_index - 1;
            $next_post_index = $current_post_index + 1;

            // Récupère les publications précédentes et suivantes.
            $prev_post = ($prev_post_index >= 0) ? $all_photo_posts[$prev_post_index] : end($all_photo_posts);
            $next_post = ($next_post_index < count($all_photo_posts)) ? $all_photo_posts[$next_post_index] : reset($all_photo_posts);

            $prev_permalink = get_permalink($prev_post);
            $next_permalink = get_permalink($next_post);

            // Récupère les miniatures des publications précédentes et suivantes.

            $prev_thumbnail = get_the_post_thumbnail($prev_post, 'thumbnail');
            $next_thumbnail = get_the_post_thumbnail($next_post, 'thumbnail');

            if (!$prev_thumbnail || !$next_thumbnail) {
                error_log('Thumbnail URL missing for previous or next post.');
            }
            ?>


            <div class="thumbnail-container">
                <!-- Miniature dynamique pour les flèches -->
                <div id="thumbnail-preview" class="thumbnail-preview"></div>

                <div class="fleches">
                    <!-- Flèche gauche (précédent) -->
                    <a href="<?php echo esc_url($prev_permalink); ?>"
                        class="arrow-link"
                        data-thumbnail="<?php echo esc_url(get_the_post_thumbnail_url($prev_post, 'thumbnail')); ?>"
                        id="prev-arrow-link">
                        <img class="fleche arrow-img-gauche"
                            src="http://mota-version-finale.local/wp-content/uploads/2024/11/Line-6@2x.png"
                            alt="Précédent" />
                    </a>

                    <!-- Flèche droite (suivant) -->
                    <a href="<?php echo esc_url($next_permalink); ?>"
                        class="arrow-link"
                        data-thumbnail="<?php echo esc_url(get_the_post_thumbnail_url($next_post, 'thumbnail')); ?>"
                        id="next-arrow-link">
                        <img class="fleche arrow-img-droite"
                            src="http://mota-version-finale.local/wp-content/uploads/2024/11/Line-7@2x.png"
                            alt="Suivant" />
                    </a>
                </div>
            </div>









        </div>
    </div>

     <div class="pagesingleend">
        <div class="barre">
            <hr>
        </div>

        <!-- Section Photos Apparentées -->
        <div>
            <h3>VOUS AIMEREZ AUSSI</h3>


            <div class="image-container">
                <?php

                // Récupérer le slug de la catégorie de la photo actuelle
                $terms = get_the_terms(get_the_ID(), 'categorie');
                if ($terms && !is_wp_error($terms)) {
                    $slug = $terms[0]->slug; // Prend le slug de la première catégorie (si plusieurs, ajustez selon vos besoins)
                } else {
                    $slug = ''; // Définit un slug par défaut ou gère l'absence de catégorie
                }

                // Récupère deux photos aléatoires de la même catégorie que la photo actuelle.
                $args_related_photos = array(
                    'post_type' => 'photos',
                    'posts_per_page' => 2,
                    'orderby' => 'rand',
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'categorie',
                            'field' => 'slug',
                            'terms' => $slug, // Utilise le slug de la catégorie de la photo actuelle
                        ),
                    ),
                );

                $related_photos_query = new WP_Query($args_related_photos);

                while ($related_photos_query->have_posts()) :
                    $related_photos_query->the_post();

                    $image_id = get_field('image'); // On récupère cette fois l'ID
                   

                    if ($image_id) {
                        echo wp_get_attachment_image($image_id, 'full');
                        echo "<img src=\"$image_id\" class=\"imagemariée\" alt=\"\">";
                    }
                endwhile;
                wp_reset_postdata(); // Réinitialise la requête globale
                ?>
            </div>
           


        </div>
    </div>
<?php

endwhile;
get_footer();
?>