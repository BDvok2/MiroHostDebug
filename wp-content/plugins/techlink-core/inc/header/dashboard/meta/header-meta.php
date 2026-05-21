<?php

if ( ! function_exists( 'techlink_core_add_page_header_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function techlink_core_add_page_header_meta_box( $page ) {

		if ( $page ) {

			$header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Header Settings', 'techlink-core' ),
					'description' => esc_html__( 'Header layout settings', 'techlink-core' )
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_layout',
					'title'       => esc_html__( 'Header Layout', 'techlink-core' ),
					'description' => esc_html__( 'Choose a header layout to set for your website', 'techlink-core' ),
					'args'        => array( 'images' => true ),
					'options'     => techlink_core_header_radio_to_select_options( apply_filters( 'techlink_core_filter_header_layout_option', $header_layout_options = array() ) )
				)
			);
			
			$header_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_skin',
					'title'       => esc_html__( 'Header Skin', 'techlink-core' ),
					'description' => esc_html__( 'Choose a predefined header style for header elements', 'techlink-core' ),
					'options'     => array(
						''      => esc_html__( 'Default', 'techlink-core' ),
						'none'  => esc_html__( 'None', 'techlink-core' ),
						'light' => esc_html__( 'Light', 'techlink-core' ),
						'dark'  => esc_html__( 'Dark', 'techlink-core' )
					)
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_enable_widgets_in_box',
					'title'         => esc_html__( 'Enable Widgets In Box Style', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will show widgets styled with square around them', 'techlink-core' ),
					'options'       => techlink_core_get_select_type_options_pool( 'yes_no' ),
					'default_value' => '',
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_enable_last_widget_special_style',
					'title'         => esc_html__( 'Enable Last Widget Special Style', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will show last widget styled in special way', 'techlink-core' ),
					'options'       => techlink_core_get_select_type_options_pool( 'yes_no' ),
					'default_value' => '',
					'dependency'    => array(
						'show' => array(
							'qodef_enable_widgets_in_box' => array(
								'values'        => 'yes',
								'default_value' => ''
							)
						)
					)
				)
			);
			
			$header_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_basic_fullscreen_opener',
					'title'         => esc_html__( 'Enable Basic Fullscreen Opener', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will show basic opener, without square around', 'techlink-core' ),
					'default_value' => 'no',
					'dependency'    => array(
						'show' => array(
							'qodef_header_layout' => array(
								'values'        => 'minimal',
								'default_value' => ''
							)
						)
					)
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_show_header_widget_areas',
					'title'         => esc_html__( 'Show Header Widget Areas', 'techlink-core' ),
					'description'   => esc_html__( 'Choose if you want to show or hide header widget areas', 'techlink-core' ),
					'default_value' => 'yes'
				)
			);
			
			$header_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_show_header_special_line',
					'title'         => esc_html__( 'Show Header Special Line', 'techlink-core' ),
					'description'   => esc_html__( 'Choose if you want to show special line below header', 'techlink-core' ),
					'default_value' => 'no'
				)
			);

			$custom_sidebars = techlink_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {

				$section = $header_tab->add_section_element(
					array(
						'name'       => 'qodef_header_custom_widget_area_section',
						'dependency' => array(
							'show' => array(
								'qodef_show_header_widget_areas' => array(
									'values'        => 'yes',
									'default_value' => 'yes'
								)
							)
						)
					)
				);
				
				$section->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_header_custom_widget_area_one',
						'title'       => esc_html__( 'Choose Custom Header Widget Area One', 'techlink-core' ),
						'description' => esc_html__( 'Choose custom widget area to display in header widget area one', 'techlink-core' ),
						'options'     => $custom_sidebars
					)
				);
				
				$section->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_header_custom_widget_area_two',
						'title'       => esc_html__( 'Choose Custom Header Widget Area Two', 'techlink-core' ),
						'description' => esc_html__( 'Choose custom widget area to display in header widget area two', 'techlink-core' ),
						'options'     => $custom_sidebars
					)
				);
				
				// Hook to include additional options after module options
				do_action( 'techlink_core_action_after_custom_widget_area_header_meta_map', $section, $custom_sidebars );
			}

			// Hook to include additional options after module options
			do_action( 'techlink_core_action_after_page_header_meta_map', $header_tab, $custom_sidebars );
		}
	}

	add_action( 'techlink_core_action_after_general_meta_box_map', 'techlink_core_add_page_header_meta_box' );
}

if ( ! function_exists( 'techlink_core_add_general_header_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function techlink_core_add_general_header_meta_box_callback( $callbacks ) {
		$callbacks['header'] = 'techlink_core_add_page_header_meta_box';
		
		return $callbacks;
	}
	
	add_filter( 'techlink_core_filter_general_meta_box_callbacks', 'techlink_core_add_general_header_meta_box_callback' );
}
