<?php
/**
 * team-member loop start template
 */
?>
<div class="nova-team-member__item <?php echo nova_elements_tools()->col_classes( array(
    'desk' => $this->get_attr( 'columns' ),
    'lap' => $this->get_attr( 'columns_laptop' ),
    'tab' => $this->get_attr( 'columns_width800' ),
    'tabp'  => $this->get_attr( 'columns_tablet' ),
    'mob'  => $this->get_attr( 'columns_mobile' ),
    'mobp'  => $this->get_attr( 'columns_width640' ),
) ); ?>">
	<div class="nova-team-member__inner-box">
        <div class="nova-team-member__inner">
            <div class="nova-team-member__image">
                <div class="nova-team-member__cover">
                    <div class="nova-team-member__socials">
                        <div class="nova-team-member__socials-item">
                            <a href="#">
                                <div class="nova-team-member__socials-icon">
                                    <div class="inner"><i class="fa fa-facebook"></i></div>
                                </div>
                            </a>
                        </div>
                        <div class="nova-team-member__socials-item">
                            <a href="#">
                                <div class="nova-team-member__socials-icon">
                                    <div class="inner"><i class="fa fa-google-plus"></i></div>
                                </div>
                            </a>
                        </div>
                        <div class="nova-team-member__socials-item">
                            <a href="#">
                                <div class="nova-team-member__socials-icon">
                                    <div class="inner"><i class="fa fa-twitter"></i></div>
                                </div>
                            </a></div>
                        <div class="nova-team-member__socials-item"><a href="#">
                                <div class="nova-team-member__socials-icon">
                                    <div class="inner"><i class="fa fa-instagram"></i></div>
                                </div>
                            </a></div>
                    </div>
                </div>
                <figure class="nova-team-member__figure">
                    <img class="nova-team-member__img-tag" src="https://novaelements.zemez.io/wp-content/uploads/2017/10/team-2.jpg" alt="">
                </figure>
            </div>
            <div class="nova-team-member__content">
                <h3 class="nova-team-member__name">
                    <span class="nova-team-member__name-first">John</span>
                </h3>
                <div class="nova-team-member__position"><span>Founder &amp; CEO</span></div>
            </div>
        </div>
    </div>
</div>