<?php

if ( ! function_exists( 'techlink_core_add_page_title_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function techlink_core_add_page_title_meta_box( $page ) {

		if ( $page ) {

			$title_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-title',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Title Settings', 'techlink-core' ),
					'description' => esc_html__( 'Title layout settings', 'techlink-core' )
				)
			);

			$title_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_page_title',
					'title'       => esc_html__( 'Enable Page Title', 'techlink-core' ),
					'description' => esc_html__( 'Use this option to enable/disable page title', 'techlink-core' ),
					'options'     => techlink_core_get_select_type_options_pool( 'no_yes' )
				)
			);

			$page_title_section = $title_tab->add_section_element(
				array(
					'name'       => 'qodef_page_title_section',
					'title'      => esc_html__( 'Title Area', 'techlink-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_page_title' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_title_layout',
					'title'       => esc_html__( 'Title Layout', 'techlink-core' ),
					'description' => esc_html__( 'Choose a title layout', 'techlink-core' ),
					'options'     => apply_filters( 'techlink_core_filter_title_layout_options', $layouts = array( '' => esc_html__( 'Default', 'techlink-core' ) ) )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_set_page_title_area_in_grid',
					'title'       => esc_html__( 'Page Title In Grid', 'techlink-core' ),
					'description' => esc_html__( 'Enabling this option will set page title area to be in grid', 'techlink-core' ),
					'options'     => techlink_core_get_select_type_options_pool( 'no_yes' )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_title_height',
					'title'       => esc_html__( 'Height', 'techlink-core' ),
					'description' => esc_html__( 'Enter title height', 'techlink-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'techlink-core' )
					)
				)
			);
			
			$page_title_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_title_height_on_smaller_screens',
					'title'       => esc_html__( 'Height on Smaller Screens', 'techlink-core' ),
					'description' => esc_html__( 'Enter title height to be displayed on smaller screens with active mobile header', 'techlink-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'techlink-core' )
					)
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_title_background_color',
					'title'       => esc_html__( 'Background Color', 'techlink-core' ),
					'description' => esc_html__( 'Enter page title area background color', 'techlink-core' )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_page_title_background_image',
					'title'       => esc_html__( 'Background Image', 'techlink-core' ),
					'description' => esc_html__( 'Enter page title area background image', 'techlink-core' )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_page_title_background_image_behavior',
					'title'      => esc_html__( 'Background Image Behavior', 'techlink-core' ),
					'options'    => array(
						''           => esc_html__( 'Default', 'techlink-core' ),
						'responsive' => esc_html__( 'Set Responsive Image', 'techlink-core' ),
						'parallax'   => esc_html__( 'Set Parallax Image', 'techlink-core' )
					)
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_page_title_color',
					'title'      => esc_html__( 'Title Color', 'techlink-core' )
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_title_tag',
					'title'         => esc_html__( 'Title Tag', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will set title tag', 'techlink-core' ),
					'options'       => techlink_core_get_select_type_options_pool( 'title_tag' ),
					'default_value' => '',
					'dependency'    => array(
						'show' => array(
							'qodef_title_layout' => array(
								'values'        => array( 'standard-with-breadcrumbs', 'standard' ),
								'default_value' => ''
							)
						)
					)
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_title_text_alignment',
					'title'         => esc_html__( 'Text Alignment', 'techlink-core' ),
					'options'       => array(
						''       => esc_html__( 'Default', 'techlink-core' ),
						'center' => esc_html__( 'Center', 'techlink-core' ),
						'left'   => esc_html__( 'Left', 'techlink-core' ),
						'right'  => esc_html__( 'Right', 'techlink-core' )
					),
					'default_value' => 'center'
				)
			);

			$page_title_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_title_vertical_text_alignment',
					'title'         => esc_html__( 'Vertical Text Alignment', 'techlink-core' ),
					'options'       => array(
						''              => esc_html__( 'Default', 'techlink-core' ),
						'header-bottom' => esc_html__( 'From Bottom of Header', 'techlink-core' ),
						'window-top'    => esc_html__( 'From Window Top', 'techlink-core' )
					),
					'default_value' => ''
				)
			);

			// Hook to include additional options after module options
			do_action( 'techlink_core_action_after_page_title_meta_box_map', $page_title_section );
		}
	}

	add_action( 'techlink_core_action_after_general_meta_box_map', 'techlink_core_add_page_title_meta_box' );
}

if ( ! function_exists( 'techlink_core_add_general_page_title_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function techlink_core_add_general_page_title_meta_box_callback( $callbacks ) {
		$callbacks['page-title'] = 'techlink_core_add_page_title_meta_box';
		
		return $callbacks;
	}
	
	add_filter( 'techlink_core_filter_general_meta_box_callbacks', 'techlink_core_add_general_page_title_meta_box_callback');
}
