<?php

class TechLinkCoreElementorTwitterList extends TechLinkCoreElementorWidgetBase {
	
	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'techlink_core_twitter_list' );
		
		parent::__construct( $data, $args );
	}
}

if ( qode_framework_is_installed( 'twitter' ) ) {
	techlink_core_get_elementor_widgets_manager()->register_widget_type( new TechLinkCoreElementorTwitterList() );
}