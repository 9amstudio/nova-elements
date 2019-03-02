<?php
namespace Nova_Elements\Modules\Banner\Widgets;

use Nova_Elements\Base\Nova_Widget;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Box_Shadow;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;
use Elementor\Modules\DynamicTags\Module as TagsModule;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Advanced_Map Widget
 */
class Banner extends Nova_Widget {
    public function get_name() {
        return 'nova-banner';
    }

    protected function get_widget_title() {
        return esc_html__( 'Banner', 'nova-elements' );
    }

    public function get_icon() {
        return 'eicon-image-rollover';
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_content',
            array(
                'label' => esc_html__( 'Content', 'nova-elements' ),
            )
        );

        $this->add_control(
            'banner_image',
            array(
                'label'   => esc_html__( 'Image', 'nova-elements' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => array(
                    'url' => Utils::get_placeholder_image_src(),
                ),
                'dynamic' => array( 'active' => true ),
            )
        );

        $this->add_control(
            'banner_image_size',
            array(
                'type'       => 'select',
                'label'      => esc_html__( 'Image Size', 'nova-elements' ),
                'default'    => 'full',
                'options'    => nova_elements_tools()->get_image_sizes(),
            )
        );

        $this->add_control(
            'banner_title',
            array(
                'label'   => esc_html__( 'Title', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => array( 'active' => true ),
            )
        );

        $this->add_control(
            'banner_title_html_tag',
            array(
                'label'   => esc_html__( 'Title HTML Tag', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'options' => array(
                    'h1'   => esc_html__( 'H1', 'nova-elements' ),
                    'h2'   => esc_html__( 'H2', 'nova-elements' ),
                    'h3'   => esc_html__( 'H3', 'nova-elements' ),
                    'h4'   => esc_html__( 'H4', 'nova-elements' ),
                    'h5'   => esc_html__( 'H5', 'nova-elements' ),
                    'h6'   => esc_html__( 'H6', 'nova-elements' ),
                    'div'  => esc_html__( 'div', 'nova-elements' ),
                    'span' => esc_html__( 'span', 'nova-elements' ),
                    'p'    => esc_html__( 'p', 'nova-elements' ),
                ),
                'default' => 'h5',
            )
        );

        $this->add_control(
            'banner_text',
            array(
                'label'   => esc_html__( 'Description', 'nova-elements' ),
                'type'    => Controls_Manager::TEXTAREA,
                'dynamic' => array( 'active' => true ),
            )
        );

				$this->add_control(
						'banner_button',
						array(
								'label'   => esc_html__( 'Button Title', 'nova-elements' ),
								'type'    => Controls_Manager::TEXT,
								'dynamic' => array( 'active' => true ),
						)
				);

				$this->add_control(
						'button_link',
						array(
								'label'   => esc_html__( 'Button Link', 'nova-elements' ),
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

        $this->add_control(
            'banner_link',
            array(
                'label'   => esc_html__( 'Link', 'nova-elements' ),
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

        $this->add_control(
            'banner_link_target',
            array(
                'label'        => esc_html__( 'Open link in new window', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'return_value' => '_blank',
                'condition'    => array(
                    'banner_link!' => '',
                ),
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
            'animation_effect',
            array(
                'label'   => esc_html__( 'Animation Effect', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => array(
                    'none'   => esc_html__( 'None', 'nova-elements' ),
                ),
            )
        );

        $this->end_controls_section();

        $css_scheme = apply_filters(
            'nova-elements/banner/css-scheme',
            array(
                'banner'         			=> '.nova-banner',
                'banner_content' 			=> '.nova-banner__content',
                'banner_overlay' 			=> '.nova-banner__overlay',
                'banner_title'   			=> '.nova-banner__title',
                'banner_text'   			=> '.nova-banner__text',
                'banner_button_wrap'  => '.nova-banner__btn-wrap',
                'banner_button'  			=> '.nova-banner__button',
            )
        );

        $this->start_controls_section(
            'section_banner_item_style',
            array(
                'label'      => esc_html__( 'General', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

				$this->add_responsive_control(
						'content_h_alignment',
						array(
								'label'   => esc_html__( 'Content Horizontal Alignment', 'nova-elements' ),
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
								'selectors'  => array(
										'{{WRAPPER}} ' . $css_scheme['banner_content'] => 'justify-content: {{VALUE}};',
								),
						)
				);

				$this->add_responsive_control(
						'content_v_alignment',
						array(
								'label'   => esc_html__( 'Content Vertical Alignment', 'nova-elements' ),
								'type'    => Controls_Manager::CHOOSE,
								'default' => 'center',
								'options' => array(
										'flex-start'    => array(
												'title' => esc_html__( 'Top', 'nova-elements' ),
												'icon'  => 'fa fa-arrow-up',
										),
										'center' => array(
												'title' => esc_html__( 'Center', 'nova-elements' ),
												'icon'  => 'fa fa-align-center',
										),
										'flex-end' => array(
												'title' => esc_html__( 'Bottom', 'nova-elements' ),
												'icon'  => 'fa fa-arrow-down',
										),
								),
								'selectors'  => array(
										'{{WRAPPER}} ' . $css_scheme['banner_content'] => 'align-items: {{VALUE}};',
								),
						)
				);

				$this->add_responsive_control(
						'content_margin',
						array(
								'label'      => esc_html__( 'Content Padding', 'nova-elements' ),
								'type'       => Controls_Manager::DIMENSIONS,
								'size_units' => array( 'px', '%' ),
								'selectors'  => array(
										'{{WRAPPER}} ' . $css_scheme['banner_content'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
								),
								'separator'  => 'before',
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

        $this->add_responsive_control(
            'banner_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['banner'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
                'separator'  => 'before',
            )
        );

        $this->add_responsive_control(
            'banner_margin',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['banner'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'banner_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['banner'],
            )
        );

        $this->add_control(
            'banner_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['banner'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'banner_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['banner'],
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_banner_title_style',
            array(
                'label'      => esc_html__( 'Title Typography', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'banner_title_color',
            array(
                'label'     => esc_html__( 'Title Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['banner_title'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'banner_title_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} ' . $css_scheme['banner_title'],
            )
        );

        $this->add_responsive_control(
            'title_margin',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['banner_title'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'title_alignment',
            array(
                'label'   => esc_html__( 'Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => array(
                    'left'    => array(
                        'title' => esc_html__( 'Left', 'nova-elements' ),
                        'icon'  => 'fa fa-arrow-left',
                    ),
                    'center' => array(
                        'title' => esc_html__( 'Center', 'nova-elements' ),
                        'icon'  => 'fa fa-align-center',
                    ),
                    'right' => array(
                        'title' => esc_html__( 'Right', 'nova-elements' ),
                        'icon'  => 'fa fa-arrow-right',
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['banner_title'] => 'text-align: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_banner_text_style',
            array(
                'label'      => esc_html__( 'Description Typography', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'banner_text_color',
            array(
                'label'     => esc_html__( 'Description Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['banner_text'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'banner_text_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} ' . $css_scheme['banner_text'],
            )
        );

        $this->add_responsive_control(
            'text_margin',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['banner_text'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'text_alignment',
            array(
                'label'   => esc_html__( 'Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'center',
                'options' => array(
                    'left'    => array(
                        'title' => esc_html__( 'Left', 'nova-elements' ),
                        'icon'  => 'fa fa-arrow-left',
                    ),
                    'center' => array(
                        'title' => esc_html__( 'Center', 'nova-elements' ),
                        'icon'  => 'fa fa-align-center',
                    ),
                    'right' => array(
                        'title' => esc_html__( 'Right', 'nova-elements' ),
                        'icon'  => 'fa fa-arrow-right',
                    ),
                ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['banner_text'] => 'text-align: {{VALUE}};',
                ),
            )
        );

        $this->end_controls_section();


				/**
				 * Banner Button Section
				 */

				$this->start_controls_section(
						'section_banner_button_style',
						array(
								'label'      => esc_html__( 'Button', 'nova-elements' ),
								'tab'        => Controls_Manager::TAB_STYLE,
								'show_label' => false,
						)
				);
				$this->add_responsive_control(
						'button_alignment',
						array(
								'label'   => esc_html__( 'Button Alignment', 'nova-elements' ),
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
								'selectors'  => array(
										'{{WRAPPER}} ' . $css_scheme['banner_button_wrap'] => 'justify-content: {{VALUE}};',
								),
						)
				);
				$this->add_responsive_control(
						'button_max_width',
						array(
								'label' => esc_html__( 'Button Max Width', 'nova-elements' ),
								'type'  => Controls_Manager::SLIDER,
								'size_units' => array( 'px', '%' ),
								'range' => array(
										'%' => array(
												'min' => 10,
												'max' => 100,
										),
										'px' => array(
												'min' => 100,
												'max' => 500,
										),
								),
								'selectors' => array(
										'{{WRAPPER}} ' . $css_scheme['banner_button'] => 'max-width: {{SIZE}}{{UNIT}};',
								),
						)
				);
        $this->start_controls_tabs( 'tabs_banner_button_style' );

        $this->start_controls_tab(
            'tab_banner_button_normal',
            array(
                'label' => esc_html__( 'Normal', 'nova-elements' ),
            )
        );
				$this->add_group_control(
						Group_Control_Background::get_type(),
						array(
								'name'     => 'button_background',
								'selector' => '{{WRAPPER}} ' . $css_scheme['banner_button'],
						)
				);
        $this->add_control(
            'banner_button_color',
            array(
                'label'     => esc_html__( 'Text Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['banner_button'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'banner_button_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_4,
                'selector' => '{{WRAPPER}}  ' . $css_scheme['banner_button'],
            )
        );

        $this->add_responsive_control(
            'banner_button_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['banner_button'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'banner_button_margin',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['banner_button'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'banner_button_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['banner_button'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'banner_button_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['banner_button'],
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'primary_button_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['banner_button'],
            )
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_banner_button_hover',
            array(
                'label' => esc_html__( 'Hover', 'nova-elements' ),
            )
        );

				$this->add_group_control(
						Group_Control_Background::get_type(),
						array(
								'name'     => 'button_background_hover',
								'selector' => '{{WRAPPER}} ' . $css_scheme['banner_button'] . ':hover',
						)
				);

        $this->add_control(
            'banner_button_hover_color',
            array(
                'label'     => esc_html__( 'Text Color', 'nova-elements' ),
                'type'      => Controls_Manager::COLOR,
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['banner_button'] . ':hover' => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'banner_button_hover_typography',
                'selector' => '{{WRAPPER}}  ' . $css_scheme['banner_button'] . ':hover',
            )
        );

        $this->add_responsive_control(
            'banner_button_hover_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['banner_button'] . ':hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'banner_button_hover_margin',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['banner_button'] . ':hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'banner_button_hover_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['banner_button'] . ':hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'banner_button_hover_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['banner_button'] . ':hover',
            )
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            array(
                'name'     => 'banner_button_hover_box_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['banner_button'] . ':hover',
            )
        );

        $this->end_controls_tab();
				$this->end_controls_section();


        /**
         * Order Style Section
         */

        $this->start_controls_section(
            'section_order_style',
            array(
                'label'      => esc_html__( 'Content Order', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'banner_title_order',
            array(
                'label'   => esc_html__( 'Title Order', 'nova-elements' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 1,
                'min'     => 1,
                'max'     => 3,
                'step'    => 1,
                'selectors' => array(
                    '{{WRAPPER}} '. $css_scheme['banner_title'] => 'order: {{VALUE}};',
                ),
            )
        );


        $this->add_control(
            'banner_text_order',
            array(
                'label'   => esc_html__( 'Description Order', 'nova-elements' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 2,
                'min'     => 1,
                'max'     => 3,
                'step'    => 1,
                'selectors' => array(
                    '{{WRAPPER}} '. $css_scheme['banner_text'] => 'order: {{VALUE}};',
                ),
            )
        );

				$this->add_control(
						'banner_button_order',
						array(
								'label'   => esc_html__( 'Button Order', 'nova-elements' ),
								'type'    => Controls_Manager::NUMBER,
								'default' => 3,
								'min'     => 1,
								'max'     => 3,
								'step'    => 1,
								'selectors' => array(
										'{{WRAPPER}} '. $css_scheme['banner_button_wrap'] => 'order: {{VALUE}};',
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

    public function __get_banner_image() {

        $image = $this->get_settings_for_display( 'banner_image' );

        if ( empty( $image['id'] ) && empty( $image['url'] ) ) {
            return;
        }

        $format = apply_filters( 'nova-elements/banner/image-format', '<img src="%s" alt="" class="nova-banner__img">' );

        if ( empty( $image['id'] ) ) {
            return sprintf( $format, $image['url'] );
        }

        $size = $this->get_settings_for_display( 'banner_image_size' );

        if ( ! $size ) {
            $size = 'full';
        }

        $image_url = wp_get_attachment_image_url( $image['id'], $size );

        return sprintf( $format, $image_url );
    }
}
