<?php

if ( ! function_exists( 'techlink_core_add_subscribe_popup_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function techlink_core_add_subscribe_popup_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => TECHLINK_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'subscribe-popup',
				'icon'        => 'fa fa-envelope',
				'title'       => esc_html__( 'Subscribe Popup', 'techlink-core' ),
				'description' => esc_html__( 'Global Subscribe Popup Options', 'techlink-core' )
			)
		);

		if ( $page ) {
			$cf7 = get_posts( 'post_type="wpcf7_contact_form"&numberposts=-1' );

			$contact_forms = array();
			if ( $cf7 ) {
				foreach ( $cf7 as $cform ) {
					$contact_forms[ $cform->ID ] = $cform->post_title;
				}
			} else {
				$contact_forms[0] = esc_html__( 'No contact forms found', 'techlink-core' );
			}

			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_subscribe_popup',
					'title'         => esc_html__( 'Enable Subscribe Popup', 'techlink-core' ),
					'description'   => esc_html__( 'Use this option to enable/disable subscribe popup', 'techlink-core' ),
					'default_value' => 'no'
				)
			);

			$subscribe_popup_section = $page->add_section_element(
				array(
					'name'       => 'qodef_subscribe_popup_section',
					'title'      => esc_html__( 'Subscribe Popup', 'techlink-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_enable_subscribe_popup' => array(
								'values'        => 'no',
								'default_value' => ''
							)
						)
					)
				)
			);

			$subscribe_popup_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_subscribe_popup_title',
					'title'       => esc_html__( 'Title', 'techlink-core' ),
					'description' => esc_html__( 'Enter subscribe popup window title ', 'techlink-core' )
				)
			);

			$subscribe_popup_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_subscribe_popup_subtitle',
					'title'       => esc_html__( 'Subtitle', 'techlink-core' ),
					'description' => esc_html__( 'Enter subscribe popup window subtitle', 'techlink-core' )
				)
			);

			$subscribe_popup_section->add_field_element(
				array(
					'field_type' => 'image',
					'name'       => 'qodef_subscribe_popup_background_image',
					'title'      => esc_html__( 'Background Image', 'techlink-core' )
				)
			);

			$subscribe_popup_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_subscribe_popup_contact_form',
					'title'       => esc_html__( 'Select Contact Form', 'techlink-core' ),
					'description' => esc_html__( 'Choose contact form to display in subscribe popup window', 'techlink-core' ),
					'options'     => $contact_forms,
				)
			);

			$subscribe_popup_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_subscribe_popup_prevent',
					'title'         => esc_html__( 'Enable Subscribe Popup Prevent', 'techlink-core' ),
					'default_value' => 'no',
				)
			);

			$subscribe_popup_section->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_subscribe_popup_prevent_behavior',
					'title'       => esc_html__( 'Subscribe Popup Prevent Behavior', 'techlink-core' ),
					'description' => esc_html__( 'Choose how to manage popup prevent', 'techlink-core' ),
					'options'     => array(
						'session' => esc_html__( 'by Current Session', 'techlink-core' ),
						'cookies' => esc_html__( 'by Browser Cookies', 'techlink-core' )
					),
					'dependency'  => array(
						'show' => array(
							'qodef_enable_subscribe_popup_prevent' => array(
								'values'        => 'yes',
								'default_value' => ''
							)
						)
					),
				)
			);

			// Hook to include additional options after module options
			do_action( 'techlink_core_action_after_subscribe_popup_options_map', $subscribe_popup_section );
		}
	}

	add_action( 'techlink_core_action_default_options_init', 'techlink_core_add_subscribe_popup_options', techlink_core_get_admin_options_map_position( 'subscribe-popup' ) );
}