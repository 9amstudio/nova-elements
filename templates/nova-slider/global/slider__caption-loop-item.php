<?php

$settings = $this->get_settings_for_display();

$use_icon = $this->get_settings_for_display( 'use_button_icon' );

?>

<div class="swiper-slide">
  <div class="slider__item">
    <?php
      echo $this->__loop_item( array( 'item_subtitle' ), '<div class="down-up"><div class="span"><h6 class="slide-subtitle">%s</h6></div></div>' );
      echo $this->__loop_item( array( 'item_title' ), '<div class="down-up"><div class="span"><h3 class="slide-title">%s</h3></div></div>' );
      echo $this->__loop_item( array( 'item_desc' ), '<div class="down-up"><div class="span"><div class="slide-description">%s</div></div></div>' );
    ?>

    <div class="nova-slider__button-wrapper">
      <div class="down-up"><div class="span">
        <div class="nova-button__container">
          <?php
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
          ?>
        </div>
        <div class="nova-button__container">
          <?php
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
          ?>
        </div>
      </div></div>
    </div>
  </div>
</div>
