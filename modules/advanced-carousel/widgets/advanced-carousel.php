<?php
namespace Nova_Elements\Modules\AdvancedCarousel\Widgets;

use Nova_Elements\Base\Nova_Widget;
use Nova_Elements\Controls\Group_Control_Box_Style;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Advanced_Carousel Widget
 */
class Advanced_Carousel extends Nova_Widget {
    public function get_name() {
        return 'nova-advanced-carousel';
    }

    protected function get_widget_title() {
        return esc_html__( 'Advanced Carousel', 'nova-elements' );
    }

    public function get_icon() {
        return 'novaelements-icon-1';
    }

    public function get_script_depends() {
        return [
            'nova-elements'
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_slides',
            array(
                'label' => esc_html__( 'Slides', 'nova-elements' ),
            )
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_image',
            array(
                'label'   => esc_html__( 'Image', 'nova-elements' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
                'dynamic' => array( 'active' => true ),
            )
        );

        $repeater->add_control(
            'item_title',
            array(
                'label'   => esc_html__( 'Item Title', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => array( 'active' => true ),
            )
        );

        $repeater->add_control(
            'item_text',
            array(
                'label'   => esc_html__( 'Item Description', 'nova-elements' ),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => array( 'active' => true ),
            )
        );

        $repeater->add_control(
            'item_link',
            array(
                'label'   => esc_html__( 'Item Link', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => array(
                    'active' => true,
                    'categories' => array(
                        TagsModule::POST_META_CATEGORY,
                        TagsModule::URL_CATEGORY,
                    ),
                ),
            )
        );

        $repeater->add_control(
            'item_link_target',
            array(
                'label'        => esc_html__( 'Open link in new window', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => '_blank',
                'condition'    => array(
                    'item_link!' => '',
                ),
            )
        );

        $repeater->add_control(
            'item_button_text',
            array(
                'label'   => esc_html__( 'Item Button Text', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
            )
        );

        $repeater->add_control(
            'item_css_class',
            array(
                'label'   => esc_html__( 'Item CSS Class', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
            )
        );

        $this->add_control(
            'items_list',
            array(
                'type'        => Controls_Manager::REPEATER,
                'fields'      => array_values( $repeater->get_controls() ),
                'default'     => array(
                    array(
                        'item_image' => array(
                            'url' => Utils::get_placeholder_image_src(),
                        ),
                        'item_title' => esc_html__( 'Item #1', 'nova-elements' ),
                        'item_text'  => esc_html__( 'Item #1 Description', 'nova-elements' ),
                        'item_link'  => '#',
                        'item_link_target'  => '',
                    ),
                ),
                'title_field' => '{{{ item_title }}}',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_settings',
            array(
                'label' => esc_html__( 'Settings', 'nova-elements' ),
            )
        );

        $this->add_control(
            'item_layout',
            array(
                'label'   => esc_html__( 'Items Layout', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'simple',
                'options' => array(
                    'banners'=> esc_html__( 'Banners', 'nova-elements' ),
                    'simple' => esc_html__( 'Simple', 'nova-elements' ),
                ),
            )
        );

        $this->add_control(
            'animation_effect',
            array(
                'label'   => esc_html__( 'Animation Effect', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'lily',
                'options' => array(
                    'none'   => esc_html__( 'None', 'nova-elements' ),
                    'lily'   => esc_html__( 'Lily', 'nova-elements' ),
                    'sadie'  => esc_html__( 'Sadie', 'nova-elements' ),
                    'layla'  => esc_html__( 'Layla', 'nova-elements' ),
                    'oscar'  => esc_html__( 'Oscar', 'nova-elements' ),
                    'marley' => esc_html__( 'Marley', 'nova-elements' ),
                    'ruby'   => esc_html__( 'Ruby', 'nova-elements' ),
                    'roxy'   => esc_html__( 'Roxy', 'nova-elements' ),
                    'bubba'  => esc_html__( 'Bubba', 'nova-elements' ),
                    'romeo'  => esc_html__( 'Romeo', 'nova-elements' ),
                    'sarah'  => esc_html__( 'Sarah', 'nova-elements' ),
                    'chico'  => esc_html__( 'Chico', 'nova-elements' )
                ),
                'condition' => array(
                    'item_layout' => 'banners',
                ),
            )
        );

        $this->add_control(
            'img_size',
            array(
                'type'       => 'select',
                'label'      => esc_html__( 'Images Size', 'nova-elements' ),
                'default'    => 'full',
                'options'    => nova_elements_tools()->get_image_sizes(),
            )
        );

        $this->add_control(
            'equal_height_cols',
            array(
                'label'        => esc_html__( 'Equal Columns Height', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'true',
                'default'      => '',
            )
        );

        $this->add_control(
            'fluid_width',
            array(
                'label'        => esc_html__( 'Fluid Columns Width', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'true',
                'default'      => '',
            )
        );

        $this->add_responsive_control(
            'slides_to_show',
            array(
                'label'   => esc_html__( 'Slides to Show', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '2',
                'options' => nova_elements_tools()->get_select_range( 10 ),
            )
        );

        $this->add_control(
            'slides_to_scroll',
            array(
                'label'     => esc_html__( 'Slides to Scroll', 'nova-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '1',
                'options'   => nova_elements_tools()->get_select_range( 10 ),
                'condition' => array(
                    'slides_to_show!' => '1',
                ),
            )
        );

        $this->add_control(
            'arrows',
            array(
                'label'        => esc_html__( 'Show Arrows Navigation', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'true',
                'default'      => 'true',
            )
        );

        $this->add_control(
            'prev_arrow',
            array(
                'label'   => esc_html__( 'Prev Arrow Icon', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'fa fa-angle-left',
                'options' => nova_elements_tools()->get_available_prev_arrows_list(),
                'condition' => array(
                    'arrows' => 'true',
                ),
            )
        );

        $this->add_control(
            'next_arrow',
            array(
                'label'   => esc_html__( 'Next Arrow Icon', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'fa fa-angle-right',
                'options' => nova_elements_tools()->get_available_next_arrows_list(),
                'condition' => array(
                    'arrows' => 'true',
                ),
            )
        );

        $this->add_control(
            'dots',
            array(
                'label'        => esc_html__( 'Show Dots Navigation', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'true',
                'default'      => '',
            )
        );

        $this->add_control(
            'center_mode',
            array(
                'label'        => esc_html__( 'Center Mode', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'yes',
                'default'      => ''
            )
        );

        $this->add_responsive_control(
            'center_mode_gap',
            array(
                'label' => esc_html__( 'Center Padding', 'nova-elements' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 1000,
                    ),
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                    ],
                    'vw' => array(
                        'min' => 0,
                        'max' => 50,
                    )
                ),
                'size_units' => ['px', '%', 'vw'],
                'default' => [
                    'size' => 30,
                    'unit' => 'px'
                ],
                'selectors' => array(
                    '{{WRAPPER}} .slick-list' => 'padding-left: {{SIZE}}{{UNIT}} !important; padding-right: {{SIZE}}{{UNIT}} !important;',
                ),
                'condition' => [
                    'center_mode' => 'yes'
                ]
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_additional_options',
            array(
                'label' => esc_html__( 'Additional Options', 'nova-elements' ),
            )
        );

        $this->add_control(
            'pause_on_hover',
            array(
                'label'        => esc_html__( 'Pause on Hover', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'true',
                'default'      => '',
            )
        );

        $this->add_control(
            'autoplay',
            array(
                'label'        => esc_html__( 'Autoplay', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'true',
                'default'      => 'true',
            )
        );

        $this->add_control(
            'autoplay_speed',
            array(
                'label'     => esc_html__( 'Autoplay Speed', 'nova-elements' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 5000,
                'condition' => array(
                    'autoplay' => 'true',
                ),
            )
        );

        $this->add_control(
            'infinite',
            array(
                'label'        => esc_html__( 'Infinite Loop', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'true',
                'default'      => 'true',
            )
        );

        $this->add_control(
            'effect',
            array(
                'label'   => esc_html__( 'Effect', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'slide',
                'options' => array(
                    'slide' => esc_html__( 'Slide', 'nova-elements' ),
                    'fade'  => esc_html__( 'Fade', 'nova-elements' ),
                ),
                'condition' => array(
                    'slides_to_show' => '1',
                ),
            )
        );

        $this->add_control(
            'speed',
            array(
                'label'   => esc_html__( 'Animation Speed', 'nova-elements' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 500,
            )
        );

        $this->end_controls_section();

        $css_scheme = apply_filters(
            'nova-elements/advanced-carousel/css-scheme',
            array(
                'arrow_next'     => '.nova-carousel.elementor-slick-slider .slick-next:before',
                'arrow_prev'     => '.nova-carousel.elementor-slick-slider .slick-prev:before',
                'arrow_next_hov' => '.nova-carousel.elementor-slick-slider .slick-next:hover:before',
                'arrow_prev_hov' => '.nova-carousel.elementor-slick-slider .slick-prev:hover:before',
                'dot'            => '.nova-carousel.elementor-slick-slider .slick-dots li button:before',
                'dot_hover'      => '.nova-carousel.elementor-slick-slider .slick-dots li button:hover:before',
                'dot_active'     => '.nova-carousel.elementor-slick-slider .slick-dots .slick-active button:before',
                'wrap'           => '.nova-carousel.elementor-slick-slider',
                'column'         => '.nova-carousel.elementor-slick-slider .nova-carousel__item',
                'image'          => '.nova-carousel__item-img',
                'items'          => '.nova-carousel__content',
                'items_title'    => '.nova-carousel__content .nova-carousel__item-title',
                'items_text'     => '.nova-carousel__content .nova-carousel__item-text',
                'items_button'   => '.nova-carousel__content .nova-carousel__item-button',
                'banner'         => '.nova-banner',
                'banner_content' => '.nova-banner__content',
                'banner_overlay' => '.nova-banner__overlay',
                'banner_title'   => '.nova-banner__title',
                'banner_text'    => '.nova-banner__text',
            )
        );

        $this->start_controls_section(
            'section_column_style',
            array(
                'label'      => esc_html__( 'Column', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_responsive_control(
            'column_padding',
            array(
                'label'       => esc_html__( 'Column Padding', 'nova-elements' ),
                'type'        => Controls_Manager::DIMENSIONS,
                'size_units'  => array( 'px' ),
                'render_type' => 'template',
                'selectors'   => array(
                    '{{WRAPPER}} ' . $css_scheme['column'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} ' . $css_scheme['wrap'] => 'margin-right: -{{RIGHT}}{{UNIT}}; margin-left: -{{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'column_margin',
            array(
                'label'       => esc_html__( 'Column Margin', 'nova-elements' ),
                'type'        => Controls_Manager::DIMENSIONS,
                'size_units'  => array( 'px' ),
                'selectors'   => array(
                    '{{WRAPPER}} ' . $css_scheme['column'] . ' .nova-carousel__item-inner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'column_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['column'] . ' .nova-carousel__item-inner',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_simple_item_style',
            array(
                'label'      => esc_html__( 'Simple Items', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
                'condition'  => array(
                    'item_layout' => 'simple',
                ),
            )
        );

        $this->add_responsive_control(
            'item_column_padding',
            array(
                'label'       => esc_html__( 'Item Padding', 'nova-elements' ),
                'type'        => Controls_Manager::DIMENSIONS,
                'size_units'  => array( 'px' ),
                'render_type' => 'template',
                'selectors'   => array(
                    '{{WRAPPER}} ' . $css_scheme['column'] . ' .nova-carousel__item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'condition'  => array(
                    'item_layout' => 'simple',
                )
            )
        );

        $this->add_control(
            'item_image_heading',
            array(
                'label' => esc_html__( 'Image', 'nova-elements' ),
                'type'  => Controls_Manager::HEADING,
            )
        );

        $this->add_responsive_control(
            'item_image_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['image'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'item_image_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['image'],
            )
        );

        $this->add_control(
            'item_content_heading',
            array(
                'label'     => esc_html__( 'Content', 'nova-elements' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->start_controls_tabs( 'tabs_item_style' );

        $this->start_controls_tab(
            'tab_item_normal',
            array(
                'label' => esc_html__( 'Normal', 'nova-elements' ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'simple_item_bg',
                'selector' => '{{WRAPPER}} ' . $css_scheme['items'],
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'item_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['items'],
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'item_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['items'],
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_item_hover',
            array(
                'label' => esc_html__( 'Hover', 'nova-elements' ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'simple_item_bg_hover',
                'selector' => '{{WRAPPER}} .nova-carousel__item:hover ' . $css_scheme['items'],
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'item_border_hover',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} .nova-carousel__item:hover ' . $css_scheme['items'],
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'item_box_shadow_hover',
                'selector' => '{{WRAPPER}} .nova-carousel__item:hover ' . $css_scheme['items'],
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'items_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['items'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'separator' => 'before',
            )
        );

        $this->add_responsive_control(
            'items_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['items'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'items_alignment',
            array(
                'label'   => esc_html__( 'Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'left',
                'options' => array(
                    'left'    => array(
                        'title' => esc_html__( 'Left', 'nova-elements' ),
                        'icon'  => 'fa fa-align-left',
                    ),
                    'center' => array(
                        'title' => esc_html__( 'Center', 'nova-elements' ),
                        'icon'  => 'fa fa-align-center',
                    ),
                    'right' => array(
                        'title' => esc_html__( 'Right', 'nova-elements' ),
                        'icon'  => 'fa fa-align-right',
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['items'] => 'text-align: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_banner_item_style',
            array(
                'label'      => esc_html__( 'Banner Items', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
                'condition'  => array(
                    'item_layout' => 'banners',
                ),
            )
        );

        $this->start_controls_tabs( 'tabs_background' );

        $this->start_controls_tab(
            'tab_background_normal',
            array(
                'label' => esc_html__( 'Normal', 'nova-elements' ),
            )
        );

        $this->add_control(
            'items_content_color',
            array(
                'label'     => esc_html__( 'Additional Elements Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .nova-effect-layla ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-layla ' . $css_scheme['banner_content'] . '::after' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-oscar ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-marley ' . $css_scheme['banner_title'] . '::after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-ruby ' . $css_scheme['banner_text'] => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-roxy ' . $css_scheme['banner_text'] . '::before' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-roxy ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-bubba ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-bubba ' . $css_scheme['banner_content'] . '::after' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-romeo ' . $css_scheme['banner_content'] . '::before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-romeo ' . $css_scheme['banner_content'] . '::after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-sarah ' . $css_scheme['banner_title'] . '::after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-chico ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'background',
                'selector' => '{{WRAPPER}} ' . $css_scheme['banner_overlay'],
            )
        );

        $this->add_control(
            'normal_opacity',
            array(
                'label'   => esc_html__( 'Opacity', 'nova-elements' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => '0',
                'min'     => 0,
                'max'     => 1,
                'step'    => 0.1,
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['banner_overlay'] => 'opacity: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_background_hover',
            array(
                'label' => esc_html__( 'Hover', 'nova-elements' ),
            )
        );

        $this->add_control(
            'items_content_hover_color',
            array(
                'label'     => esc_html__( 'Additional Elements Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .nova-effect-layla:hover ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-layla:hover ' . $css_scheme['banner_content'] . '::after' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-oscar:hover ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-marley:hover ' . $css_scheme['banner_title'] . '::after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-ruby:hover ' . $css_scheme['banner_text'] => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-roxy:hover ' . $css_scheme['banner_text'] . '::before' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-roxy:hover ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-bubba:hover ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-bubba:hover ' . $css_scheme['banner_content'] . '::after' => 'border-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-romeo:hover ' . $css_scheme['banner_content'] . '::before' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-romeo:hover ' . $css_scheme['banner_content'] . '::after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-sarah:hover ' . $css_scheme['banner_title'] . '::after' => 'background-color: {{VALUE}}',
                    '{{WRAPPER}} .nova-effect-chico:hover ' . $css_scheme['banner_content'] . '::before' => 'border-color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'background_hover',
                'selector' => '{{WRAPPER}} ' . $css_scheme['banner'] . ':hover ' . $css_scheme['banner_overlay'],
            )
        );

        $this->add_control(
            'hover_opacity',
            array(
                'label'   => esc_html__( 'Opacity', 'nova-elements' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => '0.4',
                'min'     => 0,
                'max'     => 1,
                'step'    => 0.1,
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['banner'] . ':hover ' . $css_scheme['banner_overlay'] => 'opacity: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_item_title_style',
            array(
                'label'      => esc_html__( 'Items Title Typography', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->start_controls_tabs( 'tabs_title_style' );

        $this->start_controls_tab(
            'tab_title_normal',
            array(
                'label' => esc_html__( 'Normal', 'nova-elements' ),
            )
        );

        $this->add_control(
            'items_title_color',
            array(
                'label'     => esc_html__( 'Items Title Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['items_title'] => 'color: {{VALUE}}',
                    '{{WRAPPER}} ' . $css_scheme['banner_title'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_hover',
            array(
                'label' => esc_html__( 'Hover', 'nova-elements' ),
            )
        );

        $this->add_control(
            'items_title_color_hover',
            array(
                'label'     => esc_html__( 'Items Title Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .nova-carousel__item:hover ' . $css_scheme['items_title'] => 'color: {{VALUE}}',
                    '{{WRAPPER}} .nova-carousel__item:hover ' . $css_scheme['banner_title'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'items_title_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}}  ' . $css_scheme['items_title'] . ', {{WRAPPER}} ' . $css_scheme['banner_title'],
                'separator' => 'before',
            )
        );

        $this->add_responsive_control(
            'items_title_margin',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em' ),
                'separator'  => 'before',
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['items_title'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} ' . $css_scheme['banner_title'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_item_text_style',
            array(
                'label'      => esc_html__( 'Items Content Typography', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->start_controls_tabs( 'tabs_text_style' );

        $this->start_controls_tab(
            'tab_text_normal',
            array(
                'label' => esc_html__( 'Normal', 'nova-elements' ),
            )
        );

        $this->add_control(
            'items_text_color',
            array(
                'label'     => esc_html__( 'Items Content Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['items_text'] => 'color: {{VALUE}}',
                    '{{WRAPPER}} ' . $css_scheme['banner_text'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_text_hover',
            array(
                'label' => esc_html__( 'Hover', 'nova-elements' ),
            )
        );

        $this->add_control(
            'items_text_color_hover',
            array(
                'label'     => esc_html__( 'Items Content Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} .nova-carousel__item:hover ' . $css_scheme['items_text'] => 'color: {{VALUE}}',
                    '{{WRAPPER}} .nova-carousel__item:hover ' . $css_scheme['banner_text'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'items_text_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}}  ' . $css_scheme['items_text'] . ', {{WRAPPER}} ' . $css_scheme['banner_text'],
                'separator' => 'before',
            )
        );

        $this->add_responsive_control(
            'items_text_margin',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em' ),
                'separator'  => 'before',
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['items_text'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} ' . $css_scheme['banner_text'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();

        /**
         * Action Button Style Section
         */
        $this->start_controls_section(
            'section_action_button_style',
            array(
                'label'      => esc_html__( 'Action Button', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
                'condition'  => array(
                    'item_layout' => 'simple',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'button_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}}  ' . $css_scheme['items_button'],
            )
        );

        $this->add_responsive_control(
            'button_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['items_button'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'button_margin',
            array(
                'label'      => __( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['items_button'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'button_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['items_button'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'separator' => 'after',
            )
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            array(
                'label' => esc_html__( 'Normal', 'nova-elements' ),
            )
        );

        $this->add_control(
            'button_bg_color',
            array(
                'label' => esc_html__( 'Background Color', 'nova-elements' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['items_button'] => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'button_color',
            array(
                'label'     => esc_html__( 'Text Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['items_button'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'button_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['items_button'],
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'button_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['items_button'],
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            array(
                'label' => esc_html__( 'Hover', 'nova-elements' ),
            )
        );

        $this->add_control(
            'primary_button_hover_bg_color',
            array(
                'label'     => esc_html__( 'Background Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['items_button'] . ':hover' => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'button_hover_color',
            array(
                'label'     => esc_html__( 'Text Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['items_button'] . ':hover' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'button_hover_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['items_button'] . ':hover',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'button_hover_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['items_button'] . ':hover',
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            'section_arrows_style',
            array(
                'label'      => esc_html__( 'Carousel Arrows', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->start_controls_tabs( 'tabs_arrows_style' );

        $this->start_controls_tab(
            'tab_prev',
            array(
                'label' => esc_html__( 'Normal', 'nova-elements' ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Style::get_type(),
            array(
                'name'           => 'arrows_style',
                'label'          => esc_html__( 'Arrows Style', 'nova-elements' ),
                'selector'       => '{{WRAPPER}} .nova-carousel .nova-arrow',
                'fields_options' => array(
                    'color' => array(
                        'scheme' => array(
                            'type'  => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_1,
                        ),
                    ),
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_next_hover',
            array(
                'label' => esc_html__( 'Hover', 'nova-elements' ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Style::get_type(),
            array(
                'name'           => 'arrows_hover_style',
                'label'          => esc_html__( 'Arrows Style', 'nova-elements' ),
                'selector'       => '{{WRAPPER}} .nova-carousel .nova-arrow:hover',
                'fields_options' => array(
                    'color' => array(
                        'scheme' => array(
                            'type'  => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_1,
                        ),
                    ),
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'prev_arrow_position',
            array(
                'label'     => esc_html__( 'Prev Arrow Position', 'nova-elements' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'prev_vert_position',
            array(
                'label'   => esc_html__( 'Vertical Position by', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => array(
                    'top'    => esc_html__( 'Top', 'nova-elements' ),
                    'bottom' => esc_html__( 'Bottom', 'nova-elements' ),
                ),
            )
        );

        $this->add_responsive_control(
            'prev_top_position',
            array(
                'label'      => esc_html__( 'Top Indent', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px', '%', 'em' ),
                'range'      => array(
                    'px' => array(
                        'min' => -400,
                        'max' => 400,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                    ),
                    'em' => array(
                        'min' => -50,
                        'max' => 50,
                    ),
                ),
                'condition' => array(
                    'prev_vert_position' => 'top',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .nova-carousel .nova-arrow.prev-arrow' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
                ),
            )
        );

        $this->add_responsive_control(
            'prev_bottom_position',
            array(
                'label'      => esc_html__( 'Bottom Indent', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px', '%', 'em' ),
                'range'      => array(
                    'px' => array(
                        'min' => -400,
                        'max' => 400,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                    ),
                    'em' => array(
                        'min' => -50,
                        'max' => 50,
                    ),
                ),
                'condition' => array(
                    'prev_vert_position' => 'bottom',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .nova-carousel .nova-arrow.prev-arrow' => 'bottom: {{SIZE}}{{UNIT}}; top: auto;',
                ),
            )
        );

        $this->add_control(
            'prev_hor_position',
            array(
                'label'   => esc_html__( 'Horizontal Position by', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'left',
                'options' => array(
                    'left'  => esc_html__( 'Left', 'nova-elements' ),
                    'right' => esc_html__( 'Right', 'nova-elements' ),
                ),
            )
        );

        $this->add_responsive_control(
            'prev_left_position',
            array(
                'label'      => esc_html__( 'Left Indent', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px', '%', 'em' ),
                'range'      => array(
                    'px' => array(
                        'min' => -400,
                        'max' => 400,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                    ),
                    'em' => array(
                        'min' => -50,
                        'max' => 50,
                    ),
                ),
                'condition' => array(
                    'prev_hor_position' => 'left',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .nova-carousel .nova-arrow.prev-arrow' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
                ),
            )
        );

        $this->add_responsive_control(
            'prev_right_position',
            array(
                'label'      => esc_html__( 'Right Indent', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px', '%', 'em' ),
                'range'      => array(
                    'px' => array(
                        'min' => -400,
                        'max' => 400,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                    ),
                    'em' => array(
                        'min' => -50,
                        'max' => 50,
                    ),
                ),
                'condition' => array(
                    'prev_hor_position' => 'right',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .nova-carousel .nova-arrow.prev-arrow' => 'right: {{SIZE}}{{UNIT}}; left: auto;',
                ),
            )
        );

        $this->add_control(
            'next_arrow_position',
            array(
                'label'     => esc_html__( 'Next Arrow Position', 'nova-elements' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'next_vert_position',
            array(
                'label'   => esc_html__( 'Vertical Position by', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => array(
                    'top'    => esc_html__( 'Top', 'nova-elements' ),
                    'bottom' => esc_html__( 'Bottom', 'nova-elements' ),
                ),
            )
        );

        $this->add_responsive_control(
            'next_top_position',
            array(
                'label'      => esc_html__( 'Top Indent', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px', '%', 'em' ),
                'range'      => array(
                    'px' => array(
                        'min' => -400,
                        'max' => 400,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                    ),
                    'em' => array(
                        'min' => -50,
                        'max' => 50,
                    ),
                ),
                'condition' => array(
                    'next_vert_position' => 'top',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .nova-carousel .nova-arrow.next-arrow' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
                ),
            )
        );

        $this->add_responsive_control(
            'next_bottom_position',
            array(
                'label'      => esc_html__( 'Bottom Indent', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px', '%', 'em' ),
                'range'      => array(
                    'px' => array(
                        'min' => -400,
                        'max' => 400,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                    ),
                    'em' => array(
                        'min' => -50,
                        'max' => 50,
                    ),
                ),
                'condition' => array(
                    'next_vert_position' => 'bottom',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .nova-carousel .nova-arrow.next-arrow' => 'bottom: {{SIZE}}{{UNIT}}; top: auto;',
                ),
            )
        );

        $this->add_control(
            'next_hor_position',
            array(
                'label'   => esc_html__( 'Horizontal Position by', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'right',
                'options' => array(
                    'left'  => esc_html__( 'Left', 'nova-elements' ),
                    'right' => esc_html__( 'Right', 'nova-elements' ),
                ),
            )
        );

        $this->add_responsive_control(
            'next_left_position',
            array(
                'label'      => esc_html__( 'Left Indent', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px', '%', 'em' ),
                'range'      => array(
                    'px' => array(
                        'min' => -400,
                        'max' => 400,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                    ),
                    'em' => array(
                        'min' => -50,
                        'max' => 50,
                    ),
                ),
                'condition' => array(
                    'next_hor_position' => 'left',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .nova-carousel .nova-arrow.next-arrow' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
                ),
            )
        );

        $this->add_responsive_control(
            'next_right_position',
            array(
                'label'      => esc_html__( 'Right Indent', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px', '%', 'em' ),
                'range'      => array(
                    'px' => array(
                        'min' => -400,
                        'max' => 400,
                    ),
                    '%' => array(
                        'min' => -100,
                        'max' => 100,
                    ),
                    'em' => array(
                        'min' => -50,
                        'max' => 50,
                    ),
                ),
                'condition' => array(
                    'next_hor_position' => 'right',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .nova-carousel .nova-arrow.next-arrow' => 'right: {{SIZE}}{{UNIT}}; left: auto;',
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_dots_style',
            array(
                'label'      => esc_html__( 'Carousel Dots', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->start_controls_tabs( 'tabs_dots_style' );

        $this->start_controls_tab(
            'tab_dots_normal',
            array(
                'label' => esc_html__( 'Normal', 'nova-elements' ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Style::get_type(),
            array(
                'name'           => 'dots_style',
                'label'          => esc_html__( 'Dots Style', 'nova-elements' ),
                'selector'       => '{{WRAPPER}} .nova-carousel .nova-slick-dots li span',
                'fields_options' => array(
                    'color' => array(
                        'scheme' => array(
                            'type'  => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_3,
                        ),
                    ),
                ),
                'exclude' => array(
                    'box_font_color',
                    'box_font_size',
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dots_hover',
            array(
                'label' => esc_html__( 'Hover', 'nova-elements' ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Style::get_type(),
            array(
                'name'           => 'dots_style_hover',
                'label'          => esc_html__( 'Dots Style', 'nova-elements' ),
                'selector'       => '{{WRAPPER}} .nova-carousel .nova-slick-dots li span:hover',
                'fields_options' => array(
                    'color' => array(
                        'scheme' => array(
                            'type'  => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_1,
                        ),
                    ),
                ),
                'exclude' => array(
                    'box_font_color',
                    'box_font_size',
                ),
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_dots_active',
            array(
                'label' => esc_html__( 'Active', 'nova-elements' ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Style::get_type(),
            array(
                'name'           => 'dots_style_active',
                'label'          => esc_html__( 'Dots Style', 'nova-elements' ),
                'selector'       => '{{WRAPPER}} .nova-carousel .nova-slick-dots li.slick-active span',
                'fields_options' => array(
                    'color' => array(
                        'scheme' => array(
                            'type'  => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_4,
                        ),
                    ),
                ),
                'exclude' => array(
                    'box_font_color',
                    'box_font_size',
                ),
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'dots_gap',
            array(
                'label' => esc_html__( 'Gap', 'nova-elements' ),
                'type' => Controls_Manager::SLIDER,
                'default' => array(
                    'size' => 5,
                    'unit' => 'px',
                ),
                'range' => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 50,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .nova-carousel .nova-slick-dots li' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
                ),
                'separator' => 'before',
            )
        );

        $this->add_control(
            'dots_margin',
            array(
                'label'      => esc_html__( 'Dots Box Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em' ),
                'selectors'  => array(
                    '{{WRAPPER}} .nova-carousel .nova-slick-dots' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'dots_alignment',
            array(
                'label'   => esc_html__( 'Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => array(
                    'flex-start' => array(
                        'title' => esc_html__( 'Left', 'nova-elements' ),
                        'icon'  => 'fa fa-align-left',
                    ),
                    'center' => array(
                        'title' => esc_html__( 'Center', 'nova-elements' ),
                        'icon'  => 'fa fa-align-center',
                    ),
                    'flex-end' => array(
                        'title' => esc_html__( 'Right', 'nova-elements' ),
                        'icon'  => 'fa fa-align-right',
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .nova-carousel .nova-slick-dots' => 'justify-content: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();

    }

    protected function render() {

        $this->__context = 'render';

        $this->__open_wrap();
        include $this->__get_global_template( 'index' );
        $this->__close_wrap();
    }

    public function get_advanced_carousel_options() {

        $settings = $this->get_settings();

        $desktop_col = absint( $settings['slides_to_show'] );
        $laptop_col = absint( $settings['slides_to_show_laptop'] );
        $tablet_col = absint( $settings['slides_to_show_tablet'] );
        $tablet_portrait_col = absint( $settings['slides_to_show_width800'] );
        $mobile_col = absint( $settings['slides_to_show_mobile'] );
        $mobile_portrait_col = absint( $settings['slides_to_show_width640'] );

        if($laptop_col == 0){
            $laptop_col = $desktop_col;
        }
        if($tablet_col == 0){
            $tablet_col = $laptop_col;
        }
        if($tablet_portrait_col == 0){
            $tablet_portrait_col = $tablet_col;
        }
        if($mobile_col == 0){
            $mobile_col = 1;
        }
        if($mobile_portrait_col == 0){
            $mobile_portrait_col = $mobile_col;
        }

        $slidesToShow = array(
            'desktop'           => $desktop_col,
            'laptop'            => $laptop_col,
            'tablet'            => $tablet_col,
            'tablet_portrait'   => $tablet_portrait_col,
            'mobile'            => $mobile_col,
            'mobile_portrait'   => $mobile_portrait_col
        );

        $options  = array(
            'slidesToShow'   => $slidesToShow,
            'autoplaySpeed'  => absint( $settings['autoplay_speed'] ),
            'autoplay'       => filter_var( $settings['autoplay'], FILTER_VALIDATE_BOOLEAN ),
            'infinite'       => filter_var( $settings['infinite'], FILTER_VALIDATE_BOOLEAN ),
            'pauseOnHover'   => filter_var( $settings['pause_on_hover'], FILTER_VALIDATE_BOOLEAN ),
            'speed'          => absint( $settings['speed'] ),
            'arrows'         => filter_var( $settings['arrows'], FILTER_VALIDATE_BOOLEAN ),
            'dots'           => filter_var( $settings['dots'], FILTER_VALIDATE_BOOLEAN ),
            'slidesToScroll' => absint( $settings['slides_to_scroll'] ),
            'prevArrow'      => nova_elements_tools()->get_carousel_arrow(
                array( $settings['prev_arrow'], 'prev-arrow' )
            ),
            'variableWidth'  => filter_var( $settings['fluid_width'], FILTER_VALIDATE_BOOLEAN ),
            'nextArrow'      => nova_elements_tools()->get_carousel_arrow(
                array( $settings['next_arrow'], 'next-arrow' )
            ),
            'rtl' => is_rtl(),
        );

        if ( 1 === absint( $settings['slides_to_show'] ) ) {
            $options['fade'] = ( 'fade' === $settings['effect'] );
        }

        return $options;
    }

    public function get_advanced_carousel_img( $class = '' ) {

        $settings = $this->get_settings_for_display();
        $size     = isset( $settings['img_size'] ) ? $settings['img_size'] : 'full';
        $image    = isset( $this->__processed_item['item_image'] ) ? $this->__processed_item['item_image'] : '';

        if ( ! $image ) {
            return;
        }

        if ( 'full' !== $size && ! empty( $image['id'] ) ) {
            $url = wp_get_attachment_image_url( $image['id'], $size );
        } else {
            $url = $image['url'];
        }

        return sprintf( '<img src="%1$s" alt="" class="%2$s">', $url, $class );

    }

    protected function __loop_button_item( $keys = array(), $format = '%s' ) {
        $item = $this->__processed_item;
        $params = [];

        foreach ( $keys as $key => $value ) {

            if ( ! array_key_exists( $value, $item ) ) {
                return false;
            }

            if ( empty( $item[$value] ) ) {
                return false;
            }

            $params[] = $item[ $value ];
        }

        return vsprintf( $format, $params );
    }
}