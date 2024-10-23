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
                  <img src="http://mota-version-finale.local/wp-content/uploads/2024/10/Logo.png" alt="">             
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


        </header>
        <div id="container">
            <main id="content" role="main">

            