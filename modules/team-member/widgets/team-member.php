<?php
namespace Nova_Elements\Modules\TeamMember\Widgets;

use Nova_Elements\Base\Nova_Widget;
use Nova_Elements\Controls\Group_Control_Box_Style;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Team_Member Widget
 */
class Team_Member extends Nova_Widget {

    public function get_name() {
        return 'nova-team-member';
    }

    protected function get_widget_title() {
        return esc_html__( 'Team Member', 'nova-elements' );
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function __shortcode() {
        return nova_elements_shortocdes()->get_shortcode( $this->get_name() );
    }

    public function is_reload_preview_required() {
        return true;
    }

    public function get_script_depends() {
        return [
            'nova-elements'
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_general',
            array(
                'label' => esc_html__( 'General', 'nova-elements' ),
            )
        );

        $attributes = $this->__shortcode()->get_atts();

        foreach ( $attributes as $attr => $settings ) {

            if ( empty( $settings['type'] ) ) {
                continue;
            }

            if ( ! empty( $settings['responsive'] ) ) {
                $this->add_responsive_control( $attr, $settings );
            } else {
                $this->add_control( $attr, $settings );
            }

        }

        $this->end_controls_section();

        $css_scheme = apply_filters(
            'nova-elements/nova-team-member/css-scheme',
            array(
                'wrap'              => '.nova-team-member',
                'column'            => '.nova-team-member .nova-team-member__item',
                'inner-box'         => '.nova-team-member .nova-team-member__inner-box',
                'inner-content'     => '.nova-team-member .nova-team-member__content',
                'image_wrap'        => '.nova-team-member .nova-team-member__image .loop__item__thumbnail--bkg',
                'image_instance'    => '.nova-team-member .nova-team-member__image img.wp-post-image',
                'title'             => '.nova-team-member .nova-team-member__name',
                'position'          => '.nova-team-member .nova-team-member__position',
                'socials'           => '.nova-team-member .nova-team-member__socials',
            )
        );

        $this->start_controls_section(
            'section_carousel',
            array(
                'label' => esc_html__( 'Carousel', 'nova-elements' ),
            )
        );

        $this->add_control(
            'carousel_enabled',
            array(
                'label'        => esc_html__( 'Enable Carousel', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'yes',
                'default'      => '',
            )
        );

        $this->add_responsive_control(
            'slides_min_height',
            array(
                'label'       => esc_html__( 'Slides Minimal Height', 'nova-elements' ),
                'label_block' => true,
                'type'        => Controls_Manager::NUMBER,
                'default'     => '',
                'selectors'   => array(
                    '{{WRAPPER}} ' . $css_scheme['inner-box'] => 'min-height: {{VALUE}}px;',
                ),

            )
        );

        $this->add_control(
            'slides_to_scroll',
            array(
                'label'     => esc_html__( 'Slides to Scroll', 'nova-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '1',
                'options'   => nova_elements_tools()->get_select_range( 4 ),
                'condition' => array(
                    'columns!' => '1',
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
                    'columns' => '1',
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

        $this->start_controls_section(
            'section_column_style',
            array(
                'label'      => esc_html__( 'Column', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
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

        $this->end_controls_section();

        $this->start_controls_section(
            'section_box_style',
            array(
                'label'      => esc_html__( 'Item', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'box_bg',
            array(
                'label' => esc_html__( 'Background Color', 'nova-elements' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['inner-box'] => 'background-color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'box_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['inner-box'],
            )
        );

        $this->add_responsive_control(
            'box_border_radius',
            array(
                'label'      => __( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['inner-box'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'inner_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['inner-box'],
            )
        );

        $this->add_responsive_control(
            'box_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em' ),
                'selectors'  => array(
                    '{{WRAPPER}} '  . $css_scheme['inner-box'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
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
            'enable_custom_image_height',
            array(
                'label'        => esc_html__( 'Enable Custom Image Height', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'true',
                'default'      => '',
            )
        );

        $this->add_control(
            'custom_image_height',
            [
                'label' => __( 'Custom Image Height', 'nova-elements' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 1000,
                        'step' => 5,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 200,
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 75,
                ],
                'condition' => [
                    'enable_custom_image_height!' => ''
                ],
                'selectors' => [
                    '{{WRAPPER}} ' . $css_scheme['image_wrap'] => 'padding-bottom: {{SIZE}}{{UNIT}} !important;',
                    '{{WRAPPER}} ' . $css_scheme['image_instance'] => 'display: none;',
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
                    '{{WRAPPER}} .nova-team-member .nova-team-member__image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                    '{{WRAPPER}} ' . $css_scheme['socials'] => 'display: none;'
                ),
            )
        );

        $this->end_controls_section();


        /**
         * Title Style Section
         */
        $this->start_controls_section(
            'section_title_style',
            array(
                'label'      => esc_html__( 'Title', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label'  => esc_html__( 'Color', 'nova-elements' ),
                'type'   => Controls_Manager::COLOR,
                'scheme' => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['title'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} ' . $css_scheme['title'],
            )
        );

        $this->add_responsive_control(
            'title_padding',
            array(
                'label'      => __( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['title'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'title_margin',
            array(
                'label'      => __( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['title'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                'label'      => esc_html__( 'Position', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'position_color',
            array(
                'label'  => esc_html__( 'Color', 'nova-elements' ),
                'type'   => Controls_Manager::COLOR,
                'scheme' => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
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

        $this->end_controls_section();

        /**
         * Arrow Style Section
         */
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
                'selector'       => '{{WRAPPER}} .nova-team-member .nova-arrow',
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
                'selector'       => '{{WRAPPER}} .nova-team-member .nova-arrow:hover',
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
                    '{{WRAPPER}} .nova-team-member .nova-arrow.prev-arrow' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
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
                    '{{WRAPPER}} .nova-team-member .nova-arrow.prev-arrow' => 'bottom: {{SIZE}}{{UNIT}}; top: auto;',
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
                    '{{WRAPPER}} .nova-team-member .nova-arrow.prev-arrow' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
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
                    '{{WRAPPER}} .nova-team-member .nova-arrow.prev-arrow' => 'right: {{SIZE}}{{UNIT}}; left: auto;',
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
                    '{{WRAPPER}} .nova-team-member .nova-arrow.next-arrow' => 'top: {{SIZE}}{{UNIT}}; bottom: auto;',
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
                    '{{WRAPPER}} .nova-team-member .nova-arrow.next-arrow' => 'bottom: {{SIZE}}{{UNIT}}; top: auto;',
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
                    '{{WRAPPER}} .nova-team-member .nova-arrow.next-arrow' => 'left: {{SIZE}}{{UNIT}}; right: auto;',
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
                    '{{WRAPPER}} .nova-team-member .nova-arrow.next-arrow' => 'right: {{SIZE}}{{UNIT}}; left: auto;',
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

    /**
     * Apply carousel wrappers for shortcode content if carousel is enabled.
     *
     * @param  string $content  Module content.
     * @param  array  $settings Module settings.
     * @return string
     */
    public function maybe_apply_carousel_wrappers( $content = null, $settings = array() ) {

        if ( 'yes' !== $settings['carousel_enabled'] ) {
            return $content;
        }

        $is_rtl = is_rtl();

        $desktop_col = absint( $settings['columns'] );
        $laptop_col = absint( $settings['columns_laptop'] );
        $tablet_col = absint( $settings['columns_tablet'] );
        $tablet_portrait_col = absint( $settings['columns_width800'] );
        $mobile_col = absint( $settings['columns_mobile'] );
        $mobile_portrait_col = absint( $settings['columns_width640'] );

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

        $options = array(
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
            'nextArrow'      => nova_elements_tools()->get_carousel_arrow(
                array( $settings['next_arrow'], 'next-arrow' )
            ),
            'rtl' => $is_rtl,
        );

        if ( 1 === absint( $settings['columns'] ) ) {
            $options['fade'] = ( 'fade' === $settings['effect'] );
        }

        $dir = $is_rtl ? 'rtl' : 'ltr';

        return sprintf(
            '<div class="nova-carousel elementor-slick-slider" data-slider_options="%1$s" dir="%3$s">%2$s</div>',
            htmlspecialchars( json_encode( $options ) ), $content, $dir
        );
    }

    protected function render() {

        $this->__context = 'render';

        $this->__open_wrap();

        $attributes    = array();
        $tag           = $this->get_name();
        $settings      = $this->get_settings();
        $shortcode_obj = $this->__shortcode();

        $cutom_fields_atts = array(
            'show_title_related_meta',
            'show_content_related_meta',
            'meta_title_related_position',
            'meta_content_related_position',
            'title_related_meta',
            'content_related_meta',
        );

        foreach ( $shortcode_obj->get_atts() as $attr => $data ) {

            if ( in_array( $attr, $cutom_fields_atts ) ) {
                continue;
            }

            $attr_val            = isset( $settings[ $attr ] ) ? $settings[ $attr ] : '';
            $attr_val            = ! is_array( $attr_val ) ? $attr_val : implode( ',', $attr_val );
            $attributes[ $attr ] = $attr_val;
        }

        echo $this->maybe_apply_carousel_wrappers( $shortcode_obj->do_shortcode( $attributes ), $settings );

        $this->__close_wrap();
    }

    protected function _content_template() {}

}
