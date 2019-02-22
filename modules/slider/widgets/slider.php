<?php
namespace Nova_Elements\Modules\Slider\Widgets;

use Nova_Elements\Base\Nova_Widget;
use Nova_Elements\Controls\Group_Control_Box_Style;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Repeater;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Slider Widget
 */
class Slider extends Nova_Widget {

    public function get_name() {
        return 'nova-slider';
    }

    protected function get_widget_title() {
        return esc_html__( 'Slider', 'nova-elements' );
    }

    public function get_icon() {
        return 'eicon-thumbnails-down';
    }

    public function get_script_depends() {
        return [
            'imagesloaded',
            'nova-slider-pro',
            'nova-elements'
        ];
    }

    public function get_style_depends() {
        return [
            'nova-slider-pro-css'
        ];
    }

    protected function _register_controls() {

        $css_scheme = apply_filters(
            'nova-elements/slider/css-scheme',
            array(
                'slider'              => '.shortcode_nova_slider',
                'slider_container'    => '.shortcode_nova_slider .slider__item',
                'title'               => '.shortcode_nova_slider .slide-title',
                'subtitle'            => '.shortcode_nova_slider .slide-subtitle',
                'desc'                => '.shortcode_nova_slider .slide-description',
								'buttons_wrapper2'    => '.nova-button__container',
                'buttons_wrapper'     => '.nova-slider__button-wrapper',
                'primary_button'      => '.nova-slider__button--primary',
                'secondary_button'    => '.nova-slider__button--secondary',
								'action_button'       => '.shortcode_nova_slider .slide-button',
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
                'label'   => esc_html__( 'Title', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => array( 'active' => true ),
            )
        );

        $repeater->add_control(
            'item_subtitle',
            array(
                'label'   => esc_html__( 'Subtitle', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => array( 'active' => true ),
            )
        );


        $repeater->add_control(
            'item_desc',
            array(
                'label'   => esc_html__( 'Description', 'nova-elements' ),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => array( 'active' => true ),
            )
        );

        $repeater->add_control(
            'item_button_action_url',
            array(
                'label'   => esc_html__( 'Action Button URL', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
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
            'item_button_action_text',
            array(
                'label'   => esc_html__( 'Action Button Text', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'More', 'nova-elements' ),
            )
        );

        $repeater->add_control(
            'item_button_action_bg_color',
            array(
                'label'     => esc_html__( 'Action Button Background Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
            )
        );

        $repeater->add_control(
            'item_button_primary_url',
            array(
                'label'   => esc_html__( 'Primary Button URL', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
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
            'item_button_primary_text',
            array(
                'label'   => esc_html__( 'Primary Button Text', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'More', 'nova-elements' ),
            )
        );

        $repeater->add_control(
            'item_button_secondary_url',
            array(
                'label'   => esc_html__( 'Secondary Button URL', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'default' => '',
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
            'item_button_secondary_text',
            array(
                'label'   => esc_html__( 'Secondary Button Text', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'default' => esc_html__( 'More', 'nova-elements' ),
            )
        );

        $this->add_control(
            'item_list',
            array(
                'type'        => Controls_Manager::REPEATER,
                'fields'      => array_values( $repeater->get_controls() ),
                'default'     => array(
                    array(
                        'item_image'                  => array(
                            'url' => Utils::get_placeholder_image_src(),
                        ),
                        'item_title'                  => esc_html__( 'Slide #1', 'nova-elements' ),
                        'item_subtitle'               => esc_html__( 'SubTitle', 'nova-elements' ),
                        'item_desc'                   => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'nova-elements' ),
												'item_button_action_url'      => '#',
												'item_button_action_text'     => esc_html__( 'View More', 'nova-elements' ),
												'item_button_action_bg_color' => '#54595f',
                        'item_button_primary_url'     => '#',
                        'item_button_primary_text'    => esc_html__( 'Button #1', 'nova-elements' ),
                        'item_button_secondary_ulr'   => '#',
                        'item_button_secondary_text'  => esc_html__( 'Button #2', 'nova-elements' ),
                    ),
                    array(
                        'item_image'                  => array(
                            'url' => Utils::get_placeholder_image_src(),
                        ),
                        'item_title'                  => esc_html__( 'Slide #2', 'nova-elements' ),
                        'item_subtitle'               => esc_html__( 'SubTitle', 'nova-elements' ),
                        'item_desc'                   => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'nova-elements' ),
												'item_button_action_url'      => '#',
												'item_button_action_text'     => esc_html__( 'View More', 'nova-elements' ),
												'item_button_action_bg_color' => '#54595f',
                        'item_button_primary_url'     => '#',
                        'item_button_primary_text'    => esc_html__( 'Button #1', 'nova-elements' ),
                        'item_button_secondary_ulr'   => '#',
                        'item_button_secondary_text'  => esc_html__( 'Button #2', 'nova-elements' ),
                    ),
                    array(
                        'item_image'                  => array(
                            'url' => Utils::get_placeholder_image_src(),
                        ),
                        'item_title'                  => esc_html__( 'Slide #3', 'nova-elements' ),
                        'item_subtitle'               => esc_html__( 'SubTitle', 'nova-elements' ),
                        'item_desc'                   => esc_html__( 'Lorem ipsum dolor sit amet, consectetur adipiscing elit.', 'nova-elements' ),
												'item_button_action_url'      => '#',
												'item_button_action_text'     => esc_html__( 'View More', 'nova-elements' ),
												'item_button_action_bg_color' => '#54595f',
                        'item_button_primary_url'     => '#',
                        'item_button_primary_text'    => esc_html__( 'Button #1', 'nova-elements' ),
                        'item_button_secondary_ulr'   => '#',
                        'item_button_secondary_text'  => esc_html__( 'Button #2', 'nova-elements' ),
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

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            array(
                'name'    => 'slider_image', // Usage: `{name}_size` and `{name}_custom_dimension`, in this case `image_size` and `image_custom_dimension`.
                'default' => 'full',
            )
        );

        $this->add_control(
            'slider_width',
            array(
                'label' => esc_html__( 'Slider Width(%)', 'nova-elements' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => array(
                    '%' => array(
                        'min' => 50,
                        'max' => 100,
                    ),
                ),
                'default' => array(
                    'unit' => '%',
                    'size' => 100,
                ),
								'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['slider'] => 'max-width: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_height',
            array(
                'label' => esc_html__( 'Slider Height(px)', 'nova-elements' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => array(
                    'px', 'vh',
                ),
                'range' => array(
                    'px' => array(
                        'min' => 300,
                        'max' => 1000,
                    ),
                    'vh' => array(
                        'min' => 10,
                        'max' => 100,
                    ),
                ),
                'default' => array(
                    'unit' => 'px',
                    'size' => 600,
                ),
								'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['slider'] => 'height: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_container_width',
            array(
                'label' => esc_html__( 'Slider Container Width(%)', 'nova-elements' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => array(
                    '%', 'px',
                ),
                'range' => array(
                    '%' => array(
                        'min' => 20,
                        'max' => 100,
                    ),
                    'px' => array(
                        'min' => 200,
                        'max' => 1000,
                    ),
                ),
                'default' => array(
                    'unit' => '%',
                    'size' => 100,
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['slider_container'] => 'max-width: {{SIZE}}{{UNIT}}',
                ),
            )
        );

        $this->end_controls_section();

        /**
         * Title Style Section
         */
        $this->start_controls_section(
            'section_slider_title_style',
            array(
                'label'      => esc_html__( 'Title', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'slider_title_color',
            array(
                'label'  => esc_html__( 'Title Color', 'nova-elements' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['title'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'slider_title_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} ' . $css_scheme['title'],
            )
        );

        $this->add_responsive_control(
            'slider_title_padding',
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
            'slider_title_margin',
            array(
                'label'      => __( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['title'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_title_alignment',
            array(
                'label'   => esc_html__( 'Text Alignment', 'nova-elements' ),
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
                    '{{WRAPPER}} ' . $css_scheme['title'] => 'text-align: {{VALUE}};',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_title_container_alignment',
            array(
                'label'   => esc_html__( 'Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'flex-start',
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
                    '{{WRAPPER}} ' . $css_scheme['title'] => 'align-self: {{VALUE}};',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_title_wax_width',
            array(
                'label' => esc_html__( 'Max Width', 'nova-elements' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => array( 'px', '%' ),
                'range' => array(
                    '%' => array(
                        'min' => 20,
                        'max' => 100,
                    ),
                    'px' => array(
                        'min' => 300,
                        'max' => 1000,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['title'] => 'max-width: {{SIZE}}{{UNIT}};',
                ),
            )
        );


        $this->end_controls_section();

        /**
         * SubTitle Style Section
         */
        $this->start_controls_section(
            'section_slider_subtitle_style',
            array(
                'label'      => esc_html__( 'Subtitle', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'slider_subtitle_color',
            array(
                'label'  => esc_html__( 'Subtitle Color', 'nova-elements' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['subtitle'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'slider_subtitle_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} ' . $css_scheme['subtitle'],
            )
        );

        $this->add_responsive_control(
            'slider_subtitle_padding',
            array(
                'label'      => __( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['subtitle'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_subtitle_margin',
            array(
                'label'      => __( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['subtitle'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_subtitle_alignment',
            array(
                'label'   => esc_html__( 'Text Alignment', 'nova-elements' ),
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
                    '{{WRAPPER}} ' . $css_scheme['subtitle'] => 'text-align: {{VALUE}};',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_subtitle_container_alignment',
            array(
                'label'   => esc_html__( 'Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'flex-start',
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
                    '{{WRAPPER}} ' . $css_scheme['subtitle'] => 'align-self: {{VALUE}};',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_subtitle_wax_width',
            array(
                'label' => esc_html__( 'Max Width', 'nova-elements' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => array( 'px', '%' ),
                'range' => array(
                    '%' => array(
                        'min' => 20,
                        'max' => 100,
                    ),
                    'px' => array(
                        'min' => 300,
                        'max' => 1000,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['subtitle'] => 'max-width: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();

        /**
         * Desc Style Section
         */
        $this->start_controls_section(
            'section_slider_desc_style',
            array(
                'label'      => esc_html__( 'Description', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'slider_desc_color',
            array(
                'label'  => esc_html__( 'Description Color', 'nova-elements' ),
                'type'   => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['desc'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'slider_desc_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} ' . $css_scheme['desc'],
            )
        );

        $this->add_responsive_control(
            'slider_desc_padding',
            array(
                'label'      => __( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['desc'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_desc_margin',
            array(
                'label'      => __( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['desc'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_desc_alignment',
            array(
                'label'   => esc_html__( 'Text Alignment', 'nova-elements' ),
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
                    '{{WRAPPER}} ' . $css_scheme['desc'] => 'text-align: {{VALUE}};',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_desc_container_alignment',
            array(
                'label'   => esc_html__( 'Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'flex-start',
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
                    '{{WRAPPER}} ' . $css_scheme['desc'] => 'align-self: {{VALUE}};',
                ),
            )
        );

        $this->add_responsive_control(
            'slider_desc_wax_width',
            array(
                'label' => esc_html__( 'Max Width', 'nova-elements' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => array( 'px', '%' ),
                'range' => array(
                    '%' => array(
                        'min' => 20,
                        'max' => 100,
                    ),
                    'px' => array(
                        'min' => 300,
                        'max' => 1000,
                    ),
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['desc'] => 'max-width: {{SIZE}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();

        /**
         * Action Button #1 Style Section
         */
        $this->start_controls_section(
            'section_action_button_style',
            array(
                'label'      => esc_html__( 'Button', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_responsive_control(
            'slider_action_button_alignment',
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
                    '{{WRAPPER}} ' . $css_scheme['buttons_wrapper'] => 'text-align: {{VALUE}};',
										'{{WRAPPER}} ' . $css_scheme['buttons_wrapper2'] => 'text-align: {{VALUE}};',
                ),
            )
        );

        $this->add_control(
            'section_action_primary_button_heading',
            array(
                'label'     => esc_html__( 'Primary Button', 'nova-elements' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->start_controls_tabs( 'tabs_primary_button_style' );

        $this->start_controls_tab(
            'tab_primary_button_normal',
            array(
                'label' => esc_html__( 'Normal', 'nova-elements' ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'primary_button_bg_color',
                'selector' => '{{WRAPPER}} ' . $css_scheme['primary_button'],
            )
        );

        $this->add_control(
            'primary_button_color',
            array(
                'label'     => esc_html__( 'Text Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['primary_button'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'primary_button_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}}  ' . $css_scheme['primary_button'],
            )
        );

        $this->add_responsive_control(
            'primary_button_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['primary_button'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'primary_button_margin',
            array(
                'label'      => __( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['primary_button'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'primary_button_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['primary_button'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'primary_button_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['primary_button'],
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'primary_button_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['primary_button'],
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_primary_button_hover',
            array(
                'label' => esc_html__( 'Hover', 'nova-elements' ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'primary_button_hover_bg_color',
                'selector' => '{{WRAPPER}} ' . $css_scheme['primary_button'] . ':hover',
            )
        );

        $this->add_control(
            'primary_button_hover_color',
            array(
                'label'     => esc_html__( 'Text Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['primary_button'] . ':hover' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'primary_button_hover_typography',
                'selector' => '{{WRAPPER}}  ' . $css_scheme['primary_button'] . ':hover',
            )
        );

        $this->add_responsive_control(
            'primary_button_hover_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['primary_button'] . ':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'primary_button_hover_margin',
            array(
                'label'      => __( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['primary_button'] . ':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'primary_button_hover_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['primary_button'] . ':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'primary_button_hover_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['primary_button'] . ':hover',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'primary_button_hover_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['primary_button'] . ':hover',
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_control(
            'section_action_secondary_button_heading',
            array(
                'label'     => esc_html__( 'Secondary Button', 'nova-elements' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            )
        );

        $this->start_controls_tabs( 'tabs_secondary_button_style' );

        $this->start_controls_tab(
            'tab_secondary_button_normal',
            array(
                'label' => esc_html__( 'Normal', 'nova-elements' ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'secondary_button_bg_color',
                'selector' => '{{WRAPPER}} ' . $css_scheme['secondary_button'],
            )
        );

        $this->add_control(
            'secondary_button_color',
            array(
                'label'     => esc_html__( 'Text Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['secondary_button'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'secondary_button_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}}  ' . $css_scheme['secondary_button'],
            )
        );

        $this->add_responsive_control(
            'secondary_button_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['secondary_button'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'secondary_button_margin',
            array(
                'label'      => __( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['secondary_button'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'secondary_button_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['secondary_button'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'secondary_button_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['secondary_button'],
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'secondary_button_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['secondary_button'],
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_secondary_button_hover',
            array(
                'label' => esc_html__( 'Hover', 'nova-elements' ),
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'secondary_button_hover_bg_color',
                'selector' => '{{WRAPPER}} ' . $css_scheme['secondary_button'] . ':hover',
            )
        );

        $this->add_control(
            'secondary_button_hover_color',
            array(
                'label'     => esc_html__( 'Text Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['secondary_button'] . ':hover' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'secondary_button_hover_typography',
                'selector' => '{{WRAPPER}}  ' . $css_scheme['secondary_button'] . ':hover',
            )
        );

        $this->add_responsive_control(
            'secondary_button_hover_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['secondary_button'] . ':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'secondary_button_hover_margin',
            array(
                'label'      => __( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['secondary_button'] . ':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'secondary_button_hover_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['secondary_button'] . ':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'secondary_button_hover_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['secondary_button'] . ':hover',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'secondary_button_hover_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['secondary_button'] . ':hover',
            )
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    /**
     * Generate setting json
     *
     * @return string
     */
    public function generate_setting_json() {
        $module_settings = $this->get_settings();

        $settings = array(
            'sliderWidth'           => $module_settings['slider_width'],
            'sliderHeight'          => $module_settings['slider_height'],
            'sliderHeightLaptop'    => $module_settings['slider_height_laptop'],
            'sliderHeightTablet'    => $module_settings['slider_height_tablet'],
            'sliderHeight800'       => $module_settings['slider_height_width800'],
            'sliderHeight640'       => $module_settings['slider_height_width640'],
            'sliderHeightMobile'    => $module_settings['slider_height_mobile'],
            'rightToLeft'           => is_rtl(),
        );

        $settings = json_encode( $settings );

        return sprintf( 'data-settings=\'%1$s\'', $settings );
    }

    /**
     * [__loop_button_item description]
     * @param  array  $keys   [description]
     * @param  string $format [description]
     * @return [type]         [description]
     */
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

    /**
     * [__loop_item_image_src description]
     * @return [type] [description]
     */
    protected function __loop_item_image_src( ) {
        $item = $this->__processed_item;
        $image = $item['item_image'];

        if ( empty( $image['id'] ) ) {
            return Utils::get_placeholder_image_src();
        }

        $slider_image_size = $this->get_settings_for_display( 'slider_image_size' );

        $slider_image_size = ! empty( $slider_image_size ) ? $slider_image_size : 'full';

        return wp_get_attachment_image_url( $image['id'], $slider_image_size, false );
    }

    /**
     * [render description]
     * @return [type] [description]
     */
    protected function render() {

        $this->__context = 'render';

        $this->__open_wrap();
        include $this->__get_global_template( 'index' );
        $this->__close_wrap();
    }

    protected function _content_template() {}

}
