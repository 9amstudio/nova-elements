<?php
namespace Nova_Elements;


if ( ! defined( 'ABSPATH' ) ) {	exit; } // Exit if accessed directly

/**
 * Main class plugin
 */
class NovaPlugin {

	/**
	 * @var Plugin
	 */
	private static $_instance;

	/**
	 * @var Manager
	 */
	private $_modules_manager;

	/**
	 * @var array
	 */
	private $_localize_settings = [];


    /**
     * Check if processing elementor widget
     *
     * @var boolean
     */
    private $is_elementor_ajax = false;

	/**
	 * @return string
	 */
	public function get_version() {
		return NOVA_ELEMENTS_VER;
	}

	/**
	 * Throw error on object clone
	 *
	 * The whole idea of the singleton design pattern is that there is a single
	 * object therefore, we don't want the object to be cloned.
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __clone() {
		// Cloning instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, wp_kses_post(__( 'Cheatin&#8217; huh?', 'nova-elements' )), '1.0.0' );
	}

	/**
	 * Disable unserializing of the class
	 *
	 * @since 1.0.0
	 * @return void
	 */
	public function __wakeup() {
		// Unserializing instances of the class is forbidden
		_doing_it_wrong( __FUNCTION__, wp_kses_post(__( 'Cheatin&#8217; huh?', 'nova-elements' )), '1.0.0' );
	}

	/**
	 * @return Plugin
	 */
	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	private function _includes() {
		require NOVA_ELEMENTS_PATH . 'includes/modules-manager.php';
	}

	public function autoload( $class ) {
		if ( 0 !== strpos( $class, __NAMESPACE__ ) ) {
			return;
		}

		$filename = strtolower(
			preg_replace(
				[ '/^' . __NAMESPACE__ . '\\\/', '/([a-z])([A-Z])/', '/_/', '/\\\/' ],
				[ '', '$1-$2', '-', DIRECTORY_SEPARATOR ],
				$class
			)
		);

		$filename = NOVA_ELEMENTS_PATH . $filename . '.php';


		if ( is_readable( $filename ) ) {
			include( $filename );
		}
	}

	public function get_localize_settings() {
		return $this->_localize_settings;
	}

	public function add_localize_settings( $setting_key, $setting_value = null ) {


		if ( is_array( $setting_key ) ) {
			$this->_localize_settings = array_replace_recursive( $this->_localize_settings, $setting_key );

			return;
		}

		if ( ! is_array( $setting_value ) || ! isset( $this->_localize_settings[ $setting_key ] ) || ! is_array( $this->_localize_settings[ $setting_key ] ) ) {
			$this->_localize_settings[ $setting_key ] = $setting_value;

			return;
		}

		$this->_localize_settings[ $setting_key ] = array_replace_recursive( $this->_localize_settings[ $setting_key ], $setting_value );
	}

	public function enqueue_custom_icons(){
        wp_enqueue_style(
            'nova-dlicon',
            NOVA_ELEMENTS_URL . 'assets/css/lib/dlicon/dlicon.css',
            false,
            NOVA_ELEMENTS_VER
        );
				wp_enqueue_style(
            'nova-outline-icon',
            NOVA_ELEMENTS_URL . 'assets/css/lib/nova-outline/css/style.css',
            false,
            NOVA_ELEMENTS_VER
        );
        $asset_font_without_domain = NOVA_ELEMENTS_URL . 'assets/css/lib/dlicon';
        wp_add_inline_style(
            'nova-dlicon',
            "@font-face {
                    font-family: 'dliconoutline';
                    src: url('{$asset_font_without_domain}/dlicon.woff2') format('woff2'),
                         url('{$asset_font_without_domain}/dlicon.woff') format('woff'),
                         url('{$asset_font_without_domain}/dlicon.ttf') format('truetype');
                    font-weight: 400;
                    font-style: normal
                }"
        );
    }

    /**
	 * Enqueue frontend styles
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function enqueue_frontend_styles() {

        wp_enqueue_style(
            'nova-elements',
            NOVA_ELEMENTS_URL . 'assets/css/nova-elements.css' ,
            false,
            NOVA_ELEMENTS_VER
        );

        if ( is_rtl() ) {
            wp_enqueue_style(
                'nova-elements-rtl',
                NOVA_ELEMENTS_URL . 'assets/css/nova-elements-rtl.css' ,
                false,
                NOVA_ELEMENTS_VER
            );
        }

        $default_theme_enabled = apply_filters( 'nova-elements/assets/css/default-theme-enabled', true );

        // Register vendor juxtapose-css styles
        wp_register_style(
            'nova-juxtapose-css',
            NOVA_ELEMENTS_URL . 'assets/css/lib/juxtapose/juxtapose.css' ,
            false,
            '1.3.0'
        );

        if ( ! $default_theme_enabled ) {
            return;
        }

        wp_enqueue_style(
            'nova-elements-skin',
            NOVA_ELEMENTS_URL . 'assets/css/nova-elements-skin.css' ,
            false,
            NOVA_ELEMENTS_VER
        );

	}

    /**
	 * Enqueue frontend scripts
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function enqueue_frontend_scripts() {

        $google_api_key = apply_filters('nova-elements/advanced-map/api', '');

        if ( ! empty( $google_api_key ) && ( empty( $api_disabled ) ) ) {

            wp_register_script(
                'google-maps-api',
                add_query_arg(
                    array( 'key' => $google_api_key ),
                    'https://maps.googleapis.com/maps/api/js'
                ),
                false,
                false,
                true
            );
        }

        // Register vendor masonry.pkgd.min.js script
        wp_register_script(
            'nova-masonry-js',
            NOVA_ELEMENTS_URL . 'assets/js/lib/masonry-js/masonry.pkgd.min.js' ,
            array(),
            '4.2.1',
            true
        );

        wp_register_script(
            'nova-ease-pack',
            NOVA_ELEMENTS_URL . 'assets/js/lib/easing/EasePack.min.js'  ,
            null,
            null,
            true
        );

        wp_register_script(
            'nova-tween-max',
            NOVA_ELEMENTS_URL . 'assets/js/lib/easing/TweenMax.min.js'  ,
            null,
            null,
            true
        );

        // Register vendor anime.js script (https://github.com/juliangarnier/anime)
        wp_register_script(
            'nova-anime-js',
            NOVA_ELEMENTS_URL . 'assets/js/lib/anime-js/anime.min.js' ,
            [],
            '2.2.0',
            true
        );

        // Register vendor salvattore.js script (https://github.com/rnmp/salvattore)
        wp_register_script(
            'nova-salvattore',
            NOVA_ELEMENTS_URL . 'assets/js/lib/salvattore/salvattore.min.js',
            [],
            '1.0.9',
            true
        );

        // Register vendor juxtapose.js script
        wp_register_script(
            'nova-juxtapose',
            NOVA_ELEMENTS_URL . 'assets/js/lib/juxtapose/juxtapose.min.js',
            [],
            '1.3.0',
            true
        );

        // Register vendor tablesorter.js script (https://github.com/Mottie/tablesorter)
        wp_register_script(
            'jquery-tablesorter',
            NOVA_ELEMENTS_URL .'assets/js/lib/tablesorter/jquery.tablesorter.min.js',
            [ 'jquery' ],
            '2.30.7',
            true
        );

        wp_register_script(
            'nova-elements',
            NOVA_ELEMENTS_URL . 'assets/js/nova-elements.js' ,
            [ 'jquery', 'elementor-frontend' ],
            NOVA_ELEMENTS_VER,
            true
        );

	}

	public function enqueue_frontend_localize_script(){
        $this->add_localize_settings('messages', array(
            'invalidMail' => esc_html__( 'Please specify a valid e-mail', 'nova-elements' ),
        ));

        $this->add_localize_settings('ajaxurl', esc_url( admin_url( 'admin-ajax.php' ) ));

        wp_localize_script(
            'nova-elements',
            'novaElements',
            apply_filters( 'nova-elements/frontend/localize-data', $this->get_localize_settings() )
        );
    }

    /**
	 * Enqueue editor styles
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function enqueue_editor_styles() {

	    $this->enqueue_custom_icons();

		wp_enqueue_style(
			'nova-elements-editor',
			NOVA_ELEMENTS_URL . 'assets/css/editor.css',
			[],
			NOVA_ELEMENTS_VER
		);

	}

    /**
	 * Enqueue editor scripts
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function enqueue_editor_scripts() {

        wp_enqueue_script(
            'nova-elements-editor',
            NOVA_ELEMENTS_URL . 'assets/js/nova-elements-editor.js' ,
            ['jquery'],
            NOVA_ELEMENTS_VER,
            true
        );
				wp_localize_script('nova-elements-editor', 'NovaCustomBPFE', [
						'laptop' => [
								'name' => __( 'Laptop', 'nova-elements' ),
								'text' => __( 'Preview for 1366px', 'nova-elements' )
						],
						'width800' => [
								'name' => __( 'Tablet Portrait', 'nova-elements' ),
								'text' => __( 'Preview for 768px', 'nova-elements' )
						],
						'tablet' => [
								'name' => __( 'Tablet Landscape', 'nova-elements' ),
								'text' => __( 'Preview for 1024px', 'nova-elements' )
						]
				]);

	}

	public function enqueue_panel_scripts() {}

	public function enqueue_panel_styles() {
		$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
	}

    public function enqueue_admin_scripts() {
        wp_enqueue_style(
            'nova-elements-admin',
            NOVA_ELEMENTS_URL . 'assets/css/nova-elements-admin.css',
            [],
            NOVA_ELEMENTS_VER
        );
    }

	public function elementor_init() {
		$this->_modules_manager = new Modules_Manager();

		// Add element category in panel
		\Elementor\Plugin::instance()->elements_manager->add_category(
			'nova', // This is the name of your addon's category and will be used to group your widgets/elements in the Edit sidebar pane!
			[
                'title' => esc_html__( 'Nova Elements', 'nova-elements' ),
                'icon'  => 'font'
			],
			1
		);
	}

    /**
     * Rewrite core controls.
     *
     * @param  object $controls_manager Controls manager instance.
     * @return void
     */
    public function rewrite_controls( $controls_manager ) {

        $controls = array(
            $controls_manager::ICON => '\Nova_Elements\Controls\Control_Icon',
        );

        foreach ( $controls as $control_id => $class_name ) {

            $controls_manager->unregister_control( $control_id );
            $controls_manager->register_control( $control_id, new $class_name() );
        }

    }

    /**
     * Add new controls.
     *
     * @param  object $controls_manager Controls manager instance.
     * @return void
     */
    public function add_controls( $controls_manager ) {

        $grouped = array(
            'nova-box-style' => '\Nova_Elements\Controls\Group_Control_Box_Style',
        );

        foreach ( $grouped as $control_id => $class_name ) {
            $controls_manager->add_group_control( $control_id, new $class_name() );
        }

    }

    public function remove_default_image_sizes( $sizes ) {
        if (($key = array_search('medium_large', $sizes)) !== false) {
            unset($sizes[$key]);
        }
        return $sizes;
    }

	protected function add_actions() {
		add_action( 'elementor/init', [ $this, 'elementor_init' ] );

        add_action( 'elementor/controls/controls_registered', [ $this, 'rewrite_controls' ], 10 );
        add_action( 'elementor/controls/controls_registered', [ $this, 'add_controls' ], 10 );


        add_action( 'elementor/editor/before_enqueue_scripts', [ $this, 'enqueue_editor_scripts' ] );
        add_action( 'elementor/editor/after_enqueue_styles', [ $this, 'enqueue_editor_styles' ] );

		add_action( 'elementor/frontend/after_register_scripts', [ $this, 'enqueue_frontend_scripts' ] );
        add_action( 'elementor/frontend/after_enqueue_scripts', [ $this, 'enqueue_frontend_localize_script' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'enqueue_frontend_styles' ] );

        add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_custom_icons' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_custom_icons' ] );
        add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ] );

        add_filter( 'intermediate_image_sizes', [ $this, 'remove_default_image_sizes' ], 500 );

        add_action( 'wp_ajax_elementor_render_widget', [ $this, 'set_elementor_ajax' ], 10, -1 );

        add_filter('single_template', [ $this, 'single_elementor_library_template' ] );

        add_action( 'elementor/preview/enqueue_styles', function() {
            wp_enqueue_style( 'nova-slider-pro-css' );
        } );

	}

	public function single_elementor_library_template( $template ){
        if(is_singular('elementor_library')){
            return NOVA_ELEMENTS_PATH . 'single-elementor_library.php';
        }
        return $template;
    }

    /**
     * Set $this->is_elementor_ajax to true on Elementor AJAX processing
     *
     * @return  void
     */
    public function set_elementor_ajax() {
        $this->is_elementor_ajax = true;
    }

    /**
     * Check if we currently in Elementor mode
     *
     * @return void
     */
    public function in_elementor() {

        $result = false;

        if ( wp_doing_ajax() ) {
            $result = $this->is_elementor_ajax;
        } elseif ( \Elementor\Plugin::instance()->editor->is_edit_mode()
            || \Elementor\Plugin::instance()->preview->is_preview_mode() ) {
            $result = true;
        }

        /**
         * Allow to filter result before return
         *
         * @var bool $result
         */
        return apply_filters( 'nova-elements/in-elementor', $result );
    }

    /**
     * Check if we currently in Elementor editor mode
     *
     * @return void
     */
    public function is_edit_mode() {

        $result = false;

        if ( \Elementor\Plugin::instance()->editor->is_edit_mode() ) {
            $result = true;
        }

        /**
         * Allow to filter result before return
         *
         * @var bool $result
         */
        return apply_filters( 'nova-elements/is-edit-mode', $result );
    }

	/**
	 * Plugin constructor.
	 */
	private function __construct() {
		spl_autoload_register( [ $this, 'autoload' ] );

		$this->_includes();
		$this->add_actions();

		$this->__override_js_file();
	}


	private function __override_js_file(){

        if(defined('ELEMENTOR_VERSION')){

            $opt_name = 'nova-elementor-has-init-js-' . ELEMENTOR_VERSION;
            if(!get_option($opt_name, false)){
                try{
                    $editor_target = ELEMENTOR_ASSETS_PATH . 'js/editor.min.js';
                    $editor_fake = NOVA_ELEMENTS_PATH . 'override/assets/js/editor.min.js';
                    $file_content = @file_get_contents($editor_target);
                    $string_search = array(
                        'this.stylesheet.addDevice("mobile",0).addDevice("tablet",e.md).addDevice("desktop",e.lg)',
                        '["desktop","tablet","mobile"]'
                    );
                    $string_replace = array(
                        'this.stylesheet.addDevice("width640",0).addDevice("mobile",e.width640).addDevice("width800",e.md).addDevice("tablet",e.width800).addDevice("laptop",e.lg).addDevice("desktop",e.xl)',
                        '["desktop","laptop","tablet","width800","mobile","width640"]'
                    );

                    $new_content = str_replace($string_search, $string_replace, $file_content);

                    if(@file_put_contents($editor_fake, $new_content)){
                        update_option($opt_name, true);
                    }

                }catch (\Exception $exception){

                }
            }
        }
    }

}


if ( ! defined( 'NOVA_ELEMENTS_TESTS' ) ) {
    // In tests we run the instance manually.
    NovaPlugin::instance();
}
