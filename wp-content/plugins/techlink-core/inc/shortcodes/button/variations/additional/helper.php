<?php

if ( ! function_exists( 'techlink_core_add_button_variation_additional' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_button_variation_additional( $variations ) {
		$variations['additional'] = esc_html__( 'Additional', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_button_layouts', 'techlink_core_add_button_variation_additional' );
}
