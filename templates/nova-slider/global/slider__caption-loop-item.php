<?php

$settings = $this->get_settings_for_display();

?>

<div class="swiper-slide">
  <div class="slider__item">
    <?php
      echo $this->__loop_item( array( 'item_subtitle' ), '<h6 class="slide-subtitle"><span class="down-up"><span>%s</span></span></h6>' );
      echo $this->__loop_item( array( 'item_title' ), '<h1 class="slide-title"><span class="down-up"><span>%s</span></span></h1>' );
      echo $this->__loop_item( array( 'item_desc' ), '<div class="slide-description"><span class="down-up"><span>%s</span></span></div>' );
    ?>
    <div class="nova-slider__button-wrapper">
      <span class="down-up"><span><?php
      echo $this->__loop_button_item( array( 'item_button_primary_url', 'item_button_primary_text' ), '<a class="elementor-button elementor-size-md nova-slider__button nova-slider__button--primary" href="%1$s">%2$s</a>' );
      echo $this->__loop_button_item( array( 'item_button_secondary_url', 'item_button_secondary_text' ), '<a class="elementor-button elementor-size-md nova-slider__button nova-slider__button--secondary" href="%1$s">%2$s</a>' ); ?>
      </span></span>
    </div>
  </div>
</div>
