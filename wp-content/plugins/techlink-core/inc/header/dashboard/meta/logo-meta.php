<?php

if ( ! function_exists( 'techlink_core_add_page_logo_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function techlink_core_add_page_logo_meta_box( $page ) {

		if ( $page ) {

			$logo_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-logo',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Logo Settings', 'techlink-core' ),
					'description' => esc_html__( 'Logo settings', 'techlink-core' )
				)
			);

			$header_logo_section = $logo_tab->add_section_element(
				array(
					'name'  => 'qodef_header_logo_section',
					'title' => esc_html__( 'Header Logo Options', 'techlink-core' ),
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_height',
					'title'       => esc_html__( 'Logo Height', 'techlink-core' ),
					'description' => esc_html__( 'Enter logo height', 'techlink-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'techlink-core' )
					)
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_main',
					'title'       => esc_html__( 'Logo - Main', 'techlink-core' ),
					'description' => esc_html__( 'Choose main logo image', 'techlink-core' ),
					'multiple'    => 'no'
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_dark',
					'title'       => esc_html__( 'Logo - Dark', 'techlink-core' ),
					'description' => esc_html__( 'Choose dark logo image', 'techlink-core' ),
					'multiple'    => 'no'
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_light',
					'title'       => esc_html__( 'Logo - Light', 'techlink-core' ),
					'description' => esc_html__( 'Choose light logo image', 'techlink-core' ),
					'multiple'    => 'no'
				)
			);

			// Hook to include additional options after module options
			do_action( 'techlink_core_action_after_page_logo_meta_map', $logo_tab, $header_logo_section );
		}
	}

	add_action( 'techlink_core_action_after_general_meta_box_map', 'techlink_core_add_page_logo_meta_box' );
}

if ( ! function_exists( 'techlink_core_add_general_logo_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function techlink_core_add_general_logo_meta_box_callback( $callbacks ) {
		$callbacks['logo'] = 'techlink_core_add_page_logo_meta_box';
		
		return $callbacks;
	}
	
	add_filter( 'techlink_core_filter_general_meta_box_callbacks', 'techlink_core_add_general_logo_meta_box_callback' );
}