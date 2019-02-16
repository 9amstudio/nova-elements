<?php
namespace Nova_Elements\Classes;

class Nova_Elements_WPML {
    public function __construct()
    {
		add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'translate_fields' ] );
	}
	
	public function translate_fields ( $nodes_to_translate ) {


        $nodes_to_translate[ 'nova-animated-box' ] = array(
            'conditions' => array( 'widgetType' => 'nova-animated-box' ),
            'fields'     => array(
                array(
                    'field'       => 'front_side_title',
                    'type'        => esc_html__( 'Nova Animated Box: Front Title', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'front_side_subtitle',
                    'type'        => esc_html__( 'Nova Animated Box: Front SubTitle', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'front_side_description',
                    'type'        => esc_html__( 'Nova Animated Box: Front Description', 'nova-elements' ),
                    'editor_type' => 'VISUAL',
                ),
                array(
                    'field'       => 'back_side_title',
                    'type'        => esc_html__( 'Nova Animated Box: Back Title', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'back_side_subtitle',
                    'type'        => esc_html__( 'Nova Animated Box: Back SubTitle', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'back_side_description',
                    'type'        => esc_html__( 'Nova Animated Box: Back Description', 'nova-elements' ),
                    'editor_type' => 'VISUAL',
                ),
                array(
                    'field'       => 'back_side_button_text',
                    'type'        => esc_html__( 'Nova Animated Box: Button Text', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
            ),
        );

        $nodes_to_translate[ 'nova-banner' ] = array(
            'conditions' => array( 'widgetType' => 'nova-banner' ),
            'fields'     => array(
                array(
                    'field'       => 'banner_title',
                    'type'        => esc_html__( 'Nova Banner: Title', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'banner_text',
                    'type'        => esc_html__( 'Nova Banner: Description', 'nova-elements' ),
                    'editor_type' => 'VISUAL',
                ),
            ),
        );

        $nodes_to_translate[ 'nova-countdown-timer' ] = array(
            'conditions' => array( 'widgetType' => 'nova-countdown-timer' ),
            'fields'     => array(
                array(
                    'field'       => 'label_days',
                    'type'        => esc_html__( 'Nova Countdown Timer: Label Days', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'label_hours',
                    'type'        => esc_html__( 'Nova Countdown Timer: Label Hours', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'label_min',
                    'type'        => esc_html__( 'Nova Countdown Timer: Label Min', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'label_sec',
                    'type'        => esc_html__( 'Nova Countdown Timer: Label Sec', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),

            ),
        );

        $nodes_to_translate[ 'nova-download-button' ] = array(
            'conditions' => array( 'widgetType' => 'nova-download-button' ),
            'fields'     => array(
                array(
                    'field'       => 'download_label',
                    'type'        => esc_html__( 'Nova Download Button: Label', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),

            ),
        );

        $nodes_to_translate[ 'nova-circle-progress' ] = array(
            'conditions' => array( 'widgetType' => 'nova-circle-progress' ),
            'fields'     => array(
                array(
                    'field'       => 'title',
                    'type'        => esc_html__( 'Nova Circle Progress: Title', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'subtitle',
                    'type'        => esc_html__( 'Nova Circle Progress: Subtitle', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
            ),
        );

        $nodes_to_translate[ 'nova-posts' ] = array(
            'conditions' => array( 'widgetType' => 'nova-posts' ),
            'fields'     => array(
                array(
                    'field'       => 'more_text',
                    'type'        => esc_html__( 'Nova Posts: Read More Button Text', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
            ),
        );

        $nodes_to_translate[ 'nova-animated-text' ] = array(
            'conditions' => array( 'widgetType' => 'nova-animated-text' ),
            'fields'     => array(
                array(
                    'field'       => 'before_text_content',
                    'type'        => esc_html__( 'Nova Animated Text: Before Text', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'after_text_content',
                    'type'        => esc_html__( 'Nova Animated Text: After Text', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
            ),
            'integration-class' => 'WPML_Nova_Elements_Animated_Text',
        );

        $nodes_to_translate[ 'nova-carousel' ] = array(
            'conditions'        => array( 'widgetType' => 'nova-carousel' ),
            'fields'            => array(),
            'integration-class' => 'WPML_Nova_Elements_Advanced_Carousel',
        );

        $nodes_to_translate[ 'nova-advanced-map' ] = array(
            'conditions' => array( 'widgetType' => 'nova-advanced-map' ),
            'fields'     => array(
                array(
                    'field'       => 'map_center',
                    'type'        => esc_html__( 'Nova Map: Map Center', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
            ),
            'integration-class' => 'WPML_Nova_Elements_Advanced_Map',
        );

        $nodes_to_translate[ 'nova-brands' ] = array(
            'conditions'        => array( 'widgetType' => 'nova-brands' ),
            'fields'            => array(),
            'integration-class' => 'WPML_Nova_Elements_Brands',
        );

        $nodes_to_translate[ 'nova-images-layout' ] = array(
            'conditions'        => array( 'widgetType' => 'nova-images-layout' ),
            'fields'            => array(),
            'integration-class' => 'WPML_Nova_Elements_Images_Layout',
        );

        $nodes_to_translate[ 'nova-pricing-table' ] = array(
            'conditions' => array( 'widgetType' => 'nova-pricing-table' ),
            'fields'     => array(
                array(
                    'field'       => 'title',
                    'type'        => esc_html__( 'Nova Pricing Table: Title', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'subtitle',
                    'type'        => esc_html__( 'Nova Pricing Table: Subtitle', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'price_prefix',
                    'type'        => esc_html__( 'Nova Pricing Table: Price Prefix', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'price',
                    'type'        => esc_html__( 'Nova Pricing Table: Price', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'price_suffix',
                    'type'        => esc_html__( 'Nova Pricing Table: Price Suffix', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'price_desc',
                    'type'        => esc_html__( 'Nova Pricing Table: Price Description', 'nova-elements' ),
                    'editor_type' => 'VISUAL',
                ),
                array(
                    'field'       => 'button_before',
                    'type'        => esc_html__( 'Nova Pricing Table: Button Before', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'button_text',
                    'type'        => esc_html__( 'Nova Pricing Table: Button Text', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'button_after',
                    'type'        => esc_html__( 'Nova Pricing Table: Button After', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
            ),
            'integration-class' => 'WPML_Nova_Elements_Pricing_Table',
        );

        $nodes_to_translate[ 'nova-slider' ] = array(
            'conditions'        => array( 'widgetType' => 'nova-slider' ),
            'fields'            => array(),
            'integration-class' => 'WPML_Nova_Elements_Slider',
        );

        $nodes_to_translate[ 'nova-services' ] = array(
            'conditions' => array( 'widgetType' => 'nova-services' ),
            'fields'     => array(
                array(
                    'field'       => 'services_title',
                    'type'        => esc_html__( 'Nova Services: Title', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'services_description',
                    'type'        => esc_html__( 'Nova Services: Description', 'nova-elements' ),
                    'editor_type' => 'VISUAL',
                ),
                array(
                    'field'       => 'button_text',
                    'type'        => esc_html__( 'Nova Services: Button Text', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
            ),
        );

        $nodes_to_translate[ 'nova-team-member' ] = array(
            'conditions' => array( 'widgetType' => 'nova-team-member' ),
            'fields'     => array(
                array(
                    'field'       => 'member_first_name',
                    'type'        => esc_html__( 'Nova Team Member: First Name', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'member_last_name',
                    'type'        => esc_html__( 'Nova Team Member: Last Name', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'member_position',
                    'type'        => esc_html__( 'Nova Team Member: Position', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'member_description',
                    'type'        => esc_html__( 'Nova Team Member: Description', 'nova-elements' ),
                    'editor_type' => 'VISUAL',
                ),
            ),
            'integration-class' => 'WPML_Nova_Elements_Team_Member',
        );

        $nodes_to_translate[ 'nova-testimonials' ] = array(
            'conditions' => array( 'widgetType' => 'nova-testimonials' ),
            'fields'     => array(),
            'integration-class' => 'WPML_Nova_Elements_Testimonials',
        );

        $nodes_to_translate[ 'nova-button' ] = array(
            'conditions' => array( 'widgetType' => 'nova-button' ),
            'fields'     => array(
                array(
                    'field'       => 'button_label_normal',
                    'type'        => esc_html__( 'Nova Button: Normal Label', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'button_label_hover',
                    'type'        => esc_html__( 'Nova Button: Hover Label', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
            ),
        );

        $nodes_to_translate[ 'nova-image-comparison' ] = array(
            'conditions'        => array( 'widgetType' => 'nova-image-comparison' ),
            'fields'            => array(),
            'integration-class' => 'WPML_Nova_Elements_Image_Comparison',
        );

        $nodes_to_translate[ 'nova-headline' ] = array(
            'conditions' => array( 'widgetType' => 'nova-headline' ),
            'fields'     => array(
                array(
                    'field'       => 'first_part',
                    'type'        => esc_html__( 'Nova Headline: First Part', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'second_part',
                    'type'        => esc_html__( 'Nova Headline: Second Part', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
            ),
        );

        $nodes_to_translate[ 'nova-scroll-navigation' ] = array(
            'conditions'        => array( 'widgetType' => 'nova-scroll-navigation' ),
            'fields'            => array(),
            'integration-class' => 'WPML_Nova_Elements_Scroll_Navigation',
        );

        $nodes_to_translate[ 'nova-subscribe-form' ] = array(
            'conditions' => array( 'widgetType' => 'nova-subscribe-form' ),
            'fields'     => array(
                array(
                    'field'       => 'submit_button_text',
                    'type'        => esc_html__( 'Nova Subscribe Form: Submit Text', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'submit_placeholder',
                    'type'        => esc_html__( 'Nova Subscribe Form: Input Placeholder', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
            ),
            'integration-class' => 'WPML_Nova_Elements_Subscribe_Form',
        );

        $nodes_to_translate[ 'nova-dropbar' ] = array(
            'conditions' => array( 'widgetType' => 'nova-dropbar' ),
            'fields'     => array(
                array(
                    'field'       => 'button_text',
                    'type'        => esc_html__( 'Nova Dropbar: Button Text', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'simple_content',
                    'type'        => esc_html__( 'Nova Dropbar: Simple Text', 'nova-elements' ),
                    'editor_type' => 'VISUAL',
                ),
            ),
        );

        $nodes_to_translate[ 'nova-portfolio' ] = array(
            'conditions' => array( 'widgetType' => 'nova-portfolio' ),
            'fields'     => array(
                array(
                    'field'       => 'all_filter_label',
                    'type'        => esc_html__( 'Nova Portfolio: `All` Filter Label', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
                array(
                    'field'       => 'view_more_button_text',
                    'type'        => esc_html__( 'Nova Portfolio: View More Button Text', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
            ),
            'integration-class' => 'WPML_Nova_Elements_Portfolio',
        );

        $nodes_to_translate[ 'nova-price-list' ] = array(
            'conditions'        => array( 'widgetType' => 'nova-price-list' ),
            'fields'            => array(),
            'integration-class' => 'WPML_Nova_Elements_Price_List',
        );

        $nodes_to_translate[ 'nova-progress-bar' ] = array(
            'conditions' => array( 'widgetType' => 'nova-progress-bar' ),
            'fields'     => array(
                array(
                    'field'       => 'title',
                    'type'        => esc_html__( 'Nova Progress Bar: Title', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
            ),
        );

        $nodes_to_translate[ 'nova-timeline' ] = array(
            'conditions'        => array( 'widgetType' => 'nova-timeline' ),
            'fields'            => array(),
            'integration-class' => 'WPML_Nova_Elements_Timeline',
        );

        $nodes_to_translate[ 'nova-weather' ] = array(
            'conditions' => array( 'widgetType' => 'nova-weather' ),
            'fields'     => array(
                array(
                    'field'       => 'location',
                    'type'        => esc_html__( 'Nova Weather: Location', 'nova-elements' ),
                    'editor_type' => 'LINE',
                ),
            ),
        );

        $nodes_to_translate[ 'nova-table' ] = array(
            'conditions'        => array( 'widgetType' => 'nova-table' ),
            'fields'            => array(),
            'integration-class' => 'WPML_Nova_Elements_Table',
        );

        $nodes_to_translate[ 'nova-horizontal-timeline' ] = array(
            'conditions'        => array( 'widgetType' => 'nova-horizontal-timeline' ),
            'fields'            => array(),
            'integration-class' => 'WPML_Nova_Elements_Horizontal_Timeline',
        );

		$this->init_classes();
		
		return $nodes_to_translate;
	}
	
	private function init_classes() {
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-advanced-carousel.php';
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-map.php';
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-animated-text.php';
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-brands.php';
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-images-layout.php';
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-pricing-table.php';
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-slider.php';
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-team-member.php';
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-testimonials.php';
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-image-comparison.php';
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-scroll-navigation.php';
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-portfolio.php';
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-price-list.php';
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-subscribe-form.php';
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-timeline.php';
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-table.php';
        require_once NOVA_ELEMENTS_PATH . 'classes/wpml/class-wpml-nova-elements-horizontal-timeline.php';
	}
}

$nova_elements_wpml = new Nova_Elements_WPML();
