<?php
namespace Nova_Elements\Modules\Woocommerce\Widgets;

use Elementor\Controls_Manager;
use Elementor\Repeater;
use Nova_Elements\Modules\QueryControl\Controls\Group_Control_Posts;
use Nova_Elements\Modules\QueryControl\Module;
use Nova_Elements\Modules\Woocommerce\Classes\Products_Renderer;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Products extends Products_Base {

    public function get_ajax_object_type(){
        return 'product';
    }

	public function get_name() {
		return 'nova-products';
	}

	public function get_title() {
		return esc_html__( 'Nova Products', 'nova-elements' );
	}

	public function get_icon() {
		return 'eicon-products';
	}

	public function get_keywords() {
		return [ 'woocommerce', 'shop', 'store', 'product', 'archive' ];
	}

    public function get_script_depends() {
        return [
            'nova-elements'
        ];
    }

	public function on_export( $element ) {
		$element = Group_Control_Posts::on_export_remove_setting_from_element( $element, 'nova_query' );

		return $element;
	}

	protected function register_query_controls() {
		$this->start_controls_section(
			'section_query',
			[
				'label' => esc_html__( 'Query', 'nova-elements' ),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_group_control(
			Group_Control_Posts::get_type(),
			[
				'name' => 'query',
				'post_type' => 'product',
				'fields_options' => [
					'post_type' => [
						'default' => 'product',
						'options' => [
							'current_query' => esc_html__( 'Current Query', 'nova-elements' ),
							'product' => esc_html__( 'Latest Products', 'nova-elements' ),
							'sale' => esc_html__( 'Sale', 'nova-elements' ),
							'featured' => esc_html__( 'Featured', 'nova-elements' ),
							'by_id' => _x( 'Manual Selection', 'Posts Query Control', 'nova-elements' ),
						],
					],
					'product_cat_ids' => [
						'condition' => [
							'query_post_type!' => [
								'current_query',
								'by_id',
							],
						],
					],
					'product_tag_ids' => [
						'condition' => [
							'query_post_type!' => [
								'current_query',
								'by_id',
							],
						],
					],
				],
				'exclude' => [
					'authors',
				],
			]
		);

		$this->add_control(
			'advanced',
			[
				'label' => esc_html__( 'Advanced', 'nova-elements' ),
				'type' => Controls_Manager::HEADING,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => esc_html__( 'Order by', 'nova-elements' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => esc_html__( 'Date', 'nova-elements' ),
					'title' => esc_html__( 'Title', 'nova-elements' ),
					'price' => esc_html__( 'Price', 'nova-elements' ),
					'popularity' => esc_html__( 'Popularity', 'nova-elements' ),
					'rating' => esc_html__( 'Rating', 'nova-elements' ),
					'rand' => esc_html__( 'Random', 'nova-elements' ),
					'menu_order' => esc_html__( 'Menu Order', 'nova-elements' ),
				],
				'condition' => [
					'query_post_type!' => 'current_query',
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => esc_html__( 'Order', 'nova-elements' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'desc',
				'options' => [
					'asc' => esc_html__( 'ASC', 'nova-elements' ),
					'desc' => esc_html__( 'DESC', 'nova-elements' ),
				],
				'condition' => [
					'query_post_type!' => 'current_query',
				],
			]
		);

		Module::add_exclude_controls( $this );

		$this->end_controls_section();
	}

	protected function _register_controls() {

        $grid_style = apply_filters(
            'nova-elements/products/control/grid_style',
            array(
                '1' => esc_html__( 'Type-1', 'nova-elements' ),
                '2' => esc_html__( 'Type-2', 'nova-elements' )
            )
        );
        $masonry_style = apply_filters(
            'nova-elements/products/control/masonry_style',
            array(
                '1' => esc_html__( 'Type-1', 'nova-elements' ),
                '2' => esc_html__( 'Type-2', 'nova-elements' )
            )
        );
        $list_style = apply_filters(
            'nova-elements/products/control/list_style',
            array(
                '1' => esc_html__( 'Type-1', 'nova-elements' ),
                '2' => esc_html__( 'Type-2', 'nova-elements' )
            )
        );

		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__( 'Content', 'nova-elements' ),
			]
		);

        $this->add_control(
            'layout',
            array(
                'label'     => esc_html__( 'Layout', 'nova-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => 'grid',
                'render_type' => 'template',
                'options'   => [
                    'grid'      => esc_html__( 'Grid', 'plugin-domain' ),
                    'masonry'   => esc_html__( 'Masonry', 'plugin-domain' ),
                ]
            )
        );

        $this->add_control(
            'grid_style',
            array(
                'label'     => esc_html__( 'Style', 'nova-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '1',
                'options'   => $grid_style,
                'render_type' => 'template',
                'condition' => [
                    'layout' => 'grid'
                ]
            )
        );

        $this->add_control(
            'masonry_style',
            array(
                'label'     => esc_html__( 'Style', 'nova-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '1',
                'options'   => $masonry_style,
                'render_type' => 'template',
                'condition' => [
                    'layout' => 'masonry'
                ]
            )
        );

        $this->add_control(
            'list_style',
            array(
                'label'     => esc_html__( 'Style', 'nova-elements' ),
                'type'      => Controls_Manager::SELECT,
                'default'   => '1',
                'options'   => $list_style,
                'render_type' => 'template',
                'condition' => [
                    'layout' => 'list'
                ]
            )
        );

		$this->add_responsive_control(
			'columns',
			[
				'label' => esc_html__( 'Columns', 'nova-elements' ),
				'type' => Controls_Manager::NUMBER,
				'min' => 1,
				'max' => 10,
				'default' => 4,
                'render_type' => 'template',
                'condition' => [
                    'layout!' => 'list'
                ]
			]
		);

		$this->add_control(
			'limit',
			[
                'label' => esc_html__( 'Limit', 'nova-elements' ),
                'type' => Controls_Manager::NUMBER,
                'min' => -1,
                'max' => 100,
                'default' => -1,
                'render_type' => 'template'
			]
		);

		$this->end_controls_section();

		$this->register_query_controls();

		$this->_register_carousel_controls(
		    [
		        'layout' => 'grid'
            ]
        );

		parent::_register_controls();

		$this->_register_carousel_arrows_dots_style();

		$this->_register_masonry_custom_layout();
	}

	protected function _register_masonry_custom_layout(){

        $repeater = new Repeater();

        $repeater->add_control(
            'item_width',
            array(
                'label'   => esc_html__( 'Item Width', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => array(
                    '1' => '1 width',
                    '2' => '2 width',
                    '0-5' => '1/2 width'
                ),
                'dynamic' => array( 'active' => true )
            )
        );

        $repeater->add_control(
            'item_height',
            array(
                'label'   => esc_html__( 'Item Height', 'nova-elements' ),
                'type'    => Controls_Manager::SELECT,
                'default' => '1',
                'options' => array(
                    '1' => '1 height',
                    '2' => '2 height',
                    '0-5' => '1/2 height',
                    '0-75' => '3/4 height'
                ),
                'dynamic' => array( 'active' => true )
            )
        );

        $repeater->add_control(
            'item_title',
            array(
                'label'   => esc_html__( 'Title', 'nova-elements' ),
                'type'    => Controls_Manager::TEXT,
                'dynamic' => array( 'active' => true )
            )
        );

        $this->start_controls_section(
            'section_masonry',
            array(
                'label' => esc_html__( 'Masonry Setting', 'nova-elements' ),
                'condition' => [
                    'layout' => 'masonry'
                ]
            )
        );

        $this->add_control(
            'enable_custom_masonry_layout',
            array(
                'label'        => esc_html__( 'Enable Custom Masonry Layout', 'nova-elements' ),
                'type'         => Controls_Manager::SWITCHER,
                'label_on'     => esc_html__( 'Yes', 'nova-elements' ),
                'label_off'    => esc_html__( 'No', 'nova-elements' ),
                'return_value' => 'true',
                'default'      => '',
                'condition' => array(
                    'layout' => 'masonry'
                )
            )
        );

        $this->add_control(
            'masonry_container_width',
            array(
                'label' => esc_html__( 'Container Width', 'nova-elements' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 500,
                        'max' => 2000,
                    ),
                ),
                'default' => [
                    'size' => 1170,
                ],
                'condition' => array(
                    'layout' => 'masonry',
                    'enable_custom_masonry_layout' => 'true'
                )
            )
        );

        $this->add_control(
            'masonry_item_base_width',
            array(
                'label' => esc_html__( 'Masonry Item Width', 'nova-elements' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 100,
                        'max' => 2000,
                    ),
                ),
                'default' => [
                    'size' => 300,
                ],
                'condition' => array(
                    'layout' => 'masonry',
                    'enable_custom_masonry_layout' => 'true'
                )
            )
        );

        $this->add_control(
            'masonry_item_base_height',
            array(
                'label' => esc_html__( 'Masonry Item Height', 'nova-elements' ),
                'type'  => Controls_Manager::SLIDER,
                'range' => array(
                    'px' => array(
                        'min' => 100,
                        'max' => 2000,
                    ),
                ),
                'default' => [
                    'size' => 300,
                ],
                'condition' => array(
                    'layout' => 'masonry',
                    'enable_custom_masonry_layout' => 'true'
                )
            )
        );

        $this->add_control(
            'masonry_item_sizes',
            array(
                'type'        => Controls_Manager::REPEATER,
                'fields'      => array_values( $repeater->get_controls() ),
                'default'     => array(
                    array(
                        'item_title'  => esc_html__( 'Size 1x1', 'nova-elements' ),
                        'item_width'  => 1,
                        'item_height'  => 1
                    ),
                    array(
                        'item_title'  => esc_html__( 'Size 2x2', 'nova-elements' ),
                        'item_width'  => 2,
                        'item_height'  => 2
                    ),
                    array(
                        'item_title'  => esc_html__( 'Size 1x1', 'nova-elements' ),
                        'item_width'  => 1,
                        'item_height'  => 1
                    ),
                    array(
                        'item_title'  => esc_html__( 'Size 1x1', 'nova-elements' ),
                        'item_width'  => 1,
                        'item_height'  => 1
                    )
                ),
                'title_field' => '{{{ item_title }}}',
                'condition' => array(
                    'layout' => 'masonry',
                    'enable_custom_masonry_layout' => 'true'
                )
            )
        );

        $this->end_controls_section();

    }

	protected function render() {

		if ( WC()->session ) {
			wc_print_notices();
		}

		// For Products_Renderer.
		if ( ! isset( $GLOBALS['post'] ) ) {
			$GLOBALS['post'] = null; // WPCS: override ok.
		}

		$settings = $this->get_settings();

        $settings['carousel_setting'] = $this->_generate_carousel_setting_json();
        $settings['unique_id'] = $this->get_id();

		$shortcode = new Products_Renderer( $settings, 'products' );

		$content = $shortcode->get_content();

		if ( $content ) {
			echo $content;
		}
		elseif ( $this->get_settings( 'nothing_found_message' ) ) {
			echo '<div class="elementor-nothing-found elementor-products-nothing-found">' . esc_html( $this->get_settings( 'nothing_found_message' ) ) . '</div>';
		}
	}

	public function render_plain_content() {}
}
