<?php

if ( ! function_exists( 'techlink_core_add_product_categories_list_variation_info_on_image' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_product_categories_list_variation_info_on_image( $variations ) {
		$variations['info-on-image'] = esc_html__( 'Info On Image', 'techlink-core' );

		return $variations;
	}

	add_filter( 'techlink_core_filter_product_categories_list_layouts', 'techlink_core_add_product_categories_list_variation_info_on_image' );
}