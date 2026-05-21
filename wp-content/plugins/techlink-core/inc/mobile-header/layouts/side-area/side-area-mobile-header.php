<?php

class SideAreaMobileHeader extends TechLinkCoreMobileHeader {
	private static $instance;

	public function __construct() {
		$this->set_layout( 'side-area' );
		$this->default_header_height = 70;

		parent::__construct();
	}

	public function enqueue_additional_assets() {

	}

	public static function get_instance() {
		if ( self::$instance == null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}
}
