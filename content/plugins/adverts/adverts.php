<?php
/**
 * The WordPress Plugin Boilerplate.
 *
 * A foundation off of which to build well-documented WordPress plugins that
 * also follow WordPress Coding Standards and PHP best practices.
 *
 * @package   Adverts
 * @author    Michael Bragg <michael@michaelbragg.net>
 * @license   GPL-2.0+
 * @link      http://trinitymirror.github.io
 * @copyright 2013 Trinity Mirror Creative
 *
 * @wordpress-plugin
 * Plugin Name:       Adverts
 * Plugin URI:        @TODO
 * Description:       @TODO
 * Version:           0.1.0
 * Author:            Michael Bragg
 * Author URI:        @TODO
 * Text Domain:       adverts-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/trinitymirror/digitalhub
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/*--------------------------------------------------------------------*
 * Public-Facing Functionality
 *-------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace `class-adverts.php` with the name of the plugin's class file
 *
 */
require_once( plugin_dir_path( __FILE__ ) . 'public/class-adverts.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 *
 * @TODO:
 *
 * - replace Adverts with the name of the class defined in
 *   `class-adverts.php`
 */
register_activation_hook( __FILE__, array( 'Adverts', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Adverts', 'deactivate' ) );

/*
 * @TODO:
 *
 * - replace Adverts with the name of the class defined in
 *   `class-adverts.php`
 */
add_action( 'plugins_loaded', array( 'Adverts', 'get_instance' ) );

/*----------------------------------------------------------------------------*
 * Dashboard and Administrative Functionality
 *----------------------------------------------------------------------------*/

/*
 * @TODO:
 *
 * - replace `class-plugin-admin.php` with the name of the plugin's admin file
 * - replace Adverts_Admin with the name of the class defined in
 *   `class-adverts-admin.php`
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
if ( is_admin() ) {

	require_once( plugin_dir_path( __FILE__ ) . 'admin/class-adverts-admin.php' );
	add_action( 'plugins_loaded', array( 'Adverts_Admin', 'get_instance' ) );

}
