<?php
/**
 * ort-site-2019 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package ort-site-2019
 */

if ( ! function_exists( 'ort_site_2019_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function ort_site_2019_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on ort-site-2019, use a find and replace
		 * to change 'ort_site_2019' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'ort_site_2019', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus( array(
			'menu-1'    => esc_html__( 'Primary', 'ort_site_2019' ),
			'languages' => esc_html__( 'Languages', 'ort_site_2019' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'ort_site_2019_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support( 'custom-logo', array(
			'height'      => 250,
			'width'       => 250,
			'flex-width'  => true,
			'flex-height' => true,
		) );
		add_theme_support( 'post-formats', array( 'link' ) );

		update_option('medium_crop', 1);

		// define thumbnail sizes
		define( 'RECTANGLE_WIDE_WIDTH', 300 ); /* videort post */
		define( 'RECTANGLE_WIDE_HEIGHT', 170 );

		add_image_size( 'rectangle_wide', RECTANGLE_WIDE_WIDTH, RECTANGLE_WIDE_HEIGHT, true );

		// define thumbnail sizes
		define( 'RECTANGLE_NARROW_WIDTH', 270 ); /* newsletter post */
		define( 'RECTANGLE_NARROW_HEIGHT', 245 );

		add_image_size( 'rectangle_narrow', RECTANGLE_NARROW_WIDTH, RECTANGLE_NARROW_HEIGHT, true );
	}
endif;
add_action( 'after_setup_theme', 'ort_site_2019_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function ort_site_2019_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'ort_site_2019_content_width', 640 );
}

add_action( 'after_setup_theme', 'ort_site_2019_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function ort_site_2019_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'ort_site_2019' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'ort_site_2019' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

add_action( 'widgets_init', 'ort_site_2019_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function ort_site_2019_scripts() {
    wp_dequeue_style('ort_site_2019-style');
	wp_enqueue_style( 'ort_site_2019-style', get_stylesheet_uri(), array(), filemtime(get_stylesheet_directory() . '/style.css') );

	wp_enqueue_style( 'ort_site_2019-arabic-fonts', ort_site_2019_fonts_url(), array(), null );

	wp_enqueue_script( 'ort_site_2019-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );

	wp_enqueue_script( 'ort_site_2019-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );

	wp_enqueue_script( 'ort-scripts', get_template_directory_uri() . '/js/ort-scripts.js', array(), wp_get_theme()->get('Version'), true );

	wp_enqueue_script( 'ort-accessibility-scripts', get_template_directory_uri() . '/js/ort-accessibility-scripts.js', array(), wp_get_theme()->get('Version'), true );

    wp_enqueue_script( 'object-fit-images', get_template_directory_uri() . '/js/ofi.min.js', array(), '3.2.4', true );


    /* Add localization strings */
	// get strings from language files, and put them into javascript variables
	$params = array(
		'langEnglish' => __( 'English', 'ort_site_2019' ),
		'langArabic'  => __( 'Arabic', 'ort_site_2019' ),
		'search'      => __( 'Search', 'ort_site_2019' ),
	);
	// create inline definitions of these vars, for use in the script.js file
	wp_localize_script( 'ort-scripts', 'OrtScriptParams', $params );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'ort_site_2019_scripts' );


/**
 * Add Google fonts - Alef
 * Taken from: http://themeshaper.com/2014/08/13/how-to-add-google-fonts-to-wordpress-themes/
 * @return string
 */
function ort_site_2019_fonts_url() {

	$font_families   = array();
	$font_families[] = 'Mada:400,700';
	$query_args      = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'arabic' ),
	);
	$fonts_url       = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	return esc_url_raw( $fonts_url );
}

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}
/**
 * Out theme specific additions.
 */
require get_template_directory() . '/inc/Categories.php';

require get_template_directory() . '/inc/home-functions.php';

require get_template_directory() . '/inc/utilities.php';

require get_template_directory() . '/inc/Menu_With_Description.php';

/* this function was written to play the video in main banner iPod|iPhone|iPad */
function add_autoplay_fix_ios() {?>
    <script type="text/javascript">
        var myvideos = document.querySelectorAll('.background-mainimg video');
        if (navigator.userAgent.match( /(iPod|iPhone|iPad)/ ) ) {
            for (let index = 0; index < myvideos.length; index++) {
                myvideos[index].setAttribute("playsinline","");
            }
        }
    </script>
    <?php }
add_action('wp_footer', 'add_autoplay_fix_ios');

/* Change archive title if cool timeline archive */
function ort_archive_title($title){
    if ("Timeline Stories" === $title) {
        $title = __('Timeline Stories', 'ort_site_2019');
    }

    return $title;
}
add_filter("post_type_archive_title", "ort_archive_title", 10, 2);

/* Remove description if cool timeline archive */
function ort_post_type_description($description, $post_type_obj){
    if ("cool_timeline" === $post_type_obj->name) {
        $description = NULL;
    }

    return $description;
}
add_filter("get_the_post_type_description", "ort_post_type_description", 10, 2);
