<?php

if ( ! function_exists( 'techlink_core_add_item_showcase_variation_list' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_item_showcase_variation_list( $variations ) {
		$variations['list'] = esc_html__( 'List', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_item_showcase_layouts', 'techlink_core_add_item_showcase_variation_list' );
}
