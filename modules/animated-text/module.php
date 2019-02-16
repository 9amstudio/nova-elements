<?php
namespace Nova_Elements\Modules\AnimatedText;

use Nova_Elements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'nova-animated-text';
	}

	public function get_widgets() {
		return [
			'Animated_Text'
		];
	}
}