<?php
namespace Nova_Elements\Modules\Heading;

use Nova_Elements\Base\Module_Base;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Module extends Module_Base {

	public function get_name() {
		return 'nova-heading';
	}

	public function get_widgets() {
		return [
			'Heading'
		];
	}
}
