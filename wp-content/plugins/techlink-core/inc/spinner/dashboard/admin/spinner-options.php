<?php

if ( ! function_exists( 'techlink_core_add_page_spinner_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function techlink_core_add_page_spinner_options( $page ) {
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_page_spinner',
					'title'         => esc_html__( 'Enable Page Spinner', 'techlink-core' ),
					'description'   => esc_html__( 'Enable Page Spinner Effect', 'techlink-core' ),
					'default_value' => 'no'
				)
			);
			
			$spinner_section = $page->add_section_element(
				array(
					'name'       => 'qodef_page_spinner_section',
					'title'      => esc_html__( 'Page Spinner Section', 'techlink-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_page_spinner' => array(
								'values'        => 'yes',
								'default_value' => 'no'
							)
						)
					)
				)
			);
			
			$spinner_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_spinner_type',
					'title'         => esc_html__( 'Select Page Spinner Type', 'techlink-core' ),
					'description'   => esc_html__( 'Choose a page spinner animation style', 'techlink-core' ),
					'options'       => apply_filters( 'techlink_core_filter_page_spinner_layout_options', array() ),
					'default_value' => apply_filters( 'techlink_core_filter_page_spinner_default_layout_option', '' ),
				)
			);
			
			$spinner_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_spinner_background_color',
					'title'       => esc_html__( 'Spinner Background Color', 'techlink-core' ),
					'description' => esc_html__( 'Choose the spinner background color', 'techlink-core' )
				)
			);
			
			$spinner_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_spinner_color',
					'title'       => esc_html__( 'Spinner Color', 'techlink-core' ),
					'description' => esc_html__( 'Choose the spinner color', 'techlink-core' )
				)
			);

            $spinner_section->add_field_element(
                array(
                    'field_type'    => 'text',
                    'name'          => 'qodef_page_spinner_text',
                    'title'         => esc_html__( 'Spinner Text', 'techlink-core' ),
                    'description'   => esc_html__( 'Enter spinner text', 'techlink-core' ),
                    'dependency'    => array(
                        'show' => array(
                            'qodef_page_spinner_type' => array(
                                'values'        => 'techlink',
                                'default_value' => ''
                            )
                        )
                    )
                )
            );
			
			$spinner_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_page_spinner_fade_out_animation',
					'title'         => esc_html__( 'Enable Fade Out Animation', 'techlink-core' ),
					'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'techlink-core' ),
					'default_value' => 'no',
				)
			);
		}
	}
	
	add_action( 'techlink_core_action_after_general_options_map', 'techlink_core_add_page_spinner_options' );
}