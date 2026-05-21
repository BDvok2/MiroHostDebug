<?php
if ( ! function_exists( 'techlink_core_add_top_area_meta_options' ) ) {
	/**
	 * Function that add additional header layout meta box options
	 *
	 * @param object $page
	 */
	function techlink_core_add_top_area_meta_options( $page ) {
		$top_area_section = $page->add_section_element(
			array(
				'name'       => 'qodef_top_area_section',
				'title'      => esc_html__( 'Top Area', 'techlink-core' ),
				'dependency' => array(
					'hide' => array(
						'qodef_header_layout' => array(
							'values'        => techlink_core_dependency_for_top_area_options(),
							'default_value' => ''
						)
					)
				)
			)
		);

		$top_area_section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_top_area_header',
				'title'       => esc_html__( 'Top Area', 'techlink-core' ),
				'description' => esc_html__( 'Enable top area', 'techlink-core' ),
				'options'     => techlink_core_get_select_type_options_pool( 'yes_no' )
			)
		);

		$top_area_options_section = $top_area_section->add_section_element(
			array(
				'name'        => 'qodef_top_area_options_section',
				'title'       => esc_html__( 'Top Area Options', 'techlink-core' ),
				'description' => esc_html__( 'Set desired values for top area', 'techlink-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_top_area_header' => array(
							'values'        => 'yes',
							'default_value' => 'no'
						)
					)
				)
			)
		);

        $top_area_options_section -> add_field_element (
            array (
                'field_type'    => 'yesno',
                'name'          => 'qodef_top_area_header_in_grid',
                'title'         => esc_html__ ( 'Content in Grid', 'behold-core' ),
                'description'   => esc_html__ ( 'Set content to be in grid', 'behold-core' ),
                'default_value' => 'no',
            )
        );

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_top_area_header_background_color',
				'title'       => esc_html__( 'Top Area Background Color', 'techlink-core' ),
				'description' => esc_html__( 'Choose top area background color', 'techlink-core' )
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_top_area_header_height',
				'title'       => esc_html__( 'Top Area Height', 'techlink-core' ),
				'description' => esc_html__( 'Enter top area height (default is 30px)', 'techlink-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'techlink-core' )
				)
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type' => 'text',
				'name'       => 'qodef_top_area_header_side_padding',
				'title'      => esc_html__( 'Top Area Side Padding', 'techlink-core' ),
				'args'       => array(
					'suffix' => esc_html__( 'px or %', 'techlink-core' )
				)
			)
		);
	}

	add_action( 'techlink_core_action_after_page_header_meta_map', 'techlink_core_add_top_area_meta_options', 20 );
}