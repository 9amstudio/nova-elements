<?php
/**
 * Posts loop start template
 */
?>
<div class="nova-posts__item cell">
	<div class="nova-posts__inner-box"<?php $this->add_box_bg(); ?>><?php

        $this->_load_template( $this->get_template( 'item-thumb' ) );

		echo '<div class="nova-posts__inner-content">';

            $this->_load_template( $this->get_template( 'item-title' ) );
            $this->_load_template( $this->get_template( 'item-meta' ) );
            $this->_load_template( $this->get_template( 'item-content' ) );
            $this->_load_template( $this->get_template( 'item-more' ) );

		echo '</div>';

	?></div>
</div>
