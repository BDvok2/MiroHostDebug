<?php

if ( ! function_exists( 'techlink_core_add_working_hours_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function techlink_core_add_working_hours_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => TECHLINK_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'working-hours',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( 'Working Hours', 'techlink-core' ),
				'description' => esc_html__( 'Global Working Hours Options', 'techlink-core' )
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_working_hours_monday',
					'title'      => esc_html__( 'Working Hours For Monday', 'techlink-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_working_hours_tuesday',
					'title'      => esc_html__( 'Working Hours For Tuesday', 'techlink-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_working_hours_wednesday',
					'title'      => esc_html__( 'Working Hours For Wednesday', 'techlink-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_working_hours_thursday',
					'title'      => esc_html__( 'Working Hours For Thursday', 'techlink-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_working_hours_friday',
					'title'      => esc_html__( 'Working Hours For Friday', 'techlink-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_working_hours_saturday',
					'title'      => esc_html__( 'Working Hours For Saturday', 'techlink-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_working_hours_sunday',
					'title'      => esc_html__( 'Working Hours For Sunday', 'techlink-core' )
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'checkbox',
					'name'       => 'qodef_working_hours_special_days',
					'title'      => esc_html__( 'Special Days', 'techlink-core' ),
					'options'    => array(
						'monday'    => esc_html__( 'Monday', 'techlink-core' ),
						'tuesday'   => esc_html__( 'Tuesday', 'techlink-core' ),
						'wednesday' => esc_html__( 'Wednesday', 'techlink-core' ),
						'thursday'  => esc_html__( 'Thursday', 'techlink-core' ),
						'friday'    => esc_html__( 'Friday', 'techlink-core' ),
						'saturday'  => esc_html__( 'Saturday', 'techlink-core' ),
						'sunday'    => esc_html__( 'Sunday', 'techlink-core' ),
					)
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_working_hours_special_text',
					'title'      => esc_html__( 'Featured Text For Special Days', 'techlink-core' )
				)
			);

			// Hook to include additional options after module options
			do_action( 'techlink_core_action_after_working_hours_options_map', $page );
		}
	}

	add_action( 'techlink_core_action_default_options_init', 'techlink_core_add_working_hours_options', techlink_core_get_admin_options_map_position( 'working-hours' ) );
}