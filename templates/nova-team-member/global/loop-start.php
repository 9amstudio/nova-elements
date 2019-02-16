<?php
/**
 * team-member loop start template
 */

$classes = array(
	'nova-team-member',
	'col-row',
	'preset-'. $this->get_attr( 'preset' ),
	nova_elements_tools()->gap_classes( $this->get_attr( 'columns_gap' ), $this->get_attr( 'rows_gap' ) ),
);

$equal = $this->get_attr( 'equal_height_cols' );

if ( $equal ) {
	$classes[] = 'nova-equal-cols';
}

?>
<div class="<?php echo implode( ' ', $classes ); ?>">