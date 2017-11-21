<?php
/**
 * Content Read More Text
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

if ( ! function_exists( 'wp_dl_content_more_text' ) ) {
	/**
	 * Content More Link.
	 *
	 * Example: the_content( wp_dl_content_more() );.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 *
	 * @param array $args The arguments.
	 *
	 * @return string
	 */
	function wp_dl_content_more_text( $args = array() ) {
		$content_more = new WP_Distance_Lib\Includes\Classes\Content_More_Text( $args );
		return $content_more->render();
	}
}
