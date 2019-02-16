<?php

/**
 * Class WPML_Nova_Elements_Timeline
 */
class WPML_Nova_Elements_Timeline extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'cards_list';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'item_title', 'item_meta', 'item_desc', 'item_point_text' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'item_title':
				return esc_html__( 'Nova Vertical Timeline: Item Title', 'nova-elements' );

			case 'item_meta':
				return esc_html__( 'Nova Vertical Timeline: Item Meta', 'nova-elements' );

			case 'item_desc':
				return esc_html__( 'Nova Vertical Timeline: Item Description', 'nova-elements' );

			case 'item_point_text':
				return esc_html__( 'Nova Vertical Timeline: Item Point Text', 'nova-elements' );

			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch( $field ) {
			case 'item_title':
				return 'LINE';

			case 'item_meta':
				return 'LINE';

			case 'item_desc':
				return 'VISUAL';

			case 'item_point_text':
				return 'LINE';

			default:
				return '';
		}
	}

}
