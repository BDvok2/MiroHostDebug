<?php

if ( ! function_exists( 'techlink_core_add_general_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function techlink_core_add_general_options( $page ) {

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_main_color',
					'title'       => esc_html__( 'Main Color', 'techlink-core' ),
					'description' => esc_html__( 'Choose the most dominant theme color', 'techlink-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_background_color',
					'title'       => esc_html__( 'Page Background Color', 'techlink-core' ),
					'description' => esc_html__( 'Set background color', 'techlink-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_page_background_image',
					'title'       => esc_html__( 'Page Background Image', 'techlink-core' ),
					'description' => esc_html__( 'Set background image', 'techlink-core' )
				)
			);

			$page->add_field_element(
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

			$page->add_field_element(
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

			$page->add_field_element(
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

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_content_padding',
					'title'       => esc_html__( 'Page Content Padding', 'techlink-core' ),
					'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'techlink-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_content_padding_mobile',
					'title'       => esc_html__( 'Page Content Padding Mobile', 'techlink-core' ),
					'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'techlink-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_boxed',
					'title'         => esc_html__( 'Boxed Layout', 'techlink-core' ),
					'description'   => esc_html__( 'Set boxed layout', 'techlink-core' ),
					'default_value' => 'no'
				)
			);

			$boxed_section = $page->add_section_element(
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
                        'fixed'  => esc_html__( 'Fixed', 'techlink-core' ),
                        'scroll' => esc_html__( 'Scroll', 'techlink-core' )
                    ),
                )
            );

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_passepartout',
					'title'         => esc_html__( 'Passepartout', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will display a passepartout around website content', 'techlink-core' ),
					'default_value' => 'no'
				)
			);

			$passepartout_section = $page->add_section_element(
				array(
					'name'       => 'qodef_passepartout_section',
					'title'      => esc_html__( 'Passepartout Section', 'techlink-core' ),
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

			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_content_width',
					'title'         => esc_html__( 'Initial Width of Content', 'techlink-core' ),
					'description'   => esc_html__( 'Choose the initial width of content which is in grid (applies to pages set to "Default Template" and rows set to "In Grid")', 'techlink-core' ),
					'options'       => techlink_core_get_select_type_options_pool( 'content_width', false ),
					'default_value' => '1100'
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_content_lines',
					'title'         => esc_html__( 'Display lines in content background', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will display vertical lines in website content background', 'techlink-core' ),
					'default_value' => 'no'
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_content_lines_decoration',
					'title'         => esc_html__( 'Display content lines decoration', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will display decoration inside each content vertical line', 'techlink-core' ),
					'default_value' => 'no',
					'dependency'    => array(
						'show' => array(
							'qodef_content_lines' => array(
								'values'        => 'yes',
								'default_value' => 'no'
							)
						)
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_content_lines_decoration_style',
					'title'         => esc_html__( 'Content lines decoration style', 'techlink-core' ),
					'description'   => esc_html__( 'Choose a style for content lines decoration', 'techlink-core' ),
					'options'       => array(
						'predefined1' => esc_html__( 'Predefined', 'techlink-core' ),
						'predefined2' => esc_html__( 'Predefined 2', 'techlink-core' ),
					),
					'default_value' => 'predefined1',
					'dependency'    => array(
						'show' => array(
							'qodef_content_lines_decoration' => array(
								'values'        => 'yes',
								'default_value' => 'no'
							)
						)
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_content_special_line',
					'title'         => esc_html__( 'Display special line in content background', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will display special vertical line in right side of website content background', 'techlink-core' ),
					'default_value' => 'no'
				)
			);

            $page->add_field_element(
                array(
                    'field_type'    => 'yesno',
                    'name'          => 'qodef_disable_images_lazy_loading',
                    'title'         => esc_html__( 'Disable Images Lazy Loading', 'techlink-core' ),
                    'description'   => esc_html__( 'Note that some images that have hover animation will not load if this option is turned off', 'techlink-core' ),
                    'options'       => techlink_core_get_select_type_options_pool( 'yes_no', false ),
                    'default_value' => 'yes'
                )
            );

			// Hook to include additional options after module options
			do_action( 'techlink_core_action_after_general_options_map', $page );
			
			$page->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_custom_js',
					'title'       => esc_html__( 'Custom JS', 'techlink-core' ),
					'description' => esc_html__( 'Enter your custom JavaScript here', 'techlink-core' )
				)
			);
		}
	}

	add_action( 'techlink_core_action_default_options_init', 'techlink_core_add_general_options', techlink_core_get_admin_options_map_position( 'general' ) );
}
