<?php

$settings = $this->get_settings_for_display();

$use_icon = $this->get_settings_for_display( 'use_button_icon' );
?>


<div class="swiper-slide">
  <div class="cover-slider" data-bg="<?php echo $this->__loop_item_image_src(); ?>">
    <div class="mobile-slider-caption">
      <?php
        echo $this->__loop_item( array( 'item_subtitle' ), '<h6 class="slide-subtitle">%s</h6>' );
        echo $this->__loop_item( array( 'item_title' ), '<h3 class="slide-title">%s</h3>' );
        echo $this->__loop_item( array( 'item_desc' ), '<div class="slide-description">%s</div>' );
      ?>
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
    </div>
    <?php echo $this->__loop_button_item( array( 'item_button_action_url', 'item_button_action_text' ), '<a class="slide-button" style="--slide-button-color: '.$this->__loop_item( array( 'item_button_action_bg_color' ) ).';" href="%1$s">%2$s<svg class="svg-icon"><use xlink:href="#reddot-arrow-right"></use></svg></a>' ); ?></div>
</div>
