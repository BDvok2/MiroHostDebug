<?php

if ( ! function_exists( 'techlink_core_add_page_footer_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function techlink_core_add_page_footer_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope'       => TECHLINK_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'footer',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Footer', 'techlink-core' ),
				'description' => esc_html__( 'Global Footer Options', 'techlink-core' )
			)
		);
		
		if ( $page ) {
			
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_page_footer',
					'title'         => esc_html__( 'Enable Page Footer', 'techlink-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable page footer', 'techlink-core' ),
					'default_value' => 'yes'
				)
			);
			
			$page_footer_section = $page->add_section_element(
				array(
					'name'       => 'qodef_page_footer_section',
					'title'      => esc_html__( 'Footer Area', 'techlink-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_page_footer' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);
			
			// General Footer Area Options
			
			$page_footer_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_uncovering_footer',
					'title'         => esc_html__( 'Enable Uncovering Footer', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'techlink-core' ),
					'default_value' => 'no'
				)
			);

			$page_footer_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_custom_footer_style',
					'title'         => esc_html__( 'Enable Custom Footer Style', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will show custom styled Footer ', 'techlink-core' ),
					'default_value' => 'no'
				)
			);
			
			// Top Footer Area Section
			
			$page_footer_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_top_footer_area',
					'title'         => esc_html__( 'Enable Top Footer Area', 'techlink-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable top footer area', 'techlink-core' ),
					'default_value' => 'yes'
				)
			);
			
			$top_footer_area_section = $page_footer_section->add_section_element(
				array(
					'name'       => 'qodef_top_footer_area_section',
					'title'      => esc_html__( 'Top Footer Area', 'techlink-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_top_footer_area' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);
		
			$top_footer_area_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_set_footer_top_area_in_grid',
					'title'         => esc_html__( 'Top Footer Area In Grid', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will set page top footer area to be in grid', 'techlink-core' ),
					'default_value' => 'yes'
				)
			);
			
			$top_footer_area_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_footer_top_area_columns',
					'title'         => esc_html__( 'Top Footer Area Columns', 'techlink-core' ),
					'description'   => esc_html__( 'Choose number of columns for top footer area', 'techlink-core' ),
					'options'       => techlink_core_get_select_type_options_pool( 'columns_number', true, array( '5', '6' ) ),
					'default_value' => '4'
				)
			);
			
			$top_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_top_area_grid_gutter',
					'title'       => esc_html__( 'Top Footer Area Grid Gutter', 'techlink-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between columns for top footer area', 'techlink-core' ),
					'options'     => techlink_core_get_select_type_options_pool( 'items_space' )
				)
			);
			
			$top_footer_area_styles_section = $top_footer_area_section->add_section_element(
				array(
					'name'       => 'qodef_top_footer_area_styles_section',
					'title'      => esc_html__( 'Top Footer Area Styles', 'techlink-core' )
				)
			);
			
			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_top_footer_area_background_color',
					'title'      => esc_html__( 'Background Color', 'techlink-core' ),
				)
			);
			
			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_top_footer_area_background_image',
					'title'      => esc_html__( 'Background Image', 'techlink-core' ),
				)
			);
			
			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_top_footer_area_top_border_color',
					'title'      => esc_html__( 'Top Border Color', 'techlink-core' ),
				)
			);
			
			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_top_footer_area_top_border_width',
					'title'      => esc_html__( 'Top Border Width', 'techlink-core' ),
					'args'       => array(
						'suffix'    => esc_html__( 'px', 'techlink-core' ),
					)
				)
			);
			
			$top_footer_area_styles_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_top_footer_area_widgets_margin_bottom',
					'title'       => esc_html__( 'Widgets Margin Bottom', 'techlink-core' ),
					'description' => esc_html__( 'Set space value between widgets', 'techlink-core' ),
				)
			);
			
			// Bottom Footer Area Section
			
			$page_footer_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_bottom_footer_area',
					'title'         => esc_html__( 'Enable Bottom Footer Area', 'techlink-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable bottom footer area', 'techlink-core' ),
					'default_value' => 'yes'
				)
			);
			
			$bottom_footer_area_section = $page_footer_section->add_section_element(
				array(
					'name'       => 'qodef_bottom_footer_area_section',
					'title'      => esc_html__( 'Bottom Footer Area', 'techlink-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_bottom_footer_area' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);
			
			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_set_footer_bottom_area_in_grid',
					'title'         => esc_html__( 'Bottom Footer Area In Grid', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will set page bottom footer area to be in grid', 'techlink-core' ),
					'default_value' => 'yes'
				)
			);
			
			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_set_footer_bottom_area_columns',
					'title'         => esc_html__( 'Bottom Footer Area Columns', 'techlink-core' ),
					'description'   => esc_html__( 'Choose number of columns for bottom footer area', 'techlink-core' ),
					'options'       => techlink_core_get_select_type_options_pool( 'columns_number', true, array( '4', '5', '6' ) ),
					'default_value' => '3'
				)
			);
			
			$bottom_footer_area_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_footer_bottom_area_grid_gutter',
					'title'       => esc_html__( 'Bottom Footer Area Grid Gutter', 'techlink-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between columns for bottom footer area', 'techlink-core' ),
					'options'     => techlink_core_get_select_type_options_pool( 'items_space' )
				)
			);
			
			$bottom_footer_area_styles_section = $bottom_footer_area_section->add_section_element(
				array(
					'name'       => 'qodef_bottom_footer_area_styles_section',
					'title'      => esc_html__( 'Bottom Footer Area Styles', 'techlink-core' )
				)
			);
			
			$bottom_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_bottom_footer_area_background_color',
					'title'      => esc_html__( 'Background Color', 'techlink-core' )
				)
			);
			
			$bottom_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_bottom_footer_area_top_border_color',
					'title'      => esc_html__( 'Top Border Color', 'techlink-core' )
				)
			);
			
			$bottom_footer_area_styles_section->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_bottom_footer_area_top_border_width',
					'title'      => esc_html__( 'Top Border Width', 'techlink-core' ),
					'args'       => array(
						'suffix' => esc_html__( 'px', 'techlink-core' )
					)
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'techlink_core_action_after_page_footer_options_map', $page );
		}
	}
	
	add_action( 'techlink_core_action_default_options_init', 'techlink_core_add_page_footer_options', techlink_core_get_admin_options_map_position( 'footer' ) );
}
