<?php

$settings = $this->get_settings_for_display();

$use_icon = $this->get_settings_for_display( 'use_button_icon' );

?>

<div class="swiper-slide">
  <div class="slider__item">
    <?php
      echo $this->__loop_item( array( 'item_subtitle' ), '<h6 class="slide-subtitle"><span class="down-up"><span>%s</span></span></h6>' );
      echo $this->__loop_item( array( 'item_title' ), '<h1 class="slide-title"><span class="down-up"><span>%s</span></span></h1>' );
      echo $this->__loop_item( array( 'item_desc' ), '<div class="slide-description"><span class="down-up"><span>%s</span></span></div>' );
    ?>
    <span class="down-up"><span>
    <div class="nova-button__container">
      <?php
      /*
        echo $this->__loop_button_item( array( 'item_button_primary_url', 'item_button_primary_text' ), '<a '.$this->get_render_attribute_string( 'nova-button-primary' ).' href="%1$s">
        <div class="nova-button__plane nova-button__plane-normal"></div>
    		<div class="nova-button__plane nova-button__plane-hover"></div>
        <div class="nova-button__state nova-button__state-normal">
          '. (filter_var( $use_icon, FILTER_VALIDATE_BOOLEAN ) ? $this->__get_html( 'primary_button_icon', '<span class="nova-button__icon"><i class="%s"></i></span>' ) : '') .'
          <span class="nova-button__label">%2$s</span>
        </div>
        <div class="nova-button__state nova-button__state-hover">
          '. (filter_var( $use_icon, FILTER_VALIDATE_BOOLEAN ) ? $this->__get_html( 'primary_button_hover_icon', '<span class="nova-button__icon"><i class="%s"></i></span>' ) : '') .'
          <span class="nova-button__label">%2$s</span>
        </div>
        </a>' );
        echo $this->__loop_button_item( array( 'item_button_secondary_url', 'item_button_secondary_text' ), '<a '.$this->get_render_attribute_string( 'nova-button-secondary' ).' href="%1$s">
        <div class="nova-button__plane nova-button__plane-normal"></div>
    		<div class="nova-button__plane nova-button__plane-hover"></div>
        <div class="nova-button__state nova-button__state-normal">
          '. (filter_var( $use_icon, FILTER_VALIDATE_BOOLEAN ) ? $this->__get_html( 'secondary_button_icon', '<span class="nova-button__icon"><i class="%s"></i></span>' ) : '') .'
          <span class="nova-button__label">%2$s</span>
        </div>
        <div class="nova-button__state nova-button__state-hover">
          '. (filter_var( $use_icon, FILTER_VALIDATE_BOOLEAN ) ? $this->__get_html( 'secondary_button_hover_icon', '<span class="nova-button__icon"><i class="%s"></i></span>' ) : '') .'
          <span class="nova-button__label">%2$s</span>
        </div>
        </a>' );
        */
      ?>

    </div>
    </span></span>

    <div class="nova-slider__button-wrapper">
      <span class="down-up"><span><?php
      echo $this->__loop_button_item( array( 'item_button_primary_url', 'item_button_primary_text' ), '<a class="elementor-button elementor-size-md nova-slider__button nova-slider__button--primary" href="%1$s">%2$s</a>' );
      echo $this->__loop_button_item( array( 'item_button_secondary_url', 'item_button_secondary_text' ), '<a class="elementor-button elementor-size-md nova-slider__button nova-slider__button--secondary" href="%1$s">%2$s</a>' ); ?>
      </span></span>
    </div>
  </div>
</div>
