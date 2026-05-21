<?php

if ( ! function_exists( 'techlink_core_add_page_spinner_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function techlink_core_add_page_spinner_meta_box( $page ) {
		
		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_enable_page_spinner',
					'title'       => esc_html__( 'Enable Page Spinner', 'techlink-core' ),
					'description' => esc_html__( 'Enable Page Spinner Effect', 'techlink-core' ),
					'options'     => techlink_core_get_select_type_options_pool( 'yes_no' )
				)
			);
		}
	}
	
	add_action( 'techlink_core_action_after_general_page_meta_box_map', 'techlink_core_add_page_spinner_meta_box', 9 );
}