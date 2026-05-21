<?php

if ( ! function_exists( 'techlink_core_filter_portfolio_list_info_on_hover_animation_options' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function techlink_core_filter_portfolio_list_info_on_hover_animation_options( $options ) {
		$hover_option  = array();
		$option_filter = apply_filters( 'techlink_core_filter_portfolio_list_info_on_hover_animation_options', array() );
		$options_map   = techlink_core_get_variations_options_map( $option_filter );
		
		$option = array(
			'field_type'    => 'select',
			'name'          => 'hover_animation_info-on-hover',
			'title'         => esc_html__( 'Hover Animation', 'techlink-core' ),
			'options'       => $option_filter,
			'default_value' => $options_map['default_value'],
			'dependency'    => array(
				'show' => array(
					'layout' => array(
						'values'        => 'info-on-hover',
						'default_value' => ''
					)
				)
			),
			'group'         => esc_html__( 'Layout', 'techlink-core' ),
			'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
		);
		
		$hover_option[] = $option;
		
		return array_merge( $options, $hover_option );
	}
	
	add_filter( 'techlink_core_filter_portfolio_list_hover_animation_options', 'techlink_core_filter_portfolio_list_info_on_hover_animation_options' );
}