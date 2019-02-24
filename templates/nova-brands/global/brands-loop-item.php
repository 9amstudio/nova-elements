<?php
/**
 * Features list item template
 */
?>
<div class="brands-list__item cell"><?php
	echo $this->__open_brand_link( 'item_url' );
	echo $this->__loop_item( array( 'item_image', 'url' ), '<div class="brands-list__item-img-wrap"><img src="%s" alt="" class="brands-list__item-img"></div>' );
	echo $this->__loop_item( array( 'item_name' ), '<h5 class="brands-list__item-name">%s</h5>' );
	echo $this->__loop_item( array( 'item_desc' ), '<div class="brands-list__item-desc">%s</div>' );
	echo $this->__close_brand_link( 'item_url' );
?></div>
