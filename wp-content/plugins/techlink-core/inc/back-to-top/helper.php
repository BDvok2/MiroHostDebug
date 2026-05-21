<?php

if ( ! function_exists( 'techlink_core_is_back_to_top_enabled' ) ) {
	/**
	 * Function that check is module enabled
	 *
	 * @return bool
	 */
	function techlink_core_is_back_to_top_enabled() {
		return techlink_core_get_post_value_through_levels( 'qodef_back_to_top' ) !== 'no';
	}
}

if ( ! function_exists( 'techlink_core_add_back_to_top_to_body_classes' ) ) {
	/**
	 * Function that add additional class name into global class list for body tag
	 *
	 * @param array $classes
	 *
	 * @return array
	 */
	function techlink_core_add_back_to_top_to_body_classes( $classes ) {
		$classes[] = techlink_core_is_back_to_top_enabled() ? 'qodef-back-to-top--enabled' : '';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'techlink_core_add_back_to_top_to_body_classes' );
}

if ( ! function_exists( 'techlink_core_load_back_to_top' ) ) {
	/**
	 * Loads Back To Top HTML
	 */
	function techlink_core_load_back_to_top() {
		
		if ( techlink_core_is_back_to_top_enabled() ) {
			$parameters = array();
			
			techlink_core_template_part( 'back-to-top', 'templates/back-to-top', '', $parameters );
		}
	}
	
	add_action( 'techlink_action_before_wrapper_close_tag', 'techlink_core_load_back_to_top' );
}