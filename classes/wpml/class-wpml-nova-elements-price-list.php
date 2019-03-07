<?php

/**
 * Class WPML_Nova_Elements_Price_List
 */
class WPML_Nova_Elements_Price_List extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'price_list';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'item_title', 'item_price', 'item_text' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'item_title':
				return esc_html__( 'Nova Price List: Item Title', 'nova-elements' );

			case 'item_price':
				return esc_html__( 'Nova Price List: Item Price', 'nova-elements' );

			case 'item_text':
				return esc_html__( 'Nova Price List: Item Description', 'nova-elements' );

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
			case 'item_price':
			case 'item_text':
				return 'LINE';

			default:
				return '';
		}
	}

}
