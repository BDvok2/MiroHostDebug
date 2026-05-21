<?php

if ( ! function_exists( 'techlink_core_add_image_with_text_variation_text_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_image_with_text_variation_text_below( $variations ) {
		$variations['text-below'] = esc_html__( 'Text Below', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_image_with_text_layouts', 'techlink_core_add_image_with_text_variation_text_below' );
}
