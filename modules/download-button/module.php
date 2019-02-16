<?php
namespace Nova_Elements\Modules\DownloadButton;

use Nova_Elements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

    public function get_name() {
        return 'nova-download-button';
    }

    public function get_widgets() {
        return [
            'Download_Button'
        ];
    }
}