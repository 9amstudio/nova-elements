<?php
$settings = $this->get_settings_for_display();
$attr_array = array();
$class_array = array( 'nova-instagram-gallery__instance' );
$class_array[] = 'layout-type-' . $settings['layout_type'];

if ( 'grid' === $settings['layout_type'] ) {
	$class_array[] = 'grid-x';
	//$class_array[] = 'grid-padding-x';
}

if ( filter_var( $settings['show_on_hover'], FILTER_VALIDATE_BOOLEAN ) ) {
	$class_array[] = 'show-overlay-on-hover';
}

$columns        = $settings['columns'];
$columns_tablet = $settings['columns_tablet'];
$columns_mobile = $settings['columns_mobile'];

$columns        = empty( $columns ) ? 3 : $columns;
$columns_tablet = empty( $columns_tablet ) ? 2 : $columns_tablet;
$columns_mobile = empty( $columns_mobile ) ? 1 : $columns_mobile;

$class_array[] =  'large-up-' . $columns;
$class_array[] =  'medium-up-' . $columns_tablet;
$class_array[] =  'small-up-' . $columns_mobile;

$classes = implode( ' ', $class_array );
$attrs = implode( ' ', $attr_array );
?>

<div class="<?php echo $classes; ?>" <?php echo $attrs; ?>>
	<?php
	$this->render_gallery();
?>
</div>
