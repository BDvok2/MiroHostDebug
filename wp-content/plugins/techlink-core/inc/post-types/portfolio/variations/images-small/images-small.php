<?php

if ( ! function_exists( 'techlink_core_add_portfolio_single_variation_images_small' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_portfolio_single_variation_images_small( $variations ) {
		$variations['images-small'] = esc_html__( 'Images - Small', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_portfolio_single_layout_options', 'techlink_core_add_portfolio_single_variation_images_small' );
}