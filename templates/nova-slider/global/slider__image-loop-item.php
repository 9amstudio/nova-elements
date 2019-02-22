<?php

$settings = $this->get_settings_for_display();

?>


<div class="swiper-slide">
  <div class="cover-slider" data-bg="<?php echo $this->__loop_item_image_src(); ?>"><?php echo $this->__loop_button_item( array( 'item_button_action_url', 'item_button_action_text' ), '<a class="slide-button" style="--slide-button-color: '.$this->__loop_item( array( 'item_button_action_bg_color' ) ).';" href="%1$s">%2$s<svg class="svg-icon"><use xlink:href="#reddot-arrow-right"></use></svg></a>' ); ?></div>
</div>
