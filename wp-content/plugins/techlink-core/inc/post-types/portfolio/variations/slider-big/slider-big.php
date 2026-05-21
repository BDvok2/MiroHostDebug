<?php

if ( ! function_exists( 'techlink_core_add_portfolio_single_variation_slider_big' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_portfolio_single_variation_slider_big( $variations ) {
		$variations['slider-big'] = esc_html__( 'Slider - Big', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_portfolio_single_layout_options', 'techlink_core_add_portfolio_single_variation_slider_big' );
}