<?php

if ( ! function_exists( 'techlink_core_add_team_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function techlink_core_add_team_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();
		$has_single     = techlink_core_team_has_single();
		
		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'team' ),
				'type'  => 'meta',
				'slug'  => 'team',
				'title' => esc_html__( 'Team Single', 'techlink-core' )
			)
		);
		
		if ( $page ) {
			$section = $page->add_section_element(
				array(
					'name'        => 'qodef_team_general_section',
					'title'       => esc_html__( 'General Settings', 'techlink-core' ),
					'description' => esc_html__( 'General information about team member.', 'techlink-core' )
				)
			);
			
			if ( $has_single ) {
				$section->add_field_element( array(
					'field_type'  => 'select',
					'name'        => 'qodef_team_single_layout',
					'title'       => esc_html__( 'Single Layout', 'techlink-core' ),
					'description' => esc_html__( 'Choose default layout for team single', 'techlink-core' ),
					'options'     => array(
						'' => esc_html__( 'Default', 'techlink-core' )
					)
				) );
			}
			
			$section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_member_role',
					'title'       => esc_html__( 'Role', 'techlink-core' ),
					'description' => esc_html__( 'Enter team member role', 'techlink-core' ),
				)
			);

            $section->add_field_element(
                array(
                    'field_type'  => 'image',
                    'name'        => 'qodef_team_member_hover_image',
                    'title'       => esc_html__( 'Hover Image', 'techlink-core' ),
                    'description' => esc_html__( 'Add a hover image that will be visible if Hover Animation is enabled in shortcode', 'techlink-core' ),
                )
            );
			
			$social_icons_repeater = $section->add_repeater_element(
				array(
					'name'        => 'qodef_team_member_social_icons',
					'title'       => esc_html__( 'Social Networks', 'techlink-core' ),
					'description' => esc_html__( 'Populate team member social networks info', 'techlink-core' ),
					'button_text' => esc_html__( 'Add New Network', 'techlink-core' )
				)
			);

			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_team_member_icon_text',
					'title'      => esc_html__( 'Icon Text', 'techlink-core' )
				)
			);
			
			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_team_member_icon_link',
					'title'      => esc_html__( 'Icon Link', 'techlink-core' )
				)
			);
			
			$social_icons_repeater->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_team_member_icon_target',
					'title'      => esc_html__( 'Icon Target', 'techlink-core' ),
					'options'    => techlink_core_get_select_type_options_pool( 'link_target' )
				)
			);
			
			if ( $has_single ) {
				$section->add_field_element( array(
					'field_type'  => 'date',
					'name'        => 'qodef_team_member_birth_date',
					'title'       => esc_html__( 'Birth Date', 'techlink-core' ),
					'description' => esc_html__( 'Enter team member birth date', 'techlink-core' ),
				) );
				
				$section->add_field_element( array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_member_email',
					'title'       => esc_html__( 'E-mail', 'techlink-core' ),
					'description' => esc_html__( 'Enter team member e-mail address', 'techlink-core' ),
				) );
				
				$section->add_field_element( array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_member_address',
					'title'       => esc_html__( 'Address', 'techlink-core' ),
					'description' => esc_html__( 'Enter team member address', 'techlink-core' ),
				) );
				
				$section->add_field_element( array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_member_education',
					'title'       => esc_html__( 'Education', 'techlink-core' ),
					'description' => esc_html__( 'Enter team member education', 'techlink-core' ),
				) );
				
				$section->add_field_element( array(
					'field_type'  => 'file',
					'name'        => 'qodef_team_member_resume',
					'title'       => esc_html__( 'Resume', 'techlink-core' ),
					'description' => esc_html__( 'Upload team member resume', 'techlink-core' ),
					'args'        => array(
						'allowed_type' => '[application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document]'
					)
				) );
			}
			
			// Hook to include additional options after module options
			do_action( 'techlink_core_action_after_team_meta_box_map', $page, $has_single );
		}
	}
	
	add_action( 'techlink_core_action_default_meta_boxes_init', 'techlink_core_add_team_single_meta_box' );
}