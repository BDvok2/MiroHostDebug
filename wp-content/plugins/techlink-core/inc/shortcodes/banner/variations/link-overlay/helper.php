<?php

if ( ! function_exists( 'techlink_core_add_banner_variation_link_overlay' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_banner_variation_link_overlay( $variations ) {
		$variations['link-overlay'] = esc_html__( 'Link Overlay', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_banner_layouts', 'techlink_core_add_banner_variation_link_overlay' );
}
