<?php

if ( ! function_exists( 'techlink_core_set_page_content_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function techlink_core_set_page_content_styles( $style ) {
		$styles = array();
		
		$content_margin = apply_filters( 'techlink_core_filter_content_margin', 0 );
		
		if ( $content_margin !== 0 ) {
			$styles['margin-top'] = '-' . intval( $content_margin ) . 'px';
		}
		
		if ( ! empty( $styles ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-page-outer', $styles );
		}

		$content_lines_styles = array();

		if ( $content_margin !== 0 ) {
			$content_lines_styles['top'] = intval( $content_margin ) . 'px';
		}

		if ( ! empty( $content_lines_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-content-lines-holder, .qodef-content-special-line', $content_lines_styles );
		}


		$style_mobile = array();
		$content_margin_mobile = apply_filters( 'techlink_core_filter_content_margin_mobile', 0 );

		if ( $content_margin_mobile !== 0 ) {
			$style_mobile['margin-top'] = '-' . intval( $content_margin_mobile ) . 'px';
		}

		if ( ! empty( $style_mobile ) ) {
			$style .= qode_framework_dynamic_style_responsive( '#qodef-page-outer', $style_mobile, '', '1024' );
		}

		$content_lines_style_mobile = array();

		if ( $content_margin_mobile !== 0 ) {
			$content_lines_style_mobile['top'] = intval( $content_margin_mobile ) . 'px !important';
		}

		if ( ! empty( $content_lines_style_mobile ) ) {
			$style .= qode_framework_dynamic_style_responsive( '.qodef-content-lines-holder', $content_lines_style_mobile, '', '1024' );
		}

		return $style;
	}
	
	add_filter( 'techlink_filter_add_inline_style', 'techlink_core_set_page_content_styles' );
}
