<?php

if ( ! function_exists( 'techlink_core_add_portfolio_list_variation_info_follow' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_portfolio_list_variation_info_follow( $variations ) {
		$variations['info-follow'] = esc_html__( 'Info Follow', 'techlink-core' );

		return $variations;
	}

	add_filter( 'techlink_core_filter_portfolio_list_layouts', 'techlink_core_add_portfolio_list_variation_info_follow' );
}
