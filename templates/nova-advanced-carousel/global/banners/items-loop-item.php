<?php
/**
 * Loop item template
 */
?>
<div class="nova-carousel__item<?php echo $this->__loop_item( array('item_css_class'), ' %s' )?>">
	<div class="nova-carousel__item-inner">
	<figure class="nova-banner nova-effect-<?php echo esc_attr( $this->get_settings_for_display( 'animation_effect' ) ); ?>"><?php
		$target = $this->__loop_item( array( 'item_link_target' ), ' target="%s"' );

		echo $this->__loop_item( array( 'item_link' ), '<a href="%s" class="nova-banner__link"' . $target . '>' );
			echo '<div class="nova-banner__overlay"></div>';
			echo $this->get_advanced_carousel_img( 'nova-banner__img' );
			echo '<figcaption class="nova-banner__content">';
				echo '<div class="nova-banner__content-wrap">';
					echo $this->__loop_item( array( 'item_title' ), '<h5 class="nova-banner__title">%s</h5>' );
					echo $this->__loop_item( array( 'item_text' ), '<div class="nova-banner__text">%s</div>' );
				echo '</div>';
			echo '</figcaption>';
		echo $this->__loop_item( array( 'item_link' ), '</a>' );
	?></figure>
	</div>
</div>