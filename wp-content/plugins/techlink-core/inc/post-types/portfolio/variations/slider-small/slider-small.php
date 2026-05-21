<?php

if ( ! function_exists( 'techlink_core_add_portfolio_single_variation_slider_small' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_portfolio_single_variation_slider_small( $variations ) {
		$variations['slider-small'] = esc_html__( 'Slider - Small', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_portfolio_single_layout_options', 'techlink_core_add_portfolio_single_variation_slider_small' );
}