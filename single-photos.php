<?php

get_header();
while(have_posts()):
    the_post();
?>

<div>
<div class="description">
    <h1> <?php the_title(); ?> </h1>
<div class="description_photo">
    <div class="review__reference">Référence: <?php the_field( 'reference' ); ?></div>
    <div class="review__categorie">Catégorie: <?php the_field( 'categorie' ); ?></div>
    <div class="review__format">Format: <?php the_field( 'format' ); ?></div>
    <div class="review__type">Type: <?php the_field( 'type' ); ?></div>
    <div class="review__annee">Année: <?php the_field( 'annee' ); ?></div>
</div>
</div>

    <?php 
    $image_id = get_field( 'images' ); // On récupère cette fois l'ID
    if( $image_id ) {   
        echo wp_get_attachment_image( $image_id, 'full' );
    }
    ?>
    
    <div class="texte-contact">
        <p>Cette photo vous intéresse ?</p>
    </div>

    <div class="bouton-contact">
        <?php include get_template_directory() . '/template-parts/modale.php'; ?>

    </div>
          
</div>

<?php
endwhile;
get_footer();
?>