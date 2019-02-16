<?php

/**
 * Class WPML_Nova_Elements_Brands
 */
class WPML_Nova_Elements_Brands extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'brands_list';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'item_name', 'item_desc' );
	}

	/**
	 * @param string $field
	 *
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'item_name':
				return esc_html__( 'Nova Brands: Company Name', 'nova-elements' );

			case 'item_desc':
				return esc_html__( 'Nova Brands: Company Description', 'nova-elements' );

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
			case 'item_name':
				return 'LINE';

			case 'item_desc':
				return 'VISUAL';

			default:
				return '';
		}
	}

}
