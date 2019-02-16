<?php
namespace Nova_Elements\Modules\TabsWidget;

use Nova_Elements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'nova-tabs-widget';
    }

    public function get_widgets() {
        return [
            'Tabs_Widget'
        ];
    }
}