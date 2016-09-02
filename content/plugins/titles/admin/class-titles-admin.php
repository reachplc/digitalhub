<?php
/**
 * Titles.
 *
 * @package   Titles_Admin
 * @author    Michael Bragg <michael@michaelbragg.net>
 * @license   GPL-2.0+
 * @link      http://michaelbragg.net
 * @copyright 2014 Michael Bragg
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * If you're interested in introducing public-facing
 * functionality, then refer to `class-regions.php`
 *
 * @package Titles_Admin
 * @author  Michael Bragg <michael@michaelbragg.net>
 */
class Titles_Admin {

	/**
	* Instance of this class.
	*
	* @since    1.0.0
	*
	* @var      object
	*/
	protected static $instance = null;

	/**
	* Slug of the plugin screen.
	*
	* @since    1.0.0
	*
	* @var      string
	*/
	protected $plugin_screen_hook_suffix = null;

	/**
	* Initialize the plugin by loading admin scripts & styles and adding a
	* settings page and menu.
	*
	* @since     1.0.0
	*/
	private function __construct() {

		/*
		* @TODO :
		*
		* - Uncomment following lines if the admin class should only be available for super admins
		*/
		/* if( ! is_super_admin() ) {
		return;
		} */

		/*
		* Call $plugin_slug from public plugin class.
		*
		*/
		$plugin = Titles::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );

		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

		// Define Link Custom Fields
		add_action( 'add_meta_boxes', array( $this, 'titles_link_custom_field' ) );
		add_action( 'save_post', array( $this, 'titles_link_save_postdata' ) );

	}

	/**
	* Return an instance of this class.
	*
	* @since     1.0.0
	*
	* @return    object    A single instance of this class.
	*/
	public static function get_instance() {

		/*
		* @TODO :
		*
		* - Uncomment following lines if the admin class should only be available for super admins
		*/
		/* if( ! is_super_admin() ) {
		return;
		} */

		// If the single instance hasn't been set, set it now.
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	/**
	* Register and enqueue admin-specific style sheet.
	*
	* @since     1.0.0
	*
	* @return    null    Return early if no settings page is registered.
	*/
	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), Titles::VERSION );
		}

	}

	/**
	* Register and enqueue admin-specific JavaScript.
	*
	* @since     1.0.0
	*
	* @return    null    Return early if no settings page is registered.
	*/
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), Titles::VERSION );
		}

	}

	/**
	* Register the administration menu for this plugin into the WordPress Dashboard menu.
	*
	* @since    1.0.0
	*/
	public function add_plugin_admin_menu() {

		/*
		* Add a settings page for this plugin to the Settings menu.
		*
		* NOTE:  Alternative menu locations are available via WordPress administration menu functions.
		*
		*        Administration Menus: http://codex.wordpress.org/Administration_Menus
		*
		* @TODO:
		*
		* - Change 'Page Title' to the title of your plugin admin page
		* - Change 'Menu Text' to the text for menu item for the plugin settings page
		* - Change 'manage_options' to the capability you see fit
		*   For reference: http://codex.wordpress.org/Roles_and_Capabilities
		*/
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Page Title', $this->plugin_slug ),
			__( 'Menu Text', $this->plugin_slug ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);

	}

	/**
	* Render the settings page for this plugin.
	*
	* @since    1.0.0
	*/
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}

	/**
	* Add settings action link to the plugins page.
	*
	* @since    1.0.0
	*/
	public function add_action_links( $links ) {

		return array_merge(
			array(
			'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);

	}

	/**
	* Add custom fields to custom post type
	*
	* @since    0.1.0
	*/

	public function titles_link_custom_field() {

		$screens = array( 'titles' );

		foreach ( $screens as $screen ) {

			add_meta_box(
				'link_sectionid',
				__( 'Link', 'link_textdomain' ),
				array( $this, 'titles_inner_link_box' ),
				$screen
			);
		}

	}

	/**
	* Prints the link content.
	*
	* @param WP_Post $post The object for the current post/page.
	*/
	public function titles_inner_link_box( $post ) {

		wp_nonce_field( 'titles_inner_link_box', 'titles_inner_link_box_nonce' );

		global $post;
		$_value = get_post_meta( $post->ID, '_link', true );
		//  Add preview image field
		echo '<p>';
		echo '<label for="_link">URL for Title: </label><br>';
		echo '<input type="url" name="_link" size="50" placeholder="http://example.com" value="'. esc_url( urldecode( $_value ) ) .'">';
		echo '</p>';
		echo '</fieldset>';

	}

	/**
	* When the post is saved, saves our custom data.
	*
	* @since    0.1.0
	*
	* @param int $post_id The ID of the post being saved.
	*/
	public function titles_link_save_postdata( $post_id ) {

		global $post;



		/* Verify the nonce before proceeding. */
		if ( ! isset( $_POST['titles_inner_link_box_nonce'] ) || ! wp_verify_nonce( $_POST['titles_inner_link_box_nonce'],'titles_inner_link_box' ) ) {
			return $post_id;
		}

		/* Check we have permission to edit this post type */

		if (  'titles' === strtolower( $_POST['post_type'] ) ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return $post_id;
			}
		} else {
			if ( ! current_user_can( 'edit_post', $post_id ) ) {
				return $post_id;
			}
		}

		/* Save Our Data */

		if( ! empty( $_POST['_link'] ) ) {
	    $new_meta_value = urlencode( $_POST['_link'] ) ;
		} else {
			$new_meta_value = '';
		}

		$meta_key = '_link';

		$meta_value = get_post_meta( $post_id, $meta_key, true );

		/* If a new meta value was added and there was no previous value, add it. */
		if ( $new_meta_value && '' == $meta_value ) {
			add_post_meta( $post_id, $meta_key, $new_meta_value, true );
		}
		/* If the new meta value does not match the old value, update it. */
		elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
			update_post_meta( $post_id, $meta_key, $new_meta_value );
		}
		/* If there is no new meta value but an old value exists, delete it. */
		elseif ( '' == $new_meta_value && $meta_value ) {
			delete_post_meta( $post_id, $meta_key, $meta_value );
		}

	}

}
