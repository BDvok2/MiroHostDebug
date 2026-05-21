<?php

if ( ! function_exists( 'techlink_is_installed' ) ) {
	/**
	 * Function that checks if forward plugin installed
	 *
	 * @param string $plugin - plugin name
	 *
	 * @return bool
	 */
	function techlink_is_installed( $plugin ) {

		switch ( $plugin ) {
			case 'framework':
				return class_exists( 'QodeFramework' );
				break;
			case 'core':
				return class_exists( 'TechLinkCore' );
				break;
			case 'woocommerce':
				return class_exists( 'WooCommerce' );
				break;
			case 'gutenberg-page':
				$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : array();

				return method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor();
				break;
			case 'gutenberg-editor':
				return class_exists( 'WP_Block_Type' );
				break;
			default:
				return false;
		}
	}
}

if ( ! function_exists( 'techlink_include_theme_is_installed' ) ) {
	/**
	 * Function that set case is installed element for framework functionality
	 *
	 * @param bool $installed
	 * @param string $plugin - plugin name
	 *
	 * @return bool
	 */
	function techlink_include_theme_is_installed( $installed, $plugin ) {

		if ( 'theme' === $plugin ) {
			return class_exists( 'TechlinkHandler' );
		}

		return $installed;
	}

	add_filter( 'qode_framework_filter_is_plugin_installed', 'techlink_include_theme_is_installed', 10, 2 );
}

if ( ! function_exists( 'techlink_template_part' ) ) {
	/**
	 * Function that echo module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 */
	function techlink_template_part( $module, $template, $slug = '', $params = array() ) {
		echo techlink_get_template_part( $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'techlink_get_template_part' ) ) {
	/**
	 * Function that load module template part.
	 *
	 * @param string $module name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array $params array of parameters to pass to template
	 *
	 * @return string - string containing html of template
	 */
	function techlink_get_template_part( $module, $template, $slug = '', $params = array() ) {
		//HTML Content from template
		$html          = '';
		$template_path = TECHLINK_INC_ROOT_DIR . '/' . $module;

		$temp = $template_path . '/' . $template;
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params ); // @codingStandardsIgnoreLine
		}

		$template = '';

		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";

				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}

		if ( $template ) {
			ob_start();
			include( $template );
			$html = ob_get_clean();
		}

		return $html;
	}
}

if ( ! function_exists( 'techlink_get_page_id' ) ) {
	/**
	 * Function that returns current page id
	 * Additional conditional is to check if current page is any wp archive page (archive, category, tag, date etc.) and returns -1
	 *
	 * @return int
	 */
	function techlink_get_page_id() {
		$page_id = get_queried_object_id();

		if ( techlink_is_wp_template() ) {
			$page_id = - 1;
		}

		return apply_filters( 'techlink_filter_page_id', $page_id );
	}
}

if ( ! function_exists( 'techlink_is_wp_template' ) ) {
	/**
	 * Function that checks if current page default wp page
	 *
	 * @return bool
	 */
	function techlink_is_wp_template() {
		return is_archive() || is_search() || is_404() || ( is_front_page() && is_home() );
	}
}

if ( ! function_exists( 'techlink_get_ajax_status' ) ) {
	/**
	 * Function that return status from ajax functions
	 *
	 * @param string $status - success or error
	 * @param string $message - ajax message value
	 * @param string|array $data - returned value
	 * @param string $redirect - url address
	 */
	function techlink_get_ajax_status( $status, $message, $data = null, $redirect = '' ) {
		$response = array(
			'status'   => esc_attr( $status ),
			'message'  => esc_html( $message ),
			'data'     => $data,
			'redirect' => ! empty( $redirect ) ? esc_url( $redirect ) : '',
		);

		$output = json_encode( $response );

		exit( $output );
	}
}

if ( ! function_exists( 'techlink_get_button_element' ) ) {
	/**
	 * Function that returns button with provided params
	 *
	 * @param array $params - array of parameters
	 *
	 * @return string - string representing button html
	 */
	function techlink_get_button_element( $params ) {
		if ( class_exists( 'TechLinkCoreButtonShortcode' ) ) {
			return TechLinkCoreButtonShortcode::call_shortcode( $params );
		} else {
			$link   = isset( $params['link'] ) ? $params['link'] : '#';
			$target = isset( $params['target'] ) ? $params['target'] : '_self';
			$text   = isset( $params['text'] ) ? $params['text'] : '';

			$additional_class = '';

			if ($params['button_layout'] == 'textual') {
				$additional_class = 'qodef-additional-textual';
			}

			return '<a itemprop="url" class="' .  $additional_class . ' qodef-theme-button" href="' . esc_url( $link ) . '" target="' . esc_attr( $target ) . '">' . esc_html( $text ) . '</a>';
		}
	}
}

if ( ! function_exists( 'techlink_render_button_element' ) ) {
	/**
	 * Function that render button with provided params
	 *
	 * @param array $params - array of parameters
	 */
	function techlink_render_button_element( $params ) {
		echo techlink_get_button_element( $params );
	}
}

if ( ! function_exists( 'techlink_class_attribute' ) ) {
	/**
	 * Function that render class attribute
	 *
	 * @param string|array $class
	 */
	function techlink_class_attribute( $class ) {
		echo techlink_get_class_attribute( $class );
	}
}

if ( ! function_exists( 'techlink_get_class_attribute' ) ) {
	/**
	 * Function that return class attribute
	 *
	 * @param string|array $class
	 *
	 * @return string|mixed
	 */
	function techlink_get_class_attribute( $class ) {
		$value = techlink_is_installed( 'framework' ) ? qode_framework_get_class_attribute( $class ) : '';

		return $value;
	}
}

if ( ! function_exists( 'techlink_get_post_value_through_levels' ) ) {
	/**
	 * Function that returns meta value if exists
	 *
	 * @param string $name name of option
	 * @param int $post_id id of
	 *
	 * @return string value of option
	 */
	function techlink_get_post_value_through_levels( $name, $post_id = null ) {
		return techlink_is_installed( 'framework' ) && techlink_is_installed( 'core' ) ? techlink_core_get_post_value_through_levels( $name, $post_id ) : '';
	}
}

if ( ! function_exists( 'techlink_get_space_value' ) ) {
	/**
	 * Function that returns spacing value based on selected option
	 *
	 * @param string $text_value - textual value of spacing
	 *
	 * @return int
	 */
	function techlink_get_space_value( $text_value ) {
		return techlink_is_installed( 'core' ) ? techlink_core_get_space_value( $text_value ) : 0;
	}
}

if ( ! function_exists( 'techlink_wp_kses_html' ) ) {
	/**
	 * Function that does escaping of specific html.
	 * It uses wp_kses function with predefined attributes array.
	 *
	 * @param string $type - type of html element
	 * @param string $content - string to escape
	 *
	 * @return string escaped output
	 * @see wp_kses()
	 *
	 */
	function techlink_wp_kses_html( $type, $content ) {
		return techlink_is_installed( 'framework' ) ? qode_framework_wp_kses_html( $type, $content ) : $content;
	}
}

if ( ! function_exists( 'techlink_render_svg_icon' ) ) {
	/**
	 * Function that print svg html icon
	 *
	 * @param string $name - icon name
	 * @param string $class_name - custom html tag class name
	 */
	function techlink_render_svg_icon( $name, $class_name = '' ) {
		echo techlink_get_svg_icon( $name, $class_name );
	}
}

if ( ! function_exists( 'techlink_get_svg_icon' ) ) {
	/**
	 * Returns svg html
	 *
	 * @param string $name - icon name
	 * @param string $class_name - custom html tag class name
	 *
	 * @return string|html
	 */
	function techlink_get_svg_icon( $name, $class_name = '' ) {
		$html  = '';
		$class = isset( $class_name ) && ! empty( $class_name ) ? 'class="' . esc_attr( $class_name ) . '"' : '';

		switch ( $name ) {
			case 'menu':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"><line x1="12" y1="21" x2="52" y2="21"/><line x1="12" y1="33" x2="52" y2="33"/><line x1="12" y1="45" x2="52" y2="45"/></svg>';
				break;
			case 'search':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="17px" height="16px" viewBox="0 0 17 16" style="enable-background:new 0 0 17 16;" xml:space="preserve"><g><path d="M7.06,14.12C3.17,14.12,0,10.95,0,7.06C0,3.17,3.17,0,7.06,0c3.89,0,7.06,3.17,7.06,7.06 C14.13,10.95,10.96,14.12,7.06,14.12z M7.06,0.85c-3.43,0-6.22,2.79-6.22,6.21c0,3.43,2.79,6.21,6.22,6.21 c3.43,0,6.22-2.79,6.22-6.21C13.28,3.63,10.49,0.85,7.06,0.85z"/></g><g><path d="M16.58,16c-0.1,0-0.2-0.03-0.28-0.1l-4.68-3.83c-0.18-0.15-0.2-0.42-0.04-0.6c0.15-0.18,0.42-0.2,0.6-0.04 l4.68,3.83c0.18,0.15,0.2,0.42,0.04,0.6C16.81,15.95,16.7,16,16.58,16z"/></g></svg>';
				break;
			case 'star':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32"><g><path d="M 20.756,11.768L 15.856,1.84L 10.956,11.768L0,13.36L 7.928,21.088L 6.056,32L 15.856,26.848L 25.656,32L 23.784,21.088L 31.712,13.36 z"></path></g></svg>';
				break;
			case 'menu-arrow-right':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32"><g><path d="M 13.8,24.196c 0.39,0.39, 1.024,0.39, 1.414,0l 6.486-6.486c 0.196-0.196, 0.294-0.454, 0.292-0.71 c0-0.258-0.096-0.514-0.292-0.71L 15.214,9.804c-0.39-0.39-1.024-0.39-1.414,0c-0.39,0.39-0.39,1.024,0,1.414L 19.582,17 L 13.8,22.782C 13.41,23.172, 13.41,23.806, 13.8,24.196z"></path></g></svg>';
				break;
			case 'slider-arrow-left':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15px" height="20px" viewBox="0 0 15 29" style="enable-background:new 0 0 15 29;" xml:space="preserve"><line stroke-linecap="round" stroke-miterlimit="10" x1="14.2" y1="1.1" x2="0.8" y2="14.5"/><line stroke-linecap="round" stroke-miterlimit="10" x1="14.2" y1="27.9" x2="0.8" y2="14.5"/></svg>';
				break;
			case 'slider-arrow-left-alt':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="74px" height="29px" viewBox="0 0 74 29" style="enable-background:new 0 0 74 29;" xml:space="preserve"><line stroke-linecap="round" stroke-miterlimit="10" x1="13.9" y1="1.1" x2="0.5" y2="14.5"/><line stroke-linecap="round" stroke-miterlimit="10" class="st0" x1="13.9" y1="27.9" x2="0.5" y2="14.5"/><line stroke-linecap="round" stroke-miterlimit="10" class="st0" x1="0.5" y1="14.5" x2="73.5" y2="14.5"/></svg>';
				break;
			case 'slider-arrow-right':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15px" height="20px" viewBox="0 0 15 29" style="enable-background:new 0 0 15 29;" xml:space="preserve"><line stroke-linecap="round" stroke-miterlimit="10" x1="0.8" y1="1.1" x2="14.2" y2="14.5"/><line stroke-linecap="round" stroke-miterlimit="10" x1="0.8" y1="27.9" x2="14.2" y2="14.5"/></svg>';
				break;
			case 'slider-arrow-right-alt':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="74px" height="29px" viewBox="0 0 74 29" style="enable-background:new 0 0 74 29;" xml:space="preserve"><line stroke-linecap="round" stroke-miterlimit="10" x1="60.1" y1="1.1" x2="73.5" y2="14.5"/><line stroke-linecap="round" stroke-miterlimit="10" x1="60.1" y1="27.9" x2="73.5" y2="14.5"/><line stroke-linecap="round" stroke-miterlimit="10" x1="73.5" y1="14.5" x2="0.5" y2="14.5"/></svg>';
				break;
			case 'pagination-arrow-left':
                $html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="17px" viewBox="0 0 30 17" style="enable-background:new 0 0 30 17;" xml:space="preserve"><style type="text/css">.st0{fill:none;stroke:#000000;stroke-linecap:round;stroke-miterlimit:10;}</style><g><line class="st0" x1="8.6" y1="0.5" x2="0.6" y2="8.5"/><line class="st0" x1="8.7" y1="16.5" x2="0.6" y2="8.5"/><line class="st0" x1="0.6" y1="8.5" x2="29.4" y2="8.5"/></g></svg>';
				break;
			case 'pagination-arrow-right':
                $html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="30px" height="17px" viewBox="0 0 30 17" style="enable-background:new 0 0 30 17;" xml:space="preserve"><style type="text/css">.st0{fill:none;stroke:#000000;stroke-linecap:round;stroke-miterlimit:10;}</style><g><line class="st0" x1="8.6" y1="0.5" x2="0.6" y2="8.5"/><line class="st0" x1="8.7" y1="16.5" x2="0.6" y2="8.5"/><line class="st0" x1="0.6" y1="8.5" x2="29.4" y2="8.5"/></g></svg>';
				break;
			case 'close':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32"><g><path d="M 10.050,23.95c 0.39,0.39, 1.024,0.39, 1.414,0L 17,18.414l 5.536,5.536c 0.39,0.39, 1.024,0.39, 1.414,0 c 0.39-0.39, 0.39-1.024,0-1.414L 18.414,17l 5.536-5.536c 0.39-0.39, 0.39-1.024,0-1.414c-0.39-0.39-1.024-0.39-1.414,0 L 17,15.586L 11.464,10.050c-0.39-0.39-1.024-0.39-1.414,0c-0.39,0.39-0.39,1.024,0,1.414L 15.586,17l-5.536,5.536 C 9.66,22.926, 9.66,23.56, 10.050,23.95z"></path></g></svg>';
				break;
			case 'close-alt':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="22px" height="22px" viewBox="0 0 22 22" style="enable-background:new 0 0 22 22;" xml:space="preserve"><g><path d="M21.6,1.1L1.1,21.6c-0.2,0.2-0.5,0.2-0.7,0h0c-0.2-0.2-0.2-0.5,0-0.7L20.9,0.4c0.2-0.2,0.5-0.2,0.7,0v0 C21.8,0.6,21.8,0.9,21.6,1.1z"/></g><g><path d="M1.1,0.4l6.4,6.4c0.2,0.2,0.2,0.5,0,0.7l0,0C7.3,7.7,7,7.7,6.8,7.5L0.4,1.1c-0.2-0.2-0.2-0.5,0-0.7l0,0 C0.6,0.2,0.9,0.2,1.1,0.4z"/></g><g><path d="M15.2,14.5l6.4,6.4c0.2,0.2,0.2,0.5,0,0.7l0,0c-0.2,0.2-0.5,0.2-0.7,0l-6.4-6.4c-0.2-0.2-0.2-0.5,0-0.7l0,0 C14.7,14.3,15,14.3,15.2,14.5z"/></g></svg>';
				break;
			case 'spinner':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z"></path></svg>';
				break;
			case 'link':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="72px" height="72px" viewBox="0 0 70 70" style="enable-background:new 0 0 70 70;" xml:space="preserve"><style type="text/css">.st001{fill:#EBECED;}</style><path class="st001" d="M55.54,44.36l3.52,3.54c3.04,3.07,3.05,8.06,0,11.13c-1.46,1.48-3.4,2.28-5.47,2.28 c-2.07,0-4.01-0.81-5.48-2.28L35.17,46c-2.68-2.7-6.63-7.79-2.95-11.49c1.69-1.7,1.68-4.45-0.02-6.14c-1.7-1.69-4.45-1.68-6.13,0.02 c-6.25,6.3-5.09,15.61,2.95,23.71l12.93,13.04C45.05,68.28,49.18,70,53.58,70c4.4,0,8.52-1.72,11.63-4.85 C68.4,61.93,70,57.7,70,53.47c0-4.23-1.6-8.46-4.79-11.68l-3.52-3.54c-1.69-1.7-4.43-1.71-6.13-0.02 C53.86,39.92,53.85,42.67,55.54,44.36L55.54,44.36z"/><path class="st001" d="M5.29,4.85c-6.71,6.76-7.08,16.22-0.86,22.48l4.38,4.41c1.69,1.7,4.43,1.71,6.13,0.02 c1.7-1.69,1.71-4.43,0.02-6.13l-4.38-4.41c-3.22-3.25-1.88-7.49,0.86-10.26c1.47-1.48,3.41-2.29,5.48-2.29 c2.07,0,4.01,0.81,5.48,2.29l13.8,13.91c6.31,6.36,3.35,9.34,2.08,10.62c-1.69,1.7-1.67,4.45,0.02,6.14 c1.7,1.69,4.45,1.68,6.14-0.02c2.9-2.92,4.33-6.26,4.33-9.75c0-4.28-2.15-8.8-6.42-13.1L28.55,4.85C25.45,1.72,21.31,0,16.92,0 C12.53,0,8.4,1.72,5.29,4.85L5.29,4.85z"/></svg>';
				break;
			case 'quote':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px" height="72px" viewBox="0 0 100 72" style="enable-background:new 0 0 100 72;" xml:space="preserve"><style type="text/css">.st001{fill:#EBECED;}</style><path class="st001" d="M39.97,6.18c4.34,4.12,6.51,9.59,6.51,16.41c0,3.06-0.41,6.12-1.23,9.18c-0.82,3.06-2.7,7.71-5.63,13.94 L27.29,72H2.64l8.8-29.82c-3.64-1.76-6.46-4.32-8.45-7.68C1,31.15,0,27.18,0,22.59C0,15.77,2.17,10.3,6.51,6.18 C10.86,2.06,16.43,0,23.24,0C30.05,0,35.62,2.06,39.97,6.18z"/><path class="st001" d="M93.49,6.18c4.34,4.12,6.51,9.59,6.51,16.41c0,3.06-0.41,6.12-1.23,9.18c-0.82,3.06-2.7,7.71-5.63,13.94 L80.81,72H56.16l8.8-29.82c-3.64-1.76-6.46-4.32-8.45-7.68c-2-3.35-2.99-7.32-2.99-11.91c0-6.82,2.17-12.29,6.51-16.41 C64.38,2.06,69.95,0,76.76,0C83.57,0,89.14,2.06,93.49,6.18z"/></svg>';
				break;
			case 'testimonials-quote':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 95 82" style="enable-background:new 0 0 95 82;" xml:space="preserve"><g><path d="M2.1,67.12c5.81-1.62,10.52-4.61,14.13-8.96c3.61-4.36,5.41-10.08,5.41-17.16H0V0h39.98v37.36 c0,12.95-2.76,23.08-8.27,30.37C26.2,75.01,17.74,79.77,6.31,82L2.1,67.12z"/><path d="M57.12,67.12c5.81-1.62,10.52-4.61,14.13-8.96c3.61-4.36,5.41-10.08,5.41-17.16H55.02V0H95v37.36 c0,12.95-2.76,23.08-8.27,30.37C81.22,75.01,72.75,79.77,61.33,82L57.12,67.12z"/></g></svg>';
				break;
			case 'single-nav-arrow-left':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12" height="24" x="0px" y="0px" viewBox="0 0 11 22" xml:space="preserve"><g><rect x="5" y="8.45" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -9.6673 8.5607)" width="1" height="15"/></g><g><rect x="-2" y="5.55" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -2.6673 5.6612)" width="15" height="1"/></g></svg>';
				break;
			case 'single-nav-arrow-right':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="12" height="24" x="0px" y="0px" viewBox="0 0 11 22" xml:space="preserve"><g><rect x="-2" y="15.45" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -9.6673 8.5607)" width="15" height="1"/></g><g><rect x="5" y="-1.45" transform="matrix(0.7071 -0.7071 0.7071 0.7071 -2.6673 5.6612)" width="1" height="15"/></g></svg>';
				break;
			case 'back-to-home':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="22" height="22" x="0px" y="0px" viewBox="0 0 22 22" xml:space="preserve"><path d="M6,8H2C0.9,8,0,7.1,0,6V2c0-1.1,0.9-2,2-2h4c1.1,0,2,0.9,2,2v4C8,7.1,7.1,8,6,8z"/><path d="M20,8h-4c-1.1,0-2-0.9-2-2V2c0-1.1,0.9-2,2-2h4c1.1,0,2,0.9,2,2v4C22,7.1,21.1,8,20,8z"/><path d="M6,22H2c-1.1,0-2-0.9-2-2v-4c0-1.1,0.9-2,2-2h4c1.1,0,2,0.9,2,2v4C8,21.1,7.1,22,6,22z"/><path d="M20,22h-4c-1.1,0-2-0.9-2-2v-4c0-1.1,0.9-2,2-2h4c1.1,0,2,0.9,2,2v4C22,21.1,21.1,22,20,22z"/></svg>';
				break;
			case 'dropdown-cart':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15px" height="17px" viewBox="0 0 15 17" style="enable-background:new 0 0 15 17;" xml:space="preserve"><style type="text/css">.st01{fill:#262626;}</style><path class="st01" d="M14.57,4.53h-3.29V3.57C11.28,1.6,9.58,0,7.5,0S3.72,1.6,3.72,3.57v0.96H0.43C0.19,4.53,0,4.71,0,4.93v9.46 C0,15.83,1.24,17,2.76,17h9.47c1.52,0,2.76-1.17,2.76-2.61V4.93C15,4.71,14.81,4.53,14.57,4.53z M4.58,3.57 c0-1.52,1.31-2.76,2.92-2.76s2.92,1.24,2.92,2.76v0.96H4.58V3.57z M14.14,14.39c0,0.99-0.85,1.8-1.91,1.8H2.76 c-1.05,0-1.91-0.81-1.91-1.8V5.34h2.87v1.22c0,0.22,0.19,0.4,0.43,0.4s0.43-0.18,0.43-0.4V5.34h5.84v1.22c0,0.22,0.19,0.4,0.43,0.4 c0.24,0,0.43-0.18,0.43-0.4V5.34h2.87V14.39z"/></svg>';
				break;
			case 'play':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 24 24" fill="#fff" width="18px" height="18px"><path d="M0 0h24v24H0z" fill="none"/><path d="M8 5v14l11-7z"/></svg>';
				break;
			case 'plus':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15px" height="15px" viewBox="0 0 15 15" style="enable-background:new 0 0 15 15;" xml:space="preserve"><g><rect y="7" width="15" height="1"/></g><g><rect x="7" width="1" height="15"/></g></svg>';
				break;
			case 'minus':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="15px" height="1px" viewBox="0 0 15 1" style="enable-background:new 0 0 15 1;" xml:space="preserve"><g><rect width="15" height="1"/></g></svg>';
				break;
			case 'decoration':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="53px" height="86px" viewBox="0 0 53 86" style="enable-background:new 0 0 53 86;" xml:space="preserve"><g><path d="M26.5,0c0,22,26,21,26,43"/><path d="M26.5,86c0-22,26-21,26-43"/></g><g><path d="M26.5,0C26.5,22,46,21,46,43"/><path d="M26.5,86C26.5,64,46,65,46,43"/></g><g><path d="M26.5,0c0,22,13,21,13,43"/><path d="M26.5,86c0-22,13-21,13-43"/></g><g><path d="M26.5,0c0,22,6.5,21,6.5,43"/><path d="M26.5,86c0-22,6.5-21,6.5-43"/></g><g><path d="M26.5,86c0-22-26-21-26-43"/><path d="M26.5,0c0,22-26,21-26,43"/></g><g><path d="M26.5,86C26.5,64,7,65,7,43"/><path d="M26.5,0C26.5,22,7,21,7,43"/></g><g><path d="M26.5,86c0-22-13-21-13-43"/><path d="M26.5,0c0,22-13,21-13,43"/></g><g><path d="M26.5,86c0-22-6.5-21-6.5-43"/><path d="M26.5,0c0,22-6.5,21-6.5,43"/></g></svg>';
				break;
            case 'letter':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="20px" height="14px" viewBox="0 0 20 14" style="enable-background:new 0 0 20 14;" xml:space="preserve"><style type="text/css">.st0{fill:#FFFFFF;} .st1{fill:none;stroke:#FFFFFF;stroke-miterlimit:10;}</style><g><path class="st0" d="M19,1v12H1V1H19 M20,0H0v14h20V0L20,0z"/></g><polyline class="st1" points="19.5,0.5 10,10 0.5,0.5 "/></svg>';
				break;
            case 'preloader':
                $html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="100px" height="100px" viewBox="0 0 100 92" style="enable-background:new 0 0 100 92;" xml:space="preserve"><mask id="qodef-mask--1"><g><path d="M97.5,36.9c-3-5.2-8.2-8.6-14.7-9.5l-14.9-0.3h-36l0,0l7.7,13.1h20.7h15.2h3.3c0.7,0,1.3,0.1,2,0.2l0,0c2.6,0.4,4.3,1.4,5.3,3.1c1.6,2.7,0.4,5.8-0.8,7.9L72.1,74.2c-1.2,2.1-3.4,4.7-6.5,4.7c-1.9,0-3.5-0.9-5.1-2.7l-2.9-4.9L50,84.1c4.1,5.1,9.6,7.9,15.6,7.9c7.2,0,13.8-4.1,17.9-11.2L96.7,58C100.8,50.9,101.1,43.2,97.5,36.9z"/></g></mask><mask id="qodef-mask--2"><g><path d="M60.3,40.2L42.5,71.3l-1.6,2.9c-0.3,0.6-0.7,1.1-1.1,1.7c-1.6,2-3.4,3-5.3,3c-3.1,0-5.3-2.5-6.5-4.7L14.7,51.4c-1.2-2.1-2.4-5.2-0.8-7.9c1-1.7,2.7-2.8,4.9-3.3h5.6l-7.2-13.1c-6.4,1-11.6,4.4-14.6,9.8c-3.7,6.3-3.4,14,0.7,21.1l13.2,22.8C20.6,87.9,27.1,92,34.4,92c6,0,11.5-2.8,15.6-7.9l7.7-12.8l17.8-31.1C75.5,40.2,60.3,40.2,60.3,40.2z"/></g></mask><mask id="qodef-mask--3"><g><path d="M81.9,9.8C78.2,3.6,71.4,0,63.2,0H36.8c-8.3,0-15.1,3.6-18.7,9.8c-3,5.1-3.3,11.3-1,17.3l7.2,13.1l18.1,31.1L50,58.1L39.6,40.2l0,0l-7.7-13.1l-1.6-2.7c-0.3-0.6-0.6-1.2-0.9-1.8c-1-2.4-0.9-4.4,0.1-6.1c1.6-2.7,4.8-3.3,7.3-3.3h26.3c2.5,0,5.7,0.6,7.3,3.3c0.9,1.6,1,3.5,0.2,5.7l-2.8,4.9c0,0,12.3,0.3,14.9,0.3C85.2,21.2,84.8,15,81.9,9.8z"/></g></mask><g xmlns="http://www.w3.org/2000/svg" mask="url(#qodef-mask--2)"><path class="qodef-path qodef--1" d="M28.1,33.6h-9.9c-4.5,0.7-8,3.1-10,6.6C5.8,44.4,6.1,49.6,9,54.7l13.2,22.8c3,5.1,7.3,8,12.2,8c4,0,7.6-1.9,10.5-5.5c0.6-0.8,1.2-1.6,1.7-2.5l25.1-43.8"/></g><g xmlns="http://www.w3.org/2000/svg" mask="url(#qodef-mask--1)"><path class="qodef-path qodef--2" d="M50.1,71.3l5,8.7c2.9,3.6,6.5,5.5,10.5,5.5c4.9,0,9.2-2.8,12.2-8L91,54.7c3-5.1,3.3-10.3,0.8-14.5c-2-3.5-5.5-5.6-10-6.3c-1-0.2-2-0.2-3-0.2H28.1"/></g><g xmlns="http://www.w3.org/2000/svg" mask="url(#qodef-mask--3)"><path class="qodef-path qodef--3" d="M71.7,33.7l5-8.7c1.7-4.3,1.5-8.4-0.5-11.8c-2.4-4.2-7.1-6.6-13-6.6H36.8c-5.9,0-10.5,2.3-13,6.6c-2,3.5-2.2,7.6-0.5,11.8c0.4,0.9,0.8,1.8,1.3,2.7l25.4,43.6"/></g></svg>';
                break;
		}

		return $html;
	}
}
