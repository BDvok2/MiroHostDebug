<?php

if ( ! function_exists( 'techlink_core_add_blog_list_variation_standard' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function techlink_core_add_blog_list_variation_standard( $variations ) {
		$variations['standard'] = esc_html__( 'Standard', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_blog_list_layouts', 'techlink_core_add_blog_list_variation_standard' );
}

if ( ! function_exists( 'techlink_core_load_blog_list_variation_standard_assets' ) ) {
	/**
	 * Function that return is global blog asses allowed for variation layout
	 *
	 * @param bool $is_enabled
	 * @param array $params
	 *
	 * @return bool
	 */
	function techlink_core_load_blog_list_variation_standard_assets( $is_enabled, $params ) {
		
		if ( $params['layout'] === 'standard' ) {
			$is_enabled = true;
		}
		
		return $is_enabled;
	}
	
	add_filter( 'techlink_core_filter_load_blog_list_assets', 'techlink_core_load_blog_list_variation_standard_assets', 10, 2 );
}

if ( ! function_exists( 'techlink_core_register_blog_list_standard_scripts' ) ) {
	/**
	 * Function that register modules 3rd party scripts
	 *
	 * @param array $scripts
	 *
	 * @return array
	 */
	function techlink_core_register_blog_list_standard_scripts( $scripts ) {

		$scripts['wp-mediaelement'] = array(
			'registered'	=> true
		);
		$scripts['mediaelement-vimeo'] = array(
			'registered'	=> true
		);

		return $scripts;
	}

	add_filter( 'techlink_core_filter_blog_list_register_scripts', 'techlink_core_register_blog_list_standard_scripts' );
}

if ( ! function_exists( 'techlink_core_register_blog_list_standard_styles' ) ) {
	/**
	 * Function that register modules 3rd party scripts
	 *
	 * @param array $styles
	 *
	 * @return array
	 */
	function techlink_core_register_blog_list_standard_styles( $styles ) {

		$styles['wp-mediaelement'] = array(
			'registered'	=> true
		);

		return $styles;
	}

	add_filter( 'techlink_core_filter_blog_list_register_styles', 'techlink_core_register_blog_list_standard_styles' );
}

if ( ! function_exists( 'techlink_core_add_blog_list_options_enable_author' ) ) {
	function techlink_core_add_blog_list_options_enable_author( $options ) {
		$blog_list_options   = array();
		
		$blog_list_options[] = array(
			'field_type' => 'select',
			'name'       => 'enable_media',
			'title'      => esc_html__( 'Enable Media', 'techlink-core' ),
			'options'       => array(
				'yes' => esc_html__( 'Yes', 'techlink-core' ),
				'no'  => esc_html__( 'No', 'techlink-core' )
			),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values' => 'standard'
					)
				)
			),
			'group'      => esc_html__( 'Additional Features', 'techlink-core' )
		);
		
		$blog_list_options[] = array(
			'field_type' => 'select',
			'name'       => 'enable_date',
			'title'      => esc_html__( 'Enable Date', 'techlink-core' ),
			'options'       => array(
				'yes' => esc_html__( 'Yes', 'techlink-core' ),
				'no'  => esc_html__( 'No', 'techlink-core' )
			),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values' => 'standard'
					)
				)
			),
			'group'      => esc_html__( 'Additional Features', 'techlink-core' )
		);
		
		$blog_list_options[] = array(
			'field_type' => 'select',
			'name'       => 'enable_category',
			'title'      => esc_html__( 'Enable Category', 'techlink-core' ),
			'options'       => array(
				'yes' => esc_html__( 'Yes', 'techlink-core' ),
				'no'  => esc_html__( 'No', 'techlink-core' )
			),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values' => 'standard'
					)
				)
			),
			'group'      => esc_html__( 'Additional Features', 'techlink-core' )
		);
		
		$blog_list_options[] = array(
			'field_type' => 'select',
			'name'       => 'enable_excerpt',
			'title'      => esc_html__( 'Enable Excerpt', 'techlink-core' ),
			'options'       => array(
				'yes' => esc_html__( 'Yes', 'techlink-core' ),
				'no'  => esc_html__( 'No', 'techlink-core' )
			),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values' => 'standard'
					)
				)
			),
			'group'      => esc_html__( 'Additional Features', 'techlink-core' )
		);
		
		$blog_list_options[] = array(
			'field_type' => 'select',
			'name'       => 'enable_content',
			'title'      => esc_html__( 'Enable Content', 'techlink-core' ),
			'options'       => array(
				'yes' => esc_html__( 'Yes', 'techlink-core' ),
				'no'  => esc_html__( 'No', 'techlink-core' )
			),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values' => 'standard'
					)
				)
			),
			'group'      => esc_html__( 'Additional Features', 'techlink-core' )
		);
		
		$blog_list_options[] = array(
			'field_type' => 'select',
			'name'       => 'enable_button',
			'title'      => esc_html__( 'Enable Button', 'techlink-core' ),
			'options'       => array(
				'yes' => esc_html__( 'Yes', 'techlink-core' ),
				'no'  => esc_html__( 'No', 'techlink-core' )
			),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values' => 'standard'
					)
				)
			),
			'group'      => esc_html__( 'Additional Features', 'techlink-core' )
		);
		
		$blog_list_options[] = array(
			'field_type' => 'select',
			'name'       => 'enable_button',
			'title'      => esc_html__( 'Enable Button', 'techlink-core' ),
			'options'       => array(
				'yes' => esc_html__( 'Yes', 'techlink-core' ),
				'no'  => esc_html__( 'No', 'techlink-core' )
			),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values' => 'standard'
					)
				)
			),
			'group'      => esc_html__( 'Additional Features', 'techlink-core' )
		);
		
		return array_merge( $options, $blog_list_options );
	}
	
	add_filter( 'techlink_core_filter_blog_list_extra_options', 'techlink_core_add_blog_list_options_enable_author', 10, 1 );
}