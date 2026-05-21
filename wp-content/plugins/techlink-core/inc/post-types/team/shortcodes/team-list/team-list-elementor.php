<?php

class TechLinkCoreElementorTeamList extends TechLinkCoreElementorWidgetBase {
	
	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'techlink_core_team_list' );
		
		parent::__construct( $data, $args );
	}
}

techlink_core_get_elementor_widgets_manager()->register_widget_type( new TechLinkCoreElementorTeamList() );