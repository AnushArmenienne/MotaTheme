<!DOCTYPE html>
<html>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <div id="wrapper" class="hfeed">
        <header id="header" role="banner">
            <div id="branding">
                <img class="logo" src="http://mota-version-finale.local/wp-content/uploads/2024/10/Logo.png" alt="">
            </div>

            <div id="menu">
                <?php
                wp_nav_menu(
                    array(
                        'theme_location' => 'header-menu',
                        'container_class' => 'header-menu-class'
                    )
                );
                ?>
            </div>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>



            <div class="modal" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="bg-background border-0">
                    <img class="modalphoto" src="http://mota-version-finale.local/wp-content/uploads/2024/11/Contact-header.png" alt="image header de contact" id="contact">
                        
                        <div class="modal-body overflow-hidden p-0">
                            <div class="rounded-bottom-4" src="" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen id="videoplayer">
                                <?php echo do_shortcode('[contact-form-7 id="2dca0ca" title="Formulaire de contact 1"]'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
        </header>
        <div id="hero">
                <img class="imagehero" src="http://mota-version-finale.local/wp-content/uploads/2024/10/samantha-gades-fIHozNWfcvs-unsplash-1-scaled.jpg" alt="image d'un groupe">
                <h1 class="hero-header_page-title">Photographe Event</h>

            </div>
        <div id="container">
            <main id="content" role="main">