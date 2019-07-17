<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ort-site-2019
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type='text/javascript' src='//ajax.googleapis.com/ajax/libs/jquery/1.4/jquery.min.js'></script>
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <!--<link rel="stylesheet" href="https://i.icomoon.io/public/temp/28d371a311/UntitledProject/style.css"> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css"
          integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.typekit.net/pko8dbv.css">
    <link href="https://fonts.googleapis.com/css?family=Mada:400,700&display=swap&subset=arabic" rel="stylesheet">
	<link rel="canonical" href="https://mapa-linux-new.ort.org.il<?php echo $_SERVER['REQUEST_URI']; ?>"/>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
    <a class="skip-link screen-reader-text"
       href="#content"><?php esc_html_e( 'Skip to content', 'ort_site_2019' ); ?></a>

    <header id="masthead" class="site-header">
        <div class="site-branding">
            <div class="right-logos">
                <div class="ort-logo-img">
					<?php
					the_custom_logo();
					if ( is_front_page() && is_home() ) :
						?>
                        <h1 class="site-title"><a href="<?php echo get_home_url(); ?>"
                                                  rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
					else :
						?>
                        <p class="site-title"><a href="<?php echo get_home_url(); ?>"
                                                 rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
					endif;
					$ort_site_2019_description = get_bloginfo( 'description', 'display' );
					if ( $ort_site_2019_description || is_customize_preview() ) :
						?>
                        <p class="site-description screen-reader-text"><?php echo $ort_site_2019_description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
                </div>

                <div class="ort-logo-words">
                    <a href="<?php echo get_home_url(); ?>"><?php _e( 'ort israel', 'ort_site_2019' ); ?></a>
                </div>
            </div>

            <div class="logo-tech">
                <a href="https://www.israel-scitech-schools.com/"><?php _e( 'ort tech', 'ort_site_2019' ); ?></a>
            </div>
        </div><!-- .site-branding -->

        <nav id="site-navigation" class="main-navigation">
            <button class="menu-toggle" aria-controls="primary-menu"
                    aria-expanded="false"><?php esc_html_e( 'Primary Menu', 'ort_site_2019' ); ?></button>
			<?php
			wp_nav_menu( array(
				'theme_location'  => 'menu-1',
				'menu_id'         => 'primary-menu',
				'container_class' => 'site-menu',
			) );
			?>
            <div class="popover-parent-search">
                <a href="javascript:void(0)" class="search-btn" role="search">
                    <i class="fa" aria-hidden="false"></i>
                    <span>חיפוש</span>
                </a>
				<?php get_search_form(); ?>
            </div>
			<?php
			$walker = new ortsite2019\Menu_With_Description;
			wp_nav_menu( array(
				'theme_location'  => 'languages',
				'container'       => 'div',
				'container_class' => 'languages',
				'walker'          => $walker,
			) );
			?>
        </nav><!-- #site-navigation -->
    </header><!-- #masthead -->

    <div id="content" class="site-content">
