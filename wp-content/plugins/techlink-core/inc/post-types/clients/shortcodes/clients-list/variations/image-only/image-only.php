<?php

if ( ! function_exists( 'techlink_core_add_clients_list_variation_image_only' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_clients_list_variation_image_only( $variations ) {
		$variations['image-only'] = esc_html__( 'Image Only', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_clients_list_layouts', 'techlink_core_add_clients_list_variation_image_only' );
}