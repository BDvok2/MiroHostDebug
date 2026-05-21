<?php

if ( ! function_exists( 'techlink_core_add_icon_with_text_variation_before_title' ) ) {
	function techlink_core_add_icon_with_text_variation_before_title( $variations ) {
		
		$variations['before-title'] = esc_html__( 'Before Title', 'techlink-core' );
		
		return $variations;
	}
	
	add_filter( 'techlink_core_filter_icon_with_text_layouts', 'techlink_core_add_icon_with_text_variation_before_title' );
}
