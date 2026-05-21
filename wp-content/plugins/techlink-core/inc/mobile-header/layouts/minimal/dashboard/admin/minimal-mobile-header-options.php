<?php

if ( ! function_exists( 'techlink_core_add_minimal_mobile_header_options' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 * @param array $general_tab
	 */
	function techlink_core_add_minimal_mobile_header_options( $page, $general_tab ) {
		
		$section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_minimal_mobile_header_section',
				'title'      => esc_html__( 'Minimal Mobile Header', 'techlink-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_mobile_header_layout' => array(
							'values' => 'minimal',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_mobile_header_height',
				'title'       => esc_html__( 'Minimal Height', 'techlink-core' ),
				'description' => esc_html__( 'Enter header height', 'techlink-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'techlink-core' )
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_minimal_mobile_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'techlink-core' ),
				'description' => esc_html__( 'Enter header background color', 'techlink-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'techlink-core' )
				)
			)
		);
	}
	
	add_action( 'techlink_core_action_after_mobile_header_options_map', 'techlink_core_add_minimal_mobile_header_options', 10, 2 );
}