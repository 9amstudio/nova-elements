<?php
/**
 * Loop item template
 */

$title_tag     = $this->__get_html( 'title_html_tag', '%s' );
$sub_title_tag = $this->__get_html( 'sub_title_html_tag', '%s' );
?>
<div class="nova-animated-box <?php $this->__html( 'animation_effect', '%s' ); ?>">
	<div class="nova-animated-box__front">
		<div class="nova-animated-box__overlay"></div>
		<div class="nova-animated-box__inner">
			<?php
				$this->__html( 'front_side_icon', '<div class="nova-animated-box__icon nova-animated-box__icon--front"><div class="nova-animated-box-icon-inner"><i class="%s"></i></div></div>' );
			?>
			<div class="nova-animated-box__content">
			<?php
				$this->__html( 'front_side_title', '<' . $title_tag . ' class="nova-animated-box__title nova-animated-box__title--front">%s</' . $title_tag . '>' );
				$this->__html( 'front_side_subtitle', '<' . $sub_title_tag . ' class="nova-animated-box__subtitle nova-animated-box__subtitle--front">%s</' . $sub_title_tag . '>' );
				$this->__html( 'front_side_description', '<p class="nova-animated-box__description nova-animated-box__description--front">%s</p>' );
			?>
			</div>
		</div>
	</div>
	<div class="nova-animated-box__back">
		<div class="nova-animated-box__overlay"></div>
		<div class="nova-animated-box__inner">
			<?php
				$this->__html( 'back_side_icon', '<div class="nova-animated-box__icon nova-animated-box__icon--back"><div class="nova-animated-box-icon-inner"><i class="%s"></i></div></div>' );
			?>
			<div class="nova-animated-box__content">
			<?php
				$this->__html( 'back_side_title', '<' . $title_tag . ' class="nova-animated-box__title nova-animated-box__title--back">%s</' . $title_tag . '>' );
				$this->__html( 'back_side_subtitle', '<' . $sub_title_tag . ' class="nova-animated-box__subtitle nova-animated-box__subtitle--back">%s</' . $sub_title_tag . '>' );
				$this->__html( 'back_side_description', '<p class="nova-animated-box__description nova-animated-box__description--back">%s</p>' );
				$this->__glob_inc_if( 'action-button', array( 'back_side_button_link', 'back_side_button_text' ) );
			?>
			</div>
		</div>
	</div>
</div>
