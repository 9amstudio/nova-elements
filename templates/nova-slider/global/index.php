<?php
/**
 * Slider template
 */
$settings = $this->get_settings_for_display();
$data_settings = $this->generate_setting_json();

$classes_list[] = 'shortcode_nova_slider';
$classes_list[] = 'slider-horizontal';
$classes = implode( ' ', $classes_list );

$position = $this->get_settings_for_display( 'button_icon_position' );
$hover_effect = $this->get_settings_for_display( 'hover_effect' );

$this->add_render_attribute( 'nova-button-primary', 'class', 'nova-slider__button--primary' );
$this->add_render_attribute( 'nova-button-primary', 'class', 'nova-button__instance' );
$this->add_render_attribute( 'nova-button-primary', 'class', 'nova-button__instance--icon-' . $position );
$this->add_render_attribute( 'nova-button-primary', 'class', 'hover-' . $hover_effect );

$this->add_render_attribute( 'nova-button-secondary', 'class', 'nova-slider__button--secondary' );
$this->add_render_attribute( 'nova-button-secondary', 'class', 'nova-button__instance' );
$this->add_render_attribute( 'nova-button-secondary', 'class', 'nova-button__instance--icon-' . $position );
$this->add_render_attribute( 'nova-button-secondary', 'class', 'hover-' . $hover_effect );


?>

<div class="<?php echo $classes; ?>" <?php //echo $data_settings; ?>>
	<?php $this->__get_global_looped_template( 'slider__caption', 'item_list' ); ?>
	<?php $this->__get_global_looped_template( 'slider__image', 'item_list' ); ?>

	<!-- Control -->
	<div class="control-slider control-slider--vertical swiper-control">
		<div>
			<div class="swiper-button-next zoom-cursor">
				<svg class="slider-nav slider-nav--progress" viewBox="0 0 46 46">
					<circle class="slider-nav__path-progress slider-nav__path-progress--gray" cx="23" cy="23" r="22.5"/>
				</svg>
				<svg class="slider-nav slider-nav--gray" viewBox="0 0 46 46">
					<circle class="slider-nav__path--gray" cx="23" cy="23" r="22.5"/>
					<path class="slider-nav__arrow" d="M26.45 22.45l-4.91-4.91a.7707464.7707464 0 0 0-1.09 1.09L24.82 23l-4.36 4.36a.7707464.7707464 0 0 0 1.09 1.09l4.91-4.91a.77.77 0 0 0-.01-1.09z"/>
				</svg>
			</div>
			<div class="swiper-button-prev zoom-cursor">
				<svg class="slider-nav slider-nav--gray" viewBox="0 0 46 46">
					<circle class="slider-nav__path--gray" cx="23" cy="23" r="22.5"/>
					<path class="slider-nav__arrow" d="M18.5 23.55l4.91 4.91a.7707464.7707464 0 1 0 1.09-1.09L20.14 23l4.36-4.36a.7707464.7707464 0 0 0-1.09-1.09l-4.91 4.9a.77.77 0 0 0 0 1.1z"/>
				</svg>
			</div>
		</div>
	</div>
	<!-- /Control -->

</div>
