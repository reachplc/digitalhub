<?php
/**
 * DigitalHub functions and definitions
 *
 * @package DigitalHub
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'digitalhub_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function digitalhub_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on DigitalHub, use a find and replace
	 * to change 'digitalhub' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'digitalhub', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Add support for extra menu.
	add_theme_support('menus');

	// This theme uses wp_nav_menu() in one location.
	//register_nav_menus( array(
	//	'primary' => __( 'Primary Menu', 'digitalhub' ),
	//	'secondary' => __( 'Secondary Menu' ),
	//) );

add_action( 'init', 'my_custom_menus' );
      function my_custom_menus() {
         register_nav_menus(
            array(
      'primary-menu' => __( 'Primary Menu' ),
      'secondary-menu' => __( 'Secondary Menu' )
                    )
             );
      }

	// Enable support for Post Formats.
	add_theme_support( 'post-formats', array( 'aside', 'image', 'video', 'quote', 'link' ) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'digitalhub_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
}
endif; // digitalhub_setup
add_action( 'after_setup_theme', 'digitalhub_setup' );

/**
 * Register widgetized area and update sidebar with default widgets.
 */
function digitalhub_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'digitalhub' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h1 class="widget-title">',
		'after_title'   => '</h1>',
	) );
}
add_action( 'widgets_init', 'digitalhub_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function digitalhub_scripts() {
	wp_enqueue_style( 'digitalhub-style', get_stylesheet_uri() );

  #wp_enqueue_script( 'digitalhub-searchslide', get_template_directory_uri() . '/js/search-slide.js', array('jquery'));

  #wp_enqueue_script( 'digitalhub-hero', get_template_directory_uri() . '/js/jquery.randomHero.js', array());

  #wp_enqueue_script( 'digitalhub-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );

  #wp_enqueue_script( 'digitalhub-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );

  wp_enqueue_script( 'digitalhub-global', get_template_directory_uri() . '/js/global.js', array(), '20130314', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'digitalhub_scripts' );

function digitalhub_scripts_adverts() {
  global $post_type;
  if( $post_type == 'adverts' ) {

    wp_enqueue_script( 'digitalhub-fitvid', get_template_directory_uri() . '/js/lib/jquery.fitvids.js', array('jquery'), '20130816', true );

    wp_enqueue_script( 'digitalhub-exampleSwitcher', get_template_directory_uri() . '/js/jquery.exampleSwitcher.js', array('jquery'), '20130816', true );

  }
}

add_action( 'wp_enqueue_scripts', 'digitalhub_scripts_adverts' );

  function digitalhub_scripts_map() {
  global $page;
  if( $page == 'regions') {
    wp_enqueue_script( 'digitalhub-rwdImageMaps', get_template_directory_uri() . '/js/lib/jquery.rwdImageMaps.js', array('jquery'), '20140124', true );
  }
}

add_action( 'wp_enqueue_scripts', 'digitalhub_scripts_map' );

  function digitalhub_scripts_contacts() {
  global $page;
  if( $page == 'contacts') {

    wp_enqueue_script( 'digitalhub-contactMaps', get_template_directory_uri() . '/js/contact-maps.js', array('jquery'), '20140211', true );

    wp_enqueue_script( 'digitalhub-googleMaps', 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false', '20140313', true );

  }
}

add_action( 'wp_enqueue_scripts', 'digitalhub_scripts_contacts' );

/**
 * Add custom web fonts
 */

function load_fonts() {
  wp_register_style('googleapisFonts', 'http://fonts.googleapis.com/css?family=Open+Sans:600,300');
  wp_enqueue_style( 'googleapisFonts');
}

add_action('wp_print_styles', 'load_fonts');

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

function wpb_adding_scripts() {
  wp_register_script('toggle-nav', get_template_directory_uri() . '/js/jquery.toggle-nav.js', array('jquery'),'0.0.0', true);
  wp_enqueue_script('toggle-nav');
}

/**
	* Custom Login Logo
	*/

add_action("login_head", "my_login_head");
function my_login_head() {
	echo "
	<style>
	body.login #login h1 a {
		background: url('".get_bloginfo('template_url')."/images/logo-login.png') no-repeat scroll center top transparent;
		height: 83px;
		width: 300px;
	}
	</style>
	";
}

/**
 * Set amount of posts to show in archives
 */

function per_category_basis($query) {
  if (is_post_type_archive( 'adverts' )) {
    $query->set('posts_per_archive_page', 100);
  }
  return $query;
}

add_filter('pre_get_posts', 'per_category_basis');

/**
 * HTML5 Shiv
 * Enables use of HTML5 sectioning elements in legacy Internet
 * Explorer and provides basic HTML5 styling for Internet Explorer 6-9
 */

// add ie conditional html5 shim to header
function add_ie_html5_shim () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="'. get_stylesheet_directory_uri() .'/js/lib/html5shiv-printshiv.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'add_ie_html5_shim');

/**
 * Respond
 * A fast & lightweight polyfill for min/max-width CSS3 Media Queries
 * (for IE 6-8, and more).
 */

// add ie conditional respond to header
function add_ie_respond () {
    echo '<!--[if lt IE 9]>';
    echo '<script src="'. get_stylesheet_directory_uri() .'/js/lib/respond.min.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'add_ie_respond');
