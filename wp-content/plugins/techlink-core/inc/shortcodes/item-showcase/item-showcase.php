<?php

if ( ! function_exists( 'techlink_core_add_item_showcase_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function techlink_core_add_item_showcase_shortcode( $shortcodes ) {
		$shortcodes[] = 'TechLinkCoreItemShowcaseShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'techlink_core_filter_register_shortcodes', 'techlink_core_add_item_showcase_shortcode' );
}

if ( class_exists( 'TechLinkCoreShortcode' ) ) {
	class TechLinkCoreItemShowcaseShortcode extends TechLinkCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'techlink_core_filter_item_showcase_layouts', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( TECHLINK_CORE_SHORTCODES_URL_PATH . '/item-showcase' );
			$this->set_base( 'techlink_core_item_showcase' );
			$this->set_name( esc_html__( 'Item Showcase', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds item showcase holder', 'techlink-core' ) );
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
				'field_type' => 'image',
				'name'       => 'main_image',
				'title'      => esc_html__( 'Image', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'main_image_offset',
				'title'      => esc_html__( 'Image Top Offset', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'main_image_side_margin',
				'title'      => esc_html__( 'Image Side Margin', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'responsive_layout',
				'title'         => esc_html__( 'Responsive Layout', 'techlink-core' ),
				'options'		=> array(
					''           => esc_html__( 'Default', 'techlink-core' ),
					'simplified' => esc_html__( 'Simplified', 'techlink-core' ),
				),
				'default_value' => '',
			) );
			$this->set_option( array(
				'field_type' => 'repeater',
				'name'       => 'children',
				'title'      => esc_html__( 'Child elements', 'techlink-core' ),
				'items'   => array(
					array(
						'field_type'    => 'select',
						'name'          => 'item_icon_type',
						'title'         => esc_html__( 'Icon Type', 'techlink-core' ),
						'options'       => array(
							'custom-icon' => esc_html__( 'Custom Icon', 'techlink-core' ),
							'svg-icon'    => esc_html__( 'SVG Icon', 'techlink-core' )
						),
						'default_value' => 'custom-icon',
					),
					array(
						'field_type' => 'image',
						'name'       => 'item_custom_icon',
						'title'      => esc_html__( 'Custom Icon', 'techlink-core' ),
						'dependency' => array(
							'show' => array(
								'item_icon_type' => array(
									'values'        => 'custom-icon',
									'default_value' => 'custom-icon'
								)
							)
						)
					),
					array(
						'field_type' => 'textarea_html',
						'name'       => 'item_svg_icon',
						'title'      => esc_html__( 'SVG Icon code', 'techlink-core' ),
						'dependency' => array(
							'show' => array(
								'item_icon_type' => array(
									'values'        => 'svg-icon',
									'default_value' => 'custom-icon'
								)
							)
						)
					),
					array(
						'field_type' => 'text',
						'name'       => 'item_title',
						'title'      => esc_html__( 'Title', 'techlink-core' )
					),
					array(
						'field_type'    => 'select',
						'name'          => 'item_title_tag',
						'title'         => esc_html__( 'Title Tag', 'techlink-core' ),
						'options'       => techlink_core_get_select_type_options_pool( 'title_tag', false ),
						'default_value' => 'h4'
					),
					array(
						'field_type' => 'color',
						'name'       => 'item_title_color',
						'title'      => esc_html__( 'Title Color', 'techlink-core' ),
					),
					array(
						'field_type' => 'textarea',
						'name'       => 'item_text',
						'title'      => esc_html__( 'Text', 'techlink-core' )
					),
					array(
						'field_type' => 'color',
						'name'       => 'item_text_color',
						'title'      => esc_html__( 'Text Color', 'techlink-core' ),
					),
					array(
						'field_type' => 'text',
						'name'       => 'item_text_margin_top',
						'title'      => esc_html__( 'Text Margin Top', 'techlink-core' ),
					),
					array(
						'field_type' => 'text',
						'name'       => 'item_link',
						'title'      => esc_html__( 'Link', 'techlink-core' ),
					),
					array(
						'field_type' => 'select',
						'name'       => 'item_link_target',
						'title'      => esc_html__( 'Link Target', 'techlink-core' ),
						'options'    => techlink_core_get_select_type_options_pool( 'link_target', false ),
					)
				)
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = array_chunk( $this->parse_repeater_items( $atts['children'] ), ceil( count( $this->parse_repeater_items( $atts['children'] ) ) / 2 ) );
			$atts['this_shortcode'] = $this;
			
			return techlink_core_get_template_part( 'shortcodes/item-showcase', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-item-showcase';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['responsive_layout'] ) ? 'qodef-responsive-layout--' . $atts['responsive_layout'] : '';

			return implode( ' ', $holder_classes );
		}
		
		public function get_image_styles( $atts ) {
			$styles = array();
			
			if ( $atts['main_image_offset'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['main_image_offset'] ) ) {
					$styles[] = 'margin-top: ' . $atts['main_image_offset'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['main_image_offset'] ) . 'px';
				}
			}
			
			if ( $atts['main_image_side_margin'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['main_image_side_margin'] ) ) {
					$styles[] = 'margin-left: ' . $atts['main_image_side_margin'];
					$styles[] = 'margin-right: ' . $atts['main_image_side_margin'];
				} else {
					$styles[] = 'margin-left: ' . intval( $atts['main_image_side_margin'] ) . 'px';
					$styles[] = 'margin-right: ' . intval( $atts['main_image_side_margin'] ) . 'px';
				}
			}

			return $styles;
		}
		
		public function get_title_styles( $item ) {
			$styles = array();
			
			if ( ! empty( $item['item_title_color'] ) ) {
				$styles[] = 'color: ' . $item['item_title_color'];
			}
			
			return $styles;
		}
		
		public function get_text_styles( $item ) {
			$styles = array();
			
			if ( ! empty( $item['item_text_color'] ) ) {
				$styles[] = 'color: ' . $item['item_text_color'];
			}
			
			if ( isset( $item['item_text_margin_top'] ) && $item['item_text_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $item['item_text_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $item['item_text_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $item['item_text_margin_top'] ) . 'px';
				}
			}
			
			return $styles;
		}
	}
}
