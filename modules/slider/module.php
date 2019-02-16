<?php
namespace Nova_Elements\Modules\Slider;

use Nova_Elements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'nova-slider';
	}

	public function get_widgets() {
		return [
			'Slider'
		];
	}
}