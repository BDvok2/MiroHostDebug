<?php

if ( ! function_exists( 'techlink_core_add_sticky_sidebar_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function techlink_core_add_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'TechLinkCoreStickySidebarWidget';
		
		return $widgets;
	}
	
	add_filter( 'techlink_core_filter_register_widgets', 'techlink_core_add_sticky_sidebar_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class TechLinkCoreStickySidebarWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_base( 'techlink_core_sticky_sidebar' );
			$this->set_name( esc_html__( 'TechLink Sticky Sidebar', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Use this widget to make the sidebar sticky. Drag it into the sidebar above the widget which you want to be the first element in the sticky sidebar', 'techlink-core' ) );
		}
		
		public function render( $atts ) {
		}
	}
}
