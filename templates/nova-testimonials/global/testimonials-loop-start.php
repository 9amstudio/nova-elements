<?php
/**
 * Testimonials start template
 */

$data_settings = '';

$use_comment_corner = $this->get_settings( 'use_comment_corner' );

if( $this->get_settings('enable_carousel') == 'true' ) {
    $class_array[] = 'enable-carousel';
    $class_array[] = 'nova-testimonials__instance';
    $class_array[] = 'elementor-slick-slider';
    $data_settings = $this->generate_setting_json();
}
else{
    $class_array[] = 'nova-testimonials__row';
    $class_array[] = 'grid-x grid-padding-x grid-padding-y';
}

if ( filter_var( $use_comment_corner, FILTER_VALIDATE_BOOLEAN ) ) {
	$class_array[] = 'nova-testimonials--comment-corner';
}
if( $this->get_settings('enable_carousel') != 'true' ) {
    $small = $this->get_settings( 'slides_to_show_with640' ) ? $this->get_settings( 'slides_to_show_with640' ) : '1';
    $medium = $this->get_settings( 'slides_to_show_mobile' ) ? $this->get_settings( 'slides_to_show_mobile' ) : '2';
    $medium_ex = $this->get_settings( 'slides_to_show_tablet' ) ? $this->get_settings( 'slides_to_show_tablet' ) : '2';
    $large = $this->get_settings( 'slides_to_show_width800' ) ? $this->get_settings( 'slides_to_show_width800' ) : '2';
    $xlarge = $this->get_settings( 'slides_to_show_laptop' ) ? $this->get_settings( 'slides_to_show_laptop' ) : '3';
    $xxlarge = $this->get_settings( 'slides_to_show' ) ? $this->get_settings( 'slides_to_show' ) : '3';
    $class_array[] = nova_elements_tools()->col_classes( array(
        'xxlarge' => $xxlarge,
        'xlarge' => $xlarge,
        'large' => $large,
        'medium-ex'  => $medium_ex,
        'medium'  => $medium,
        'small'  => $small,
    ) );
}
$classes = implode( ' ', $class_array );

$dir = is_rtl() ? 'rtl' : 'ltr';

?>
<div class="<?php echo $classes; ?>" <?php echo $data_settings; ?> dir="<?php echo $dir; ?>">
