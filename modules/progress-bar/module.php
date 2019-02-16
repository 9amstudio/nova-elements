<?php
namespace Nova_Elements\Modules\ProgressBar;

use Nova_Elements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'nova-progress-bar';
	}

	public function get_widgets() {
		return [
			'Progress_Bar'
		];
	}
}