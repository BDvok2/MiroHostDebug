<?php

if ( ! function_exists( 'techlink_core_add_minimal_header_meta' ) ) {
	/**
	 * Function that add additional header layout meta box options
	 *
	 * @param object $page
	 */
	function techlink_core_add_minimal_header_meta( $page ) {
		
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_minimal_header_section',
				'title'      => esc_html__( 'Minimal Header', 'techlink-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values' => 'minimal',
							'default_value' => ''
						)
					)
				)
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_minimal_header_in_grid',
				'title'       => esc_html__( 'Content in Grid', 'techlink-core' ),
				'description' => esc_html__( 'Set content to be in grid', 'techlink-core' ),
				'default_value' => '',
				'options'       => techlink_core_get_select_type_options_pool( 'no_yes' )
			)
		);
		
		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_minimal_header_height',
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
				'name'        => 'qodef_minimal_header_side_padding',
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
				'name'        => 'qodef_minimal_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'techlink-core' ),
				'description' => esc_html__( 'Enter header background color', 'techlink-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'techlink-core' )
				)
			)
		);

	}
	
	add_action( 'techlink_core_action_after_page_header_meta_map', 'techlink_core_add_minimal_header_meta' );
}