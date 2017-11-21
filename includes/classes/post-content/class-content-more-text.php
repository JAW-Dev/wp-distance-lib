<?php
/**
 * Content More Text.
 *
 * @package    WP_Distance_Lib
 * @subpackage WP_Distance_Lib/Includes/Classes
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

namespace WP_Distance_Lib\Includes\Classes;

if ( ! class_exists( 'Content_More_Text' ) ) {

	/**
	 * Content More Link.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class Content_More_Text extends \WP_Distance_Lib\Includes\Classes\Base {

		/**
		 * Initialize the class.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @param array $args {
		 *     The arguments.
		 *
		 *     @type string $more_text The text for the more link.
		 *                             Default: 'Continue Reading'.
		 *     @type string $classes   The classes for the more text span tag.
		 *                             Defualt: 'more-text'.
		 * }
		 *
		 * @return void
		 */
		public function __construct( $args = array() ) {
			$this->defaults = array(
				'more_text' => __( 'Continue Reading', 'wp-distance-lib' ),
				'classes'   => 'more-text',
			);
			parent::__construct( $args );
		}

		/**
		 * More Text Filter.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return string
		 */
		public function more_text_filter() {
			return apply_filters( "{$this->prefix}text_filter", $this->args['more_text'] );
		}

		/**
		 * Classes Filter.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return string
		 */
		public function classes_filter() {
			return apply_filters( "{$this->prefix}classes_filter", $this->args['classes'] );
		}

		/**
		 * Output Filter.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @param string string The output text.
		 *
		 * @return string
		 */
		public function output_filter( $string ) {
			return apply_filters( "{$this->prefix}outout_filter", $string );
		}

		/**
		 * Output.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return string
		 */
		public function render() {
			$classes   = ( $this->args['classes'] ) ? ' class="' . esc_attr( $this->classes_filter() ) . '"' : '';
			$output    = sprintf( '<span' . $classes . '>%s</span>', esc_html( $this->more_text_filter() ) );

			/**
			 * Action before returing the output.
			 *
			 * @author Jason Witt
			 * @since  0.0.1
			 */
			do_action( "before_{$this->prefix}output" );

			return $this->output_filter( $output );
		}
	}
}
