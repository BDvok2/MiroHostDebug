<?php

class TechLinkCoreElementorSocialShare extends TechLinkCoreElementorWidgetBase {
	
	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'techlink_core_social_share' );
		
		parent::__construct( $data, $args );
	}
}

techlink_core_get_elementor_widgets_manager()->register_widget_type( new TechLinkCoreElementorSocialShare() );