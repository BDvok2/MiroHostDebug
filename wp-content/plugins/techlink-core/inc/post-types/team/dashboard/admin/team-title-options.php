<?php

if ( ! function_exists( 'techlink_core_add_team_title_options' ) ) {
	/**
	 * Function that add title options for team module
	 */
	function techlink_core_add_team_title_options( $tab ) {
		
		if ( $tab ) {
			$tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_enable_team_title',
					'title'         => esc_html__( 'Enable Title on Team Single', 'techlink-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable team single title', 'techlink-core' ),
					'options'       => techlink_core_get_select_type_options_pool( 'yes_no' )
				)
			);
			
			$tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_team_title_area_in_grid',
					'title'         => esc_html__( 'Team Title in Grid', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will set team title area to be in grid', 'techlink-core' ),
					'options'       => techlink_core_get_select_type_options_pool( 'yes_no' )
				)
			);
		}
	}
	
	add_action( 'techlink_core_action_after_team_options_single', 'techlink_core_add_team_title_options' );
}