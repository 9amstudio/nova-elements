<?php
/**
 * Loop item more button
 */

if ( 'yes' !== $this->get_attr( 'show_more' ) ) {
	return;
}

nova_elements_utility()->get_button( array(
	'class' => 'button bordered dark nova-btn-readmore',
	'text'  => $this->get_attr( 'more_text' ),
	'icon'  => $this->html( $this->get_attr( 'more_icon' ), '<i class="nova-more-icon %1$s"></i>', array(), false ),
	'html'  => '<div class="nova-more-wrap"><a href="%1$s" %3$s><span class="btn__text">%4$s</span>%5$s</a></div>',
	'echo'  => true,
), 'post', get_the_ID());
