<?php

class TechLinkCoreElementorProductCategoriesList extends TechLinkCoreElementorWidgetBase {
	
	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'techlink_core_product_categories_list' );
		
		parent::__construct( $data, $args );
	}
}

if ( qode_framework_is_installed( 'woocommerce' ) ) {
	techlink_core_get_elementor_widgets_manager()->register_widget_type( new TechLinkCoreElementorProductCategoriesList() );
}