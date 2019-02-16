<?php
namespace Nova_Elements\Modules\ImageComparison;

use Nova_Elements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'nova-image-comparison';
    }

    public function get_widgets() {
        return [
            'Image_Comparison'
        ];
    }
}