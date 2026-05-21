<?php

if ( ! function_exists( 'techlink_core_add_standard_header_options' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 * @param array $general_header_tab
	 */
	function techlink_core_add_standard_header_options( $page, $general_header_tab ) {
		
		$section = $general_header_tab->add_section_element(
			array(
				'name'        => 'qodef_standard_header_section',
				'title'       => esc_html__( 'Standard Header', 'techlink-core' ),
				'description' => esc_html__( 'Standard header settings', 'techlink-core' ),
				'dependency'  => array(
					'show'    => array(
						'qodef_header_layout' => array(
							'values' => 'standard',
							'default_value' => ''
						)
					)
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'yesno',
				'name'        => 'qodef_standard_header_in_grid',
				'title'       => esc_html__( 'Content in Grid', 'techlink-core' ),
				'description' => esc_html__( 'Set content to be in grid', 'techlink-core' ),
				'default_value' => 'no',
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_height',
				'title'       => esc_html__( 'Header Height', 'techlink-core' ),
				'description' => esc_html__( 'Enter header height', 'techlink-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'techlink-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_side_padding',
				'title'       => esc_html__( 'Header Side Padding', 'techlink-core' ),
				'description' => esc_html__( 'Enter side padding for header area', 'techlink-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'techlink-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'techlink-core' ),
				'description' => esc_html__( 'Enter header background color', 'techlink-core' )
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_standard_header_menu_position',
				'title'         => esc_html__( 'Menu position', 'techlink-core' ),
				'default_value' => 'right',
				'options'       => array(
					'left'   => esc_html__( 'Left', 'techlink-core' ),
					'center' => esc_html__( 'Center', 'techlink-core' ),
					'right'  => esc_html__( 'Right', 'techlink-core' ),
				)
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'yesno',
				'name'        => 'qodef_standard_header_custom_style',
				'title'       => esc_html__( 'Enable Header Custom Style', 'techlink-core' ),
				'description' => esc_html__( 'Set custom style for header', 'techlink-core' ),
				'default_value' => 'no',
			)
		);
	}
	
	add_action( 'techlink_core_action_after_header_options_map', 'techlink_core_add_standard_header_options', 10, 2 );
}
