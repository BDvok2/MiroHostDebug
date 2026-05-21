<?php

if ( ! function_exists( 'techlink_core_add_portfolio_item_list_meta_boxes' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function techlink_core_add_portfolio_item_list_meta_boxes( $page ) {

		if ( $page ) {

			$list_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-list',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'List Settings', 'techlink-core' ),
					'description' => esc_html__( 'Portfolio list settings', 'techlink-core' )
				)
			);

			$list_tab->add_field_element( array(
				'field_type'  => 'image',
				'name'        => 'qodef_portfolio_list_image',
				'title'       => esc_html__( 'Portfolio List Image', 'techlink-core' ),
				'description' => esc_html__( 'Upload image to be displayed on portfolio list instead of featured image', 'techlink-core' ),
			) );

			$list_tab->add_field_element( array(
				'field_type'  => 'select',
				'name'        => 'qodef_masonry_image_dimension_portfolio_item',
				'title'       => esc_html__( 'Image Dimension', 'techlink-core' ),
				'description' => esc_html__( 'Choose an image layout for "masonry behavior" portfolio list. If you are using fixed image proportions on the list, choose an option other than default', 'techlink-core' ),
				'options'     => techlink_core_get_select_type_options_pool( 'masonry_image_dimension' )
			) );

			$list_tab->add_field_element( array(
				'field_type'  => 'text',
				'name'        => 'qodef_portfolio_item_padding',
				'title'       => esc_html__( 'Portfolio Item Custom Padding', 'techlink-core' ),
				'description' => esc_html__( 'Choose item padding when it appears in portfolio list (ex. 5% 5% 5% 5%)', 'techlink-core' )
			) );

			$list_tab->add_field_element( array(
			    'field_type'  => 'color',
                'name'        => 'qodef_portfolio_item_overlay_color',
                'title'       => esc_html__( 'Portfolio Item Overlay Color', 'techlink-core' ),
                'description' => esc_html__( 'Choose background color for portfolio item overlay on Info On Hover layout')
            ) );

			$list_tab->add_field_element( array(
				'field_type'  => 'color',
				'name'        => 'qodef_portfolio_item_title_color',
				'title'       => esc_html__( 'Portfolio Item Title Color', 'techlink-core' ),
				'description' => esc_html__( 'Choose title color for portfolio item overlay on Info On Hover layout')
			) );
			$list_tab->add_field_element( array(
				'field_type'  => 'color',
				'name'        => 'qodef_portfolio_item_category_color',
				'title'       => esc_html__( 'Portfolio Item Category Color', 'techlink-core' ),
				'description' => esc_html__( 'Choose category color for portfolio item overlay on Info On Hover layout')
			) );
			
			// Hook to include additional options after module options
			do_action( 'techlink_core_action_after_portfolio_list_meta_box_map', $list_tab );
		}
	}

	add_action( 'techlink_core_action_after_portfolio_meta_box_map', 'techlink_core_add_portfolio_item_list_meta_boxes' );
}
