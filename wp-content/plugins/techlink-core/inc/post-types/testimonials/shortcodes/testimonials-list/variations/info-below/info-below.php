<?php

if ( ! function_exists( 'techlink_core_add_testimonials_list_variation_info_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_testimonials_list_variation_info_below( $variations ) {
		$variations['info-below'] = esc_html__( 'Info Below', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_testimonials_list_layouts', 'techlink_core_add_testimonials_list_variation_info_below' );
}

if ( ! function_exists( 'techlink_core_add_testimonials_list_options_info_below' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function techlink_core_add_testimonials_list_options_info_below( $options ) {
		$info_below_options   = array(
			array(
				'field_type' => 'text',
				'name'       => 'info_below_content_padding',
				'title'      => esc_html__( 'Content Padding', 'techlink-core' ),
				'dependency' => array(
					'show' => array(
						'layout' => array(
							'values'        => 'info-below',
							'default_value' => 'default'
						)
					)
				),
				'group'      => esc_html__( 'Layout', 'techlink-core' )
			),
			array(
				'field_type'    => 'select',
				'name'          => 'disable_info_below_content_padding',
				'title'         => esc_html__( 'Disable Content Padding', 'techlink-core' ),
				'description'   => esc_html__( 'Enabling this option will disable content padding for screen size 1024 and lower', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no',
				'dependency'    => array(
					'show' => array(
						'layout' => array(
							'values'        => 'info-below',
							'default_value' => 'default'
						)
					)
				),
				'group'         => esc_html__( 'Layout', 'techlink-core' )
			)
		);
		
		return array_merge( $options, $info_below_options );
	}
	
	add_filter( 'techlink_core_filter_testimonials_list_extra_options', 'techlink_core_add_testimonials_list_options_info_below' );
}