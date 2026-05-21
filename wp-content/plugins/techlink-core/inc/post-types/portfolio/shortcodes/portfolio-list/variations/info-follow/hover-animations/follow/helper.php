<?php

if ( ! function_exists( 'techlink_core_filter_portfolio_list_info_follow' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_filter_portfolio_list_info_follow( $variations ) {
		$variations['follow'] = esc_html__( 'Follow', 'techlink-core' );

		return $variations;
	}

	add_filter( 'techlink_core_filter_portfolio_list_info_follow_animation_options', 'techlink_core_filter_portfolio_list_info_follow' );
}
