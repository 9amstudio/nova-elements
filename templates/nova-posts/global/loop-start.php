<?php
/**
 * Posts loop start template
 */

$classes = array(
	'nova-posts',
	'grid-x',
	'grid-padding-x',
	'grid-padding-y',
);
$columns        = $this->get_attr( 'columns' );
$columns_tablet = $this->get_attr( 'columns_tablet' );
$columns_mobile = $this->get_attr( 'columns_mobile' );

$columns        = empty( $columns ) ? 3 : $columns;
$columns_tablet = empty( $columns_tablet ) ? 2 : $columns_tablet;
$columns_mobile = empty( $columns_mobile ) ? 1 : $columns_mobile;

$classes[] =  'large-up-' . $columns;
$classes[] =  'medium-up-' . $columns_tablet;
$classes[] =  'small-up-' . $columns_mobile;

$classes[] =  'preset-' . $this->get_attr( 'preset' );
?>
<div class="<?php echo implode( ' ', $classes ); ?>">
