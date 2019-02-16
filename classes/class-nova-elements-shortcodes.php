<?php
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! class_exists( 'Nova_Elements_Shortcodes' ) ) {

	/**
	 * Define Nova_Elements_Shortcodes class
	 */
	class Nova_Elements_Shortcodes {

		/**
		 * A reference to an instance of this class.
		 *
		 * @since 1.0.0
		 * @var   object
		 */
		private static $instance = null;

		/**
		 * Check if processing elementor widget
		 *
		 * @var boolean
		 */
		private $shortocdes = array();

		/**
		 * Initalize integration hooks
		 *
		 * @return void
		 */
		public function init() {
			add_action( 'init', array( $this, 'register_shortcodes' ), 30 );
		}

		/**
		 * Register plugins shortcodes
		 *
		 * @return void
		 */
		public function register_shortcodes() {

		    $this->shortocdes['nova-posts'] = new \Nova_Elements\Shortcodes\Posts();
		    $this->shortocdes['nova-team-member'] = new \Nova_Elements\Shortcodes\Team_Member();
		}

		/**
		 * Get shortcode class instance by tag
		 *
		 * @param  [type] $tag [description]
		 * @return [type]      [description]
		 */
		public function get_shortcode( $tag ) {
			return isset( $this->shortocdes[ $tag ] ) ? $this->shortocdes[ $tag ] : false;
		}

		/**
		 * Returns the instance.
		 *
		 * @since  1.0.0
		 * @return object
		 */
		public static function get_instance( $shortcodes = array() ) {

			// If the single instance hasn't been set, set it now.
			if ( null == self::$instance ) {
				self::$instance = new self( $shortcodes );
			}
			return self::$instance;
		}
	}

}

/**
 * Returns instance of Nova_Elements_Shortcodes
 *
 * @return object
 */
function nova_elements_shortocdes() {
	return Nova_Elements_Shortcodes::get_instance();
}
