<?php
get_header();
while (have_posts()):
    the_post();
?>



    <h1 class="titre"> <?php the_title(); ?> </h1>

    <div class="reference">REFERENCE: <?php the_field('reference'); ?></div>


    <div class="categorie">
        CATEGORIE:
        <?php

        $categories = get_the_terms(get_the_ID(), 'categorie');
        if (!empty($categories) && !is_wp_error($categories)) {
            $categorie_names = wp_list_pluck($categories, 'name');
            echo implode(', ', $categorie_names);
        } else {
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
        }
        ?>
    </div>

    <div class="type">TYPE: <?php the_field('type'); ?></div>
    <h1 class="date"> <?php the_date(); ?> </h1>



    <div>
        <?php
        $image_id = get_field('image'); // On récupère cette fois l'ID

        if ($image_id) {
            echo wp_get_attachment_image($image_id, 'full');
            echo '<img class="images" src="' . esc_url($image_id) . '" alt="">';
        }

        ?>
    </div>

    <hr class="trait1">
    <div class="phrasebouton">
        <div class="texte-contact">
            <p>Cette photo vous intéresse ?</p>
        </div>



        <!-- Bouton Contact -->
        <button type="button" class="bouton" data-bs-toggle="modal" data-bs-target="#videoModal">
            Contact
        </button>

        <!-- Modal -->
        <div class="modal" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="bg-background border-0">
                    <img class="modalphoto" src="http://mota-version-finale.local/wp-content/uploads/2024/11/Contact-header.png" alt="image header de contact" id="contact">

                    <div class="modal-body overflow-hidden p-0">
                        <div class="rounded-bottom-4" id="videoplayer">
                            <?php echo do_shortcode('[contact-form-7 id="2dca0ca" title="Formulaire de contact 1"]'); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr class="trait2">

<?php
endwhile;
get_footer();
?>