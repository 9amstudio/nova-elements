<?php
namespace Nova_Elements\Modules\TabsWidget\Widgets;

use Nova_Elements\Base\Nova_Widget;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * TabsWidget Widget
 */
class Tabs_Widget extends Nova_Widget {

    public $__query           = array();

    public function get_name() {
        return 'nova-tabs';
    }

    protected function get_widget_title() {
        return esc_html__( 'Tabs', 'nova-elements' );
    }

    public function get_icon() {
        return 'eicon-tabs';
    }

    protected function _register_controls() {
        $css_scheme = apply_filters(
            'nova-tabs/tabs/css-scheme',
            array(
                'instance'        => '> .elementor-widget-container > .nova-tabs',
                'control_wrapper' => '> .elementor-widget-container > .nova-tabs > .nova-tabs__control-wrapper',
                'control'         => '> .elementor-widget-container > .nova-tabs > .nova-tabs__control-wrapper > .nova-tabs__control',
                'content_wrapper' => '> .elementor-widget-container > .nova-tabs > .nova-tabs__content-wrapper',
                'content'         => '> .elementor-widget-container > .nova-tabs > .nova-tabs__content-wrapper > .nova-tabs__content',
                'label'           => '.nova-tabs__label-text',
                'icon'            => '.nova-tabs__label-icon',
            )
        );

        $this->start_controls_section(
            'section_items_data',
            array(
                'label' => esc_html__( 'Items', 'nova-elements' ),
            )
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'item_active',
            array(
                'label'        => esc_html__( 'Active', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'yes',
                'default'      => 'false',
            )
        );

        $repeater->add_control(
            'item_use_image',
            array(
                'label'        => esc_html__( 'Use Image?', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'yes',
                'default'      => 'false',
            )
        );

        $repeater->add_control(
            'item_icon',
            array(
                'label'       => esc_html__( 'Icon', 'nova-elements' ),
                'type'        => Controls_Manager::ICON,
                'label_block' => true,
                'file'        => '',
                'default'     => '',
            )
        );

        $repeater->add_control(
            'item_image',
            array(
                'label'   => esc_html__( 'Image', 'nova-elements' ),
                'type'    => Controls_Manager::MEDIA,
            )
        );

        $repeater->add_control(
            'item_label',
            array(
                'label'   => esc_html__( 'Label', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'New Tab', 'nova-elements' ),
                'dynamic' => [
                    'active' => true,
                ],
            )
        );

        $templates = \Elementor\Plugin::$instance->templates_manager->get_source( 'local' )->get_items();

        if ( empty( $templates ) ) {

            $this->add_control(
                'no_templates',
                array(
                    'label' => false,
                    'type'  => Controls_Manager::RAW_HTML,
                    'raw'   => $this->empty_templates_message(),
                )
            );

            return;
        }

        $options = [
            '0' => '— ' . esc_html__( 'Select', 'nova-elements' ) . ' —',
        ];

        $types = [];

        foreach ( $templates as $template ) {
            $options[ $template['template_id'] ] = $template['title'] . ' (' . $template['type'] . ')';
            $types[ $template['template_id'] ] = $template['type'];
        }

        $repeater->add_control(
            'content_type',
            [
                'label'       => esc_html__( 'Content Type', 'nova-elements' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'editor',
                'options'     => [
                    'template' => esc_html__( 'Template', 'nova-elements' ),
                    'editor'   => esc_html__( 'Editor', 'nova-elements' ),
                ],
                'label_block' => 'true',
            ]
        );

        $repeater->add_control(
            'item_template_id',
            [
                'label'       => esc_html__( 'Choose Template', 'nova-elements' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => '0',
                'options'     => $options,
                'types'       => $types,
                'label_block' => 'true',
                'condition'   => [
                    'content_type' => 'template',
                ]
            ]
        );

        $repeater->add_control(
            'item_editor_content',
            [
                'label'      => esc_html__( 'Content', 'nova-elements' ),
                'type'       => Controls_Manager::WYSIWYG,
                'default'    => esc_html__( 'Tab Item Content', 'nova-elements' ),
                'dynamic' => [
                    'active' => true,
                ],
                'condition'   => [
                    'content_type' => 'editor',
                ]
            ]
        );

        $this->add_control(
            'tabs',
            array(
                'type'        => Controls_Manager::REPEATER,
                'fields'      => array_values( $repeater->get_controls() ),
                'default'     => array(
                    array(
                        'item_label'  => esc_html__( 'Tab #1', 'nova-elements' ),
                    ),
                    array(
                        'item_label'  => esc_html__( 'Tab #2', 'nova-elements' ),
                    ),
                    array(
                        'item_label'  => esc_html__( 'Tab #3', 'nova-elements' ),
                    ),
                ),
                'title_field' => '{{{ item_label }}}',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_settings_data',
            array(
                'label' => esc_html__( 'Settings', 'nova-elements' ),
            )
        );

        $this->add_control(
            'show_effect',
            array(
                'label'       => esc_html__( 'Show Effect', 'nova-elements' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'move-up',
                'options' => array(
                    'none'             => esc_html__( 'None', 'nova-elements' ),
                    'fade'             => esc_html__( 'Fade', 'nova-elements' ),
                    //'column-fade'      => esc_html__( 'Column Fade', 'nova-elements' ),
                    'zoom-in'          => esc_html__( 'Zoom In', 'nova-elements' ),
                    'zoom-out'         => esc_html__( 'Zoom Out', 'nova-elements' ),
                    'move-up'          => esc_html__( 'Move Up', 'nova-elements' ),
                    //'column-move-up'   => esc_html__( 'Column Move Up', 'nova-elements' ),
                    'fall-perspective' => esc_html__( 'Fall Perspective', 'nova-elements' ),
                ),
            )
        );

        $this->add_control(
            'tabs_event',
            array(
                'label'   => esc_html__( 'Tabs Event', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'click',
                'options' => array(
                    'click' => esc_html__( 'Click', 'nova-elements' ),
                    'hover' => esc_html__( 'Hover', 'nova-elements' ),
                ),
            )
        );

        $this->add_control(
            'auto_switch',
            array(
                'label'        => esc_html__( 'Auto Switch', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'On', 'nova-elements' ),
                'label_off'    => esc_html__( 'Off', 'nova-elements' ),
                'return_value' => 'yes',
                'default'      => 'false',
            )
        );

        $this->add_control(
            'auto_switch_delay',
            array(
                'label'   => esc_html__( 'Auto Switch Delay', 'nova-elements' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 3000,
                'min'     => 1000,
                'max'     => 20000,
                'step'    => 100,
                'condition' => array(
                    'auto_switch' => 'yes',
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_general_style',
            array(
                'label'      => esc_html__( 'General', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_responsive_control(
            'tabs_position',
            array(
                'label'   => esc_html__( 'Tabs Position', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'top',
                'options' => array(
                    'left'  => esc_html__( 'Left', 'nova-elements' ),
                    'top'   => esc_html__( 'Top', 'nova-elements' ),
                    'right' => esc_html__( 'Right', 'nova-elements' ),
                ),
            )
        );

        $this->add_responsive_control(
            'tabs_control_wrapper_width',
            array(
                'label'      => esc_html__( 'Tabs Control Width', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px', '%',
                ),
                'range'      => array(
                    '%' => array(
                        'min' => 10,
                        'max' => 50,
                    ),
                    'px' => array(
                        'min' => 100,
                        'max' => 500,
                    ),
                ),
                'condition' => array(
                    'tabs_position' => array( 'left', 'right' ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control_wrapper'] => 'min-width: {{SIZE}}{{UNIT}}',
                    '{{WRAPPER}} ' . $css_scheme['content_wrapper'] => 'min-width: calc(100% - {{SIZE}}{{UNIT}})',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'tabs_container_background',
                'selector' => '{{WRAPPER}} ' . $css_scheme['instance'],
            )
        );

        $this->add_responsive_control(
            'tabs_container_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['instance'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'tabs_container_margin',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['instance'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'tabs_container_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['instance'],
            )
        );

        $this->add_responsive_control(
            'tabs_container_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['instance'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'tabs_container_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['instance'],
            )
        );

        $this->end_controls_section();

        /**
         * Tabs Control Style Section
         */
        $this->start_controls_section(
            'section_tabs_control_style',
            array(
                'label'      => esc_html__( 'Tabs Control', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_responsive_control(
            'tabs_controls_aligment',
            array(
                'label'   => esc_html__( 'Tabs Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'flex-start',
                'options' => array(
                    'flex-start'    => array(
                        'title' => esc_html__( 'Left', 'nova-elements' ),
                        'icon'  => 'fa fa-arrow-left',
                    ),
                    'center' => array(
                        'title' => esc_html__( 'Center', 'nova-elements' ),
                        'icon'  => 'fa fa-align-center',
                    ),
                    'flex-end' => array(
                        'title' => esc_html__( 'Right', 'nova-elements' ),
                        'icon'  => 'fa fa-arrow-right',
                    ),
                ),
                'condition' => array(
                    'tabs_position' => 'top',
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control_wrapper'] => 'align-self: {{VALUE}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'tabs_content_wrapper_background',
                'selector' => '{{WRAPPER}} ' . $css_scheme['control_wrapper'],
            )
        );

        $this->add_responsive_control(
            'tabs_control_wrapper_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control_wrapper'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'tabs_control_wrapper_margin',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control_wrapper'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'tabs_control_wrapper_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['control_wrapper'],
            )
        );

        $this->add_responsive_control(
            'tabs_control_wrapper_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control_wrapper'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'tabs_control_wrapper_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['control_wrapper'],
            )
        );

        $this->end_controls_section();

        /**
         * Tabs Control Style Section
         */
        $this->start_controls_section(
            'section_tabs_control_item_style',
            array(
                'label'      => esc_html__( 'Tabs Control Item', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_responsive_control(
            'tabs_controls_item_aligment_top_icon',
            array(
                'label'   => esc_html__( 'Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => array(
                    'flex-start'    => array(
                        'title' => esc_html__( 'Left', 'nova-elements' ),
                        'icon'  => 'fa fa-arrow-left',
                    ),
                    'center' => array(
                        'title' => esc_html__( 'Center', 'nova-elements' ),
                        'icon'  => 'fa fa-align-center',
                    ),
                    'flex-end' => array(
                        'title' => esc_html__( 'Right', 'nova-elements' ),
                        'icon'  => 'fa fa-arrow-right',
                    ),
                ),
                'condition' => array(
                    'tabs_position' => array( 'left', 'right' ),
                    'tabs_control_icon_position' => 'top'
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . ' .nova-tabs__control-inner' => 'align-items: {{VALUE}};',
                ),
            )
        );

        $this->add_responsive_control(
            'tabs_controls_item_aligment_left_icon',
            array(
                'label'   => esc_html__( 'Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'flex-start',
                'options' => array(
                    'flex-start'    => array(
                        'title' => esc_html__( 'Left', 'nova-elements' ),
                        'icon'  => 'fa fa-arrow-left',
                    ),
                    'center' => array(
                        'title' => esc_html__( 'Center', 'nova-elements' ),
                        'icon'  => 'fa fa-align-center',
                    ),
                    'flex-end' => array(
                        'title' => esc_html__( 'Right', 'nova-elements' ),
                        'icon'  => 'fa fa-arrow-right',
                    ),
                ),
                'condition' => array(
                    'tabs_position' => array( 'left', 'right' ),
                    'tabs_control_icon_position' => 'left'
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . ' .nova-tabs__control-inner' => 'justify-content: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'tabs_control_icon_style_heading',
            array(
                'label'     => esc_html__( 'Icon Styles', 'nova-elements' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->add_responsive_control(
            'tabs_control_icon_margin',
            array(
                'label'      => esc_html__( 'Icon Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . ' .nova-tabs__label-icon' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'tabs_control_image_margin',
            array(
                'label'      => esc_html__( 'Image Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . ' .nova-tabs__label-image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'tabs_control_image_width',
            array(
                'label'      => esc_html__( 'Image Width', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px', 'em', '%',
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 10,
                        'max' => 100,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . ' .nova-tabs__label-image' => 'width: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_control(
            'tabs_control_icon_position',
            array(
                'label'       => esc_html__( 'Icon Position', 'nova-elements' ),
                'type'        => Controls_Manager::SELECT,
                'default'     => 'left',
                'options' => array(
                    'left' => esc_html__( 'Left', 'nova-elements' ),
                    'top'  => esc_html__( 'Top', 'nova-elements' ),
                ),
            )
        );

        $this->add_control(
            'tabs_control_state_style_heading',
            array(
                'label'     => esc_html__( 'State Styles', 'nova-elements' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->start_controls_tabs( 'tabs_control_styles' );

        $this->start_controls_tab(
            'tabs_control_normal',
            array(
                'label' => esc_html__( 'Normal', 'nova-elements' ),
            )
        );

        $this->add_control(
            'tabs_control_label_color',
            array(
                'label'  => esc_html__( 'Text Color', 'nova-elements' ),
                'type'   => Controls_Manager::COLOR,
                'scheme' => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . ' ' . $css_scheme['label'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'tabs_control_label_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} '. $css_scheme['control'] . ' ' . $css_scheme['label'],
            )
        );

        $this->add_control(
            'tabs_control_icon_color',
            array(
                'label'     => esc_html__( 'Icon Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'scheme' => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_3,
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . ' ' . $css_scheme['icon'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_responsive_control(
            'tabs_control_icon_size',
            array(
                'label'      => esc_html__( 'Icon Size', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px', 'em', 'rem',
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 18,
                        'max' => 200,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . ' ' . $css_scheme['icon'] => 'font-size: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'tabs_control_background',
                'selector' => '{{WRAPPER}} ' . $css_scheme['control'],
            )
        );

        $this->add_responsive_control(
            'tabs_control_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . ' .nova-tabs__control-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'tabs_control_margin',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'tabs_control_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'tabs_control_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'  => '{{WRAPPER}} ' . $css_scheme['control'],
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'tabs_control_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['control'],
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tabs_control_hover',
            array(
                'label' => esc_html__( 'Hover', 'nova-elements' ),
            )
        );

        $this->add_control(
            'tabs_control_label_color_hover',
            array(
                'label'  => esc_html__( 'Text Color', 'nova-elements' ),
                'type'   => Controls_Manager::COLOR,
                'scheme' => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . ':hover ' . $css_scheme['label'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'tabs_control_label_typography_hover',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} ' . $css_scheme['control'] . ':hover ' . $css_scheme['label'],
            )
        );

        $this->add_control(
            'tabs_control_icon_color_hover',
            array(
                'label'     => esc_html__( 'Icon Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'scheme' => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . ':hover ' . $css_scheme['icon'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_responsive_control(
            'tabs_control_icon_size_hover',
            array(
                'label'      => esc_html__( 'Icon Size', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px', 'em', 'rem',
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 18,
                        'max' => 200,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . ':hover ' . $css_scheme['icon'] => 'font-size: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'tabs_control_background_hover',
                'selector' => '{{WRAPPER}} ' . $css_scheme['control'] . ':hover',
            )
        );

        $this->add_responsive_control(
            'tabs_control_padding_hover',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . ':hover' . ' .nova-tabs__control-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'tabs_control_margin_hover',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . ':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'tabs_control_border_hover',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'  => '{{WRAPPER}} ' . $css_scheme['control'] . ':hover',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'tabs_control_box_shadow_hover',
                'selector' => '{{WRAPPER}} ' . $css_scheme['control'] . ':hover',
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tabs_control_active',
            array(
                'label' => esc_html__( 'Active', 'nova-elements' ),
            )
        );

        $this->add_control(
            'tabs_control_label_color_active',
            array(
                'label'  => esc_html__( 'Text Color', 'nova-elements' ),
                'type'   => Controls_Manager::COLOR,
                'scheme' => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . '.active-tab ' . $css_scheme['label'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'tabs_control_label_typography_active',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} ' . $css_scheme['control'] . '.active-tab ' . $css_scheme['label'],
            )
        );

        $this->add_control(
            'tabs_control_icon_color_active',
            array(
                'label'     => esc_html__( 'Icon Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'scheme'    => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . '.active-tab ' . $css_scheme['icon'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_responsive_control(
            'tabs_control_icon_size_active',
            array(
                'label'      => esc_html__( 'Icon Size', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px', 'em', 'rem',
                ),
                'range'      => array(
                    'px' => array(
                        'min' => 18,
                        'max' => 200,
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . '.active-tab ' . $css_scheme['icon'] => 'font-size: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'tabs_control_background_active',
                'selector' => '{{WRAPPER}} ' . $css_scheme['control'] . '.active-tab',
            )
        );

        $this->add_responsive_control(
            'tabs_control_padding_active',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . '.active-tab' . ' .nova-tabs__control-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'tabs_control_margin_active',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . '.active-tab' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'tabs_control_border_radius_active',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['control'] . '.active-tab' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'tabs_control_box_shadow_active',
                'selector' => '{{WRAPPER}} ' . $css_scheme['control'] . '.active-tab',
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'tabs_control_border_active',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['control'] . '.active-tab',
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

        /**
         * Tabs Content Style Section
         */
        $this->start_controls_section(
            'section_tabs_content_style',
            array(
                'label'      => esc_html__( 'Tabs Content', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'tabs_content_background',
                'selector' => '{{WRAPPER}} ' . $css_scheme['content_wrapper'],
            )
        );

        $this->add_responsive_control(
            'tabs_content_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['content'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'tabs_content_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'  => '{{WRAPPER}} ' . $css_scheme['content_wrapper'],
            )
        );

        $this->add_responsive_control(
            'tabs_content_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['content_wrapper'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'tabs_content_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['content_wrapper'],
            )
        );

        $this->end_controls_section();

    }

    /**
     * [render description]
     * @return [type] [description]
     */
    protected function render() {

        $this->__context = 'render';

        $tabs = $this->get_settings_for_display( 'tabs' );

        if ( ! $tabs || empty( $tabs ) ) {
            return false;
        }

        $id_int = substr( $this->get_id_int(), 0, 3 );

        $tabs_position = $this->get_settings( 'tabs_position' );
        $tabs_position_tablet = $this->get_settings( 'tabs_position_tablet' );
        $tabs_position_mobile = $this->get_settings( 'tabs_position_mobile' );
        $show_effect = $this->get_settings( 'show_effect' );

        $active_index = 0;

        foreach ( $tabs as $index => $item ) {
            if ( array_key_exists( 'item_active', $item ) && filter_var( $item['item_active'], FILTER_VALIDATE_BOOLEAN ) ) {
                $active_index = $index;
            }
        }

        $settings = array(
            'activeIndex'     => $active_index,
            'event'           => $this->get_settings( 'tabs_event' ),
            'autoSwitch'      => filter_var( $this->get_settings( 'auto_switch' ), FILTER_VALIDATE_BOOLEAN ),
            'autoSwitchDelay' => $this->get_settings( 'auto_switch_delay' ),
        );

        $this->add_render_attribute( 'instance', array(
            'class' => array(
                'nova-tabs',
                'nova-tabs-position-' . $tabs_position,
                'nova-tabs-' . $show_effect . '-effect',
            ),
            'data-settings' => json_encode( $settings ),
        ) );

        if ( ! empty( $tabs_position_tablet ) ) {
            $this->add_render_attribute( 'instance', 'class', [
                'nova-tabs-position-tablet-' . $tabs_position_tablet
            ] );
        }

        if ( ! empty( $tabs_position_mobile ) ) {
            $this->add_render_attribute( 'instance', 'class', [
                'nova-tabs-position-mobile-' . $tabs_position_mobile
            ] );
        }

        ?>
        <div <?php echo $this->get_render_attribute_string( 'instance' ); ?>>
            <div class="nova-tabs__control-wrapper">
                <?php
                foreach ( $tabs as $index => $item ) {
                    $tab_count = $index + 1;
                    $tab_title_setting_key = $this->get_repeater_setting_key( 'nova_tab_control', 'tabs', $index );

                    $this->add_render_attribute( $tab_title_setting_key, array(
                        'id'            => 'nova-tabs-control-' . $id_int . $tab_count,
                        'class'         => array(
                            'nova-tabs__control',
                            'nova-tabs__control-icon-' . $this->get_settings( 'tabs_control_icon_position' ),
                            $index === $active_index ? 'active-tab' : '',
                        ),
                        'data-tab'      => $tab_count,
                        'tabindex'      => $id_int . $tab_count,
                    ) );


                    $title_icon_html = '';

                    if ( ! empty( $item['item_icon'] ) ) {
                        $title_icon_html = sprintf( '<div class="nova-tabs__label-icon"><i class="%1$s"></i></div>', $item['item_icon'] );
                    }

                    $title_image_html = '';

                    if ( ! empty( $item['item_image']['url'] ) ) {
                        $title_image_html = sprintf( '<img class="nova-tabs__label-image" src="%1$s" alt="">', $item['item_image']['url'] );
                    }

                    $title_label_html = '';

                    if ( ! empty( $item['item_label'] ) ) {
                        $title_label_html = sprintf( '<div class="nova-tabs__label-text">%1$s</div>', $item['item_label'] );
                    }

                    echo sprintf(
                        '<div %1$s><div class="nova-tabs__control-inner">%2$s%3$s</div></div>',
                        $this->get_render_attribute_string( $tab_title_setting_key ),
                        filter_var( $item['item_use_image'], FILTER_VALIDATE_BOOLEAN ) ? $title_image_html : $title_icon_html,
                        $title_label_html
                    );
                }
                ?>
            </div>
            <div class="nova-tabs__content-wrapper">
                <?php
                foreach ( $tabs as $index => $item ) {
                    $tab_count = $index + 1;
                    $tab_content_setting_key = $this->get_repeater_setting_key( 'tab_content', 'tabs', $index );

                    $this->add_render_attribute( $tab_content_setting_key, array(
                        'id'       => 'nova-tabs-content-' . $id_int . $tab_count,
                        'class'    => array(
                            'nova-tabs__content',
                            $index === $active_index ? 'active-content' : '',
                        ),
                        'data-tab' => $tab_count,
                    ) );

                    $content_html = '';

                    switch ( $item[ 'content_type' ] ) {
                        case 'template':

                            if ( '0' !== $item['item_template_id'] ) {

                                $template_content = \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $item['item_template_id'] );

                                if ( ! empty( $template_content ) ) {
                                    $content_html .= $template_content;

                                    if ( \Nova_Elements\NovaPlugin::instance()->is_edit_mode() ) {
                                        $link = add_query_arg(
                                            array(
                                                'elementor' => '',
                                            ),
                                            get_permalink( $item['item_template_id'] )
                                        );

                                        $content_html .= sprintf( '<div class="nova-tabs__edit-cover" data-template-edit-link="%s"><i class="fa fa-pencil"></i><span>%s</span></div>', $link, esc_html__( 'Edit Template', 'nova-elements' ) );
                                    }
                                } else {
                                    $content_html = $this->no_template_content_message();
                                }
                            } else {
                                $content_html = $this->no_templates_message();
                            }
                            break;

                        case 'editor':
                            $content_html = $this->parse_text_editor( $item['item_editor_content'] );
                            break;
                    }

                    echo sprintf( '<div %1$s>%2$s</div>', $this->get_render_attribute_string( $tab_content_setting_key ), $content_html );
                }
                ?>
            </div>
        </div>
        <?php
    }

    /**
     * [empty_templates_message description]
     * @return [type] [description]
     */
    public function empty_templates_message() {
        return '<div id="elementor-widget-template-empty-templates">
				<div class="elementor-widget-template-empty-templates-icon"><i class="eicon-nerd"></i></div>
				<div class="elementor-widget-template-empty-templates-title">' . esc_html__( 'You Haven’t Saved Templates Yet.', 'nova-elements' ) . '</div>
				<div class="elementor-widget-template-empty-templates-footer">' . esc_html__( 'What is Library?', 'nova-elements' ) . ' <a class="elementor-widget-template-empty-templates-footer-url" href="https://go.elementor.com/docs-library/" target="_blank">' . esc_html__( 'Read our tutorial on using Library templates.', 'nova-elements' ) . '</a></div>
				</div>';
    }

    /**
     * [no_templates_message description]
     * @return [type] [description]
     */
    public function no_templates_message() {
        $message = '<span>' . esc_html__( 'Template is not defined. ', 'nova-elements' ) . '</span>';

        //$link =  Utils::get_create_new_post_url( 'elementor_library' );

        $link = add_query_arg(
            array(
                'post_type'     => 'elementor_library',
                'action'        => 'elementor_new_post',
                '_wpnonce'      => wp_create_nonce( 'elementor_action_new_post' ),
                'template_type' => 'section',
            ),
            esc_url( admin_url( '/edit.php' ) )
        );

        $new_link = '<span>' . esc_html__( 'Select an existing template or create a ', 'nova-elements' ) . '</span><a class="nova-tabs-new-template-link elementor-clickable" target="_blank" href="' . $link . '">' . esc_html__( 'new one', 'nova-elements' ) . '</a>' ;

        return sprintf(
            '<div class="nova-tabs-no-template-message">%1$s%2$s</div>',
            $message,
            \Nova_Elements\NovaPlugin::instance()->in_elementor() ? $new_link : ''
        );
    }

    /**
     * [no_template_content_message description]
     * @return [type] [description]
     */
    public function no_template_content_message() {
        $message = '<span>' . esc_html__( 'The tabs are working. Please, note, that you have to add a template to the library in order to be able to display it inside the tabs.', 'nova-elements' ) . '</span>';

        return sprintf( '<div class="nova-toogle-no-template-message">%1$s</div>', $message );
    }

    /**
     * [get_template_edit_link description]
     * @param  [type] $template_id [description]
     * @return [type]              [description]
     */
    public function get_template_edit_link( $template_id ) {

        $link = add_query_arg( 'elementor', '', get_permalink( $template_id ) );

        return '<a target="_blank" class="elementor-edit-template elementor-clickable" href="' . $link .'"><i class="fa fa-pencil"></i> ' . esc_html__( 'Edit Template', 'nova-elements' ) . '</a>';
    }

    /**
     * Set posts query results
     */
    public function __set_query( $posts ) {
        $this->__query = $posts;
    }

    /**
     * Return posts query results
     */
    public function __get_query() {
        return $this->__query;
    }

}
