<?php

if ( ! function_exists( 'techlink_core_add_blog_list_variation_metro' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_blog_list_variation_metro( $variations ) {
		$variations['metro'] = esc_html__( 'Metro', 'techlink-core' );

		return $variations;
	}

	add_filter( 'techlink_core_filter_blog_list_layouts', 'techlink_core_add_blog_list_variation_metro' );
}
