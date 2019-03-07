<?php

/**
 * Class WPML_Nova_Elements_Images_Layout
 */
class WPML_Nova_Elements_Images_Layout extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'image_list';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'item_title', 'item_desc' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'item_title':
				return esc_html__( 'Nova Images Layout: Item Title', 'nova-elements' );

			case 'item_desc':
				return esc_html__( 'Nova Images Layout: Item Description', 'nova-elements' );

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

			case 'item_desc':
				return 'VISUAL';

			default:
				return '';
		}
	}

}
