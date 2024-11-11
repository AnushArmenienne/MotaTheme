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



