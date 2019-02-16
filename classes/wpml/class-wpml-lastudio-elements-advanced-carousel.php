<?php

/**
 * Class WPML_Nova_Elements_Advanced_Carousel
 */
class WPML_Nova_Elements_Advanced_Carousel extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'items_list';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'item_title', 'item_text', 'item_button_text' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'item_title':
				return esc_html__( 'Advanced Carousel: Item Title', 'nova-elements' );

			case 'item_text':
				return esc_html__( 'Advanced Carousel: Item Description', 'nova-elements' );

			case 'item_button_text':
				return esc_html__( 'Advanced Carousel: Item Button Text', 'nova-elements' );

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

			case 'item_text':
				return 'VISUAL';

			case 'item_button_text':
				return 'LINE';

			default:
				return '';
		}
	}

}
