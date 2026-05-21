<?php

if ( ! function_exists( 'techlink_set_404_page_inner_classes' ) ) {
	/**
	 * Function that return classes for the page inner div from header.php
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function techlink_set_404_page_inner_classes( $classes ) {

		if ( is_404() ) {
			$classes = 'qodef-content-full-width';
		}

		return $classes;
	}

	add_filter( 'techlink_filter_page_inner_classes', 'techlink_set_404_page_inner_classes' );
}

if ( ! function_exists( 'techlink_get_404_page_parameters' ) ) {
	/**
	 * Function that set 404 page area content parameters
	 */
	function techlink_get_404_page_parameters() {

		$params = array(
			'title'       => esc_html__( 'Error Page', 'techlink' ),
			'text'        => esc_html__( 'The page you are looking for doesn\'t exist. It may have been moved or removed altogether. Please try searching for some other page, or return to the website\'s homepage to find what you\'re looking for.', 'techlink' ),
			'button_text' => esc_html__( 'Back to home', 'techlink' ),
		);

		return apply_filters( 'techlink_filter_404_page_template_params', $params );
	}
}
