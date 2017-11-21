<?php
/**
 * Comments Title.
 *
 * @package    WP_Distance_Lib
 * @subpackage WP_Distance_Lib/Includes/Classes
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

namespace WP_Distance_Lib\Includes\Classes;

if ( ! class_exists( 'Post_Comments_Title' ) ) {

	/**
	 * Comments Title.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class Post_Comments_Title extends \WP_Distance_Lib\Includes\Classes\Base {
		
		/**
		 * Comment Count.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @var int
		 */
		protected $comment_count;

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
				'title_singular' => __( 'Comment for', 'wp-distance-lib' ),
				'title_plural'   => __( 'Comments for', 'wp-distance-lib' ),
				'classes'        => 'title',
			);
			$this->comment_count = get_comments_number();
			parent::__construct( $args );
		}
		
		/**
		 * Comments Title Filter.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return string
		 */
		public function comments_title_filter() {
			return apply_filters(
				"{$this->prefix}filter",
				_nx(
					$this->args['title_singular'],
					$this->args['title_plural'],
					$this->comment_count,
					'comments title',
					'wp-distance-lib'
				)
			);
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
			$classes = ( $this->args['classes'] ) ? ' class="' . esc_attr( $this->classes_filter() ) . '"' : '';
			$output  = sprintf( '<span' . $classes . '>%1$s ' . esc_html( $this->comments_title_filter() ) . ' %2$s</span>', esc_html( number_format_i18n( $this->comment_count ) ), esc_html( get_the_title() ) );

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
