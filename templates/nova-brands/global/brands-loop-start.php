<?php
/**
 * Features list start template
 */
?>
<div class="brands-list grid-x grid-padding-x grid-padding-y <?php echo nova_elements_tools()->col_classes( array(
    'xxlarge' => $this->__get_html( 'columns' ),
    'xlarge' => $this->__get_html( 'columns_laptop' ),
    'large' => $this->__get_html( 'columns_tablet' ),
    'medium-ex'  => $this->__get_html( 'columns_width800' ),
    'medium'  => $this->__get_html( 'columns_mobile' ),
    'small'  => $this->__get_html( 'columns_width640' )
  ) ); ?>">
