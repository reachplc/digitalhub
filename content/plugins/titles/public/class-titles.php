<?php
/**
 * Titles.
 *
 * @package   Titles
 * @author    Michael Bragg <michael@michaelbragg.net>
 * @license   GPL-2.0+
 * @link      http://michaelbragg.net
 * @copyright 2014 Michael Bragg
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * public-facing side of the WordPress site.
 *
 * If you're interested in introducing administrative or dashboard
 * functionality, then refer to `class-titles-admin.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package Regions
 * @author  Michael Bragg <michael@michaelbragg.net>
 */
class Titles {

	/**
	* Plugin version, used for cache-busting of style and script file references.
	*
	* @since   1.0.0
	*
	* @var     string
	*/
	const VERSION = '1.0.0';

	/**
	* @TODO - Rename "titles" to the name your your plugin
	*
	* Unique identifier for your plugin.
	*
	*
	* The variable name is used as the text domain when internationalizing strings
	* of text. Its value should match the Text Domain file header in the main
	* plugin file.
	*
	* @since    1.0.0
	*
	* @var      string
	*/
	protected $plugin_slug = 'titles';

	/**
	* Instance of this class.
	*
	* @since    1.0.0
	*
	* @var      object
	*/
	protected static $instance = null;

	/**
	* Initialize the plugin by setting localization and loading public scripts
	* and styles.
	*
	* @since     1.0.0
	*/
	private function __construct() {

		// Load plugin text domain
		add_action( 'init', array( $this, 'load_plugin_textdomain' ) );

		// Activate plugin when new blog is added
		add_action( 'wpmu_new_blog', array( $this, 'activate_new_site' ) );

		// Load public-facing style sheet and JavaScript.
		//add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		//add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );

		// Define custom functionality.
		add_action( 'init', array( $this, 'titles_cpt' ) );
		add_action( 'init', array( $this, 'regions_taxonomy' ) );

		// Include functions for outputting info to themes
		include(plugin_dir_path( __FILE__ ) . 'includes/link' . '.php');

	}

	/**
	* Return the plugin slug.
	*
	* @since    1.0.0
	*
	* @return    Plugin slug variable.
	*/
	public function get_plugin_slug() {
		return $this->plugin_slug;
	}

	/**
	* Return an instance of this class.
	*
	* @since     1.0.0
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
	* @since    1.0.0
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
	* @since    1.0.0
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
	* @since    1.0.0
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
	* @since    1.0.0
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
	* @since    1.0.0
	*/
	private static function single_activate() {
		// @TODO: Define activation functionality here
	}

	/**
	* Fired for each blog when the plugin is deactivated.
	*
	* @since    1.0.0
	*/
	private static function single_deactivate() {
		// @TODO: Define deactivation functionality here
	}

	/**
	* Load the plugin text domain for translation.
	*
	* @since    1.0.0
	*/
	public function load_plugin_textdomain() {

		$domain = $this->plugin_slug;
		$locale = apply_filters( 'plugin_locale', get_locale(), $domain );

		load_textdomain( $domain, trailingslashit( WP_LANG_DIR ) . $domain . '/' . $domain . '-' . $locale . '.mo' );

	}

	/**
	* Register and enqueue public-facing style sheet.
	*
	* @since    1.0.0
	*/
	public function enqueue_styles() {
		wp_enqueue_style( $this->plugin_slug . '-plugin-styles', plugins_url( 'assets/css/public.css', __FILE__ ), array(), self::VERSION );
	}

	/**
	* Register and enqueues public-facing JavaScript files.
	*
	* @since    1.0.0
	*/
	public function enqueue_scripts() {
		wp_enqueue_script( $this->plugin_slug . '-plugin-script', plugins_url( 'assets/js/public.js', __FILE__ ), array( 'jquery' ), self::VERSION );
	}

	/**
	* Setup the Titles Custom Post Type
	*
	* @since    1.0.0
	*/
	public function titles_cpt() {
		$titles_labels = array(
		'name' => _x( 'Titles', 'post type general name' ),
		'singular_name' => _x( 'Titlen', 'post type singular name' ),
		'add_new' => __( 'Add New Title' ),
		'add_new_item' => __( 'Add New Title' ),
		'edit_item' => __( 'Edit Title' ),
		'new_item' => __( 'New Title' ),
		'view_item' => __( 'View Title' ),
		'search_items' => __( 'Search Title' ),
		'not_found' => __( 'No Title found' ),
		'not_found_in_trash' => __( 'No Title found in Trash' ),
		'parent_item_colon' => ''
		);
		$titles_args = array(
		'labels' => $titles_labels,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		'rewrite' => array( 'slug' => 'titles' ),
		'hierarchical' => false,
		'menu_position' => 5,
		'capability_type' => 'post',
		'supports' => array( 'title', 'thumbnail', 'page-attributes' ),
		//  TODO: link image to plugin admin assets folder
		//'menu_icon' => get_bloginfo('template_directory') . '/images/photo-album.png', //16x16 png if you want an icon
		//'taxonomies' => array('title'),
		'has_archive' => true,
		);

		register_post_type( 'titles', $titles_args );

	}

	/**
	* Add packages custom taxonomy
	*
	* @since    1.0.0
	*/
	public function regions_taxonomy() {

		$regions_taxonomy_labels = array(
			'name' => _x( 'Regions', 'post type general name' ),
			'singular_name' => _x( 'Region', 'post type singular name' ),
			'edit_item' => __( 'Edit Regions' ),
			'update_item' => __( 'Update Regions' ),
			'add_new_item' => __( 'Add New Regions' ),
			'search_items' => __( 'Search Regions' ),
			'popular_items' => __( 'Popular Regions' ),
			'all_items' => __( 'All Regionss' ),
			'parent_item' => __( 'Parent Region' ),
			'parent_item_colon' => __( 'Parent Regions:' )
		);

		register_taxonomy(
			'regions',
			'titles',
			array(
				'labels' => $regions_taxonomy_labels,
				'public' => true,
				'query_var' => true,
				'show_ui' => true,
				'show_in_nav_menus' => true,
				'show_admin_column' => false,
				'rewrite' => array( 'slug' => 'regions' ),
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

}
