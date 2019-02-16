<?php
/**
 * Testimonials item template
 */


$preset = $this->get_settings( 'preset' );

$class_array = array('nova-testimonials__item');

if( $this->get_settings('enable_carousel') != 'true' ) {
    $class_array[] = nova_elements_tools()->col_classes( array(
        'desk' => $this->get_settings( 'slides_to_show' ),
        'lap' => $this->get_settings( 'slides_to_show_laptop' ),
        'tab' => $this->get_settings( 'slides_to_show_width800' ),
        'tabp'  => $this->get_settings( 'slides_to_show_tablet' ),
        'mob'  => $this->get_settings( 'slides_to_show_mobile' ),
        'mobp'  => $this->get_settings( 'slides_to_show_with640' ),
    ) );
}

?>
<div class="<?php echo esc_attr(join(' ', $class_array)); ?>">
	<div class="nova-testimonials__item-inner">
		<div class="nova-testimonials__content"><?php

			if($preset == 'type-1'){
				echo $this->__loop_item( array( 'item_icon' ), '<div class="nova-testimonials__icon"><div class="nova-testimonials__icon-inner"><i class="%s"></i></div></div>' );
				echo $this->__loop_item( array( 'item_comment' ), '<p class="nova-testimonials__comment"><span>%s</span></p>' );
				echo '<div class="nova-testimonials_info">';
				echo $this->__loop_item( array( 'item_image', 'url' ), '<figure class="nova-testimonials__figure"><img class="nova-testimonials__tag-img" src="%s" alt=""></figure>' );
				echo $this->__loop_item( array( 'item_name' ), '<div class="nova-testimonials__name"><span>%s</span></div>' );
				echo $this->__loop_item( array( 'item_position' ), '<div class="nova-testimonials__position"><span>%s</span></div>' );
				echo '</div>';
			}
			else{
				echo $this->__loop_item( array( 'item_image', 'url' ), '<figure class="nova-testimonials__figure"><img class="nova-testimonials__tag-img" src="%s" alt=""></figure>' );
				echo $this->__loop_item( array( 'item_icon' ), '<div class="nova-testimonials__icon"><div class="nova-testimonials__icon-inner"><i class="%s"></i></div></div>' );
				echo $this->__loop_item( array( 'item_title' ), '<h5 class="nova-testimonials__title">%s</h5>' );
				echo $this->__loop_item( array( 'item_comment' ), '<p class="nova-testimonials__comment"><span>%s</span></p>' );
				echo $this->__loop_item( array( 'item_name' ), '<div class="nova-testimonials__name"><span>%s</span></div>' );
				echo $this->__loop_item( array( 'item_position' ), '<div class="nova-testimonials__position"><span>%s</span></div>' );

				$item_rating = $this->__loop_item( array( 'item_rating' ), '%d' );
				if(absint($item_rating)> 0){
                    $percentage =  (absint($item_rating) * 10) . '%';
                    echo '<div class="nova-testimonials__rating"><span class="star-rating"><span style="width: '.$percentage.'"></span></span></div>';
                }
			}
		?></div>
	</div>
</div>