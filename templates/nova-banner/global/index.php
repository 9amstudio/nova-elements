<?php
/**
 * Loop item template
 */
?>
<figure class="nova-banner nova-effect-<?php $this->__html( 'animation_effect', '%s' ); ?>"><?php
	$target = $this->__get_html( 'banner_link_target', ' target="%s"' );
		echo '<div class="nova-banner__overlay"></div>';
		echo $this->__get_banner_image();
		echo '<figcaption class="nova-banner__content">';
			echo '<div class="nova-banner__content-wrap">';
				$title_tag = $this->__get_html( 'banner_title_html_tag', '%s' );

				$this->__html( 'banner_title', '<' . $title_tag  . ' class="nova-banner__title">%s</' . $title_tag  . '>' );
				$this->__html( 'banner_text', '<div class="nova-banner__text">%s</div>' );
				$this->__html( 'button_link', '<div class="nova-banner__btn-wrap"><a href="%s" class="button bordered nova-banner__button"' . $target . '>' );
				$this->__html( 'banner_button', '%s' );
				$this->__html( 'button_link', '</a></div>' );
			echo '</div>';
            $this->__html( 'banner_link', '<a href="%s" class="nova-banner__link"' . $target . '></a>' );
		echo '</figcaption>';
?></figure>
