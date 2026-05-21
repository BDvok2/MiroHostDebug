<?php

if ( ! function_exists( 'techlink_core_add_icon_with_text_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function techlink_core_add_icon_with_text_shortcode( $shortcodes ) {
		$shortcodes[] = 'TechLinkCoreIconWithTextShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'techlink_core_filter_register_shortcodes', 'techlink_core_add_icon_with_text_shortcode' );
}

if ( ! function_exists( 'techlink_core_add_svg_content_filter_atts' ) ) {
	/**
	 * Function that adds svg content filter attributes
	 *
	 * @param $atts array
	 *
	 * @return array
	 */
	function techlink_core_add_svg_content_filter_atts( $atts ) {

		$atts['polyline'] = array(
			'd'                 => true,
			'stroke'            => true,
			'stroke-width'      => true,
			'stroke-miterlimit' => true,
			'fill'              => true,
			'fill-opacity'      => true,
			'points'            => true,
		);

		return $atts;
	}

	add_filter( 'qode_framework_filter_wp_kses_svg_atts', 'techlink_core_add_svg_content_filter_atts' );
}

if ( class_exists( 'TechLinkCoreShortcode' ) ) {
	class TechLinkCoreIconWithTextShortcode extends TechLinkCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'techlink_core_filter_icon_with_text_layouts', array() ) );
			
			$options_map = techlink_core_get_variations_options_map( $this->get_layouts() );
			$default_value = $options_map['default_value'];
			
			$this->set_extra_options( apply_filters( 'techlink_core_filter_icon_with_text_extra_options', array(), $default_value ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( TECHLINK_CORE_SHORTCODES_URL_PATH . '/icon-with-text' );
			$this->set_base( 'techlink_core_icon_with_text' );
			$this->set_name( esc_html__( 'Icon With Text', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds icon with text element', 'techlink-core' ) );
			$this->set_category( esc_html__( 'TechLink Core', 'techlink-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'techlink-core' ),
			) );
			
			$options_map = techlink_core_get_variations_options_map( $this->get_layouts() );
			
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'layout',
				'title'         => esc_html__( 'Layout', 'techlink-core' ),
				'options'		=> $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
			) );
			$this->set_option( array(
				'field_type'    => 'text',
				'name'          => 'link',
				'title'         => esc_html__( 'Link', 'techlink-core' ),
				'default_value' => ''
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Link Target', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'icon_type',
				'title'         => esc_html__( 'Icon Type', 'techlink-core' ),
				'options'       => array(
					'icon-pack'   => esc_html__( 'Icon Pack', 'techlink-core' ),
					'custom-icon' => esc_html__( 'Custom Icon', 'techlink-core' ),
					'svg-icon'    => esc_html__( 'SVG Icon', 'techlink-core' )
				),
				'default_value' => 'icon-pack',
				'group'         => esc_html__( 'Icon', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'custom_icon',
				'title'      => esc_html__( 'Custom Icon', 'techlink-core' ),
				'group'      => esc_html__( 'Icon', 'techlink-core' ),
				'dependency' => array(
					'show' => array(
						'icon_type' => array(
							'values'        => 'custom-icon',
							'default_value' => 'icon-pack'
						)
					)
				)
			) );
            $this->set_option( array(
                'field_type' => 'image',
                'name'       => 'custom_icon_hover',
                'title'      => esc_html__( 'Custom Icon Hover', 'techlink-core' ),
                'group'      => esc_html__( 'Icon', 'techlink-core' ),
                'dependency' => array(
                    'show' => array(
                        'icon_type' => array(
                            'values'        => 'custom-icon',
                            'default_value' => 'icon-pack'
                        )
                    )
                )
            ) );
			$this->set_option( array(
				'field_type' => 'textarea_html',
				'name'       => 'svg_icon',
				'title'      => esc_html__( 'SVG code', 'techlink-core' ),
				'group'      => esc_html__( 'Icon', 'techlink-core' ),
				'dependency' => array(
					'show' => array(
						'icon_type' => array(
							'values'        => 'svg-icon',
							'default_value' => 'icon-pack'
						)
					)
				)
			) );
			$this->set_option( array(
                'field_type' => 'text',
                'name'       => 'vertical_offset_custom',
                'title'      => esc_html__( 'Vertical Offset', 'techlink-core' ),
				'group'      => esc_html__( 'Icon', 'techlink-core' ),
				'dependency' => array(
					'show' => array(
						'icon_type' => array(
							'values'        => array('custom-icon', 'svg-icon'),
							'default_value' => 'icon-pack'
						)
					)
				)
            ) );
			$this->import_shortcode_options( array(
				'shortcode_base'    => 'techlink_core_icon',
				'exclude'           => array( 'custom-class', 'link', 'target', 'margin' ),
				'additional_params' => array(
					'group'      => esc_html__( 'Icon', 'techlink-core' ),
					'dependency' => array(
						'show' => array(
							'icon_type' => array(
								'values'        => 'icon-pack',
								'default_value' => 'icon-pack'
							)
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'techlink-core' ),
				'group'      => esc_html__( 'Content', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'h4',
				'group'         => esc_html__( 'Content', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'techlink-core' ),
				'group'      => esc_html__( 'Content', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title_margin_top',
				'title'      => esc_html__( 'Title Margin Top', 'techlink-core' ),
				'group'      => esc_html__( 'Content', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'textarea',
				'name'       => 'text',
				'title'      => esc_html__( 'Text', 'techlink-core' ),
				'group'      => esc_html__( 'Content', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_font_size',
				'title'      => esc_html__( 'Text Font Size', 'techlink-core' ),
				'group'      => esc_html__( 'Content', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'text_color',
				'title'      => esc_html__( 'Text Color', 'techlink-core' ),
				'group'      => esc_html__( 'Content', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_margin_top',
				'title'      => esc_html__( 'Text Margin Top', 'techlink-core' ),
				'group'      => esc_html__( 'Content', 'techlink-core' )
			) );
            $this->set_option( array(
                'field_type'    => 'select',
                'name'          => 'appear_animation',
                'title'         => esc_html__( 'Appear Animation', 'techlink-core' ),
                'options'       => techlink_core_get_select_type_options_pool( 'no_yes', false ),
                'default_value' => 'no',
                'group'         => esc_html__( 'Animation Options', 'techlink-core' )
            ) );
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'techlink_core_icon_with_text', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']     = $this->get_holder_classes( $atts );
			$atts['title_styles']       = $this->get_title_styles( $atts );
			$atts['text_styles']        = $this->get_text_styles( $atts );
			$atts['custom_icon_styles'] = $this->get_custom_icon_styles( $atts );
			$atts['icon_params']        = $this->generate_icon_params( $atts );
			
			return techlink_core_get_template_part( 'shortcodes/icon-with-text', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-icon-with-text';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['icon_type'] ) ? 'qodef--' . $atts['icon_type'] : '';
            $holder_classes[] = ! empty ( $atts['appear_animation'] ) && 'yes' === $atts['appear_animation'] ? 'qodef--has-appear qodef--appear-delay-random' : '';
			
			$holder_classes = apply_filters( 'techlink_core_filter_icon_with_text_variation_classes', $holder_classes, $atts );
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_title_styles( $atts ) {
			$styles = array();

			if ( $atts['title_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['title_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['title_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['title_margin_top'] ) . 'px';
				}
			}
			
			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}
			
			return $styles;
		}
		
		private function get_text_styles( $atts ) {
			$styles = array();
			
			if ( $atts['text_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['text_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['text_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['text_margin_top'] ) . 'px';
				}
			}

			if ( ! empty( $atts['text_font_size'] ) ) {
				if ( qode_framework_string_ends_with_typography_units( $atts['text_font_size'] ) ) {
					$styles[] = 'font-size: ' . $atts['text_font_size'];
				} else {
					$styles[] = 'font-size: ' . intval( $atts['text_font_size'] ) . 'px';
				}
			}

			if ( ! empty( $atts['text_color'] ) ) {
				$styles[] = 'color: ' . $atts['text_color'];
			}
			
			return $styles;
		}

		private function get_custom_icon_styles( $atts ) {
			$styles = array();

			if ( ( $atts['icon_type'] == 'custom-icon' || $atts['icon_type'] == 'svg-icon' ) && $atts['vertical_offset_custom'] !== '' ) {
                $styles[] = 'top: ' . $atts['vertical_offset_custom'];
            }

			return $styles;
		}
		
		private function generate_icon_params( $atts ) {
			$params = $this->populate_imported_shortcode_atts( array(
				'shortcode_base' => 'techlink_core_icon',
				'exclude'        => array( 'custom_class', 'link', 'target', 'margin' ),
				'atts'           => $atts,
			) );
			
			return $params;
		}
	}
}
