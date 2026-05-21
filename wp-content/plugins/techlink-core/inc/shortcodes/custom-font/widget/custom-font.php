<?php

if ( ! function_exists( 'techlink_core_add_custom_font_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function techlink_core_add_custom_font_widget( $widgets ) {
		$widgets[] = 'TechLinkCoreCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'techlink_core_filter_register_widgets', 'techlink_core_add_custom_font_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class TechLinkCoreCustomFontWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'techlink_core_custom_font'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'techlink_core_custom_font' );
				$this->set_name( esc_html__( 'TechLink Custom Font', 'techlink-core' ) );
				$this->set_description( esc_html__( 'Add a custom font element into widget areas', 'techlink-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[techlink_core_custom_font $params]" ); // XSS OK
		}
	}
}