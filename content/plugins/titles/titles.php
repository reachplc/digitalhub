<?php
/**
 * @package   Titles
 * @author    Michael Bragg <michael@michaelbragg.net>
 * @license   GPL-2.0+
 * @link      http://michaelbragg.net
 * @copyright 2014 Michael Bragg
 *
 * @wordpress-plugin
 * Plugin Name:       Titles
 * Plugin URI:
 * Description:       Allows the user to add new titles and areas.
 * Version:           1.0.0
 * Author:            Michael Bragg
 * Author URI:        http://michaelbragg.net
 * Text Domain:       titles
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/trinitymirror/digitalhub
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
  die;
}

/*-------------------------------------------------------------------*
 * Public-Facing Functionality
 *-------------------------------------------------------------------*/

require_once( plugin_dir_path( __FILE__ ) . 'public/class-titles.php' );

/*
 * Register hooks that are fired when the plugin is activated
 * or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook( __FILE__, array( 'Titles', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Titles', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'Titles', 'get_instance' ) );

/*-------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *-------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace `class-titles-admin.php` with the name of the plugin's admin file
 * - replace Regions_Admin with the name of the class defined in
 *   `class-titles-admin.php`
 *
 * If you want to include Ajax within the dashboard, change the following
 * conditional to:
 *
 * if ( is_admin() ) {
 *   ...
 * }
 *
 * The code below is intended to to give the lightest footprint possible.
 */
if ( is_admin() && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {

  require_once( plugin_dir_path( __FILE__ ) . 'admin/class-titles-admin.php' );
  add_action( 'plugins_loaded', array( 'Titles_Admin', 'get_instance' ) );

}
