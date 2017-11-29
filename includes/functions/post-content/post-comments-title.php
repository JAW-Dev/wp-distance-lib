<?php
/**
 * Post Comments Title
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

if ( ! function_exists( 'wp_dl_post_comments_title' ) ) {
	/**
	 * Post Comments Title.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 *
	 * @param array $args The arguments.
	 */
	function wp_dl_post_comments_title( $args = array() ) {
		$comments_title = new WP_Distance_Lib\Includes\Classes\Post_Comments_Title( $args );
		echo wp_kses_post( $comments_title->render() );
	}
}
