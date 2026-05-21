<?php

if ( ! function_exists( 'techlink_core_add_image_with_text_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function techlink_core_add_image_with_text_shortcode( $shortcodes ) {
		$shortcodes[] = 'TechLinkCoreImageWithTextShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'techlink_core_filter_register_shortcodes', 'techlink_core_add_image_with_text_shortcode' );
}

if ( class_exists( 'TechLinkCoreShortcode' ) ) {
	class TechLinkCoreImageWithTextShortcode extends TechLinkCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'techlink_core_filter_image_with_text_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'techlink_core_filter_image_with_text_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( TECHLINK_CORE_SHORTCODES_URL_PATH . '/image-with-text' );
			$this->set_base( 'techlink_core_image_with_text' );
			$this->set_name( esc_html__( 'Image With Text', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds image with text element', 'techlink-core' ) );
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
				'name'       => 'image',
				'title'      => esc_html__( 'Image', 'techlink-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'image_size',
				'title'      => esc_html__( 'Image Size', 'techlink-core' ),
				'description'=> esc_html__( 'For predefined image sizes input thumbnail, medium, large or full. If you wish to set a custom image size, type in the desired image dimensions in pixels (e.g. 400x400).', 'techlink-core' ),
			) );
            $this->set_option( array(
                'field_type' => 'image',
                'name'       => 'background_image',
                'title'      => esc_html__( 'Background Image', 'techlink-core' ),
                'dependency' => array(
                    'show' => array(
                        'layout' => array(
                            'values'        => 'text-below',
                            'default_value' => 'text-on-hover'
                        )
                    )
                )
            ) );
            $this->set_option( array(
                'field_type' => 'text',
                'name'       => 'background_image_size',
                'title'      => esc_html__( 'Background Image Size', 'techlink-core' ),
                'description'=> esc_html__( 'For predefined image sizes input thumbnail, medium, large or full. If you wish to set a custom image size, type in the desired image dimensions in pixels (e.g. 400x400).', 'techlink-core' ),
                'dependency' => array(
                    'show' => array(
                        'layout' => array(
                            'values'        => 'text-below',
                            'default_value' => 'text-on-hover'
                        )
                    )
                )
            ) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'image_shadow',
				'title'         => esc_html__( 'Image Shadow', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no',
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'image_border',
				'title'         => esc_html__( 'Image Border', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no',
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'image_radius',
				'title'         => esc_html__( 'Image Radius', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no',
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'image_action',
				'title'         => esc_html__( 'Image Action', 'techlink-core' ),
				'options'       => array(
					''            => esc_html__( 'No Action', 'techlink-core' ),
					'open-popup'  => esc_html__( 'Open Popup', 'techlink-core' ),
					'custom-link' => esc_html__( 'Custom Link', 'techlink-core' )
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'link',
				'title'      => esc_html__( 'Custom Link', 'techlink-core' ),
				'dependency' => array(
					'show' => array(
						'image_action' => array(
							'values'        => 'custom-link',
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'target',
				'title'         => esc_html__( 'Custom Link Target', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'link_target' ),
				'default_value' => '_self',
				'dependency' => array(
					'show' => array(
						'image_action' => array(
							'values'        => 'custom-link',
							'default_value' => ''
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
				'field_type'  => 'text',
				'name'        => 'line_break_positions',
				'title'       => esc_html__( 'Positions of Title Line Break', 'techlink-core' ),
				'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'techlink-core' ),
				'group'       => esc_html__( 'Content', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'disable_title_break_words',
				'title'         => esc_html__( 'Disable Title Line Break', 'techlink-core' ),
				'description'   => esc_html__( 'Enabling this option will disable title line breaks for screen size 1024 and lower', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no',
				'group'         => esc_html__( 'Content', 'techlink-core' )
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
			$this->map_extra_options();
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'techlink_core_image_with_text', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes']  = $this->get_holder_classes( $atts );
			$atts['title']           = $this->get_modified_title( $atts );
			$atts['title_styles']    = $this->get_title_styles( $atts );
			$atts['text_styles']     = $this->get_text_styles( $atts );
			$atts['image_params']    = $this->generate_image_params( $atts );
			$atts['bg_image_params'] = $this->generate_bg_image_params( $atts );
			
			return techlink_core_get_template_part( 'shortcodes/image-with-text', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-image-with-text';
			$holder_classes[] = ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = $atts['disable_title_break_words'] === 'yes' ? 'qodef-title-break--disabled' : '';
			$holder_classes[] = $atts['image_shadow'] === 'yes' ? 'qodef-image-shadow--enabled' : '';
			$holder_classes[] = $atts['image_border'] === 'yes' ? 'qodef-image-border--enabled' : '';
			$holder_classes[] = $atts['image_radius'] === 'yes' ? 'qodef-image-radius--enabled' : '';

			return implode( ' ', $holder_classes );
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
		
		private function generate_image_params( $atts ) {
			$image = array();
			
			if ( ! empty( $atts['image'] ) ) {
				$id = $atts['image'];
				
				$image['image_id'] = intval( $id );
				$image_original    = wp_get_attachment_image_src( $id, 'full' );
				$image['url']      = $image_original[0];
				$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );
				
				$image_size = trim( $atts['image_size'] );
				preg_match_all( '/\d+/', $image_size, $matches ); /* check if numeral width and height are entered */
				if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
					$image['image_size'] = $image_size;
				} elseif ( ! empty( $matches[0] ) ) {
					$image['image_size'] = array(
						$matches[0][0],
						$matches[0][1]
					);
				} else {
					$image['image_size'] = 'full';
				}
			}
			
			return $image;
		}

        private function generate_bg_image_params( $atts ) {
            $image = array();

            if ( ! empty( $atts['background_image'] ) ) {
                $id = $atts['background_image'];

                $image['image_id'] = intval( $id );
                $image_original    = wp_get_attachment_image_src( $id, 'full' );
                $image['url']      = $image_original[0];
                $image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );

                $image_size = trim( $atts['background_image_size'] );
                preg_match_all( '/\d+/', $image_size, $matches ); /* check if numeral width and height are entered */
                if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ) ) ) {
                    $image['image_size'] = $image_size;
                } elseif ( ! empty( $matches[0] ) ) {
                    $image['image_size'] = array(
                        $matches[0][0],
                        $matches[0][1]
                    );
                } else {
                    $image['image_size'] = 'full';
                }
            }

            return $image;
        }
	}
}
