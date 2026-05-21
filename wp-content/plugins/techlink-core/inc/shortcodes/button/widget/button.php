<?php

if ( ! function_exists( 'techlink_core_add_button_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function techlink_core_add_button_widget( $widgets ) {
		$widgets[] = 'TechLinkCoreButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'techlink_core_filter_register_widgets', 'techlink_core_add_button_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class TechLinkCoreButtonWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'techlink_core_button'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'techlink_core_button' );
				$this->set_name( esc_html__( 'TechLink Button', 'techlink-core' ) );
				$this->set_description( esc_html__( 'Add a button element into widget areas', 'techlink-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[techlink_core_button $params]" ); // XSS OK
		}
	}
}