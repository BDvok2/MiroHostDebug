<?php

if ( ! function_exists( 'techlink_child_theme_enqueue_scripts' ) ) {
	/**
	 * Function that enqueue theme's child style
	 */
	function techlink_child_theme_enqueue_scripts() {
		$main_style = 'techlink-main';

		wp_enqueue_style( 'techlink-child-style', get_stylesheet_directory_uri() . '/style.css', array( $main_style ) );
		wp_enqueue_style( 'techlink-custom-fonts', get_stylesheet_directory_uri() . '/font/stylesheet.css', 'custom-fonts' );
	}

	add_action( 'wp_enqueue_scripts', 'techlink_child_theme_enqueue_scripts' );
}
