<?php

if ( ! function_exists( 'techlink_core_add_social_share_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function techlink_core_add_social_share_widget( $widgets ) {
		$widgets[] = 'TechLinkCoreSocialShareWidget';
		
		return $widgets;
	}
	
	add_filter( 'techlink_core_filter_register_widgets', 'techlink_core_add_social_share_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class TechLinkCoreSocialShareWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'techlink_core_social_share'
			) );
			if( $widget_mapped ) {
				$this->set_base( 'techlink_core_social_share' );
				$this->set_name( esc_html__( 'TechLink Social Share', 'techlink-core' ) );
				$this->set_description( esc_html__( 'Add a social share element into widget areas', 'techlink-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[techlink_core_social_share $params]" ); // XSS OK
		}
	}
}