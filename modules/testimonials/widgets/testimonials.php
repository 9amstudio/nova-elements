<?php
namespace Nova_Elements\Modules\Testimonials\Widgets;

use Nova_Elements\Base\Nova_Widget;
use Nova_Elements\Controls\Group_Control_Box_Style;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Testimonials Widget
 */
class Testimonials extends Nova_Widget {

    public function get_name() {
        return 'nova-testimonials';
    }

    protected function get_widget_title() {
        return esc_html__( 'Testimonials', 'nova-elements' );
    }

    public function get_icon() {
        return 'eicon-testimonial';
    }

    public function get_script_depends() {
        return [
            'nova-elements'
        ];
    }

    protected function _register_controls() {
        $css_scheme = apply_filters(
            'nova-elements/testimonials/css-scheme',
            array(
                'instance'   => '.nova-testimonials__instance',
                'slick_list' => '.nova-testimonials__instance .slick-list',
                'item'       => '.nova-testimonials__item',
                'item_inner' => '.nova-testimonials__item-inner',
                'image'      => '.nova-testimonials__figure',
                'image_tag'  => '.nova-testimonials__tag-img',
                'content'    => '.nova-testimonials__content',
                'icon'       => '.nova-testimonials__icon',
                'icon_inner' => '.nova-testimonials__icon-inner',
                'title'      => '.nova-testimonials__title',
                'comment'    => '.nova-testimonials__comment',
                'name'       => '.nova-testimonials__name',
                'position'   => '.nova-testimonials__position',
                'date'       => '.nova-testimonials__date',
                'arrow'      => '.nova-testimonials__instance .nova-arrow',
                'dots'       => '.nova-testimonials__instance .nova-slick-dots',
            )
        );

        $this->start_controls_section(
            'section_settings',
            array(
                'label' => esc_html__( 'Settings', 'nova-elements' ),
            )
        );

        $preset_type = apply_filters(
            'nova-elements/testimonials/control/preset',
            array(
                'type-1' => esc_html__( 'Type-1', 'nova-elements' ),
                'type-2' => esc_html__( 'Type-2', 'nova-elements' ),
                'type-3' => esc_html__( 'Type-3', 'nova-elements' ),
                'type-4' => esc_html__( 'Type-4', 'nova-elements' ),
                'type-5' => esc_html__( 'Type-5', 'nova-elements' ),
            )
        );

        $this->add_control(
            'preset',
            array(
                'label'   => esc_html__( 'Preset', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'type-1',
                'options' => $preset_type
            )
        );

        $this->add_control(
            'enable_carousel',
            array(
                'label'        => esc_html__( 'Enable Carousel', 'nova-elements' ),
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
                'label'   => esc_html__( 'Item to Show', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => nova_elements_tools()->get_select_range( 6 ),
            )
        );

        $this->add_control(
            'slides_to_scroll',
            array(
                'label'     => esc_html__( 'Slides to Scroll', 'nova-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '1',
                'options'   => nova_elements_tools()->get_select_range( 6 ),
                'condition' => array(
                    'slides_to_show!' => '1',
                    'enable_carousel' => 'true'
                ),
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
                'condition' => array(
                    'enable_carousel' => 'true'
                )
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
                'condition' => array(
                    'enable_carousel' => 'true'
                )
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
                    'enable_carousel' => 'true'
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
                'condition' => array(
                    'enable_carousel' => 'true'
                )
            )
        );

        $this->add_control(
            'adaptive_height',
            array(
                'label'        => esc_html__( 'Adaptive Height', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'true',
                'default'      => 'true',
                'condition' => array(
                    'enable_carousel' => 'true'
                )
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
                    'enable_carousel' => 'true'
                ),
            )
        );

        $this->add_control(
            'speed',
            array(
                'label'   => esc_html__( 'Animation Speed', 'nova-elements' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 500,
                'condition' => array(
                    'enable_carousel' => 'true'
                )
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
                'default'      => 'false',
                'condition' => array(
                    'enable_carousel' => 'true'
                )
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
                    'enable_carousel' => 'true'
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
                    'enable_carousel' => 'true'
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
                'default'      => 'true',
                'condition' => array(
                    'enable_carousel' => 'true'
                )
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_items_data',
            array(
                'label' => esc_html__( 'Items', 'nova-elements' ),
            )
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_image',
            array(
                'label'   => esc_html__( 'Image', 'nova-elements' ),
                'type'    => Controls_Manager::MEDIA,
                'dynamic' => array( 'active' => true ),
            )
        );

        $repeater->add_control(
            'item_icon',
            array(
                'label'       => esc_html__( 'Icon', 'nova-elements' ),
                'type'        => Controls_Manager::ICON,
                'label_block' => true,
                'file'        => '',
                'default'     => 'fa fa-quote-left',
            )
        );

        $repeater->add_control(
            'item_title',
            array(
                'label'   => esc_html__( 'Title', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => array( 'active' => true ),
            )
        );

        $repeater->add_control(
            'item_comment',
            array(
                'label'   => esc_html__( 'Comment', 'nova-elements' ),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => array( 'active' => true ),
            )
        );

        $repeater->add_control(
            'item_name',
            array(
                'label'   => esc_html__( 'Name', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => array( 'active' => true ),
            )
        );

        $repeater->add_control(
            'item_position',
            array(
                'label'   => esc_html_x( 'Position', 'Position at work', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => array( 'active' => true ),
            )
        );

        $repeater->add_control(
            'item_rating',
            array(
                'label'     => esc_html__( 'Rating', 'nova-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '10',
                'options'   => nova_elements_tools()->get_select_range( 10 ),
                'dynamic' => array( 'active' => true )
            )
        );

        $this->add_control(
            'item_list',
            array(
                'type'        => Controls_Manager::REPEATER,
                'fields'      => array_values( $repeater->get_controls() ),
                'default'     => array(
                    array(
                        'item_comment'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'nova-elements' ),
                        'item_name'     => esc_html__( 'Mary Scott', 'nova-elements' ),
                        'item_position' => esc_html__( 'Founder & CEO', 'nova-elements' ),
                        'item_rating'     => 10,
                    ),
                    array(
                        'item_comment'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'nova-elements' ),
                        'item_name'     => esc_html__( 'John Borthwick', 'nova-elements' ),
                        'item_position' => esc_html__( 'Founder & CEO', 'nova-elements' ),
                        'item_rating'     => 10,
                    ),
                    array(
                        'item_comment'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'nova-elements' ),
                        'item_name'     => esc_html__( 'Jane Bill', 'nova-elements' ),
                        'item_position' => esc_html__( 'Founder & CEO', 'nova-elements' ),
                        'item_rating'     => 10,
                    ),
                    array(
                        'item_comment'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'nova-elements' ),
                        'item_name'     => esc_html__( 'David Anderson', 'nova-elements' ),
                        'item_position' => esc_html__( 'Founder & CEO', 'nova-elements' ),
                        'item_rating'     => 10,
                    ),
                    array(
                        'item_comment'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'nova-elements' ),
                        'item_name'     => esc_html__( 'Susan O’Neill', 'nova-elements' ),
                        'item_position' => esc_html__( 'Founder & CEO', 'nova-elements' ),
                        'item_rating'     => 10,
                    ),
                    array(
                        'item_comment'  => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 'nova-elements' ),
                        'item_name'     => esc_html__( 'Ryan King', 'nova-elements' ),
                        'item_position' => esc_html__( 'Founder & CEO', 'nova-elements' ),
                        'item_rating'     => 10,
                    ),
                ),
                'title_field' => '{{{ item_title }}}',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_slick_list',
            array(
                'label' => esc_html__( 'Carousel List', 'nova-elements' ),
                'condition' => array(
                    'enable_carousel' => 'true'
                )
            )
        );

        $this->add_responsive_control(
            'slick_list_padding_left',
            array(
                'label'      => esc_html__( 'Padding Left', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( '%', 'px', 'em' ),
                'range'      => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 500,
                    ),
                    '%' => array(
                        'min' => 0,
                        'max' => 50,
                    ),
                    'em' => array(
                        'min' => 0,
                        'max' => 20,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['slick_list'] . '' => 'padding-left: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'slick_list_padding_right',
            array(
                'label'      => esc_html__( 'Padding Right', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( '%', 'px', 'em' ),
                'range'      => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 500,
                    ),
                    '%' => array(
                        'min' => 0,
                        'max' => 50,
                    ),
                    'em' => array(
                        'min' => 0,
                        'max' => 20,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['slick_list'] . '' => 'padding-right: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_item_style',
            array(
                'label'      => esc_html__( 'Item', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'equal_height_cols',
            array(
                'label'        => esc_html__( 'Equal Items Height', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'true',
                'default'      => '',
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'item_background',
                'selector' => '{{WRAPPER}} ' . $css_scheme['item_inner'],
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'item_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['item_inner'],
            )
        );

        $this->add_control(
            'item_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['item_inner'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'item_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['item_inner'],
            )
        );

        $this->add_responsive_control(
            'item_margin',
            array(
                'label'       => esc_html__( 'Item Margin', 'nova-elements' ),
                'type'        => Controls_Manager::DIMENSIONS,
                'size_units'  => array( 'px' ),
                'render_type' => 'template',
                'selectors'   => array(
                    '{{WRAPPER}} ' . $css_scheme['item_inner'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    //'{{WRAPPER}} ' . $css_scheme['instance']   => 'margin-right: -{{RIGHT}}{{UNIT}}; margin-left: -{{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'item_padding',
            array(
                'label'       => esc_html__( 'Item Padding', 'nova-elements' ),
                'type'        => Controls_Manager::DIMENSIONS,
                'size_units'  => array( 'px' ),
                'render_type' => 'template',
                'selectors'   => array(
                    '{{WRAPPER}} ' . $css_scheme['content'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                )
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_thumb_style',
            array(
                'label'      => esc_html__( 'Image', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'enable_custom_image_width',
            array(
                'label'        => esc_html__( 'Enable Custom Image Width', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'true',
                'default'      => '',
            )
        );

        $this->add_responsive_control(
            'custom_image_width',
            [
                'label' => __( 'Custom Image Width', 'nova-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units'  => array( 'px' ),
                'range' => [
                    'px' => [
                        'min' => 50,
                        'max' => 500,
                        'step' => 1,
                    ]
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 70,
                ],
                'condition' => [
                    'enable_custom_image_width!' => ''
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $css_scheme['image_tag'] => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};'
                ],
                'render_type' => 'template'
            ]
        );

        $this->add_responsive_control(
            'thumb_border_radius',
            array(
                'label'      => __( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['image_tag'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;'
                ),
            )
        );

        $this->end_controls_section();

        /*
         * Arrows section
         */
        $this->start_controls_section(
            'section_arrows_style',
            array(
                'label'      => esc_html__( 'Arrows', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->start_controls_tabs( 'tabs_arrows_style' );

        $this->start_controls_tab(
            'tab_arrows_normal',
            array(
                'label' => esc_html__( 'Normal', 'nova-elements' ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Style::get_type(),
            array(
                'name'           => 'arrows_style',
                'label'          => esc_html__( 'Arrows Style', 'nova-elements' ),
                'selector'       => '{{WRAPPER}} ' . $css_scheme['arrow'],
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
            'tab_arrows_hover',
            array(
                'label' => esc_html__( 'Hover', 'nova-elements' ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Style::get_type(),
            array(
                'name'           => 'arrows_hover_style',
                'label'          => esc_html__( 'Arrows Style', 'nova-elements' ),
                'selector'       => '{{WRAPPER}} ' . $css_scheme['arrow'] . ':hover',
                'fields_options' => array(
                    'color' => array(
                        'scheme' => array(
                            'type'  => Scheme_Color::get_type(),
                            'value' => Scheme_Color::COLOR_4,
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
                    '{{WRAPPER}} ' . $css_scheme['arrow'] . '.prev-arrow' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
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
                    '{{WRAPPER}} ' . $css_scheme['arrow'] . '.prev-arrow' => 'bottom: {{SIZE}}{{UNIT}}; top: auto;',
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
                    '{{WRAPPER}} ' . $css_scheme['arrow'] . '.prev-arrow' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
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
                    '{{WRAPPER}} ' . $css_scheme['arrow'] . '.prev-arrow' => 'right: {{SIZE}}{{UNIT}}; left: auto;',
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
                    '{{WRAPPER}} ' . $css_scheme['arrow'] . '.next-arrow' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
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
                    '{{WRAPPER}} ' . $css_scheme['arrow'] . '.next-arrow' => 'bottom: {{SIZE}}{{UNIT}}; top: auto;',
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
                    '{{WRAPPER}} ' . $css_scheme['arrow'] . '.next-arrow' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
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
                    '{{WRAPPER}} ' . $css_scheme['arrow'] . '.next-arrow' => 'right: {{SIZE}}{{UNIT}}; left: auto;',
                ),
            )
        );

        $this->end_controls_section();

        /*
         * Dots section
         */
        $this->start_controls_section(
            'section_dots_style',
            array(
                'label'      => esc_html__( 'Dots', 'nova-elements' ),
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
                'selector'       => '{{WRAPPER}} ' . $css_scheme['dots'] .' li span',
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
                'selector'       => '{{WRAPPER}} ' . $css_scheme['dots'] . ' li span:hover',
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
                'selector'       => '{{WRAPPER}} ' . $css_scheme['dots'] .' li.slick-active span',
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
                    '{{WRAPPER}} ' . $css_scheme['dots'] . ' li' => 'padding-left: {{SIZE}}{{UNIT}}; padding-right: {{SIZE}}{{UNIT}}',
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
                    '{{WRAPPER}} ' . $css_scheme['dots'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'dots_alignment',
            array(
                'label'   => esc_html__( 'Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => '',
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
                    '{{WRAPPER}} ' . $css_scheme['dots'] => 'justify-content: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();

        /**
         * Comment Style Section
         */
        $this->start_controls_section(
            'section_comment_style',
            array(
                'label'      => esc_html__( 'Comment', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'comment_color',
            array(
                'label'  => esc_html__( 'Color', 'nova-elements' ),
                'type'   => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['comment'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'comment_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} ' . $css_scheme['comment'],
            )
        );

        $this->add_responsive_control(
            'comment_width',
            array(
                'label'      => esc_html__( 'Width', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px', '%',
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 10,
                        'max' => 1000,
                    ),
                    '%' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                ),
                'default' => array(
                    'size' => 100,
                    'unit' => '%',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['comment'] => 'width: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->add_control(
            'use_comment_corner',
            array(
                'label'        => esc_html__( 'Use comment corner', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'yes',
                'default'      => 'false',
            )
        );

        $this->add_control(
            'use_comment_corner_as_line',
            array(
                'label'        => esc_html__( 'Use corner as line', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'yes',
                'default'      => 'false',
                'condition' => array(
                    'use_comment_corner' => 'yes',
                ),
            )
        );

        $this->add_control(
            'comment_corner_line_color',
            array(
                'label'   => esc_html__( 'Corner Line Color', 'nova-elements' ),
                'type'    => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['comment'] . ':after' => 'border-color: {{VALUE}};',
                ),
                'condition' => array(
                    'use_comment_corner' => 'yes',
                    'use_comment_corner_as_line' => 'yes'
                ),
            )
        );

        $this->add_control(
            'comment_corner_color',
            array(
                'label'   => esc_html__( 'Corner Color', 'nova-elements' ),
                'type'    => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['comment'] . ':after' => 'border-color: {{VALUE}} transparent transparent transparent;',
                ),
                'condition' => array(
                    'use_comment_corner' => 'yes',
                    'use_comment_corner_as_line!' => 'yes'
                ),
            )
        );

        $this->add_responsive_control(
            'comment_corner_position',
            array(
                'label'      => esc_html__( 'Corner Position', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( '%' ),
                'range'      => array(
                    '%' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                ),
                'default' => array(
                    'size' => 50,
                    'unit' => '%',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['comment'] . ':after' => 'left: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'use_comment_corner' => 'yes',
                ),
            )
        );

        $this->add_responsive_control(
            'comment_corner_width',
            array(
                'label'      => esc_html__( 'Corner Width', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px' ),
                'range'      => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 50,
                    ),
                ),
                'default' => array(
                    'size' => 10,
                    'unit' => 'px',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['comment'] . ':after' => 'border-right-width: {{SIZE}}{{UNIT}}; margin-left: calc({{SIZE}}{{UNIT}}/-2);',
                ),
                'condition' => array(
                    'use_comment_corner' => 'yes',
                ),
            )
        );

        $this->add_responsive_control(
            'comment_corner_height',
            array(
                'label'      => esc_html__( 'Corner Height', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px' ),
                'range'      => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 50,
                    ),
                ),
                'default' => array(
                    'size' => 10,
                    'unit' => 'px',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['comment'] . ':after' => 'border-top-width: {{SIZE}}{{UNIT}}; bottom: -{{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'use_comment_corner' => 'yes',
                ),
            )
        );

        $this->add_responsive_control(
            'comment_corner_skew',
            array(
                'label'      => esc_html__( 'Corner Skew', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px' ),
                'range'      => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 50,
                    ),
                ),
                'default' => array(
                    'size' => 10,
                    'unit' => 'px',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['comment'] . ':after' => 'border-left-width: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'use_comment_corner' => 'yes',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'comment_background',
                'selector' => '{{WRAPPER}} ' . $css_scheme['comment'],
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

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'comment_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['comment'],
            )
        );

        $this->add_control(
            'comment_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'default' => array(
                    'top'    => 0,
                    'right'  => 0,
                    'bottom' => 0,
                    'left'   => 0,
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['comment'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'comment_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['comment'],
            )
        );

        $this->add_responsive_control(
            'comment_padding',
            array(
                'label'      => __( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'default' => array(
                    'top'    => '',
                    'right'  => '',
                    'bottom' => '',
                    'left'   => '',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['comment'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'comment_margin',
            array(
                'label'      => __( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['comment'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'comment_alignment',
            array(
                'label'   => esc_html__( 'Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => '',
                'options' => array(
                    'flex-start'    => array(
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
                    '{{WRAPPER}} ' . $css_scheme['comment'] => 'align-self: {{VALUE}};',
                ),
            )
        );

        $this->add_responsive_control(
            'comment_text_alignment',
            array(
                'label'   => esc_html__( 'Text Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => '',
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
                    '{{WRAPPER}} ' . $css_scheme['comment'] => 'text-align: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();

        /**
         * Name Style Section
         */
        $this->start_controls_section(
            'section_name_style',
            array(
                'label'      => esc_html__( 'Name', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'name_custom_width',
            array(
                'label'        => esc_html__( 'Custom width', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'yes',
                'default'      => 'false',
            )
        );

        $this->add_responsive_control(
            'name_width',
            array(
                'label'      => esc_html__( 'Width', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px', '%',
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 10,
                        'max' => 1000,
                    ),
                    '%' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                ),
                'default' => array(
                    'size' => 350,
                    'unit' => 'px',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['name'] => 'width: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'name_custom_width' => 'yes',
                ),
            )
        );

        $this->add_control(
            'name_color',
            array(
                'label'  => esc_html__( 'Color', 'nova-elements' ),
                'type'   => Controls_Manager::COLOR,
                'scheme' => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['name'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'name_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} ' . $css_scheme['name'],
            )
        );

        $this->add_responsive_control(
            'name_padding',
            array(
                'label'      => __( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['name'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'name_margin',
            array(
                'label'      => __( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['name'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'name_alignment',
            array(
                'label'   => esc_html__( 'Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => '',
                'options' => array(
                    'flex-start'    => array(
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
                    '{{WRAPPER}} ' . $css_scheme['name'] => 'align-self: {{VALUE}};',
                ),
            )
        );

        $this->add_responsive_control(
            'name_text_alignment',
            array(
                'label'   => esc_html__( 'Text Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => '',
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
                    '{{WRAPPER}} ' . $css_scheme['name'] => 'text-align: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();

        /**
         * Position Style Section
         */
        $this->start_controls_section(
            'section_position_style',
            array(
                'label'      => esc_html_x( 'Position', 'Position at work', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'position_custom_width',
            array(
                'label'        => esc_html__( 'Custom width', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'yes',
                'default'      => 'false',
            )
        );

        $this->add_responsive_control(
            'position_width',
            array(
                'label'      => esc_html__( 'Width', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px', '%',
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 10,
                        'max' => 1000,
                    ),
                    '%' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                ),
                'default' => array(
                    'size' => 350,
                    'unit' => 'px',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['position'] => 'width: {{SIZE}}{{UNIT}};',
                ),
                'condition' => array(
                    'position_custom_width' => 'yes',
                ),
            )
        );

        $this->add_control(
            'position_color',
            array(
                'label'  => esc_html__( 'Color', 'nova-elements' ),
                'type'   => Controls_Manager::COLOR,
                'scheme' => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['position'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'position_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} ' . $css_scheme['position'],
            )
        );

        $this->add_responsive_control(
            'position_padding',
            array(
                'label'      => __( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['position'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'position_margin',
            array(
                'label'      => __( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['position'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'position_alignment',
            array(
                'label'   => esc_html__( 'Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => '',
                'options' => array(
                    'flex-start'    => array(
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
                    '{{WRAPPER}} ' . $css_scheme['position'] => 'align-self: {{VALUE}};',
                ),
            )
        );

        $this->add_responsive_control(
            'position_text_alignment',
            array(
                'label'   => esc_html__( 'Text Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => '',
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
                    '{{WRAPPER}} ' . $css_scheme['position'] => 'text-align: {{VALUE}};',
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

    /**
     * Generate setting json
     *
     * @return string
     */
    public function generate_setting_json() {
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

        $instance_settings = array(
            'slidesToShow'   => $slidesToShow,
            'autoplaySpeed'  => absint( $settings['autoplay_speed'] ),
            'autoplay'       => filter_var( $settings['autoplay'], FILTER_VALIDATE_BOOLEAN ),
            'infinite'       => filter_var( $settings['infinite'], FILTER_VALIDATE_BOOLEAN ),
            'adaptiveHeight' => filter_var( $settings['adaptive_height'], FILTER_VALIDATE_BOOLEAN ),
            'pauseOnHover'   => filter_var( $settings['pause_on_hover'], FILTER_VALIDATE_BOOLEAN ),
            'speed'          => absint( $settings['speed'] ),
            'arrows'         => filter_var( $settings['arrows'], FILTER_VALIDATE_BOOLEAN ),
            'dots'           => filter_var( $settings['dots'], FILTER_VALIDATE_BOOLEAN ),
            'slidesToScroll' => absint( $settings['slides_to_scroll'] ),
            'prevArrow'      => nova_elements_tools()->get_carousel_arrow(
                array( $settings['prev_arrow'], 'prev-arrow' )
            ),
            'nextArrow'      => nova_elements_tools()->get_carousel_arrow(
                array( $settings['next_arrow'], 'next-arrow' )
            ),
            'rtl' => is_rtl(),
        );

        if ( 'fade' === $settings['effect'] ) {
            $instance_settings['fade'] = true;
        }

        $instance_settings = json_encode( $instance_settings );

        return sprintf( 'data-settings=\'%1$s\'', $instance_settings );
    }

}
