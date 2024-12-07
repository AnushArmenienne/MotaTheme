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




	
function load_images_from_photos_cpt() {
    // Vérification de sécurité
    if (
        !isset($_REQUEST['nonce']) ||
        !wp_verify_nonce($_REQUEST['nonce'], 'load_images_nonce')
    ) {
        wp_send_json_error("Action non autorisée.", 403);
    }

    // Récupérer la page actuelle pour la pagination
    $paged = isset($_POST['paged']) ? intval($_POST['paged']) : 1;

    // Requête pour récupérer les articles de type "photos" avec leurs images attachées
    $query_args = [
        'post_type'      => 'photos', // CPT "photos"
        'posts_per_page' => 8,        // Nombre d'articles par requête
        'paged'          => $paged,
        'post_status'    => 'publish',
    ];

    $query = new WP_Query($query_args);

    if (!$query->have_posts()) {
        wp_send_json_error("Aucune photo trouvée dans les articles.", 404);
    }

    $html = '';

    // Parcourir les articles
    while ($query->have_posts()) {
        $query->the_post();

        // Obtenir les images attachées à l'article
        $attachment_ids = get_attached_media('image', get_the_ID());

        // Parcourir les images attachées
        foreach ($attachment_ids as $attachment) {
            // Obtenir l'URL de l'image
            $image_url = wp_get_attachment_url($attachment->ID);
            $alt_text = get_post_meta($attachment->ID, '_wp_attachment_image_alt', true);

            if ($image_url) {
                $html .= "<div class='photo-item'><img src='" . esc_url($image_url) . "' alt='" . esc_attr($alt_text) . "'></div>";
            }
        }
    }

    wp_reset_postdata();

    // Envoyer le HTML et la page suivante
    wp_send_json_success([
        'html'  => $html,
        'paged' => $paged + 1,
    ]);
}
add_action('wp_ajax_load_images', 'load_images_from_photos_cpt');
add_action('wp_ajax_nopriv_load_images', 'load_images_from_photos_cpt');
