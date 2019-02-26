<?php
/**
 * Plugin Name: Nova Elements For Elementor
 * Plugin URI:  https://nineamstudio.com
 * Description: This plugin use only for Nova theme with Elementor Page Builder
 * Version:     1.0
 * Author:      Nova
 * Author URI:  https://nineamstudio.com
 * License:           GNU General Public License v2
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.html
 * Domain Path:       /languages
 * Text Domain:       nova-elements
 * Network:           true
 * GitHub Plugin URI: hhttps://github.com/9amstudio/nova-elements
 * Requires WP:       4.6
 * Requires PHP:      5.6
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

define( 'NOVA_ELEMENTS_VER', '1.0.2.1' );
define( 'NOVA_ELEMENTS_PATH', plugin_dir_path( __FILE__ ) );
define( 'NOVA_ELEMENTS_BASE', plugin_basename( __FILE__ ) );
define( 'NOVA_ELEMENTS_URL', plugins_url( '/', __FILE__ ) );
define( 'NOVA_ELEMENTS_ELEMENTOR_VERSION_REQUIRED', '1.7' );
define( 'NOVA_ELEMENTS_PHP_VERSION_REQUIRED', '5.4' );

require_once NOVA_ELEMENTS_PATH . 'includes/helper-functions.php';
require_once NOVA_ELEMENTS_PATH . 'plugin.php';
require_once NOVA_ELEMENTS_PATH . 'classes/class-nova-elements-tools.php';
require_once NOVA_ELEMENTS_PATH . 'classes/class-nova-elements-utility.php';
require_once NOVA_ELEMENTS_PATH . 'classes/class-nova-elements-shortcodes.php';
require_once NOVA_ELEMENTS_PATH . 'classes/class-nova-elements-wpml.php';


/**
 * Check if Elementor is installed
 *
 * @since 1.0
 *
 */
if ( ! function_exists( '_is_elementor_installed' ) ) {
    function _is_elementor_installed() {
        $file_path = 'elementor/elementor.php';
        $installed_plugins = get_plugins();
        return isset( $installed_plugins[ $file_path ] );
    }
}

/**
 * Shows notice to user if Elementor plugin
 * is not installed or activated or both
 *
 * @since 1.0
 *
 */
function nova_elements_fail_load() {
    $plugin = 'elementor/elementor.php';

    if ( _is_elementor_installed() ) {
        if ( ! current_user_can( 'activate_plugins' ) ) {
            return;
        }

        $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
        $message = __( 'Nova Elements requires Elementor plugin to be active. Please activate Elementor to continue.', 'nova-elements' );
        $button_text = __( 'Activate Elementor', 'nova-elements' );

    } else {
        if ( ! current_user_can( 'install_plugins' ) ) {
            return;
        }

        $activation_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
        $message = sprintf( __( 'Nova Elements requires %1$s"Elementor"%2$s plugin to be installed and activated. Please install Elementor to continue.', 'nova-elements' ), '<strong>', '</strong>' );
        $button_text = __( 'Install Elementor', 'nova-elements' );
    }

    $button = '<p><a href="' . $activation_url . '" class="button-primary">' . $button_text . '</a></p>';

    printf( '<div class="error"><p>%1$s</p>%2$s</div>', esc_html( $message ), $button );
}

/**
 * Shows notice to user if
 * Elementor version if outdated
 *
 * @since 1.0
 *
 */
function nova_elements_out_of_date() {
    if ( ! current_user_can( 'update_plugins' ) ) {
        return;
    }

    $message = __( 'Nova Elements requires Elementor version at least ' . NOVA_ELEMENTS_ELEMENTOR_VERSION_REQUIRED . '. Please update Elementor to continue.', 'nova-elements' );

    printf( '<div class="error"><p>%1$s</p></div>', esc_html( $message ) );
}

/**
 * Shows notice to user if minimum PHP
 * version requirement is not met
 *
 * @since 1.0
 *
 */
function nova_elements_fail_php() {
    $message = __( 'Nova Elements requires PHP version ' . NOVA_ELEMENTS_PHP_VERSION_REQUIRED .'+ to work properly. The plugins is deactivated for now.', 'nova-elements' );

    printf( '<div class="error"><p>%1$s</p></div>', esc_html( $message ) );

    if ( isset( $_GET['activate'] ) )
        unset( $_GET['activate'] );
}

/**
 * Deactivates the plugin
 *
 * @since 1.0
 */
function nova_elements_deactivate() {
    deactivate_plugins( plugin_basename( __FILE__ ) );
}

/**
 * Load theme textdomain
 *
 * @since 1.0
 *
 */
function nova_elements_load_plugin_textdomain() {
    load_plugin_textdomain( 'nova-elements', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
}

/**
 * Assigns category to Nova Elements
 *
 * @since 1.0
 *
 */
function nova_elements_add_root_category() {
    \Elementor\Plugin::instance()->elements_manager->add_category(
        'nova',
        array(
            'title' => esc_html__( 'Nova Elements', 'nova-elements' ),
            'icon'  => 'font',
        ),
        1 );
}


function nova_elements_override_frontend_after_register_scripts(){
    wp_deregister_script('jquery-slick');
}

function nova_elements_override_editor_before_enqueue_scripts( $src, $handler ){
    if($handler == 'elementor-editor'){
        return NOVA_ELEMENTS_URL . 'override/assets/js/editor.min.js';
    }
    return $src;
}

function nova_elements_override_editor_wp_head(){

    $document = \Elementor\Plugin::$instance->documents->get( \Elementor\Plugin::$instance->editor->get_post_id() );

?>
    <script type="text/template" id="tmpl-elementor-panel-footer-content">
        <div id="elementor-panel-footer-settings" class="elementor-panel-footer-tool elementor-leave-open tooltip-target" data-tooltip="<?php esc_attr_e( 'Settings', 'nova-elements' ); ?>">
            <i class="fa fa-cog" aria-hidden="true"></i>
            <span class="elementor-screen-only"><?php printf( __( '%s Settings', 'nova-elements' ), $document::get_title() ); ?></span>
        </div>
        <div id="elementor-panel-footer-navigator" class="elementor-panel-footer-tool tooltip-target" data-tooltip="<?php esc_attr_e( 'Navigator', 'nova-elements' ); ?>">
            <i class="eicon-navigator" aria-hidden="true"></i>
            <span class="elementor-screen-only"><?php echo __( 'Navigator', 'nova-elements' ); ?></span>
        </div>
        <div id="elementor-panel-footer-history" class="elementor-panel-footer-tool elementor-leave-open tooltip-target elementor-toggle-state" data-tooltip="<?php esc_attr_e( 'History', 'nova-elements' ); ?>">
            <i class="fa fa-history" aria-hidden="true"></i>
            <span class="elementor-screen-only"><?php echo __( 'History', 'nova-elements' ); ?></span>
        </div>
        <div id="elementor-panel-footer-responsive" class="elementor-panel-footer-tool elementor-toggle-state">
            <i class="eicon-device-desktop tooltip-target" aria-hidden="true" data-tooltip="<?php esc_attr_e( 'Responsive Mode', 'nova-elements' ); ?>"></i>
            <span class="elementor-screen-only">
			<?php echo __( 'Responsive Mode', 'nova-elements' ); ?>
		</span>
            <div class="elementor-panel-footer-sub-menu-wrapper">
                <div class="elementor-panel-footer-sub-menu">
                    <div class="elementor-panel-footer-sub-menu-item" data-device-mode="desktop">
                        <i class="elementor-icon eicon-device-desktop" aria-hidden="true"></i>
                        <span class="elementor-title"><?php echo __( 'Desktop', 'nova-elements' ); ?></span>
                        <span class="elementor-description"><?php echo __( 'Default Preview', 'nova-elements' ); ?></span>
                    </div>
                    <div class="elementor-panel-footer-sub-menu-item" data-device-mode="laptop">
                        <i class="elementor-icon eicon-laptop" aria-hidden="true"></i>
                        <span class="elementor-title"><?php echo __( 'Laptop', 'nova-elements' ); ?></span>
                        <span class="elementor-description"><?php echo sprintf( __( 'Preview for %s', 'nova-elements' ),   '1366px' ); ?></span>
                    </div>
                    <div class="elementor-panel-footer-sub-menu-item" data-device-mode="tablet">
                        <i class="elementor-icon eicon-device-tablet landscape" aria-hidden="true"></i>
                        <span class="elementor-title"><?php echo __( 'Tablet Landscape', 'nova-elements' ); ?></span>
                        <?php $breakpoints = \Elementor\Core\Responsive\Responsive::get_breakpoints(); ?>
                        <span class="elementor-description"><?php echo sprintf( __( 'Preview for %s', 'nova-elements' ), '1024px' ); ?></span>
                    </div>
                    <div class="elementor-panel-footer-sub-menu-item" data-device-mode="width800">
                        <i class="elementor-icon eicon-device-width800" aria-hidden="true"></i>
                        <span class="elementor-title"><?php echo __( 'Tablet Portrait', 'nova-elements' ); ?></span>
                        <span class="elementor-description"><?php echo sprintf( __( 'Preview for %s', 'nova-elements' ), $breakpoints['md'] . 'px' ); ?></span>
                    </div>
                    <div class="elementor-panel-footer-sub-menu-item" data-device-mode="mobile">
                        <i class="elementor-icon eicon-device-mobile landscape" aria-hidden="true"></i>
                        <span class="elementor-title"><?php echo __( 'Mobile Landscape', 'nova-elements' ); ?></span>
                        <span class="elementor-description"><?php echo __( 'Preview for 640px', 'nova-elements' ); ?></span>
                    </div>
                    <div class="elementor-panel-footer-sub-menu-item" data-device-mode="width640">
                        <i class="elementor-icon eicon-device-width640" aria-hidden="true"></i>
                        <span class="elementor-title"><?php echo __( 'Mobile Portrait', 'nova-elements' ); ?></span>
                        <span class="elementor-description"><?php echo __( 'Preview for 360px', 'nova-elements' ); ?></span>
                    </div>
                </div>
            </div>
        </div>
        <div id="elementor-panel-footer-saver-preview" class="elementor-panel-footer-tool tooltip-target" data-tooltip="<?php esc_attr_e( 'Preview Changes', 'nova-elements' ); ?>">
		<span id="elementor-panel-footer-saver-preview-label">
			<i class="fa fa-eye" aria-hidden="true"></i>
			<span class="elementor-screen-only"><?php echo __( 'Preview Changes', 'nova-elements' ); ?></span>
		</span>
        </div>
        <div id="elementor-panel-footer-saver-publish" class="elementor-panel-footer-tool">
            <button id="elementor-panel-saver-button-publish" class="elementor-button elementor-button-success elementor-disabled">
			<span class="elementor-state-icon">
				<i class="fa fa-spin fa-circle-o-notch" aria-hidden="true"></i>
			</span>
                <span id="elementor-panel-saver-button-publish-label">
				<?php echo __( 'Publish', 'nova-elements' ); ?>
			</span>
            </button>
        </div>
        <div id="elementor-panel-footer-saver-options" class="elementor-panel-footer-tool elementor-toggle-state">
            <button id="elementor-panel-saver-button-save-options" class="elementor-button elementor-button-success tooltip-target elementor-disabled" data-tooltip="<?php esc_attr_e( 'Save Options', 'nova-elements' ); ?>">
                <i class="fa fa-caret-up" aria-hidden="true"></i>
                <span class="elementor-screen-only"><?php echo __( 'Save Options', 'nova-elements' ); ?></span>
            </button>
            <div class="elementor-panel-footer-sub-menu-wrapper">
                <p class="elementor-last-edited-wrapper">
				<span class="elementor-state-icon">
					<i class="fa fa-spin fa-circle-o-notch" aria-hidden="true"></i>
				</span>
                    <span class="elementor-last-edited">
					{{{ elementor.config.document.last_edited }}}
				</span>
                </p>
                <div class="elementor-panel-footer-sub-menu">
                    <div id="elementor-panel-footer-sub-menu-item-save-draft" class="elementor-panel-footer-sub-menu-item elementor-disabled">
                        <i class="elementor-icon fa fa-save" aria-hidden="true"></i>
                        <span class="elementor-title"><?php echo __( 'Save Draft', 'nova-elements' ); ?></span>
                    </div>
                    <div id="elementor-panel-footer-sub-menu-item-save-template" class="elementor-panel-footer-sub-menu-item">
                        <i class="elementor-icon fa fa-folder" aria-hidden="true"></i>
                        <span class="elementor-title"><?php echo __( 'Save as Template', 'nova-elements' ); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </script>
    <script type="text/template" id="tmpl-elementor-control-responsive-switchers">
        <div class="elementor-control-responsive-switchers">
            <#
            var devices = responsive.devices || [ 'desktop', 'laptop', 'tablet', 'width800',  'mobile', 'width640' ];

            _.each( devices, function( device ) { #>
            <a class="elementor-responsive-switcher elementor-responsive-switcher-{{ device }}" data-device="{{ device }}">
                <i class="eicon-device-{{ device }}"></i>
            </a>
            <# } );
            #>
        </div>
    </script>
<?php
}

add_action( 'plugins_loaded', 'nova_elements_init' );

function nova_elements_init() {

    // Notice if the Elementor is not active
    if ( ! did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', 'nova_elements_fail_load' );
        return;
    }

    // Check for required Elementor version
    if ( ! version_compare( ELEMENTOR_VERSION, NOVA_ELEMENTS_ELEMENTOR_VERSION_REQUIRED, '>=' ) ) {
        add_action( 'admin_notices', 'nova_elements_out_of_date' );
        add_action( 'admin_init', 'nova_elements_deactivate' );
        return;
    }

    // Check for required PHP version
    if ( ! version_compare( PHP_VERSION, NOVA_ELEMENTS_PHP_VERSION_REQUIRED, '>=' ) ) {
        add_action( 'admin_notices', 'nova_elements_fail_php' );
        add_action( 'admin_init', 'nova_elements_deactivate' );
        return;
    }

    nova_elements_shortocdes()->init();

    add_action( 'init', 'nova_elements_load_plugin_textdomain' );

    add_action( 'elementor/init', 'nova_elements_add_root_category' );


    /** Override */

    add_action('elementor/frontend/after_register_scripts', 'nova_elements_override_frontend_after_register_scripts' );

    if(defined('ELEMENTOR_VERSION')){

        add_action('script_loader_src', 'nova_elements_override_editor_before_enqueue_scripts', 10, 2);
        add_action('elementor/editor/wp_head', 'nova_elements_override_editor_wp_head' );

        require NOVA_ELEMENTS_PATH . 'override/includes/base/controls-stack.php';
        require NOVA_ELEMENTS_PATH . 'override/core/files/css/base.php' ;
        require NOVA_ELEMENTS_PATH . 'override/core/responsive/files/frontend.php';
        require NOVA_ELEMENTS_PATH . 'override/core/responsive/responsive.php';

    }
}

/**
 * Enable white labeling setting form after re-activating the plugin
 *
 * @since 1.0.1
 * @return void
 */
function nova_elements_plugin_activation()
{

}
register_activation_hook( __FILE__, 'nova_elements_plugin_activation' );
