<?php 
// Ajout style CSS et JS
function ajout_CSS_script() {
    // JS
 wp_enqueue_script('script-global', get_template_directory_uri() . '/scripts.js', array('jquery'), '1.1', true);
    // CSS
    wp_enqueue_style('style', get_stylesheet_uri(), array(), '1.0');
}

add_action( 'wp_enqueue_scripts', 'ajout_CSS_script' );




function register_my_menu() {
    register_nav_menus(
        array(
            'header-menu' => __( 'Header Menu' ),
            'footer-menu' => __( 'Footer Menu' )
        )
    );
    }
add_action( 'init', 'register_my_menu' );





// Enregistrement des taxonomies
function create_photo_taxonomies() {
    register_taxonomy('categorie', 'photo', array(
        'labels' => array(
            'name' => 'categories',
            'singular_name' => 'categorie',
            'all_items' => 'Toutes les catégories',
            'edit_item' => 'Modifier la catégorie',
            'view_item' => 'Voir la catégorie',
            'add_new_item' => 'Ajouter une nouvelle catégorie',
        ),
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true, // Nécessaire pour que l'API REST les supporte
    ));

    // Taxonomie pour les formats
    register_taxonomy('format', 'photo', array(
        'labels' => array(
            'name' => 'Formats',
            'singular_name' => 'Format',
            'all_items' => 'Tous les formats',
            'edit_item' => 'Modifier le format',
            'view_item' => 'Voir le format',
            'add_new_item' => 'Ajouter un nouveau format',
        ),
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true, // Nécessaire pour que l'API REST les supporte
    ));
}
add_action('init', 'create_photo_taxonomies');




