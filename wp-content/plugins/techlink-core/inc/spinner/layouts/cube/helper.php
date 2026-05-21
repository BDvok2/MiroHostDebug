<?php

if ( ! function_exists( 'techlink_core_add_cube_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts  - module layouts
	 *
	 * @return array
	 */
	function techlink_core_add_cube_spinner_layout_option( $layouts ) {
		$layouts['cube'] = esc_html__( 'Cube', 'techlink-core' );
		
		return $layouts;
	}
	
	add_filter( 'techlink_core_filter_page_spinner_layout_options', 'techlink_core_add_cube_spinner_layout_option' );
}