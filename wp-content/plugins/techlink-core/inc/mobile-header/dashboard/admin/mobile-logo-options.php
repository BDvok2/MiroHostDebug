<?php

if ( ! function_exists( 'techlink_core_add_mobile_logo_options' ) ) {
	/**
	 * Function that add general options for this module
	 *
	 * @param object $page
	 * @param object $header_tab
	 */
	function techlink_core_add_mobile_logo_options( $page, $header_tab ) {

		if ( $page ) {
			
			$mobile_header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-mobile-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Mobile Header Logo Options', 'techlink-core' ),
					'description' => esc_html__( 'Set options for mobile headers', 'techlink-core' )
				)
			);
			
			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_mobile_logo_height',
					'title'       => esc_html__( 'Mobile Logo Height', 'techlink-core' ),
					'description' => esc_html__( 'Enter mobile logo height', 'techlink-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'techlink-core' )
					)
				)
			);
			
			$mobile_header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_mobile_logo_main',
					'title'       => esc_html__( 'Mobile Logo - Main', 'techlink-core' ),
					'description' => esc_html__( 'Choose main mobile logo image', 'techlink-core' ),
					'default_value' => defined( 'TECHLINK_ASSETS_ROOT' ) ? TECHLINK_ASSETS_ROOT . '/img/logo.png' : '',
					'multiple'    => 'no'
				)
			);
			
			do_action( 'techlink_core_action_after_mobile_logo_options_map', $page );
		}
	}
	
	add_action( 'techlink_core_action_after_header_logo_options_map', 'techlink_core_add_mobile_logo_options', 10, 2 );
}