<?php

class TechLinkCoreElementorSeparator extends TechLinkCoreElementorWidgetBase {
	
	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'techlink_core_separator' );
		
		parent::__construct( $data, $args );
	}
}

techlink_core_get_elementor_widgets_manager()->register_widget_type( new TechLinkCoreElementorSeparator() );