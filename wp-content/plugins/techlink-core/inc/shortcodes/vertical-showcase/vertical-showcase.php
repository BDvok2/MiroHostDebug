<?php

if ( ! function_exists( 'techlink_core_add_vertical_showcase_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function techlink_core_add_vertical_showcase_shortcode( $shortcodes ) {
		$shortcodes[] = 'TechLinkCoreVerticalShowcaseShortcode';

		return $shortcodes;
	}

	add_filter( 'techlink_core_filter_register_shortcodes', 'techlink_core_add_vertical_showcase_shortcode' );
}

if ( class_exists( 'TechLinkCoreShortcode' ) ) {
	class TechLinkCoreVerticalShowcaseShortcode extends TechLinkCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( TECHLINK_CORE_SHORTCODES_URL_PATH . '/vertical-showcase' );
			$this->set_base( 'techlink_core_vertical_showcase' );
			$this->set_name( esc_html__( 'Vertical Showcase', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds vertical showcase holder', 'techlink-core' ) );
			$this->set_category( esc_html__( 'TechLink Core', 'techlink-core' ) );
			$this->set_scripts(
				array(
					'swiper' => array(
						'registered'	=> true,
					),
					'techlink-main-js' => array(
						'registered'	=> true,
					)
				)
			);
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'techlink-core' ),
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'enable_phone_frame',
				'title'         => esc_html__( 'Enable Phone Frame', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'yes_no', false ),
				'default_value' => 'yes'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'enable_app_store_link',
				'title'         => esc_html__( 'Enable App Store Link', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no'
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'app_store_link',
				'title'      => esc_html__( 'App Store Link', 'techlink-core' ),
				'dependency' => array(
					'show' => array(
						'enable_app_store_link' => array(
							'values'        => 'yes',
							'default_value' => 'no'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'enable_play_store_link',
				'title'         => esc_html__( 'Enable Google Play Store Link', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no'
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'play_store_link',
				'title'      => esc_html__( 'Google Play Store Link', 'techlink-core' ),
				'dependency' => array(
					'show' => array(
						'enable_play_store_link' => array(
							'values'        => 'yes',
							'default_value' => 'no'
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'contact_form_title',
				'title'      => esc_html__( 'Contact Form Title', 'techlink-core' ),
				'group'      => esc_html__( 'Last Slide', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'contact_form_subtitle',
				'title'      => esc_html__( 'Contact Form Subtitle', 'techlink-core' ),
				'group'      => esc_html__( 'Last Slide', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'contact_form_text',
				'title'      => esc_html__( 'Contact Form Text', 'techlink-core' ),
				'group'      => esc_html__( 'Last Slide', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'contact_form_id',
				'title'      => esc_html__( 'Select Contact Form 7', 'techlink-core' ),
				'options'    => qode_framework_is_installed( 'contact_form_7' ) ? techlink_core_get_contact_form_7_forms() : array(),
				'group'      => esc_html__( 'Last Slide', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'last_slide_header_skin',
				'title'         => esc_html__( 'Header Skin', 'techlink-core' ),
				'options'       => array(
					'light' => esc_html__( 'Light', 'techlink-core' ),
					'dark'  => esc_html__( 'Dark', 'techlink-core' )
				),
				'default_value' => 'dark',
				'group'         => esc_html__( 'Last Slide', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Image Items', 'techlink-core' ),
				'items'   => array(
					array(
						'field_type'    => 'text',
						'name'          => 'item_title',
						'title'         => esc_html__( 'Title', 'techlink-core' )
					),
					array(
						'field_type'    => 'textarea',
						'name'          => 'item_text',
						'title'         => esc_html__( 'Text', 'techlink-core' )
					),
					array(
						'field_type' => 'image',
						'name'       => 'item_decoration',
						'title'      => esc_html__( 'Decoration', 'techlink-core' )
					),
					array(
						'field_type'    => 'text',
						'name'          => 'item_tagline',
						'title'         => esc_html__( 'Tagline', 'techlink-core' )
					),
					array(
						'field_type' => 'image',
						'name'       => 'item_image',
						'title'      => esc_html__( 'Image', 'techlink-core' )
					),
					array(
						'field_type'    => 'select',
						'name'          => 'item_header_skin',
						'title'         => esc_html__( 'Header Skin', 'techlink-core' ),
						'options'       => array(
							'light' => esc_html__( 'Light', 'techlink-core' ),
							'dark'  => esc_html__( 'Dark', 'techlink-core' )
						),
						'default_value' => 'dark'
					)
				)
			) );
			$this->map_extra_options();
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']  = $this->get_holder_classes( $atts );
			$atts['items']           = $this->parse_repeater_items( $atts['children'] );
			$atts['last_slide_data'] = $this->get_last_slide_data( $atts );
			$atts['this_shortcode']  = $this;

			return techlink_core_get_template_part( 'shortcodes/vertical-showcase', 'templates/vertical-showcase', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-vertical-showcase qodef-vertical-showcase-ready-animation';

			$holder_classes[] = $atts['enable_phone_frame'] == "no" ? 'qodef-vertical-showcase-no-frame' : '';

			return implode( ' ', $holder_classes );
		}

		public function get_slide_data( $slide ) {
			$data = array(
				'headerSkin' => ! empty( $slide['item_header_skin'] ) ? $slide['item_header_skin'] : 'dark'
			);

			return json_encode( $data );
		}

		private function get_last_slide_data( $atts ) {
			$data = array(
				'headerSkin' => ! empty( $atts['last_slide_header_skin'] ) ? $atts['last_slide_header_skin'] : 'dark'
			);

			return json_encode( $data );
		}
	}
}
