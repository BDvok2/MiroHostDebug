<?php

if ( ! function_exists( 'techlink_core_add_icon_list_item_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function techlink_core_add_icon_list_item_shortcode( $shortcodes ) {
		$shortcodes[] = 'TechLinkCoreIconListItemShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'techlink_core_filter_register_shortcodes', 'techlink_core_add_icon_list_item_shortcode' );
}

if ( class_exists( 'TechLinkCoreShortcode' ) ) {
	class TechLinkCoreIconListItemShortcode extends TechLinkCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( TECHLINK_CORE_SHORTCODES_URL_PATH . '/icon-list-item' );
			$this->set_base( 'techlink_core_icon_list_item' );
			$this->set_name( esc_html__( 'Icon List Item', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds icon list item element', 'techlink-core' ) );
			$this->set_category( esc_html__( 'TechLink Core', 'techlink-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'item_margin_bottom',
				'title'      => esc_html__( 'Item Margin Bottom', 'techlink-core' )
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
					'custom-icon' => esc_html__( 'Custom Icon', 'techlink-core' )
				),
				'default_value' => 'icon-pack'
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'custom_icon',
				'title'      => esc_html__( 'Custom Icon', 'techlink-core' ),
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
				'field_type' => 'text',
				'name'       => 'custom_icon_margin',
				'title'      => esc_html__( 'Custom Icon Margin', 'techlink-core' ),
				'dependency' => array(
					'show' => array(
						'icon_type' => array(
							'values'        => 'custom-icon',
							'default_value' => 'icon-pack'
						)
					)
				)
			) );
			$this->import_shortcode_options( array(
				'shortcode_base'    => 'techlink_core_icon',
				'exclude'           => array( 'custom_class', 'link', 'target', 'size' ),
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
				'group'      => esc_html__( 'Title', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'title_tag', false, array(), array( 'div' => esc_attr__( 'Custom', 'techlink-core' ) ) ),
				'default_value' => 'p',
				'group'         => esc_html__( 'Title', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'techlink-core' ),
				'group'      => esc_html__( 'Title', 'techlink-core' )
			) );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']     = $this->get_holder_classes( $atts );
			$atts['holder_styles']      = $this->get_holder_styles( $atts );
			$atts['title_styles']       = $this->get_title_styles( $atts );
			$atts['custom_icon_styles'] = $this->get_custom_icon_styles( $atts );
			$atts['icon_params']        = $this->generate_icon_params( $atts );
			
			return techlink_core_get_template_part( 'shortcodes/icon-list-item', 'templates/icon-list-item', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = array();
			
			$holder_classes[] = 'qodef-icon-list-item';
			$holder_classes[] = ! empty( $atts['icon_type'] ) ? 'qodef-icon--' . $atts['icon_type'] : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_holder_styles( $atts ) {
			$styles = array();
			
			if ( $atts['item_margin_bottom'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['item_margin_bottom'] ) ) {
					$styles[] = 'margin-bottom: ' . $atts['item_margin_bottom'];
				} else {
					$styles[] = 'margin-bottom: ' . intval( $atts['item_margin_bottom'] ) . 'px';
				}
			}
			
			return $styles;
		}
		
		private function get_title_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}
			
			return $styles;
		}

		private function get_custom_icon_styles( $atts ) {
			$styles = array();

			if ( $atts['icon_type'] == 'custom-icon' && $atts['custom_icon_margin'] !== '' ) {
				$styles[] = 'margin: ' . $atts['custom_icon_margin'];
			}

			return $styles;
		}

		private function generate_icon_params( $atts ) {
			$params = $this->populate_imported_shortcode_atts( array(
				'shortcode_base' => 'techlink_core_icon',
				'exclude'        => array( 'custom_class', 'link', 'target', 'size' ),
				'atts'           => $atts,
			) );
			
			return $params;
		}
	}
}
