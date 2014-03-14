<?php
/**
 * Plugin Name.
 *
 * @package   Adverts
 * @author    Michael Bragg <michael@michaelbragg.net>
 * @license   GPL-2.0+
 * @link      http://trinitymirror.github.io
 * @copyright 2013 Trinity Mirror Creative
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * If you're interested in introducing administrative or dashboard
 * functionality, then refer to `class-adverts-admin.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package Adverts
 * @author  Michael Bragg <michael@michaelbragg.net>
 */
class Adverts {

  /**
   * Plugin version, used for cache-busting of style and script file references.
   *
   * @since   0.1.0
   *
   * @var     string
   */
  const VERSION = '0.1.0';

  /**
   * @TODO - Rename "adverts" to the name your your plugin
   *
   * Unique identifier for your plugin.
   *
   *
   * The variable name is used as the text domain when internationalizing strings
   * of text. Its value should match the Text Domain file header in the main
   * plugin file.
   *
   * @since    0.1.0
   *
   * @var      string
   */
  protected $plugin_slug = 'adverts';

  /**
   * Instance of this class.
   *
   * @since    0.1.0
   *
   * @var      object
   */
  protected static $instance = null;

  /**
   * Initialize the plugin by setting localization and loading public scripts
   * and styles.
   *
   * @since     0.1.0
   */
  private function __construct() {

    $this->post_type = 'adverts';
    $this->taxonomy_format = 'formats';
    $this->taxonomy_packages = 'packages';

    // Load plugin text domain
    add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

    // Activate plugin when new blog is added
    add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

    // Load public-facing style sheet and JavaScript.
    //add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
    //add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

    // Define custom functionality.
    add_action( 'init', array( $this, 'adverts_cpt' ) );
    add_action( 'init', array( $this, 'format_taxonomy' ) );
    add_action( 'init', array( $this, 'packages_taxonomy' ) );

    // Define custom template order.
    add_action("template_redirect", array( $this, 'adverts_template_redirect' ) );

    add_action('template_redirect', array( $this, 'taxonomy_template_redirect' ) );

    // Include functions for outputting info to themes

    include(plugin_dir_path( __FILE__ ) . 'includes/example' . '.php');
    include(plugin_dir_path( __FILE__ ) . 'includes/build-guide' . '.php');
    include(plugin_dir_path( __FILE__ ) . 'includes/packages' . '.php');
    include( plugin_dir_path( __FILE__ ) . 'includes/current-items' . '.php' );
  }

  /**
   * Return the plugin slug.
   *
   * @since    0.1.0
   *
   * @return    Plugin slug variable.
   */
  public function get_plugin_slug() {
    return $this->plugin_slug;
  }

  /**
   * Return an instance of this class.
   *
   * @since     0.1.0
   *
   * @return    object    A single instance of this class.
   */
  public static function get_instance() {

    // If the single instance hasn't been set, set it now.
    if ( null == self::$instance ) {
      self::$instance = new self;
    }

    return self::$instance;
  }

  /**
   * Fired when the plugin is activated.
   *
   * @since    0.1.0
   *
   * @param    boolean    $network_wide    True if WPMU superadmin uses
   *                                       "Network Activate" action, false if
   *                                       WPMU is disabled or plugin is
   *                                       activated on an individual blog.
   */
  public static function activate( $network_wide ) {

    if ( function_exists( 'is_multisite' ) && is_multisite() ) {

      if ( $network_wide  ) {

        // Get all blog ids
        $blog_ids = self::get_blog_ids();

        foreach ( $blog_ids as $blog_id ) {

          switch_to_blog( $blog_id );
          self::single_activate();
        }

        restore_current_blog();

      } else {
        self::single_activate();
      }

    } else {
      self::single_activate();
    }

  }

  /**
   * Fired when the plugin is deactivated.
   *
   * @since    0.1.0
   *
   * @param    boolean    $network_wide    True if WPMU superadmin uses
   *                                       "Network Deactivate" action, false if
   *                                       WPMU is disabled or plugin is
   *                                       deactivated on an individual blog.
   */
  public static function deactivate( $network_wide ) {

    if ( function_exists( 'is_multisite' ) && is_multisite() ) {

      if ( $network_wide ) {

        // Get all blog ids
        $blog_ids = self::get_blog_ids();

        foreach ( $blog_ids as $blog_id ) {

          switch_to_blog( $blog_id );
          self::single_deactivate();

        }

        restore_current_blog();

      } else {
        self::single_deactivate();
      }

    } else {
      self::single_deactivate();
    }

  }

  /**
   * Fired when a new site is activated with a WPMU environment.
   *
   * @since    0.1.0
   *
   * @param    int    $blog_id    ID of the new blog.
   */
  public function activate_new_site( $blog_id ) {

    if ( 1 !== did_action( 'wpmu_new_blog' ) ) {
      return;
    }

    switch_to_blog( $blog_id );
    self::single_activate();
    restore_current_blog();

  }

  /**
   * Get all blog ids of blogs in the current network that are:
   * - not archived
   * - not spam
   * - not deleted
   *
   * @since    0.1.0
   *
   * @return   array|false    The blog ids, false if no matches.
   */
  private static function get_blog_ids() {

    global $wpdb;

    // get an array of blog ids
    $sql = "SELECT blog_id FROM $wpdb->blogs
      WHERE archived = '0' AND spam = '0'
      AND deleted = '0'";

    return $wpdb->get_col( $sql );

  }

  /**
   * Fired for each blog when the plugin is activated.
   *
   * @since    0.1.0
   */
  private static function single_activate() {
    // @TODO: Define activation functionality here
  }

  /**
   * Fired for each blog when the plugin is deactivated.
   *
   * @since    0.1.0
   */
  private static function single_deactivate() {
    // @TODO: Define deactivation functionality here
  }

  /**
   * Load the plugin text domain for translation.
   *
   * @since    0.1.0
   */
  public function load_plugin_textdomain() {

    $domain = $this->plugin_slug;
    $locale = apply_filters( 'plugin_locale', get_locale(), $domain );

    load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );

  }

  /**
   * Register and enqueue public-facing style sheet.
   *
   * @since    0.1.0
   */
  public function enqueue_styles() {
    wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'assets/css/public.css', __FILE__ ), array(), self::VERSION );
  }

  /**
   * Register and enqueues public-facing JavaScript files.
   *
   * @since    0.1.0
   */
  public function enqueue_scripts() {
    wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'assets/js/public.js', __FILE__ ), array( 'jquery' ), self::VERSION );
  }

  /**
   * Setup the Advert Custom Post Type
   *
   * @since    0.1.0
   */
  public function adverts_cpt() {
    $adverts_labels = array(
      'name' => _x('Adverts', 'post type general name'),
      'singular_name' => _x('Advert', 'post type singular name'),
      'add_new' => __('Add New Advert'),
      'add_new_item' => __("Add New Advert"),
      'edit_item' => __("Edit Advert"),
      'new_item' => __("New Advert"),
      'view_item' => __("View Adverts"),
      'search_items' => __("Search Advert"),
      'not_found' =>  __('No Advert found'),
      'not_found_in_trash' => __('No Advert found in Trash'),
      'parent_item_colon' => ''
    );
    $adverts_args = array(
      'labels' => $adverts_labels,
      'public' => true,
      'publicly_queryable' => true,
      'show_ui' => true,
      'query_var' => true,
      'rewrite' => array( 'slug' => 'adverts' ),
      'hierarchical' => false,
      'menu_position' => 5,
      'capability_type' => 'post',
      'supports' => array('title', 'editor', 'thumbnail'),
      //  TODO: link image to plugin admin assets folder
      //'menu_icon' => get_bloginfo('template_directory') . '/images/photo-album.png', //16x16 png if you want an icon
      'taxonomies' => array('formats', 'packages'),
      'has_archive' => true
    );

    register_post_type('adverts', $adverts_args);

  }

  /**
   * Add format custom taxonomy
   *
   * @since    0.1.0
   */
  public function format_taxonomy() {

    $format_taxonomy_labels = array(
            'name' => _x('Formats', 'post type general name'),
            'singular_name' => _x( 'Format', 'post type singular name'),
            'edit_item' => __( 'Edit Formats' ),
            'update_item' => __( 'Update Formats' ),
            'add_new_item' => __( 'Add New Formats' ),
            'search_items' => __( 'Search Formats' ),
            'popular_items' => __( 'Popular Formats' ),
            'all_items' => __( 'All Formats' ),
            'parent_item' => __( 'Parent Format' ),
            'parent_item_colon' => __( 'Parent Formats:' )
        );

        register_taxonomy(
        'formats',
        'adverts',
            array(
                'labels' => $format_taxonomy_labels,
                'public' => true,
                'query_var' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'show_admin_column' => false,
                'rewrite' => array( 'slug' => 'formats' ),
                'hierarchical' => true,
                'capabilities' => array(
                    'manage_terms' => 'manage_categories',
                    'edit_terms'   => 'manage_categories',
                    'delete_terms' => 'manage_categories',
                    'assign_terms' => 'edit_posts',
                )
            )
        );
  }

  /**
   * Add packages custom taxonomy
   *
   * @since    0.1.0
   */
  public function packages_taxonomy() {

    $packages_taxonomy_labels = array(
            'name' => _x('Packages', 'post type general name'),
            'singular_name' => _x( 'Package', 'post type singular name'),
            'edit_item' => __( 'Edit Packages' ),
            'update_item' => __( 'Update Packages' ),
            'add_new_item' => __( 'Add New Packages' ),
            'search_items' => __( 'Search Packages' ),
            'popular_items' => __( 'Popular Packages' ),
            'all_items' => __( 'All Packages' ),
            'parent_item' => __( 'Parent Package' ),
            'parent_item_colon' => __( 'Parent Packages:' )
        );

        register_taxonomy(
        'packages',
        'adverts',
            array(
                'labels' => $packages_taxonomy_labels,
                'public' => true,
                'query_var' => true,
                'show_ui' => true,
                'show_in_nav_menus' => true,
                'show_admin_column' => false,
                'rewrite' => array( 'slug' => 'packages' ),
                'hierarchical' => true,
                'capabilities' => array(
                    'manage_terms' => 'manage_categories',
                    'edit_terms'   => 'manage_categories',
                    'delete_terms' => 'manage_categories',
                    'assign_terms' => 'edit_posts',
                )
            )
        );

  }

  /**
   * Control which template file is used
   *
   * @since    0.1.0
   */
  public function adverts_template_redirect() {

    global $wp;
    global $wp_query;

    if( !empty( $wp->query_vars['post_type'] ) && $wp->query_vars['post_type'] == 'adverts' ) {
      // Archive Views
      if( is_post_type_archive() ){
        if(locate_template( 'archive-' . 'adverts' . '.php') != '' ) {
          include(TEMPLATEPATH . "/archive-".'adverts'.".php");
            exit;
        } elseif(is_file( plugin_dir_path( __FILE__ ) . 'views/archive-' . $wp->query_vars['post_type'] . '.php') ) {
          include(plugin_dir_path( __FILE__ ) . 'views/archive-' . $wp->query_vars['post_type'] . '.php');
            exit;
        }

      } elseif (is_single()) {
        if(locate_template( 'single-'.'adverts' . '.php') != '' ) {
          include( TEMPLATEPATH . '/single-' . 'adverts'. '.php' );
            exit;
        } elseif( is_file( plugin_dir_path( __FILE__ ) . 'views/single-' . $wp->query_vars['post_type'] . '.php' ) ) {
          include(plugin_dir_path( __FILE__ ) . 'views/single-' . $wp->query_vars['post_type'] . '.php');
            exit;
        }

      }

    }

  }

  /**
   * Control which template file is used for taxonomies
   *
   * @since    0.1.0
   */
  public function taxonomy_template_redirect() {

    global $wp;
    global $wp_query;
    $_taxonomy = get_query_var( 'taxonomy' );

    // Check that we are view a taxonomy of 'packages'
    if( is_tax() ) {

      // Use term specific taxonomy theme template
      if( locate_template( 'taxonomy-' . $_taxonomy . '-' . $wp->query_vars[$_taxonomy] . '.php' )) {
        include(TEMPLATEPATH . '/taxonomy-' . $_taxonomy . '-' . $wp->query_vars[$_taxonomy] .'.php');
        exit;

      // Use taxonomy specific theme template
      } elseif( locate_template('taxonomy-' . $_taxonomy . '.php') != '' ) {
        include( TEMPLATEPATH . '/taxonomy-' . $_taxonomy . '.php' );
        exit;

      // Use default taxonomy theme template
      } elseif( locate_template('taxonomy' . '.php') != '' ) {
        include( TEMPLATEPATH . '/taxonomy' . '.php' );
        exit;

      // Use taxonomy specific plugin template
      } elseif( is_file( plugin_dir_path( __FILE__ ) . 'views/taxonomy-' . $_taxonomy . '.php') ) {
        include(plugin_dir_path( __FILE__ ) . 'views/taxonomy-' . $_taxonomy . '.php');
        exit;

      // Use generic taxonomy plugin template
      } elseif( is_file( plugin_dir_path( __FILE__ ) . 'views/taxonomy' . '.php' ) ) {
        include(plugin_dir_path( __FILE__ ) . 'views/taxonomy' . '.php');
        exit;
      }

    }

  }

}
