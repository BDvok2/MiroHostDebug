<?php

if ( ! function_exists( 'techlink_core_add_pricing_table_variation_standard' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_pricing_table_variation_standard( $variations ) {
		
		$variations['standard'] = esc_html__( 'Standard', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_pricing_table_layouts', 'techlink_core_add_pricing_table_variation_standard' );
}
