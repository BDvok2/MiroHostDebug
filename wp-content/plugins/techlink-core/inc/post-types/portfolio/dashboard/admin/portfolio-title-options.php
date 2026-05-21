<?php

if ( ! function_exists( 'techlink_core_add_portfolio_title_options' ) ) {
	/**
	 * Function that add title options for portfolio module
	 */
	function techlink_core_add_portfolio_title_options( $tab ) {
		
		if ( $tab ) {
			$tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_enable_portfolio_title',
					'title'         => esc_html__( 'Enable Title on Portfolio Single', 'techlink-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable portfolio single title', 'techlink-core' ),
					'options'       => techlink_core_get_select_type_options_pool( 'yes_no' )
				)
			);
			
			$tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_portfolio_title_area_in_grid',
					'title'         => esc_html__( 'Portfolio Title in Grid', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will set portfolio title area to be in grid', 'techlink-core' ),
					'options'       => techlink_core_get_select_type_options_pool( 'yes_no' )
				)
			);
		}
	}
	
	add_action( 'techlink_core_action_after_portfolio_options_single', 'techlink_core_add_portfolio_title_options' );
}