<?php

if ( ! function_exists( 'techlink_core_include_portfolio_single_post_navigation_template' ) ) {
	/**
	 * Function which includes additional module on single portfolio page
	 */
	function techlink_core_include_portfolio_single_post_navigation_template() {
		techlink_core_template_part( 'post-types/portfolio', 'templates/single/single-navigation/templates/single-navigation' );
	}
	
	add_action( 'techlink_core_action_after_portfolio_single_item', 'techlink_core_include_portfolio_single_post_navigation_template' );
}