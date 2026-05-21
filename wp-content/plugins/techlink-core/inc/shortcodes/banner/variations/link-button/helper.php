<?php

if ( ! function_exists( 'techlink_core_add_banner_variation_link_button' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_banner_variation_link_button( $variations ) {
		$variations['link-button'] = esc_html__( 'Link Button', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_banner_layouts', 'techlink_core_add_banner_variation_link_button' );
}
