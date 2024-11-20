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

<div id="hero">
    <img src="/wp-content/uploads/2024/10/nathalie-11-scaled.jpeg" alt="image d'un groupe de personnes à une fête" id="hero">
    <h1 class="hero-header__page-title">Photographe Event</h1>
</div>

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

</div>
<!-- Section | Filtres -->
<div class="filters-and-sort">
<!-- Filtre | Categorie -->
<label for="category-filter"></label>
<select name="category-filter" id="category-filter">
    <option value="ALL">CATÉGORIE</option>
    <?php
    $photo_categories = get_terms('categorie');
    foreach ($photo_categories as $category) {
        echo '<option value="' . $category->slug . '">' . $category->name . '</option>';
    }
    ?>
</select>

<!-- Filtre | Format -->
<label for="format-filter"></label>
<select name="format-filter" id="format-filter">
    <option value="ALL">FORMAT</option>
    <?php
    $photo_formats = get_terms('format');
    foreach ($photo_formats as $format) {
        echo '<option value="' . $format->slug . '">' . $format->name . '</option>';
    }
    ?>
</select>

<!-- Filtre | Trier par date -->
<label for="date-sort"></label>
<select name="date-sort" id="date-sort">
    <option value="ALL">TRIER PAR</option>
    <option value="DESC">Du plus récent au plus ancien</option>
    <option value="ASC">Du plus ancien au plus récent</option>
</select>
</div>

<!-- Section | Bloc de photos -->
<div id="photo-container">
    <?php include get_template_directory() . '/template-parts/photo_block.php'; ?>
</div>

<?
get_footer();
?>
