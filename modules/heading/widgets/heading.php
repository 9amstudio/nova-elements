<?php
namespace Nova_Elements\Modules\Heading\Widgets;

use Nova_Elements\Base\Nova_Widget;

// Elementor Classes
use Elementor\Controls_Manager;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Headline Widget
 */
class Heading extends Nova_Widget {

    public function get_name() {
        return 'nova-heading';
    }

    protected function get_widget_title() {
        return esc_html__( 'Heading', 'nova-elements' );
    }

		public function is_reload_preview_required() {
				return true;
		}

    public function get_icon() {
        return 'eicon-heading';
    }

    protected function _register_controls() {

        $css_scheme = apply_filters(
            'nova-elements/headline/css-scheme',
            array(
                'heading_box'    => '.nova-heading',
                'heading_title'  => '.nova-heading__title',
                'heading_subtitle' => '.nova-heading__sub-title',
							)
        );
				$preset_type = apply_filters(
						'nova-elements/heading/control/preset',
						array(
								'type-1' => esc_html__( 'Type-1', 'nova-elements' ),
								'type-2' => esc_html__( 'Type-2', 'nova-elements' ),
						)
				);

        $this->start_controls_section(
            'section_title',
            array(
                'label' => esc_html__( 'Title', 'nova-elements' ),
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
            'heading_title',
            array(
                'label'       => esc_html__( 'Title', 'nova-elements' ),
                'type'        => Controls_Manager::TEXT,
                'placeholder' => esc_html__( 'Enter  heading title', 'nova-elements' ),
                'default'     => esc_html__( 'Your Title', 'nova-elements' ),
                'dynamic'     => array( 'active' => true ),
            )
        );

        $this->add_control(
            'heading_subtitle',
            array(
                'label'       => esc_html__( 'Sub Title', 'nova-elements' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => esc_html__( 'Enter heading sub title', 'nova-elements' ),
                'dynamic'     => array( 'active' => true ),
            )
        );

        $this->add_control(
            'header_size',
            array(
                'label'   => esc_html__( 'HTML Tag', 'nova-elements' ),
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
                'default' => 'h2',
            )
        );

        $this->end_controls_section();

        /**
         * General Style Section
         */
        $this->start_controls_section(
            'section_general_style',
            array(
                'label'      => esc_html__( 'General', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'instance_alignment_horizontal',
            array(
                'label'   => esc_html__( 'Alignment', 'nova-elements' ),
                'type'    => Controls_Manager::CHOOSE,
                'default' => 'center',
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
                    '{{WRAPPER}} '. $css_scheme['heading_box'] => 'text-align: {{VALUE}};',
                ),
            )
        );

				$this->add_control(
						'content_width',
						array(
								'label' => esc_html__( 'Content Width(px)', 'nova-elements' ),
								'type'  => Controls_Manager::SLIDER,
								'range' => array(
										'px' => array(
												'min' => 300,
												'max' => 1280,
										),
								),
								'default' => array(
										'unit' => 'px',
										'size' => 750,
								),
								'selectors'  => array(
										'{{WRAPPER}} ' . $css_scheme['heading_box'] . ' .nova-heading__inner' => 'max-width: {{SIZE}}{{UNIT}};',
								),
						)
				);
        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'instance_background',
                'selector' => '{{WRAPPER}} ' . $css_scheme['heading_box'],
            )
        );

        $this->add_responsive_control(
            'instance_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%', 'em' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['heading_box'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'instance_margin',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['heading_box'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'instance_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'  => '{{WRAPPER}} ' . $css_scheme['heading_box'],
            )
        );

        $this->add_responsive_control(
            'instance_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['heading_box'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();

        /**
         * Heading Title Style Section
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
                'label'  => esc_html__( 'Text Color', 'nova-elements' ),
                'type'   => Controls_Manager::COLOR,
                'scheme' => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_2,
                ),
                'selectors' => array(
                    '{{WRAPPER}} ' . $css_scheme['heading_title'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'title_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_1,
                'selector' => '{{WRAPPER}} ' . $css_scheme['heading_title'],
            )
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            array(
                'name'     => 'title_text_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['heading_title'],
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'title_background',
                'selector' => '{{WRAPPER}} ' . $css_scheme['heading_title'],
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'title_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['heading_title'],
                'separator'   => 'before',
            )
        );

        $this->add_responsive_control(
            'title_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['heading_title'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'title_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['heading_title'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'title_margin',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['heading_title'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();

        /**
         * Heading Sub Title Style Section
         */
        $this->start_controls_section(
            'section_sub_title_style',
            array(
                'label'      => esc_html__( 'Sub Title', 'nova-elements' ),
                'tab'        => Controls_Manager::TAB_STYLE,
                'show_label' => false,
            )
        );

        $this->add_control(
            'sub_title_color',
            array(
                'label'  => esc_html__( 'Text Color', 'nova-elements' ),
                'type'   => Controls_Manager::COLOR,
                'scheme' => array(
                    'type'  => Scheme_Color::get_type(),
                    'value' => Scheme_Color::COLOR_1,
                ),
                'selectors' => array(
										'{{WRAPPER}} ' . $css_scheme['heading_title'].' span' => 'color: {{VALUE}}',
                    '{{WRAPPER}} ' . $css_scheme['heading_subtitle'] => 'color: {{VALUE}}',
                ),
            )
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            array(
                'name'     => 'sub_title_typography',
                'scheme'   => Scheme_Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} ' . $css_scheme['heading_subtitle'],
            )
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            array(
                'name'     => 'sub_title_text_shadow',
                'selector' => '{{WRAPPER}} ' . $css_scheme['heading_subtitle'],
            )
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            array(
                'name'     => 'sub_title_background',
                'selector' => '{{WRAPPER}} ' . $css_scheme['heading_subtitle'],
            )
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            array(
                'name'        => 'sub_title_border',
                'label'       => esc_html__( 'Border', 'nova-elements' ),
                'placeholder' => '1px',
                'default'     => '1px',
                'selector'    => '{{WRAPPER}} ' . $css_scheme['heading_subtitle'],
                'separator'   => 'before',
            )
        );

        $this->add_responsive_control(
            'sub_title_border_radius',
            array(
                'label'      => esc_html__( 'Border Radius', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['heading_subtitle'] => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'sub_title_padding',
            array(
                'label'      => esc_html__( 'Padding', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['heading_subtitle'] => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->add_responsive_control(
            'sub_title_margin',
            array(
                'label'      => esc_html__( 'Margin', 'nova-elements' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => array( 'px', '%' ),
                'selectors'  => array(
                    '{{WRAPPER}} ' . $css_scheme['heading_subtitle'] => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ),
            )
        );

        $this->end_controls_section();

    }

    /**
     * [render description]
     * @return [type] [description]
     */
    protected function render() {

        $settings = $this->get_settings_for_display();

        if ( empty( $settings['heading_title'] ) && empty( $settings['heading_subtitle'] ) ) {
            return;
        }

        $heading_title = '';
        $heading_subtitle = '';

        $heading_classes_array = array( 'nova-heading' );
        $heading_classes_array[] = 'preset-' . $settings['preset'];

        $heading_classes = implode( ' ', $heading_classes_array );

        if ( ! empty( $settings['heading_title'] ) ) {

            $title_classes_array = array( 'nova-heading__title');

            $title_classes = implode( ' ', $title_classes_array );

            $heading_title = sprintf( '<%1$s class="%2$s">%3$s</%1$s>', $settings['header_size'],$title_classes, $settings['heading_title']);
        }

        if ( ! empty( $settings['heading_subtitle'] ) ) {
            $subtitle_classes_array = array( 'nova-heading__sub-title');
            $subtitle_classes = implode( ' ', $subtitle_classes_array );
            $heading_subtitle = sprintf( '<p class="%1$s">%2$s</p>', $subtitle_classes, $settings['heading_subtitle'] );
        }

				$inner_classes_array = array( 'nova-heading__inner');
				if ( ! empty( $settings['instance_alignment_horizontal'] ) ) {
					$inner_classes_array[] = 'postion--'.$settings['instance_alignment_horizontal'];
				}
				$inner_classes = implode( ' ', $inner_classes_array );

        $content = sprintf( '%1$s%2$s', $heading_title, $heading_subtitle );

        $title_html = sprintf( '<div class="%1$s"><div class="%2$s">%3$s</div></div>', $heading_classes, $inner_classes, $content );

        echo $title_html;
    }

}
