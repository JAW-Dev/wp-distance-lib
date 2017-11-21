<?php
/**
 * Post Published
 *
 * Load: true
 *
 * @package    WP_Distance_Lib
 * @subpackage WP_Distance_Lib/Includes/Functions
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

if ( ! function_exists( 'wp_dl_post_published' ) ) {
	/**
	 * Post Published.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 *
	 * @param array $args The arguments.
	 *
	 * @return string
	 */
	function wp_dl_post_published( $args = array() ) {
		$published = new WP_Distance_Lib\Includes\Classes\Post_Published( $args );
		echo $published->render();
	}
}
