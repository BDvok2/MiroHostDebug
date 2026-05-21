<?php

if ( ! function_exists( 'techlink_core_add_fusion_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts  - module layouts
	 *
	 * @return array
	 */
	function techlink_core_add_fusion_spinner_layout_option( $layouts ) {
		$layouts['fusion'] = esc_html__( 'Fusion', 'techlink-core' );
		
		return $layouts;
	}
	
	add_filter( 'techlink_core_filter_page_spinner_layout_options', 'techlink_core_add_fusion_spinner_layout_option' );
}