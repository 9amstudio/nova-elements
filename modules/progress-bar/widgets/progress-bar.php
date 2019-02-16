<?php
namespace Nova_Elements\Modules\ProgressBar\Widgets;

use Nova_Elements\Base\Nova_Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Pricing_Table Widget
 */
class Progress_Bar extends Nova_Widget {

    public function get_name() {
        return 'nova-progress-bar';
    }

    protected function get_widget_title() {
        return esc_html__( 'Progress Bar', 'nova-elements' );
    }

    public function get_icon() {
        return 'novaelements-icon-34';
    }

    public function get_script_depends() {
        return [
            'nova-anime-js',
            'nova-elements'
        ];
    }

    protected function _register_controls() {
        $css_scheme = apply_filters(
            'nova-elements/progress-bar/css-scheme',
            array(
                'instance'         => '.nova-progress-bar',
                'title'            => '.nova-progress-bar__title',
                'title_icon'       => '.nova-progress-bar__title-icon',
                'title_text'       => '.nova-progress-bar__title-text',
                'progress_wrapper' => '.nova-progress-bar__wrapper',
                'status_bar'       => '.nova-progress-bar__status-bar',
                'percent'          => '.nova-progress-bar__percent',
            )
        );

        $this->start_controls_section(
            'section_progress',
            array(
                'label' => esc_html__( 'Progress Bar', 'nova-elements' ),
            )
        );

        $this->add_control(
            'progress_type',
            array(
                'label' => esc_html__( 'Type', 'nova-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'type-1',
                'options' => array(
                    'type-1' => esc_html__( 'Inside the bar', 'nova-elements' ),
                    'type-2' => esc_html__( 'Placed above ', 'nova-elements' ),
                    'type-3' => esc_html__( 'Shown as tip', 'nova-elements' ),
                    'type-4' => esc_html__( 'On the right', 'nova-elements' ),
                    'type-5' => esc_html__( 'Inside the empty bar', 'nova-elements' ),
                    'type-6' => esc_html__( 'Inside the bar with title', 'nova-elements' ),
                    'type-7' => esc_html__( 'Inside the vertical bar', 'nova-elements' ),
                ),
            )
        );

        $this->add_control(
            'title',
            array(
                'label'       => esc_html__( 'Title', 'nova-elements' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter your title', 'nova-elements' ),
                'default'     => esc_html__( 'Title', 'nova-elements' ),
                'label_block' => true,
                'dynamic'     => array( 'active' => true ),
            )
        );

        $this->add_control(
            'icon',
            array(
                'label'       => esc_html__( 'Icon', 'nova-elements' ),
                'type'        => Controls_Manager::ICON,
                'label_block' => true,
                'file'        => '',
                'default'     => 'fa fa-wordpress',
            )
        );

        $this->add_control(
            'percent',
            array(
                'label'       => esc_html__( 'Percentage', 'nova-elements' ),
                'type'        => Controls_Manager::NUMBER,
                'default'     => 50,
                'min'         => 0,
                'max'         => 100,
                'label_block' => false,
            )
        );

        $this->end_controls_section();

        /**
         * Progress Bar Style Section
         */
        $this->start_controls_section(
            'section_progress_style',
            array(
                'label'      => esc_html__( 'Progress Bar', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_responsive_control(
            'progress_wrapper_height',
            array(
                'label'      => esc_html__( 'Progress Height', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px',
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 1,
                        'max' => 500,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['progress_wrapper'] => 'height: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_responsive_control(
            'progress_wrapper_width',
            array(
                'label'      => esc_html__( 'Progress Width', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px',
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 1,
                        'max' => 200,
                    ),
                ),
                'condition' => array(
                    'progress_type' => array( 'type-7' ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['progress_wrapper'] => 'width: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_responsive_control(
            'progress_wrapper_margin',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['progress_wrapper'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'progress_wrapper_background',
                'selector' => '{{WRAPPER}} ' . $css_scheme['progress_wrapper'],
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'progress_wrapper_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['progress_wrapper'],
            )
        );

        $this->add_responsive_control(
            'progress_wrapper_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['progress_wrapper'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name' => 'progress_wrapper_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['progress_wrapper'],
            )
        );

        $this->add_control(
            'status_bar_heading',
            array(
                'label' => esc_html__( 'Status Bar', 'nova-elements' ),
                'type'  => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'status_bar_background',
                'selector' => '{{WRAPPER}} ' . $css_scheme['status_bar'],
            )
        );

        $this->add_responsive_control(
            'status_bar_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['status_bar'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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

        $this->add_responsive_control(
            'title_alignment',
            array(
                'label'       => esc_html__( 'Title Alignment', 'nova-elements' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default'     => '',
                'options'     => array(
                    'flex-start' => array(
                        'title' => esc_html__( 'Left', 'nova-elements' ),
                        'icon'  => 'eicon-h-align-left',
                    ),
                    'center' => array(
                        'title' => esc_html__( 'Center', 'nova-elements' ),
                        'icon'  => 'eicon-h-align-center',
                    ),
                    'flex-end' => array(
                        'title' => esc_html__( 'Right', 'nova-elements' ),
                        'icon'  => 'eicon-h-align-right',
                    ),
                ),
                'condition' => array(
                    'progress_type' => array( 'type-1', 'type-2', 'type-3', 'type-5' ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} '. $css_scheme['title'] => 'align-self: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'title_background',
                'selector' => '{{WRAPPER}} ' . $css_scheme['title'],
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'title_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['title'],
            )
        );

        $this->add_responsive_control(
            'title_border_radius',
            array(
                'label'      => __( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['title'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'title_box_shadow',
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

        $this->add_control(
            'title_icon_heading',
            array(
                'label'     => esc_html__( 'Icon', 'nova-elements' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'icon_color',
            array(
                'label'     => esc_html__( 'Icon Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['title_icon'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_responsive_control(
            'icon_size',
            array(
                'label'      => esc_html__( 'Icon Size', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px', 'em',
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 10,
                        'max' => 200,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['title_icon'] => 'font-size: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_responsive_control(
            'icon_margin',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['title_icon'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_control(
            'title_text_heading',
            array(
                'label'     => esc_html__( 'Text', 'nova-elements' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_control(
            'text_color',
            array(
                'label'  => esc_html__( 'Text Color', 'nova-elements' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['title_text'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'text_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} ' . $css_scheme['title_text'],
            )
        );

        $this->add_responsive_control(
            'text_alignment',
            array(
                'label'       => esc_html__( 'Text Alignment', 'nova-elements' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default'     => '',
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
                    '{{WRAPPER}} '. $css_scheme['title_text'] => 'align-self: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();

        /**
         * Percent Style Section
         */
        $this->start_controls_section(
            'section_percent_style',
            array(
                'label'      => esc_html__( 'Percent', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_responsive_control(
            'percent_width',
            array(
                'label'      => esc_html__( 'Percent Width', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px',
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 20,
                        'max' => 200,
                    ),
                ),
                'condition' => array(
                    'progress_type' => array( 'type-3' ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} '. $css_scheme['percent'] => 'width: {{SIZE}}{{UNIT}}; margin-right: calc( {{SIZE}}{{UNIT}}/-2 );',
                ),
            )
        );

        $this->add_responsive_control(
            'percent_alignment',
            array(
                'label'       => esc_html__( 'Percent Alignment', 'nova-elements' ),
                'type'        => Controls_Manager::CHOOSE,
                'label_block' => false,
                'default'     => '',
                'options'     => array(
                    'flex-start' => array(
                        'title' => esc_html__( 'Left', 'nova-elements' ),
                        'icon'  => 'eicon-h-align-left',
                    ),
                    'center' => array(
                        'title' => esc_html__( 'Center', 'nova-elements' ),
                        'icon'  => 'eicon-h-align-center',
                    ),
                    'flex-end' => array(
                        'title' => esc_html__( 'Right', 'nova-elements' ),
                        'icon'  => 'eicon-h-align-right',
                    ),
                ),
                'condition' => array(
                    'progress_type' => array( 'type-1' ,'type-2' ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} '. $css_scheme['percent'] => 'align-self: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'percent_background',
                'selector' => '{{WRAPPER}} ' . $css_scheme['percent'],
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'percent_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['percent'],
            )
        );

        $this->add_responsive_control(
            'percent_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['percent'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'percent_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['percent'],
            )
        );

        $this->add_responsive_control(
            'percent_margin',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['percent'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'percent_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['percent'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_control(
            'percent_color',
            array(
                'label'  => esc_html__( 'Text Color', 'nova-elements' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['percent'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'percent_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} ' . $css_scheme['percent'],
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
                'selectors'  => array(
                    '{{WRAPPER}} '. $css_scheme['percent'] . ' .nova-progress-bar__percent-suffix' => 'font-size: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_responsive_control(
            'percent_suffix_alignment',
            array(
                'label'       => esc_html__( 'Percent Suffix Alignment', 'nova-elements' ),
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
                    '{{WRAPPER}} '. $css_scheme['percent'] . ' .nova-progress-bar__percent-suffix' => 'align-self: {{VALUE}};',
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
     * Get type template
     * @param  [type] $name [description]
     * @return [type]       [description]
     */
    public function __get_type_template( $type = null ) {
        return nova_elements_get_template( $this->get_name() . '/global/types/' . $type . '.php' );
    }

}