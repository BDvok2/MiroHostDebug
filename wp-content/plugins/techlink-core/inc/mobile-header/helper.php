<?php

if ( ! function_exists( 'techlink_core_dependency_for_mobile_menu_typography_options' ) ) {
	/**
	 * Function that set dependency values for module global options
	 *
	 * @return array
	 */
	function techlink_core_dependency_for_mobile_menu_typography_options() {
		return apply_filters( 'techlink_core_filter_mobile_menu_typography_hide_option', $hide_dep_options = array() );
	}
}