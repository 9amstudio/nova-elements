<?php
/**
 * Posts loop start template
 */
?>
<div class="nova-posts__item <?php echo nova_elements_tools()->col_classes( array(
    'desk' => $this->get_attr( 'columns' ),
    'lap' => $this->get_attr( 'columns_laptop' ),
    'tab' => $this->get_attr( 'columns_width800' ),
    'tabp'  => $this->get_attr( 'columns_tablet' ),
    'mob'  => $this->get_attr( 'columns_mobile' ),
    'mobp'  => $this->get_attr( 'columns_width640' ),
) ); ?>">
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