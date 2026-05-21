<?php

if ( ! function_exists( 'techlink_core_add_custom_font_variation_simple' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_custom_font_variation_simple( $variations ) {
		$variations['simple'] = esc_html__( 'Simple', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_custom_font_layouts', 'techlink_core_add_custom_font_variation_simple' );
}
