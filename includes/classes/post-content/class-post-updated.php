<?php
/**
 * Post Updated.
 *
 * @package    WP_Distance_Lib
 * @subpackage WP_Distance_Lib/Includes/Classes
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

namespace WP_Distance_Lib\Includes\Classes;

if ( ! class_exists( 'Post_Updated' ) ) {

	/**
	 * Post Updated.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class Post_Updated extends \WP_Distance_Lib\Includes\Classes\Base {

		/**
		 * Initialize the class
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
		 *                             Defualt: null.
		 * }
		 *
		 * @return void
		 */
		public function __construct( $args = array() ) {
			$this->defaults = array(
				'text'                 => __( 'Updated on', 'wp-distance-lib' ),
				'time_classes'         => 'updated',
				'classes'              => 'updated-on',
			);
			parent::__construct( $args );
		}

		/**
		 * Time Classes Filter.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return string
		 */
		public function time_classes_filter() {
			return apply_filters( "{$this->prefix}time_classes_filter", $this->args['time_classes'] );
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
		 * @param string $string The output text.
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
			$time_classes = ( $this->args['time_classes'] ) ? ' class="' . esc_attr( $this->time_classes_filter() ) . '"' : '';
			$time_tag     = '<time' . $time_classes . '" datetime="%1$s">%2$s</time>';
			$time         = sprintf( $time_tag, esc_attr( get_the_modified_date( 'c' ) ), esc_html( get_the_modified_date() ) );
			$classes      = ( $this->args['classes'] ) ? ' class="' . esc_attr( $this->classes_filter() ) . '"' : '';
			$output       = '<span' . $classes . '">' . esc_html( $this->args['text'] ) . ' <a href="' . esc_url( get_the_permalink() ) . '" rel="bookmark">' . $time . '</a></span>';

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
