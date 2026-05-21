<?php

if ( ! function_exists( 'techlink_core_add_fixed_header_option' ) ) {
	/**
	 * This function set header scrolling appearance value for global header option map
	 */
	function techlink_core_add_fixed_header_option( $options ) {
		$options['fixed'] = esc_html__( 'Fixed', 'techlink-core' );

		return $options;
	}

	add_filter( 'techlink_core_filter_header_scroll_appearance_option', 'techlink_core_add_fixed_header_option' );
}