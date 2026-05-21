<?php

if ( ! function_exists( 'techlink_core_add_banner_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function techlink_core_add_banner_shortcode( $shortcodes ) {
		$shortcodes[] = 'TechLinkCoreBannerShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'techlink_core_filter_register_shortcodes', 'techlink_core_add_banner_shortcode' );
}

if ( class_exists( 'TechLinkCoreShortcode' ) ) {
	class TechLinkCoreBannerShortcode extends TechLinkCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'techlink_core_filter_banner_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'techlink_core_filter_banner_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( TECHLINK_CORE_SHORTCODES_URL_PATH . '/banner' );
			$this->set_base( 'techlink_core_banner' );
			$this->set_name( esc_html__( 'Banner', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds banner element', 'techlink-core' ) );
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
				'options'       => $this->get_layouts(),
				'default_value' => $options_map['default_value'],
				'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] )
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'image',
				'title'      => esc_html__( 'Image', 'techlink-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'overlay_color',
				'title'      => esc_html__( 'Overlay Color', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'link_url',
				'title'      => esc_html__( 'Link', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'link_target',
				'title'         => esc_html__( 'Link Target', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self'
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title',
				'title'      => esc_html__( 'Title', 'techlink-core' ),
				'group'      => esc_html__( 'Content', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type'  => 'text',
				'name'        => 'line_break_positions',
				'title'       => esc_html__( 'Positions of Title Line Break', 'techlink-core' ),
				'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'techlink-core' ),
				'group'       => esc_html__( 'Title Style', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'disable_title_break_words',
				'title'         => esc_html__( 'Disable Title Line Break', 'techlink-core' ),
				'description'   => esc_html__( 'Enabling this option will disable title line breaks for screen size 1024 and lower', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no',
				'group'         => esc_html__( 'Title Style', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'title_tag',
				'title'         => esc_html__( 'Title Tag', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'title_tag', false, array(), array( 'div' => esc_attr__( 'Custom', 'techlink-core' ) ) ),
				'default_value' => 'h4',
				'group'         => esc_html__( 'Title Style', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'title_color',
				'title'      => esc_html__( 'Title Color', 'techlink-core' ),
				'group'      => esc_html__( 'Title Style', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'title_margin_top',
				'title'      => esc_html__( 'Title Margin Top', 'techlink-core' ),
				'group'      => esc_html__( 'Title Style', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'subtitle',
				'title'      => esc_html__( 'Subtitle', 'techlink-core' ),
				'group'      => esc_html__( 'Content', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'subtitle_tag',
				'title'         => esc_html__( 'Subtitle Tag', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'title_tag', false, array(), array( 'div' => esc_attr__( 'Custom', 'techlink-core' ) ) ),
				'default_value' => 'div',
				'group'         => esc_html__( 'Subtitle Style', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'subtitle_color',
				'title'      => esc_html__( 'Subtitle Color', 'techlink-core' ),
				'group'      => esc_html__( 'Subtitle Style', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'subtitle_margin_top',
				'title'      => esc_html__( 'Subtitle Margin Top', 'techlink-core' ),
				'group'      => esc_html__( 'Subtitle Style', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_field',
				'title'      => esc_html__( 'Text', 'techlink-core' ),
				'group'      => esc_html__( 'Content', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'text_tag',
				'title'         => esc_html__( 'Text Tag', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'title_tag' ),
				'default_value' => 'p',
				'group'         => esc_html__( 'Text Style', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'text_color',
				'title'      => esc_html__( 'Text Color', 'techlink-core' ),
				'group'      => esc_html__( 'Text Style', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'text_margin_top',
				'title'      => esc_html__( 'Text Margin Top', 'techlink-core' ),
				'group'      => esc_html__( 'Text Style', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'background_text',
				'title'      => esc_html__( 'Background Text', 'techlink-core' ),
				'group'      => esc_html__( 'Content', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'background_text_color',
				'title'      => esc_html__( 'Background Text Color', 'techlink-core' ),
				'group'      => esc_html__( 'Background Text Style', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'background_text_font_size',
				'title'      => esc_html__( 'Background Text Font Size (px or em)', 'techlink-core' ),
				'group'      => esc_html__( 'Background Text Style', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'background_text_top_offset',
				'title'      => esc_html__( 'Background Text Top Offset (px or %)', 'techlink-core' ),
				'group'      => esc_html__( 'Background Text Style', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'disable_breakpoint',
				'title'         => esc_html__( 'Disable on smaller screens', 'techlink-core' ),
				'options'       => array(
					''     => esc_html__( 'Never', 'techlink-core' ),
					'1024' => esc_html__( 'Below 1024px', 'techlink-core' ),
					'768'  => esc_html__( 'Below 768px', 'techlink-core' ),
					'680'  => esc_html__( 'Below 680px', 'techlink-core' ),
				),
				'default_value' => '',
				'group'         => esc_html__( 'Background Text Style', 'techlink-core' )
			) );
			$this->import_shortcode_options( array(
				'shortcode_base'    => 'techlink_core_button',
				'exclude'           => array( 'custom_class', 'link', 'target' ),
				'additional_params' => array(
					'group' => esc_html__( 'Button', 'techlink-core' ),
					'dependency'    => array(
						'show' => array(
							'layout' => array(
								'values'        => 'link-button',
								'default_value' => ''
							)
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'enable_custom_layout',
				'title'         => esc_html__( 'Enable Custom Layout', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no',
				'group'         => esc_html__( 'Additional Features', 'techlink-core' )
			) );

			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']         = $this->get_holder_classes( $atts );
			$atts['image_styles']           = $this->get_image_styles( $atts );
			$atts['title']                  = $this->get_modified_title( $atts );
			$atts['title_styles']           = $this->get_title_styles( $atts );
			$atts['subtitle_styles']        = $this->get_subtitle_styles( $atts );
			$atts['text_styles']            = $this->get_text_styles( $atts );
			$atts['background_text_styles'] = $this->get_background_text_styles( $atts );
			$atts['button_params']          = $this->generate_button_params( $atts );
			
			return techlink_core_get_template_part( 'shortcodes/banner', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-banner';
			$holder_classes[] = ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = $atts['disable_title_break_words'] === 'yes' ? 'qodef-title-break--disabled' : '';
			$holder_classes[] = ! empty ( $atts['disable_breakpoint'] ) ? 'qodef-disable-below--' . $atts['disable_breakpoint'] : '';
			$holder_classes[] = $atts['enable_custom_layout'] === 'yes' ? 'qodef-custom-layout--enabled' : '';

			return implode( ' ', $holder_classes );
		}

		private function get_image_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['overlay_color'] ) ) {
				$styles[] = 'background-color: ' . $atts['overlay_color'];
			}

			return $styles;
		}

		private function get_modified_title( $atts ) {
			$title = $atts['title'];

			if ( ! empty( $title ) && ! empty( $atts['line_break_positions'] ) ) {
				$split_title          = explode( ' ', $title );
				$line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );

				foreach ( $line_break_positions as $position ) {
					if ( isset( $split_title[ $position - 1 ] ) && ! empty( $split_title[ $position - 1 ] ) ) {
						$split_title[ $position - 1 ] = $split_title[ $position - 1 ] . '<br />';
					}
				}

				$title = implode( ' ', $split_title );
			}

			return $title;
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
		
		private function get_subtitle_styles( $atts ) {
			$styles = array();
			
			if ( $atts['subtitle_margin_top'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['subtitle_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['subtitle_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['subtitle_margin_top'] ) . 'px';
				}
			}
			
			if ( ! empty( $atts['subtitle_color'] ) ) {
				$styles[] = 'color: ' . $atts['subtitle_color'];
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
			
			if ( ! empty( $atts['text_color'] ) ) {
				$styles[] = 'color: ' . $atts['text_color'];
			}
			
			return $styles;
		}

		private function get_background_text_styles( $atts ) {
			$styles = array();

			if ( $atts['background_text_top_offset'] !== '' ) {
				if ( qode_framework_string_ends_with_space_units( $atts['background_text_top_offset'] ) ) {
					$styles[] = 'top: ' . $atts['background_text_top_offset'];
				} else {
					$styles[] = 'top: ' . intval( $atts['background_text_top_offset'] ) . 'px';
				}
			}

			if ( ! empty( $atts['background_text_color'] ) ) {
				$styles[] = 'color: ' . $atts['background_text_color'];
			}

			if ( ! empty ( $atts['background_text_font_size'] ) ) {
				$styles[] = 'font-size:' . $atts['background_text_font_size'];
			}

			return $styles;
		}

		private function generate_button_params( $atts ) {
			$params = $this->populate_imported_shortcode_atts( array(
				'shortcode_base' => 'techlink_core_button',
				'exclude'        => array( 'custom_class', 'link', 'target' ),
				'atts'           => $atts,
			) );
			
			$params['link']   = ! empty( $atts['link_url'] ) ? $atts['link_url'] : '';
			$params['target'] = ! empty( $atts['link_target'] ) ? $atts['link_target'] : '';
			
			return $params;
		}
	}
}
