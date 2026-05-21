<?php

if ( ! function_exists( 'techlink_core_add_single_image_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param $shortcodes array
	 *
	 * @return array
	 */
	function techlink_core_add_single_image_shortcode( $shortcodes ) {
		$shortcodes[] = 'TechLinkCoreSingleImageShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'techlink_core_filter_register_shortcodes', 'techlink_core_add_single_image_shortcode' );
}

if ( class_exists( 'TechLinkCoreShortcode' ) ) {
	class TechLinkCoreSingleImageShortcode extends TechLinkCoreShortcode {
		
		public function __construct() {
			$this->set_layouts( apply_filters( 'techlink_core_filter_single_image_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'techlink_core_filter_single_image_extra_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( TECHLINK_CORE_SHORTCODES_URL_PATH . '/single-image' );
			$this->set_base( 'techlink_core_single_image' );
			$this->set_name( esc_html__( 'Single Image', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds image element', 'techlink-core' ) );
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
				'field_type'  => 'text',
				'name'        => 'image_size',
				'title'       => esc_html__( 'Image Size', 'techlink-core' ),
				'description' => esc_html__( 'For predefined image sizes input thumbnail, medium, large or full. If you wish to set a custom image size, type in the desired image dimensions in pixels (e.g. 400x400).', 'techlink-core' ),
			) );
			
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'image_action',
				'title'      => esc_html__( 'Image Action', 'techlink-core' ),
				'options'    => array(
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
							'values'        => array( 'custom-link' ),
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
				'dependency'    => array(
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
				'name'          => 'decoration',
				'title'         => esc_html__( 'Decoration', 'techlink-core' ),
				'options'       => array(
					''      => esc_html__( 'No Decoration', 'techlink-core' ),
					'image' => esc_html__( 'Background Image', 'techlink-core' ),
					'svg'   => esc_html__( 'Background SVG', 'techlink-core' )
				),
				'default_value' => '',
				'group'         => esc_html__( 'Decoration', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'background_image',
				'title'      => esc_html__( 'Background Image', 'techlink-core' ),
				'group'      => esc_html__( 'Decoration', 'techlink-core' ),
				'dependency' => array(
					'show' => array(
						'decoration' => array(
							'values'        => 'image',
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'textarea_html',
				'name'       => 'background_svg',
				'title'      => esc_html__( 'Background SVG code', 'techlink-core' ),
				'group'      => esc_html__( 'Decoration', 'techlink-core' ),
				'dependency' => array(
					'show' => array(
						'decoration' => array(
							'values'        => 'svg',
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'decoration_horizontal_position',
				'title'         => esc_html__( 'Decoration Horizontal Position', 'techlink-core' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'techlink-core' ),
					'center' => esc_html__( 'Center', 'techlink-core' ),
					'left'   => esc_html__( 'Left', 'techlink-core' ),
					'right'  => esc_html__( 'Right', 'techlink-core' ),
				),
				'default_value' => '',
				'group'         => esc_html__( 'Decoration', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'decoration_vertical_position',
				'title'         => esc_html__( 'Decoration Vertical Position', 'techlink-core' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'techlink-core' ),
					'center' => esc_html__( 'Center', 'techlink-core' ),
					'top'    => esc_html__( 'Top', 'techlink-core' ),
					'bottom' => esc_html__( 'Bottom', 'techlink-core' ),
				),
				'default_value' => '',
				'group'         => esc_html__( 'Decoration', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'area_padding',
				'title'      => esc_html__( 'Area Padding', 'techlink-core' ),
				'group'      => esc_html__( 'Decoration', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'appear_animation',
				'title'         => esc_html__( 'Appear Animation', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no',
				'group'         => esc_html__( 'Animation Options', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'appear_orientation',
				'title'         => esc_html__( 'Appear Orientation', 'techlink-core' ),
				'options'       => array(
					'left'  => esc_html__( 'Left', 'techlink-core' ),
					'right' => esc_html__( 'Right', 'techlink-core' )
				),
				'default_value' => 'left',
				'dependency'    => array(
					'show' => array(
						'appear_animation' => array(
							'values'        => 'yes',
							'default_value' => 'no'
						)
					)
				),
				'group'         => esc_html__( 'Animation Options', 'techlink-core' )
			) );
			$this->map_extra_options();
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'techlink_core_single_image', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['holder_styles']  = $this->get_holder_styles( $atts );
			$atts['image_params']   = $this->generate_image_params( $atts );
			
			return techlink_core_get_template_part( 'shortcodes/single-image', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-single-image';
			$holder_classes[] = ! empty ( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty ( $atts['image_action'] ) && $atts['image_action'] == 'open-popup' ? 'qodef-magnific-popup qodef-popup-gallery' : '';
			$holder_classes[] = ! empty ( $atts['decoration'] ) ? 'qodef-decoration--' . $atts['decoration'] : '';
			$holder_classes[] = ! empty ( $atts['decoration_horizontal_position'] ) ? 'qodef-decoration-horizontal-position--' . $atts['decoration_horizontal_position'] : '';
			$holder_classes[] = ! empty ( $atts['decoration_vertical_position'] ) ? 'qodef-decoration-vertical-position--' . $atts['decoration_vertical_position'] : '';
			$holder_classes[] = ! empty ( $atts['appear_animation'] ) && 'yes' === $atts['appear_animation'] ? 'qodef--has-appear' : '';
			$holder_classes[] = ! empty ( $atts['appear_orientation'] ) ? 'qodef-animation--' . $atts['appear_orientation'] : '';
			
			return implode( ' ', $holder_classes );
		}
		
		private function get_holder_styles( $atts ) {
			$styles = array();
			
			if ( $atts['area_padding'] !== '' ) {
				$styles[] = 'padding: ' . $atts['area_padding'];
			}
			
			return $styles;
		}
		
		private function generate_image_params( $atts ) {
			$image = array();
			
			if ( ! empty( $atts['image'] ) ) {
				$id = $atts['image'];
				
				$image['image_id'] = intval( $id );
				$image_original    = wp_get_attachment_image_src( $id, 'full' );
				$image['url']      = ( is_array( $image_original ) ) ? $image_original[0] : '';
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
	}
}