<?php

if ( ! function_exists( 'techlink_core_add_portfolio_single_social_share_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function techlink_core_add_portfolio_single_social_share_options( $page ) {
		
		if ( $page ) {
			
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_portfolio_single_enable_social_share',
					'title'         => esc_html__( 'Social Share', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will show social share section on portfolio single', 'techlink-core' ),
					'default_value' => 'yes'
				)
			);
		}
	}
	
	add_action( 'techlink_core_action_after_portfolio_options_single', 'techlink_core_add_portfolio_single_social_share_options' );
}