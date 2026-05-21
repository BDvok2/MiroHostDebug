<?php

if ( ! function_exists( 'techlink_core_add_header_options' ) ) {
	/**
	 * Function that add header options for this module
	 */
	function techlink_core_add_header_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => TECHLINK_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'layout'      => 'tabbed',
				'slug'        => 'header',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Header', 'techlink-core' ),
				'description' => esc_html__( 'Global Header Options', 'techlink-core' )
			)
		);

		if ( $page ) {
			$general_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-header-general',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'General Settings', 'techlink-core' )
				)
			);
			
			$general_tab->add_field_element(
				array(
					'field_type'    => 'radio',
					'name'          => 'qodef_header_layout',
					'title'         => esc_html__( 'Header Layout', 'techlink-core' ),
					'description'   => esc_html__( 'Choose a header layout to set for your website', 'techlink-core' ),
					'args'          => array( 'images' => true ),
					'options'       => apply_filters( 'techlink_core_filter_header_layout_option', $header_layout_options = array() ),
					'default_value' => apply_filters( 'techlink_core_filter_header_layout_default_option_value', '' ),
				)
			);
			
			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_header_skin',
					'title'       => esc_html__( 'Header Skin', 'techlink-core' ),
					'description' => esc_html__( 'Choose a predefined header style for header elements', 'techlink-core' ),
					'options'     => array(
						'none'  => esc_html__( 'None', 'techlink-core' ),
						'light' => esc_html__( 'Light', 'techlink-core' ),
						'dark'  => esc_html__( 'Dark', 'techlink-core' )
					)
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_widgets_in_box',
					'title'         => esc_html__( 'Enable Widgets In Box Style', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will show widgets styled with square around them', 'techlink-core' ),
					'default_value' => 'no',
				)
			);

			$general_tab->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_last_widget_special_style',
					'title'         => esc_html__( 'Enable Last Widget Special Style', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will show last widget styled in special way', 'techlink-core' ),
					'default_value' => 'no',
					'dependency'    => array(
						'show' => array(
							'qodef_enable_widgets_in_box' => array(
								'values'        => 'yes',
								'default_value' => 'no'
							)
						)
					)
				)
			);

			$general_tab->add_field_element(
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

			// Hook to include additional options after module options
			do_action( 'techlink_core_action_after_header_options_map', $page, $general_tab );
		}
	}

	add_action( 'techlink_core_action_default_options_init', 'techlink_core_add_header_options', techlink_core_get_admin_options_map_position( 'header' ) );
}
