<?php
/**
 * Base Class.
 *
 * @package    WP_Distance_Lib
 * @subpackage WP_Distance_Lib/Includes/Classes
 * @author     Jason Witt <contact@jawittdesigns.com>
 * @copyright  Copyright (c) 2017, Jason Witt
 * @license    GNU General Public License v2 or later
 * @version    0.0.1
 */

namespace WP_Distance_Lib\Includes\Classes;

/**
 * Base Class
 */
abstract class Base {

	/**
	 * Prefix.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 *
	 * @var string
	 */
	protected $prefix = '';

	/**
	 * Argument Defaults.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 *
	 * @var string
	 */
	protected $defaults = array();

	/**
	 * Arguments.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 *
	 * @var array
	 */
	protected $args = array();

	/**
	 * Initialize the class.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 *
	 * @param array $args The arguments.
	 *
	 * @return void
	 */
	public function __construct( $args = array() ) {
		$this->prefix = $this->prefix();
		$this->args   = wp_parse_args( $args, $this->defaults );
	}

	/**
	 * Perfix.
	 *
	 * @author Jason Witt
	 * @since  0.0.1
	 *
	 * @return string
	 */
	private function prefix() {
		$classname = get_class( $this );
		// Strip off namespace.
		$classname = substr( $classname, strrpos( $classname, '\\' ) + 1 );
		// Make lower case.
		$classname = strtolower( $classname );
		return $classname . '_';
	}
}
