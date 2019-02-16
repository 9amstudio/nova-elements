<?php
namespace Nova_Elements\Modules\CircleProgress\Widgets;

use Nova_Elements\Base\Nova_Widget;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Button Widget
 */
class Circle_Progress extends Nova_Widget {

    public function get_name() {
        return 'nova-circle-progress';
    }

    protected function get_widget_title() {
        return esc_html__( 'Circle Progress', 'nova-elements' );
    }

    public function get_icon() {
        return 'novaelements-icon-3';
    }


    public function get_script_depends() {
        return [
            'jquery-numerator',
            'nova-elements'
        ];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_values',
            array(
                'label' => esc_html__( 'Values', 'nova-elements' ),
            )
        );

        $this->add_control(
            'values_type',
            array(
                'label'   => esc_html__( 'Progress Values Type', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'percent',
                'options' => array(
                    'percent'  => esc_html__( 'Percent', 'nova-elements' ),
                    'absolute' => esc_html__( 'Absolute', 'nova-elements' ),
                ),
            )
        );

        $this->add_control(
            'percent_value',
            array(
                'label'      => esc_html__( 'Current Percent', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( '%' ),
                'default'    => array(
                    'unit' => '%',
                    'size' => 50,
                ),
                'range'      => array(
                    '%' => array(
                        'min' => 0,
                        'max' => 100,
                    ),
                ),
                'condition' => array(
                    'values_type' => 'percent',
                ),
            )
        );

        $this->add_control(
            'absolute_value_curr',
            array(
                'label'     => esc_html__( 'Current Value', 'nova-elements' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 50,
                'condition' => array(
                    'values_type' => 'absolute',
                ),
            )
        );

        $this->add_control(
            'absolute_value_max',
            array(
                'label'     => esc_html__( 'Max Value', 'nova-elements' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 100,
                'condition' => array(
                    'values_type' => 'absolute',
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_size',
            array(
                'label' => esc_html__( 'Settings', 'nova-elements' ),
            )
        );

        $this->add_responsive_control(
            'circle_size',
            array(
                'label'      => esc_html__( 'Circle Size', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px' ),
                'default'    => array(
                    'unit' => 'px',
                    'size' => 185,
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 100,
                        'max' => 600,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .circle-progress-bar' => 'max-width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .circle-progress' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} .position-in-circle'  => 'height: {{SIZE}}{{UNIT}}',

                ),
                'render_type' => 'template',
            )
        );

        $this->add_responsive_control(
            'value_stroke',
            array(
                'label'      => esc_html__( 'Value Stoke Width', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px' ),
                'default'    => array(
                    'unit' => 'px',
                    'size' => 7,
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 1,
                        'max' => 300,
                    ),
                ),
            )
        );

        $this->add_responsive_control(
            'bg_stroke',
            array(
                'label'      => esc_html__( 'Background Stoke Width', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( 'px' ),
                'default'    => array(
                    'unit' => 'px',
                    'size' => 7,
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 0,
                        'max' => 300,
                    ),
                ),
            )
        );

        $this->add_control(
            'duration',
            array(
                'label'   => esc_html__( 'Animation Duration', 'nova-elements' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 1000,
                'min'     => 100,
                'step'    => 100,
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Content', 'nova-elements' ),
            )
        );

        $this->add_control(
            'prefix',
            array(
                'label'       => esc_html__( 'Value Number Prefix', 'nova-elements' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'placeholder' => '+',
            )
        );

        $this->add_control(
            'suffix',
            array(
                'label'       => esc_html__( 'Value Number Suffix', 'nova-elements' ),
                'type'        => Controls_Manager::TEXT,
                'default'     => '%',
                'placeholder' => '%',
            )
        );

        $this->add_control(
            'thousand_separator',
            array(
                'label'     => esc_html__( 'Show Thousand Separator in Value', 'nova-elements' ),
                'type'      => Controls_Manager::SWITCHER,
                'default'   => 'yes',
                'label_on'  => esc_html__( 'Show', 'nova-elements' ),
                'label_off' => esc_html__( 'Hide', 'nova-elements' ),
            )
        );

        $this->add_control(
            'title',
            array(
                'label'   => esc_html__( 'Counter Title', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
                'dynamic' => array( 'active' => true ),
            )
        );

        $this->add_control(
            'subtitle',
            array(
                'label'   => esc_html__( 'Counter Subtitle', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
                'dynamic' => array( 'active' => true ),
            )
        );

        $this->add_control(
            'percent_position',
            array(
                'label'   => esc_html__( 'Percent Position', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'in-circle',
                'options' => array(
                    'in-circle'  => esc_html__( 'Inside of Circle', 'nova-elements' ),
                    'out-circle' => esc_html__( 'Outside of Circle', 'nova-elements' ),
                ),
            )
        );

        $this->add_control(
            'labels_position',
            array(
                'label'   => esc_html__( 'Label Position', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'out-circle',
                'options' => array(
                    'in-circle'  => esc_html__( 'Inside of Circle', 'nova-elements' ),
                    'out-circle' => esc_html__( 'Outside of Circle', 'nova-elements' ),
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_progress_style',
            array(
                'label'      => esc_html__( 'Progress Circle Style', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'bg_stroke_type',
            array(
                'label'       => esc_html__( 'Background Stroke Type', 'nova-elements' ),
                'type'        => Controls_Manager::CHOOSE,
                'options'     => array(
                    'color' => array(
                        'title' => esc_html__( 'Classic', 'nova-elements' ),
                        'icon'  => 'fa fa-paint-brush',
                    ),
                    'gradient' => array(
                        'title' => esc_html__( 'Gradient', 'nova-elements' ),
                        'icon'  => 'fa fa-barcode',
                    ),
                ),
                'default'     => 'color',
                'label_block' => false,
                'render_type' => 'ui',
            )
        );

        $this->add_control(
            'val_bg_color',
            array(
                'label'     => esc_html__( 'Background Stroke Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#e6e9ec',
                'condition' => array(
                    'bg_stroke_type' => array( 'color' ),
                ),
            )
        );

        $this->add_control(
            'val_bg_gradient_color_a',
            array(
                'label'     => esc_html__( 'Background Stroke Color A', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#54595f',
                'condition' => array(
                    'bg_stroke_type' => array( 'gradient' ),
                ),
            )
        );

        $this->add_control(
            'val_bg_gradient_color_b',
            array(
                'label'     => esc_html__( 'Background Stroke Color B', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#858d97',
                'condition' => array(
                    'bg_stroke_type' => array( 'gradient' ),
                ),
            )
        );

        $this->add_control(
            'val_bg_gradient_angle',
            array(
                'label'     => esc_html__( 'Background Stroke Gradient Angle', 'nova-elements' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 45,
                'min'       => 0,
                'max'       => 360,
                'step'      => 0,
                'condition' => array(
                    'bg_stroke_type' => array( 'gradient' ),
                ),
            )
        );

        $this->add_control(
            'val_stroke_type',
            array(
                'label'       => esc_html__( 'Value Stroke Type', 'nova-elements' ),
                'type'        => Controls_Manager::CHOOSE,
                'options'     => array(
                    'color' => array(
                        'title' => esc_html__( 'Classic', 'nova-elements' ),
                        'icon'  => 'fa fa-paint-brush',
                    ),
                    'gradient' => array(
                        'title' => esc_html__( 'Gradient', 'nova-elements' ),
                        'icon'  => 'fa fa-barcode',
                    ),
                ),
                'default'     => 'color',
                'label_block' => false,
                'render_type' => 'ui',
            )
        );

        $this->add_control(
            'val_stroke_color',
            array(
                'label'     => esc_html__( 'Value Stroke Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#6ec1e4',
                'condition' => array(
                    'val_stroke_type' => array( 'color' ),
                ),
            )
        );

        $this->add_control(
            'val_stroke_gradient_color_a',
            array(
                'label'     => esc_html__( 'Value Stroke Color A', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#6ec1e4',
                'condition' => array(
                    'val_stroke_type' => array( 'gradient' ),
                ),
            )
        );

        $this->add_control(
            'val_stroke_gradient_color_b',
            array(
                'label'     => esc_html__( 'Value Stroke Color B', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '#b6e0f1',
                'condition' => array(
                    'val_stroke_type' => array( 'gradient' ),
                ),
            )
        );

        $this->add_control(
            'val_stroke_gradient_angle',
            array(
                'label'     => esc_html__( 'Value Stroke Angle', 'nova-elements' ),
                'type'      => Controls_Manager::NUMBER,
                'default'   => 45,
                'min'       => 0,
                'max'       => 360,
                'step'      => 1,
                'condition' => array(
                    'val_stroke_type' => array( 'gradient' ),
                ),
            )
        );

        $this->add_control(
            'circle_fill_color',
            array(
                'label'     => esc_html__( 'Circle Fill Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => array(
                    '{{WRAPPER}} .circle-progress__meter' => 'fill: {{VALUE}}',
                ),
            )
        );

        $this->add_control(
            'line_endings',
            array(
                'label'   => esc_html__( 'Progress Line Endings', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'butt',
                'options' => array(
                    'butt'  => esc_html__( 'Flat', 'nova-elements' ),
                    'round' => esc_html__( 'Rounded', 'nova-elements' ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} .circle-progress__value' => 'stroke-linecap: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'circle_box_shadow',
                'label'    => esc_html__( 'Circle Box Shadow', 'nova-elements' ),
                'selector' => '{{WRAPPER}} .circle-progress',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_content_style',
            array(
                'label'      => esc_html__( 'Content Style', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'number_style',
            array(
                'label'     => esc_html__( 'Number Styles', 'nova-elements' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'number_color',
            array(
                'label' => esc_html__( 'Color', 'nova-elements' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ),
                'selectors' => array(
                    '{{WRAPPER}} .circle-counter .circle-val' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'number_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .circle-counter .circle-val',
            )
        );

        $this->add_responsive_control(
            'number_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em' ),
                'selectors'  => array(
                    '{{WRAPPER}} .circle-counter .circle-val' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'number_prefix_font_size',
            array(
                'label'      => esc_html__( 'Prefix Font Size', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px', 'em', 'rem',
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 1,
                        'max' => 200,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .circle-counter .circle-val .circle-counter__prefix' => 'font-size: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_responsive_control(
            'number_prefix_gap',
            array(
                'label'      => esc_html__( 'Prefix Gap (px)', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px',
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 1,
                        'max' => 30,
                    ),
                ),
                'selectors'  => array(
                    'body:not(.rtl) {{WRAPPER}} .circle-counter .circle-val .circle-counter__prefix' => 'margin-right: {{SIZE}}{{UNIT}}',
                    'body.rtl {{WRAPPER}} .circle-counter .circle-val .circle-counter__prefix' => 'margin-left: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_responsive_control(
            'number_prefix_alignment',
            array(
                'label'       => esc_html__( 'Prefix Alignment', 'nova-elements' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default'     => 'center',
                'options'     => array(
                    'flex-start' => array(
                        'title' => esc_html__( 'Top', 'nova-elements' ),
                        'icon'  => 'eicon-v-align-top',
                    ),
                    'center' => array(
                        'title' => esc_html__( 'Center', 'nova-elements' ),
                        'icon'  => 'eicon-v-align-middle',
                    ),
                    'flex-end' => array(
                        'title' => esc_html__( 'Bottom', 'nova-elements' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .circle-counter .circle-val .circle-counter__prefix' => 'align-self: {{VALUE}};',
                ),
            )
        );

        $this->add_responsive_control(
            'number_suffix_font_size',
            array(
                'label'      => esc_html__( 'Suffix Font Size', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px', 'em', 'rem',
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 1,
                        'max' => 200,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .circle-counter .circle-val .circle-counter__suffix' => 'font-size: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_responsive_control(
            'number_suffix_gap',
            array(
                'label'      => esc_html__( 'Suffix Gap (px)', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px',
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 1,
                        'max' => 30,
                    ),
                ),
                'selectors'  => array(
                    'body:not(.rtl) {{WRAPPER}} .circle-counter .circle-val .circle-counter__suffix' => 'margin-left: {{SIZE}}{{UNIT}}',
                    'body.rtl {{WRAPPER}} .circle-counter .circle-val .circle-counter__suffix' => 'margin-right: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_responsive_control(
            'number_suffix_alignment',
            array(
                'label'       => esc_html__( 'Suffix Alignment', 'nova-elements' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default'     => 'center',
                'options'     => array(
                    'flex-start' => array(
                        'title' => esc_html__( 'Top', 'nova-elements' ),
                        'icon'  => 'eicon-v-align-top',
                    ),
                    'center' => array(
                        'title' => esc_html__( 'Center', 'nova-elements' ),
                        'icon'  => 'eicon-v-align-middle',
                    ),
                    'flex-end' => array(
                        'title' => esc_html__( 'Bottom', 'nova-elements' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} .circle-counter .circle-val .circle-counter__suffix' => 'align-self: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'title_style',
            array(
                'label'     => esc_html__( 'Title Styles', 'nova-elements' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'title_color',
            array(
                'label' => esc_html__( 'Color', 'nova-elements' ),
                'type' => Controls_Manager::COLOR,
                'scheme' => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ),
                'selectors' => array(
                    '{{WRAPPER}} .circle-counter .circle-counter__title' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} .circle-counter .circle-counter__title',
            )
        );

        $this->add_responsive_control(
            'title_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em' ),
                'selectors'  => array(
                    '{{WRAPPER}} .circle-counter .circle-counter__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_control(
            'subtitle_style',
            array(
                'label'     => esc_html__( 'Subtitle Styles', 'nova-elements' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'subtitle_color',
            array(
                'label'  => esc_html__( 'Color', 'nova-elements' ),
                'type'   => Controls_Manager::COLOR,
                'scheme' => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ),
                'selectors' => array(
                    '{{WRAPPER}} .circle-counter .circle-counter__subtitle' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'subtitle_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .circle-counter .circle-counter__subtitle',
            )
        );

        $this->add_responsive_control(
            'subtitle_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em' ),
                'selectors'  => array(
                    '{{WRAPPER}} .circle-counter .circle-counter__subtitle' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

}