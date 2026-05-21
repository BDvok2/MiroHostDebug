<?php

if ( ! function_exists( 'techlink_core_add_button_variation_textual' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_button_variation_textual( $variations ) {
		$variations['textual'] = esc_html__( 'Textual', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_button_layouts', 'techlink_core_add_button_variation_textual' );
}
