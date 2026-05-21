<?php

if ( ! function_exists( 'techlink_core_add_button_variation_filled' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_button_variation_filled( $variations ) {
		$variations['filled'] = esc_html__( 'Filled', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_button_layouts', 'techlink_core_add_button_variation_filled' );
}
