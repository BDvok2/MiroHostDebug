<?php

if ( ! function_exists( 'techlink_core_add_image_marquee_variation_default' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_image_marquee_variation_default( $variations ) {
		$variations['default'] = esc_html__( 'Default', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_image_marquee_layouts', 'techlink_core_add_image_marquee_variation_default' );
}
