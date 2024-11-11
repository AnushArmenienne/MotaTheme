<?php
get_header();
while (have_posts()):
    the_post();
?>

    <div>
        <div class="description">
        <h1 class="titre"> <?php the_title(); ?> </h1>
            <div class="description_photo">
                <div class="reference">REFERENCE: <?php the_field('reference'); ?></div>
                
                

                <div class="categorie">
            CATEGORIE:
            <?php
            // Récupère les termes de la taxonomie 'categorie' pour le post actuel
            $categories = get_the_terms(get_the_ID(), 'categorie');
            if (!empty($categories) && !is_wp_error($categories)) {
                $categorie_names = wp_list_pluck($categories, 'name');
                echo implode(', ', $categorie_names); // Affiche les noms des catégories, séparés par des virgules
            } else {
                echo 'Non spécifié';
            }
            ?>
        </div>


        <div class="format">
            FORMAT:
            <?php
            // Récupère les termes de la taxonomie 'formats' pour le post actuel
            $formats = get_the_terms(get_the_ID(), 'formats');
            if (!empty($formats) && !is_wp_error($formats)) {
                $format_names = wp_list_pluck($formats, 'name');
                echo implode(', ', $format_names); // Affiche les noms des formats, séparés par des virgules
            } else {
                echo 'Non spécifié';
            }
            ?>
        </div>









                <div class="type">TYPE: <?php the_field('type'); ?></div>
                <h1> <?php the_date(); ?> </h1>
            </div>

        </div>
       
       















        <?php
        $image_id = get_field('image'); // On récupère cette fois l'ID

        if ($image_id) {
            echo wp_get_attachment_image($image_id, 'full');
           echo "<img src=\"$image_id\" class=\"imagemariée\" alt=\"\">";

        }

        ?>

        <div class="texte-contact">
            <p>Cette photo vous intéresse ?</p>
        </div>

        <div class="bouton-contact">
            <?php include get_template_directory() . '/template-parts/'; ?>

        </div>

    </div>

<?php
endwhile;
get_footer();
?>