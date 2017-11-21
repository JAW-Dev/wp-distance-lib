<?php
/**
 * Post Author Byline.
 *
 * @package    WP_Distance_Lib
 * @subpackage WP_Distance_Lib/Includes/Classes
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

namespace WP_Distance_Lib\Includes\Classes;

if ( ! class_exists( 'Post_Author_Byline' ) ) {

	/**
	 * Post Author Byline.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 */
	class Post_Author_Byline extends \WP_Distance_Lib\Includes\Classes\Base {

		/**
		 * Initialize the class
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @param array $args The arguments.
		 *
		 * @return void
		 */
		public function __construct( $args = array() ) {
			$this->defaults = array(
				'by_text'        => __( 'Written by: ', 'wp-distance-lib' ),
				'a_tag_classes'  => 'url fn n',
				'byline_classes' => 'byline',
				'author_classes' => 'author vcard',
				'link'           => true,
			);
			parent::__construct( $args );
		}

		/**
		 * Author By Text Filter.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return string
		 */
		public function author_by_text_filter() {
			return apply_filters( "{$this->prefix}author_by_text_filter", $this->args['by_text'] );
		}

		/**
		 * A Tag Classes Filter.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return string
		 */
		public function a_tag_classes_filter() {
			return apply_filters( "{$this->prefix}a_tag_classes_filter", $this->args['a_tag_classes'] );
		}

		/**
		 * Byline Classes Filter.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return string
		 */
		public function byline_classes_filter() {
			return apply_filters( "{$this->prefix}byline_classes_filter", $this->args['byline_classes'] );
		}

		/**
		 * Author Classes Filter.
		 *
		 * @author Jason Witt
		 * @since  0.0.1
		 *
		 * @return string
		 */
		public function author_classes_filter() {
			return apply_filters( "{$this->prefix}author_classes_filter", $this->args['author_classes'] );
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
		 * @return string The date the post was posted.
		 */
		public function render() {

			// A Tag.
			$a_tag_classes  = ( $this->args['a_tag_classes'] ) ? ' class="' . esc_attr( $this->a_tag_classes_filter() ) . '"' : '';
			$url            = esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) );
			$link_markup    = '<a' . $a_tag_classes . '" href="' . esc_url( $url ) . '">' . esc_html( get_the_author() ) . '</a>';
			$link           = ( $this->args['link'] ) ? $link_markup : esc_html( get_the_author() );
			$byline_classes = ( $this->args['byline_classes'] ) ? ' class="' . esc_attr( $this->byline_classes_filter() ) . '"' : '';
			$author_classes = ( $this->args['author_classes'] ) ? ' class="' . esc_attr( $this->author_classes_filter() ) . '"' : '';
			$output         = '<span' . $byline_classes . '">' . esc_html( $this->author_by_text_filter() ) . ' <span' . $author_classes . '">' . $link . '</span></span>';
			
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
