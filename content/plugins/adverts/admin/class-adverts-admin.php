<?php
/**
 * Plugin Name.
 *
 * @package   Adverts_Admin
 * @author    Michael Bragg <michael@michaelbragg.net>
 * @license   GPL-2.0+
 * @link      http://trinitymirror.github.io
 * @copyright 2013 Trinity Mirror Creative
 */

/**
 * Plugin class. This class should ideally be used to work with the
 * administrative side of the WordPress site.
 *
 * If you're interested in introducing public-facing
 * functionality, then refer to `class-adverts.php`
 *
 * @TODO: Rename this class to a proper name for your plugin.
 *
 * @package Adverts_Admin
 * @author  Michael Bragg <michael@michaelbragg.net>
 */
class Adverts_Admin {

	/**
	 * Instance of this class.
	 *
	 * @since    0.1.0
	 *
	 * @var      object
	 */
	protected static $instance = null;

	/**
	 * Slug of the plugin screen.
	 *
	 * @since    0.1.0
	 *
	 * @var      string
	 */
	protected $plugin_screen_hook_suffix = null;

	/**
	 * Initialize the plugin by loading admin scripts & styles and adding a
	 * settings page and menu.
	 *
	 * @since     0.1.0
	 */
	private function __construct() {

		$plugin = Adverts::get_instance();
		$this->plugin_slug = $plugin->get_plugin_slug();

		// Load admin style sheet and JavaScript.
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_styles' ) );
		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_admin_scripts' ) );

		// Add the options page and menu item.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );
    // Register the options page settings.
    add_action( 'admin_init', array( $this, 'register_plugin_admin_settings' ) );
    // Add the error and success messages
    add_action( 'admin_notices', array( $this, 'plugin_admin_notices' ) );



		// Add an action link pointing to the options page.
		$plugin_basename = plugin_basename( plugin_dir_path( __DIR__ ) . $this->plugin_slug . '.php' );
		add_filter( 'plugin_action_links_' . $plugin_basename, array( $this, 'add_action_links' ) );

    // Define Custom Fields
    add_action( 'add_meta_boxes', array( $this, 'build_guide_custom_field' ) );
    add_action( 'save_post', array( $this, 'adverts_build_guide_save_postdata' ) );

    add_action( 'add_meta_boxes', array( $this, 'example_custom_field') );
    add_action( 'save_post', array( $this, 'adverts_example_save_postdata' ) );

    function update_edit_form() {
	    echo ' enctype="multipart/form-data"';
		}

		add_action('post_edit_form_tag', 'update_edit_form');

    // Define Custom Post Type Columns
    add_filter('manage_edit-adverts_columns', array( $this, 'adverts_edit_columns' ) );

    add_action('manage_adverts_posts_custom_column', array( $this, 'advert_custom_columns' ) );

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
	 * Register and enqueue admin-specific style sheet.
	 *
	 * @since     0.1.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_styles() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_style( $this->plugin_slug .'-admin-styles', plugins_url( 'assets/css/admin.css', __FILE__ ), array(), Adverts::VERSION );
		}

	}

	/**
	 * Register and enqueue admin-specific JavaScript.
	 *
	 * @since     0.1.0
	 *
	 * @return    null    Return early if no settings page is registered.
	 */
	public function enqueue_admin_scripts() {

		if ( ! isset( $this->plugin_screen_hook_suffix ) ) {
			return;
		}

		$screen = get_current_screen();
		if ( $this->plugin_screen_hook_suffix == $screen->id ) {
			wp_enqueue_script( $this->plugin_slug . '-admin-script', plugins_url( 'assets/js/admin.js', __FILE__ ), array( 'jquery' ), Adverts::VERSION );

      wp_enqueue_script('uploads');
      if ( function_exists('wp_enqueue_media') ) {
      // this enqueues all the media upload stuff
        wp_enqueue_media();
      }

		}

	}

	/**
	 * Register the administration menu for this plugin into the WordPress Dashboard menu.
	 *
	 * @since    0.1.0
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
		 * - Change 'manage_options' to the capability you see fit
		 *   For reference: http://codex.wordpress.org/Roles_and_Capabilities
		 */
		$this->plugin_screen_hook_suffix = add_options_page(
			__( 'Adverts', $this->plugin_slug ),
			__( 'Adverts Settings', $this->plugin_slug ),
			'manage_options',
			$this->plugin_slug,
			array( $this, 'display_plugin_admin_page' )
		);

	}

	/**
	 * Render the settings page for this plugin.
	 *
	 * @since    0.1.0
	 */
	public function display_plugin_admin_page() {
		include_once( 'views/admin.php' );
	}

  /**
   * Register the settings
   *
   * @since   0.2.0
   */
  function register_plugin_admin_settings() {
      //this will save the option in the wp_options table as 'wpse61431_settings'
      //the third parameter is a function that will validate your input values
      register_setting('adverts-settings', 'adverts-settings');
  }

  /**
   * Display the validation errors and update message
   */

    function plugin_admin_notices() {
      settings_errors();
    }

	/**
	 * Add settings action link to the plugins page.
	 *
	 * @since    0.1.0
	 */
	public function add_action_links( $links ) {

		return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_slug ) . '">' . __( 'Settings', $this->plugin_slug ) . '</a>'
			),
			$links
		);

	}

 /* Add custom fields to custom post type
   *
   */

  public function build_guide_custom_field() {

    $screens = array( 'adverts' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'adverts_sectionid',
            __( 'Build Guide', 'adverts_textdomain' ),
            array($this, 'adverts_inner_build_guide_box'),
            $screen
        );
    }



  }

/**
 * Prints the build guide content.
 *
 * @since    0.1.0
 *
 * @param WP_Post $post The object for the current post/page.
 */
  public function adverts_inner_build_guide_box( $post ) {

    // Add an nonce field so we can check for it later.
    wp_nonce_field( 'adverts_inner_build_guide_box', 'adverts_inner_build_guide_box_nonce' );

		global $post;

    $custom         = get_post_custom($post->ID);
    $download_id    = get_post_meta($post->ID, 'document_file_id', true);

    echo '<p><label for="document_file">Upload document:</label><br />';
    echo '<input type="file" name="document_file" id="document_file" /></p>';
    echo '</p>';

    if(!empty($download_id) && $download_id != '0') {
        echo '<p><a href="' . wp_get_attachment_url($download_id) . '">
            View document</a></p>';
    }

    /**
     *
     */

    $build_guide_disabled = get_post_meta($post->ID, '_build_guide_disabled', true);

    function isDisabled( $build_guide_disabled ) {

      if( $build_guide_disabled != true ) {
        return;
      }

      return "checked";

    }

    echo '<p><label for="_build_guide_disabled">Disable build guides for this advert: </label>';
    echo '<input type="checkbox" name="_build_guide_disabled" id="_build_guide_disabled" value="true" ' . isDisabled( $build_guide_disabled ) . ' /></p>';
    echo '</p>';

  }

  /**
   * When the post is saved, saves our custom data.
   *
   * @since    0.1.0
   *
   * @param int $post_id The ID of the post being saved.
   */
	public function adverts_build_guide_save_postdata( $post_id ) {

	  global $post;

	    if(strtolower($_POST['post_type']) === 'adverts') {
	        if(!current_user_can('edit_page', $post_id)) {
	            return $post_id;
	        }
	    }
	    else {
	        if(!current_user_can('edit_post', $post_id)) {
	            return $post_id;
	        }
	    }

	    if(!empty($_FILES['document_file'])) {
	        $file   = $_FILES['document_file'];
	        $upload = wp_handle_upload($file, array('test_form' => false));
	        if(!isset($upload['error']) && isset($upload['file'])) {
	            $filetype   = wp_check_filetype(basename($upload['file']), null);
	            $title      = $file['name'];
	            $ext        = strrchr($title, '.');
	            $title      = ($ext !== false) ? substr($title, 0, -strlen($ext)) : $title;
	            $attachment = array(
	                'post_mime_type'    => $filetype['type'],
	                'post_title'        => addslashes($title),
	                'post_content'      => '',
	                'post_status'       => 'inherit',
	                'post_parent'       => $post->ID
	            );

	            $attach_key = 'document_file_id';
	            $attach_id  = wp_insert_attachment($attachment, $upload['file']);
	            $existing_download = (int) get_post_meta($post->ID, $attach_key, true);

	            if(is_numeric($existing_download)) {
	                wp_delete_attachment($existing_download);
	            }

	            update_post_meta($post->ID, $attach_key, $attach_id);
	        }
	    }

      // Save Build Guide Disabled option
        $new_meta_value = ( isset( $_POST[ '_build_guide_disabled' ] ) ? $_POST[ '_build_guide_disabled' ] : '' );

        $meta_key = '_build_guide_disabled';

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


  /**
   * Add custom fields to custom post type
   *
   * @since    0.1.0
   */

  public function example_custom_field() {

    $screens = array( 'adverts' );

    foreach ( $screens as $screen ) {

        add_meta_box(
            'example_sectionid',
            __( 'Examples', 'example_textdomain' ),
            array($this, 'adverts_inner_example_box'),
            $screen
        );
    }

  }

  /**
   * Prints the build guide content.
   *
   * @param WP_Post $post The object for the current post/page.
   */
  public function adverts_inner_example_box( $post ) {

    wp_nonce_field( 'example_inner_build_guide_box', 'example_inner_build_guide_box_nonce' );

    global $post;
    $example_limit = 3;
    /* Formats allowed */
    $_formats = array('mp4', 'webm', 'ogg', 'flv');
    $custom         = get_post_custom($post->ID);



    for ($i = 1; $i <= $example_limit; $i++) {

      $example_preview = get_post_meta($post->ID, '_example_' . $i .'_url_preview', true);
      $example_video = get_post_meta($post->ID, '_example_' . $i .'_url_video', true);

      echo '<fieldset>';
      echo '<legend>Example ' . $i .' URL:</legend>';

      //  Add preview image field
      echo '<p>';
      echo '<label for="_example_' . $i .'_url_preview">Preview: </label><br>';
      echo '<input type="text" name="_example_' . $i .'_url_preview" placeholder="http://example.net/preview-image.png" value="' . urldecode($example_preview) . '">';
      echo '</p>';
      echo '<p>';
      echo '<label for="_example_' . $i .'_url_video">Video Placeholder: </label><br>';
      echo '<input type="text" name="_example_' . $i .'_url_video" placeholder="http://example.net/video-image.png" value="' . urldecode($example_video) . '">';
      echo '</p>';

      foreach ($_formats as $value) {
        // Get current value
        $example_value    = get_post_meta($post->ID, '_example_'. $i . '_url_' . $value, true);
        echo '<p>';
        echo '<label for="_example_' . $i .'_url_' . $value . '">'. $value .'</label><br>';
        echo '<input type="text" name="_example_' . $i .'_url_' . $value . '" id="example_' . $i .'_url_' . $value . '" placeholder="http://example.net/video.' . $value . '" value="' . urldecode($example_value) . '">';
        echo '</p>';
      }

      unset($value);

      echo '</fieldset>';
    }

  }

  /**
   * When the post is saved, saves our custom data.
   *
   * @since    0.1.0
   *
   * @param int $post_id The ID of the post being saved.
   */
  public function adverts_example_save_postdata( $post_id ) {

    global $post;
    $example_limit = 3;

    /* Verify the nonce before proceeding. */
    if ( !isset( $_POST['example_inner_build_guide_box_nonce'] ) || !wp_verify_nonce($_POST['example_inner_build_guide_box_nonce'],'example_inner_build_guide_box') ) {
      return $post_id;
    }

    if(strtolower($_POST['post_type']) === 'adverts') {
      if(!current_user_can('edit_page', $post_id)) {
          return $post_id;
      }
    } else {
      if(!current_user_can('edit_post', $post_id)) {
          return $post_id;
      }
    }

    for ($i = 1; $i <= $example_limit; $i++) {

      /* Formats allowed */
      $_formats = array('mp4', 'webm', 'ogg', 'flv');

      // Preview image

      $placeholder_meta_value = ( isset( $_POST[ '_example_' . $i .'_url_preview' ] ) ? urlencode( $_POST[ '_example_' . $i .'_url_preview' ] ) : '' );

        $meta_key = '_example_' . $i .'_url_preview' ;

        $meta_value = get_post_meta( $post_id, $meta_key, true );

        /* If a new meta value was added and there was no previous value, add it. */
        if ( $placeholder_meta_value && '' == $meta_value ) {
          add_post_meta( $post_id, $meta_key, $placeholder_meta_value, true );
        }
        /* If the new meta value does not match the old value, update it. */
        elseif ( $placeholder_meta_value && $placeholder_meta_value != $meta_value ) {
          update_post_meta( $post_id, $meta_key, $placeholder_meta_value );
        }
        /* If there is no new meta value but an old value exists, delete it. */
        elseif ( '' == $placeholder_meta_value && $meta_value ) {
          delete_post_meta( $post_id, $meta_key, $meta_value );
        }

      // Video Placeholder

      $new_meta_value = ( isset( $_POST[ '_example_' . $i .'_url_video' ] ) ? urlencode( $_POST[ '_example_' . $i .'_url_video' ] ) : '' );

        $meta_key = '_example_' . $i .'_url_video' ;

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

      // Videos

      foreach ($_formats as $value) {
        $new_meta_value = ( isset( $_POST['_example_' . $i . '_url_' . $value ] ) ? urlencode( $_POST['_example_' . $i . '_url_' . $value ] ) : '' );

        $meta_key = '_example_' . $i . '_url_' . $value ;

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

      unset($value);

    }

  }

  /**
   * Define column headers for custom post type
   *
   * @param
   */
  public function adverts_edit_columns($columns){
    $columns = array(
      'cb' => '<input type="checkbox">',
      'title' => 'Advert',
      'description' => 'Description',
      'format' => 'Format',
      'packages' => 'Package',
      'build_guide' => 'Build Guide',
      'date' => __( 'Date' )
    );

    return $columns;
  }


  /**
   * Show the content of the custom taxonomies and fields
   *
   * @param
   */
  public function advert_custom_columns($column) {
    global $post;
    switch ($column) {
      case 'description':
          the_excerpt();
          break;
      case 'format':
          echo get_the_term_list($post->ID, 'formats', '', ', ','');
          break;
      case 'packages':
          echo get_the_term_list($post->ID, 'packages', '', ', ','');
          break;
      case 'build_guide':
          $download_id = get_post_meta($post->ID, 'document_file_id', true);
          if ( empty( $download_id) || $download_id == '0' ) {
            echo __( 'N/A' );
          } else {
            echo '<a href="' . wp_get_attachment_url($download_id) . '">' . '@TODO: File Name' .'</a>';
          }
          break;
    }
  }

}
