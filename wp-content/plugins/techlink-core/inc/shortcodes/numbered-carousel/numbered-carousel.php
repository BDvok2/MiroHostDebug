<?php

if ( ! function_exists( 'techlink_core_add_numbered_carousel_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function techlink_core_add_numbered_carousel_shortcode( $shortcodes ) {
		$shortcodes[] = 'TechLinkCoreNumberedCarouselShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'techlink_core_filter_register_shortcodes', 'techlink_core_add_numbered_carousel_shortcode' );
}

if ( class_exists( 'TechLinkCoreShortcode' ) ) {
	class TechLinkCoreNumberedCarouselShortcode extends TechLinkCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( TECHLINK_CORE_SHORTCODES_URL_PATH . '/numbered-carousel' );
			$this->set_base( 'techlink_core_numbered_carousel' );
			$this->set_name( esc_html__( 'Numbered Carousel', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds numbered carousel holder', 'techlink-core' ) );
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
						'field_type'    => 'text',
						'name'          => 'item_subtitle',
						'title'         => esc_html__( 'Subitle', 'techlink-core' )
					),
					array(
						'field_type'    => 'textarea',
						'name'          => 'item_text',
						'title'         => esc_html__( 'Text', 'techlink-core' )
					),
					array(
						'field_type'    => 'text',
						'name'          => 'item_button_text',
						'title'         => esc_html__( 'Button Text', 'techlink-core' )
					),
					array(
						'field_type'    => 'text',
						'name'          => 'item_link',
						'title'         => esc_html__( 'Button Link', 'techlink-core' )
					),
					array(
						'field_type'    => 'select',
						'name'          => 'item_target',
						'title'         => esc_html__( 'Button Target', 'techlink-core' ),
						'options'       => techlink_core_get_select_type_options_pool( 'link_target' ),
						'default_value' => '_self'
					),
					array(
						'field_type' => 'image',
						'name'       => 'item_image',
						'title'      => esc_html__( 'Image', 'techlink-core' )
					)
				)
			) );
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			$atts['this_shortcode'] = $this;
			
			return techlink_core_get_template_part( 'shortcodes/numbered-carousel', 'templates/numbered-carousel', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-numbered-carousel qodef-swiper-holder swiper-container-horizontal qodef-change-on-scroll qodef-pagination--numbers qodef-skin--light';

			return implode( ' ', $holder_classes );
		}

		public function get_image_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['item_image'] ) ) {
				$styles[] = 'background-image: url(' . esc_url( wp_get_attachment_url( $atts['item_image'] ) ) . ')';
			}

			return $styles;
		}
	}
}