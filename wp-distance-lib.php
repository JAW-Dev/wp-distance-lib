<?php
/**
 * Plugin Name: WP Distance Lib
 * Plugin URI:  https://github.com/jawittdesigns/wp-distance-lib
 * Description: A Library a helpers for WordPress development
 * Version:     0.0.1
 * Author:      Jason Witt
 * Author URI:  https://jawittdesigns.com
 * License:     GPLv2
 * Text Domain: wp-distance-lib
 * Domain Path: /languages
 *
 * @package   WP_Distance_Lib
 * @author    Jason Witt <contact@jawittdesigns.com>
 * @copyright Copyright (c) 2017, Jason Witt
 * @license   GNU General Public License v2 or later
 * @version   0.0.1
 */

namespace WP_Distance_Lib;

use WP_Distance_Lib\Includes\Classes as Classes;

/*
 * Autoloader
 */
require_once trailingslashit( plugin_dir_path( __FILE__ ) ) . trailingslashit( 'includes' ) . 'autoload.php';

if ( ! class_exists( 'WP_Distance_Lib' ) ) {

	/**
	 * Names
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class WP_Distance_Lib {

		/**
		 * Singleton instance of plugin.
		 *
		 * @var   WP_Distance_Lib
		 * @since 0.0.1
		 */
		protected static $single_instance = null;

		/**
		 * Creates or returns an instance of this class.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return A single instance of this class.
		 */
		public static function get_instance() {
			if ( null === self::$single_instance ) {
				self::$single_instance = new self();
			}

			return self::$single_instance;
		}

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function __construct() {

		}

		/**
		 * Init
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function init() {

			// Load translated strings for plugin.
			load_plugin_textdomain( 'wp-distance-lib', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );

			// Instantiate Classes.
			$this->classes();
		}

		/**
		 * Classes.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function classes() {
			// Instantiate the Classes.
			$template_tags = new Classes\Template_Tags( trailingslashit( plugin_dir_path( __FILE__ ) ) . 'includes/functions' );
		}

		/**
		 * Activate the plugin.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function _activate() {

			flush_rewrite_rules();
		}

		/**
		 * Deactivate the plugin.
		 * Uninstall routines should be in uninstall.php.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return void
		 */
		public function _deactivate() {

		}
	}
}

/**
 * Return an instance of the plugin class.
 *
 * @author Jason Witt
 * @since  0.0.1
 *
 * @return Singleton instance of plugin class.
 */
function wp_distance_lib() {
	return WP_Distance_Lib::get_instance();
}
add_action( 'plugins_loaded', array( wp_distance_lib(), 'init' ) );

// ==============================================
// Activation
// ==============================================
register_activation_hook( __FILE__, array( wp_distance_lib(), '_activate' ) );

// ==============================================
// Deactivation
// ==============================================
register_deactivation_hook( __FILE__, array( wp_distance_lib(), '_deactivate' ) );
