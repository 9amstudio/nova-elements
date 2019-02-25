<?php
namespace Nova_Elements\Modules\ParallaxSection;


use Nova_Elements\Base\Module_Base;

use Elementor\Controls_Manager;
use Elementor\Repeater;

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

class Module extends Module_Base {

    public $parallax_sections = array();

    public function __construct() {
        $this->add_actions();
    }

    public function get_name() {
        return 'parallax-section';
    }

    /**
     * After section_layout callback
     *
     * @param  object $obj
     * @param  array $args
     * @return void
     */
    public function after_section_end( $obj, $args ){
        $obj->start_controls_section(
            'section_parallax',
            array(
                'label' => esc_html__( 'Nova Parallax', 'nova-elements' ),
                'tab'   => Controls_Manager::TAB_LAYOUT,
            )
        );

        $obj->add_control(
            'nova_parallax_items_heading',
            array(
                'label'     => esc_html__( 'Layouts', 'nova-elements' ),
                'type'      => Controls_Manager::HEADING,
            )
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'nova_parallax_layout_image',
            array(
                'label'   => esc_html__( 'Image', 'nova-elements' ),
                'type'    => Controls_Manager::MEDIA,
            )
        );

        $repeater->add_control(
            'nova_parallax_layout_speed',
            array(
                'label'      => esc_html__( 'Parallax Speed(%)', 'nova-elements' ),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => array( '%' ),
                'range'      => array(
                    '%' => array(
                        'min'  => 1,
                        'max'  => 100,
                    ),
                ),
                'default' => array(
                    'size' => 50,
                    'unit' => '%',
                ),
            )
        );

        $repeater->add_control(
            'nova_parallax_layout_type',
            array(
                'label'   => esc_html__( 'Parallax Type', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'scroll',
                'options' => array(
                    'none'   => esc_html__( 'None', 'nova-elements' ),
                    'scroll' => esc_html__( 'Scroll', 'nova-elements' ),
                    'mouse'  => esc_html__( 'Mouse Move', 'nova-elements' ),
                    'zoom'   => esc_html__( 'Scrolling Zoom', 'nova-elements' ),
                ),
            )
        );

        $repeater->add_control(
            'nova_parallax_layout_z_index',
            array(
                'label'    => esc_html__( 'z-Index', 'nova-elements' ),
                'type'     => Controls_Manager::NUMBER,
                'min'      => 0,
                'max'      => 99,
                'step'     => 1,
            )
        );

        $repeater->add_control(
            'nova_parallax_layout_bg_x',
            array(
                'label'   => esc_html__( 'Background X Position(%)', 'nova-elements' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 50,
                'min'     => -200,
                'max'     => 200,
                'step'    => 1,
            )
        );

        $repeater->add_control(
            'nova_parallax_layout_bg_y',
            array(
                'label'   => esc_html__( 'Background Y Position(%)', 'nova-elements' ),
                'type'    => Controls_Manager::NUMBER,
                'default' => 50,
                'min'     => -200,
                'max'     => 200,
                'step'    => 1,
            )
        );

        $repeater->add_control(
            'nova_parallax_layout_bg_size',
            array(
                'label'   => esc_html__( 'Background Size', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'auto',
                'options' => array(
                    'auto'    => esc_html__( 'Auto', 'nova-elements' ),
                    'cover'   => esc_html__( 'Cover', 'nova-elements' ),
                    'contain' => esc_html__( 'Contain', 'nova-elements' ),
                ),
            )
        );

        $repeater->add_control(
            'nova_parallax_layout_animation_prop',
            array(
                'label'   => esc_html__( 'Animation Property', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'transform',
                'options' => array(
                    'bgposition'  => esc_html__( 'Background Position', 'nova-elements' ),
                    'transform'   => esc_html__( 'Transform', 'nova-elements' ),
                    'transform3d' => esc_html__( 'Transform 3D', 'nova-elements' ),
                ),
            )
        );

        $repeater->add_control(
            'nova_parallax_layout_on',
            array(
                'label'       => __( 'Enable On Device', 'nova-elements' ),
                'type'        => Controls_Manager::SELECT2,
                'multiple'    => true,
                'label_block' => 'true',
                'default'     => array(
                    'desktop',
                    'tablet',
                ),
                'options'     => array(
                    'desktop' => __( 'Desktop', 'nova-elements' ),
                    'tablet'  => __( 'Tablet', 'nova-elements' ),
                    'mobile'  => __( 'Mobile', 'nova-elements' ),
                ),
            )
        );

        $repeater->add_control(
            'nova_parallax_layout_css_class',
            array(
                'label'    => esc_html__( 'CSS Class', 'nova-elements' ),
                'type'     => Controls_Manager::TEXT
            )
        );

        $obj->add_control(
            'nova_parallax_layout_list',
            array(
                'type'    => Controls_Manager::REPEATER,
                'fields'  => array_values( $repeater->get_controls() ),
                'default' => array(
                    array(
                        'nova_parallax_layout_image' => array(
                            'url' => '',
                        ),
                    )
                ),
            )
        );

        $obj->end_controls_section();
    }

    /**
     * After column/layout callback
     *
     * @param  object $obj
     * @param  array $args
     * @return void
     */
    public function after_column_end( $obj, $args ) {


        $obj->start_controls_section(
            'nova_section_column_align',
            array(
                'label' => esc_html__( 'Nova Extra Settings', 'nova-elements' ),
                'tab'   => Controls_Manager::TAB_LAYOUT,
            )
        );

        $obj->add_responsive_control(
            '_inline_maxwidth',
            [
                'label' => __( 'Column Max Width', 'elementor' ) . ' (px)',
                'type' => Controls_Manager::NUMBER,
                'min' => 50,
                'max' => 2000,
                'selectors' => [
                    '{{WRAPPER}}.elementor-column .elementor-column-wrap' => 'width: {{VALUE}}px; max-width: 100%;',
                ]
            ]
        );

        $obj->add_responsive_control(
            'nova_column_align',
            [
                'label' => __( 'Column Alignment', 'nova-elements' ),
                'type' => Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => __( 'Default', 'nova-elements' ),
                    'left' => __( 'Left', 'nova-elements' ),
                    'right' => __( 'Right', 'nova-elements' ),
                    'center' => __( 'Center', 'nova-elements' ),
                ],
                'selectors_dictionary' => [
                    'left' => '-right',
                    'right' => '-left',
                    'center' => ' '
                ],
                'selectors' => [
                    '{{WRAPPER}}.elementor-column .elementor-column-wrap' => 'margin{{VALUE}}: auto'
                ]
            ]
        );

        $obj->end_controls_section();

        $obj->start_controls_section(
            'nova_section_column_responsive',
            array(
                'label' => esc_html__( 'Responsive', 'nova-elements' ),
                'tab'   => Controls_Manager::TAB_LAYOUT,
            )
        );

        $obj->add_control(
            'raw_column_responsive',
            array(
                'type' => Controls_Manager::RAW_HTML,
                'raw'  => esc_html__( 'Attention: The display settings (show/hide for mobile, tablet or desktop) will only take effect once you are on the preview or live page, and not while you\'re in editing mode in Elementor.', 'nova-elements' )
            )
        );

        $obj->add_control(
            'hide_desktop_column',
            [
                'label' => __( 'Hide On Desktop', 'nova-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'prefix_class' => 'elementor-',
                'label_on' => __( 'Hide', 'nova-elements' ),
                'label_off' => __( 'Show', 'nova-elements' ),
                'return_value' => 'hidden-desktop',
            ]
        );

        $obj->add_control(
            'hide_tablet_landscape_column',
            [
                'label' => __( 'Hide On Tablet Landscape', 'nova-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'prefix_class' => 'elementor-',
                'label_on' => __( 'Hide', 'nova-elements' ),
                'label_off' => __( 'Show', 'nova-elements' ),
                'return_value' => 'hidden-tablet-landscape',
            ]
        );

        $obj->add_control(
            'hide_tablet_portrait_column',
            [
                'label' => __( 'Hide On Tablet Portrait', 'nova-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'prefix_class' => 'elementor-',
                'label_on' => __( 'Hide', 'nova-elements' ),
                'label_off' => __( 'Show', 'nova-elements' ),
                'return_value' => 'hidden-tablet-portrait',
            ]
        );

        $obj->add_control(
            'hide_mobile_landscape_column',
            [
                'label' => __( 'Hide On Mobile Landscape', 'nova-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'prefix_class' => 'elementor-',
                'label_on' => __( 'Hide', 'nova-elements' ),
                'label_off' => __( 'Show', 'nova-elements' ),
                'return_value' => 'hidden-phone-landscape',
            ]
        );

        $obj->add_control(
            'hide_mobile_portrait_column',
            [
                'label' => __( 'Hide On Mobile Portrait', 'nova-elements' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => '',
                'prefix_class' => 'elementor-',
                'label_on' => __( 'Hide', 'nova-elements' ),
                'label_off' => __( 'Show', 'nova-elements' ),
                'return_value' => 'hidden-phone-portrait',
            ]
        );

        $obj->end_controls_section();
    }

    /**
     * Elementor before section render callback
     *
     * @param  object $obj
     * @return void
     */
    public function section_before_render( $obj ) {
        $data     = $obj->get_data();
        $type     = isset( $data['elType'] ) ? $data['elType'] : 'section';
        $settings = $data['settings'];

        if ( 'section' === $type || 'column' === $type ) {
            if ( isset( $settings['nova_parallax_layout_list'] ) ) {

                $new_settings = array();
                foreach ($settings['nova_parallax_layout_list'] as $k => $setting){
                    if(!empty($setting['nova_parallax_layout_image']) && !empty($setting['nova_parallax_layout_image']['url'])){
                        $new_settings[$k] = $setting;
                    }
                }
                if(!empty($new_settings)){
                    $this->parallax_sections[ $data['id'] ] = $new_settings;
                }
            }
        }
    }

    public function localize_settings( $settings ) {
        $settings = array_replace_recursive( $settings, [
            'novaParallaxSections' => $this->parallax_sections
        ] );

        return $settings;
    }

    /**
     * [enqueue_scripts description]
     *
     * @return void
     */
    public function enqueue_scripts() {
        if(!empty($this->parallax_sections) || \Elementor\Plugin::$instance->preview->is_preview_mode() ){
            wp_enqueue_script('nova-ease-pack');
            wp_enqueue_script('nova-tween-max');
            wp_enqueue_script('nova-elements');
        }
    }

    protected function add_actions() {

        add_action( 'elementor/element/section/section_layout/after_section_end', [ $this, 'after_section_end' ], 10, 2 );
        add_action( 'elementor/element/column/layout/after_section_end', [ $this, 'after_column_end' ], 10, 2 );

        add_action( 'elementor/frontend/section/before_render', [ $this, 'section_before_render' ] );

        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'enqueue_scripts' ], 0 );
        add_filter('nova-elements/frontend/localize-data', [ $this, 'localize_settings' ] );
    }
}
