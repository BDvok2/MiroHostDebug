<?php

if ( ! function_exists( 'techlink_core_add_general_page_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function techlink_core_add_general_page_meta_box( $page ) {

		$general_tab = $page->add_tab_element(
			array(
				'name'        => 'tab-page',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Page Settings', 'techlink-core' ),
				'description' => esc_html__( 'General page layout settings', 'techlink-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_page_background_color',
				'title'       => esc_html__( 'Page Background Color', 'techlink-core' ),
				'description' => esc_html__( 'Set background color', 'techlink-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_page_background_image',
				'title'       => esc_html__( 'Page Background Image', 'techlink-core' ),
				'description' => esc_html__( 'Set background image', 'techlink-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_repeat',
				'title'       => esc_html__( 'Page Background Image Repeat', 'techlink-core' ),
				'description' => esc_html__( 'Set background image repeat', 'techlink-core' ),
				'options'     => array(
					''          => esc_html__( 'Default', 'techlink-core' ),
					'no-repeat' => esc_html__( 'No Repeat', 'techlink-core' ),
					'repeat'    => esc_html__( 'Repeat', 'techlink-core' ),
					'repeat-x'  => esc_html__( 'Repeat-x', 'techlink-core' ),
					'repeat-y'  => esc_html__( 'Repeat-y', 'techlink-core' )
				)
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_size',
				'title'       => esc_html__( 'Page Background Image Size', 'techlink-core' ),
				'description' => esc_html__( 'Set background image size', 'techlink-core' ),
				'options'     => array(
					''        => esc_html__( 'Default', 'techlink-core' ),
					'contain' => esc_html__( 'Contain', 'techlink-core' ),
					'cover'   => esc_html__( 'Cover', 'techlink-core' )
				)
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_attachment',
				'title'       => esc_html__( 'Page Background Image Attachment', 'techlink-core' ),
				'description' => esc_html__( 'Set background image attachment', 'techlink-core' ),
				'options'     => array(
					''       => esc_html__( 'Default', 'techlink-core' ),
					'fixed'  => esc_html__( 'Fixed', 'techlink-core' ),
					'scroll' => esc_html__( 'Scroll', 'techlink-core' )
				)
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding',
				'title'       => esc_html__( 'Page Content Padding', 'techlink-core' ),
				'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'techlink-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding_mobile',
				'title'       => esc_html__( 'Page Content Padding Mobile', 'techlink-core' ),
				'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'techlink-core' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_boxed',
				'title'         => esc_html__( 'Boxed Layout', 'techlink-core' ),
				'description'   => esc_html__( 'Set boxed layout', 'techlink-core' ),
				'default_value' => '',
				'options'       => techlink_core_get_select_type_options_pool( 'yes_no' )
			)
		);

		$boxed_section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_boxed_section',
				'title'      => esc_html__( 'Boxed Layout Section', 'techlink-core' ),
				'dependency' => array(
					'hide' => array(
						'qodef_boxed' => array(
							'values'        => 'no',
							'default_value' => ''
						)
					)
				)
			)
		);

		$boxed_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_boxed_background_color',
				'title'       => esc_html__( 'Boxed Background Color', 'techlink-core' ),
				'description' => esc_html__( 'Set boxed background color', 'techlink-core' )
			)
		);

        $boxed_section->add_field_element(
            array(
                'field_type'  => 'image',
                'name'        => 'qodef_boxed_background_pattern',
                'title'       => esc_html__( 'Boxed Background Pattern', 'techlink-core' ),
                'description' => esc_html__( 'Set boxed background pattern', 'techlink-core' )
            )
        );

        $boxed_section->add_field_element(
            array(
                'field_type'  => 'select',
                'name'        => 'qodef_boxed_background_pattern_behavior',
                'title'       => esc_html__( 'Boxed Background Pattern Behavior', 'techlink-core' ),
                'description' => esc_html__( 'Set boxed background pattern behavior', 'techlink-core' ),
                'options'     => array(
                    ''       => esc_html__( 'Default', 'techlink-core' ),
                    'fixed'  => esc_html__( 'Fixed', 'techlink-core' ),
                    'scroll' => esc_html__( 'Scroll', 'techlink-core' )
                ),
            )
        );

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_passepartout',
				'title'         => esc_html__( 'Passepartout', 'techlink-core' ),
				'description'   => esc_html__( 'Enabling this option will display a passepartout around website content', 'techlink-core' ),
				'default_value' => '',
				'options'       => techlink_core_get_select_type_options_pool( 'yes_no' )
			)
		);

		$passepartout_section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_passepartout_section',
				'dependency' => array(
					'hide' => array(
						'qodef_passepartout' => array(
							'values'        => 'no',
							'default_value' => ''
						)
					)
				)
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_passepartout_color',
				'title'       => esc_html__( 'Passepartout Color', 'techlink-core' ),
				'description' => esc_html__( 'Choose background color for passepartout', 'techlink-core' )
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_passepartout_image',
				'title'       => esc_html__( 'Passepartout Background Image', 'techlink-core' ),
				'description' => esc_html__( 'Set background image for passepartout', 'techlink-core' )
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_passepartout_size',
				'title'       => esc_html__( 'Passepartout Size', 'techlink-core' ),
				'description' => esc_html__( 'Enter size amount for passepartout', 'techlink-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'techlink-core' )
				)
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_passepartout_size_responsive',
				'title'       => esc_html__( 'Passepartout Responsive Size', 'techlink-core' ),
				'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (1024px and below)', 'techlink-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'techlink-core' )
				)
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_content_width',
				'title'       => esc_html__( 'Initial Width of Content', 'techlink-core' ),
				'description' => esc_html__( 'Choose the initial width of content which is in grid (applies to pages set to "Default Template" and rows set to "In Grid")', 'techlink-core' ),
				'options'     => techlink_core_get_select_type_options_pool( 'content_width' )
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_content_lines',
				'title'         => esc_html__( 'Display lines in content background', 'techlink-core' ),
				'description'   => esc_html__( 'Enabling this option will display vertical lines in website content background', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'yes_no' ),
				'default_value' => ''
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_content_lines_decoration',
				'title'         => esc_html__( 'Display content line decoration', 'techlink-core' ),
				'description'   => esc_html__( 'Enabling this option will display decoration inside each content vertical line', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'yes_no' ),
				'default_value' => '',
				'dependency'    => array(
					'show' => array(
						'qodef_content_lines' => array(
							'values'        => 'yes',
							'default_value' => ''
						)
					)
				)
			)
		);

		$general_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_content_lines_decoration_style',
					'title'         => esc_html__( 'Content lines decoration style', 'techlink-core' ),
					'description'   => esc_html__( 'Choose a style for content lines decoration', 'techlink-core' ),
					'options'       => array(
						''            => esc_html__( 'Default', 'techlink-core' ),
						'predefined1' => esc_html__( 'Predefined', 'techlink-core' ),
						'predefined2' => esc_html__( 'Predefined 2', 'techlink-core' ),
					),
					'default_value' => 'predefined1',
					'dependency'    => array(
						'show' => array(
							'qodef_content_lines_decoration' => array(
								'values'        => 'yes',
								'default_value' => ''
							)
						)
					)
				)
			);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_content_special_line',
				'title'         => esc_html__( 'Display special line in content background', 'techlink-core' ),
				'description'   => esc_html__( 'Enabling this option will display special vertical line in right side of website content background', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'yes_no' ),
				'default_value' => ''
			)
		);

		$general_tab->add_field_element( array(
			'field_type'    => 'yesno',
			'default_value' => 'no',
			'name'          => 'qodef_content_behind_header',
			'title'         => esc_html__( 'Always put content behind header', 'techlink-core' ),
			'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'techlink-core' ),
		) );

		// Hook to include additional options after module options
		do_action( 'techlink_core_action_after_general_page_meta_box_map', $general_tab );
	}

	add_action( 'techlink_core_action_after_general_meta_box_map', 'techlink_core_add_general_page_meta_box', 9 );
}

if ( ! function_exists( 'techlink_core_add_general_page_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function techlink_core_add_general_page_meta_box_callback( $callbacks ) {
		$callbacks['page'] = 'techlink_core_add_general_page_meta_box';
		
		return $callbacks;
	}
	
	add_filter( 'techlink_core_filter_general_meta_box_callbacks', 'techlink_core_add_general_page_meta_box_callback' );
}
