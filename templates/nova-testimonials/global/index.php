<?php
/**
 * Testimonials template
 */

$classes_list[] = 'nova-testimonials';
$equal_cols     = $this->get_settings( 'equal_height_cols' );

if ( 'true' === $equal_cols ) {
	$classes_list[] = 'nova-equal-cols';
}
$classes = implode( ' ', $classes_list );
?>

<div class="<?php echo $classes; ?>">
	<?php $this->__get_global_looped_template( 'testimonials', 'item_list' ); ?>
</div>
