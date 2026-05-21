<?php

if ( ! function_exists( 'techlink_core_add_icon_with_text_variation_before_content' ) ) {
	function techlink_core_add_icon_with_text_variation_before_content( $variations ) {
		
		$variations['before-content'] = esc_html__( 'Before Content', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_icon_with_text_layouts', 'techlink_core_add_icon_with_text_variation_before_content' );
}
