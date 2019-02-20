<?php
/**
 * Slide item template
 */
$settings = $this->get_settings_for_display();

$container_width = $settings['slider_container_width']['size'];
$container_width = ( '%' === $settings['slider_container_width']['unit'] ) ? $container_width . $settings['slider_container_width']['unit'] : $container_width;

?>
<div class="nova-slider__item sp-slide">
	<?php
		echo $this->__loop_item_image_tag();
	?>
	<div class="nova-slider__content sp-layer" data-position="centerCenter" data-width="100%" data-height="100%" data-horizontal="0%" data-show-transition="up" data-show-duration="400" data-show-delay="400">
		<div class="nova-slider__content-item">
			<div class="nova-slider__content-inner">
				<?php
					echo $this->__loop_item( array( 'item_icon' ), '<div class="nova-slider__icon"><div class="nova-slider-icon-inner"><i class="%s"></i></div></div>' );
					echo $this->__loop_item( array( 'item_title' ), '<h5 class="nova-slider__title">%s</h5>' );
					echo $this->__loop_item( array( 'item_subtitle' ), '<h5 class="nova-slider__subtitle">%s</h5>' );
					echo $this->__loop_item( array( 'item_desc' ), '<div class="nova-slider__desc">%s</div>' );
				?>
				<div class="nova-slider__button-wrapper"><?php
					echo $this->__loop_button_item( array( 'item_button_primary_url', 'item_button_primary_text' ), '<a class="elementor-button elementor-size-md nova-slider__button nova-slider__button--primary" href="%1$s">%2$s</a>' );
					echo $this->__loop_button_item( array( 'item_button_secondary_url', 'item_button_secondary_text' ), '<a class="elementor-button elementor-size-md nova-slider__button nova-slider__button--secondary" href="%1$s">%2$s</a>' ); ?>
				</div>
			</div>
		</div>
	</div>
</div>
