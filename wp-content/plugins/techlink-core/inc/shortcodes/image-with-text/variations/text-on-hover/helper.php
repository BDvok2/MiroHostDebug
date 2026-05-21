<?php

if ( ! function_exists( 'techlink_core_add_image_with_text_variation_text_on_hover' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_image_with_text_variation_text_on_hover( $variations ) {
		$variations['text-on-hover'] = esc_html__( 'Text On Hover', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_image_with_text_layouts', 'techlink_core_add_image_with_text_variation_text_on_hover' );
}
