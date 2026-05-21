<?php

if ( ! function_exists( 'techlink_load_page_mobile_header' ) ) {
	/**
	 * Function which loads page template module
	 */
	function techlink_load_page_mobile_header() {
		// Include mobile header template
		echo apply_filters( 'techlink_filter_mobile_header_template', techlink_get_template_part( 'mobile-header', 'templates/mobile-header' ) );
	}

	add_action( 'techlink_action_page_header_template', 'techlink_load_page_mobile_header' );
}

if ( ! function_exists( 'techlink_register_mobile_navigation_menus' ) ) {
	/**
	 * Function which registers navigation menus
	 */
	function techlink_register_mobile_navigation_menus() {
		$navigation_menus = apply_filters( 'techlink_filter_register_mobile_navigation_menus', array( 'mobile-navigation' => esc_html__( 'Mobile Navigation', 'techlink' ) ) );

		if ( ! empty( $navigation_menus ) ) {
			register_nav_menus( $navigation_menus );
		}
	}

	add_action( 'techlink_action_after_include_modules', 'techlink_register_mobile_navigation_menus' );
}
