<?php

if ( ! function_exists( 'techlink_core_add_floating_images_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function techlink_core_add_floating_images_shortcode( $shortcodes ) {
		$shortcodes[] = 'TechLinkCoreFloatingImagesShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'techlink_core_filter_register_shortcodes', 'techlink_core_add_floating_images_shortcode' );
}

if ( class_exists( 'TechLinkCoreShortcode' ) ) {
	class TechLinkCoreFloatingImagesShortcode extends TechLinkCoreShortcode {
		
		public function map_shortcode() {
			$this->set_shortcode_path( TECHLINK_CORE_SHORTCODES_URL_PATH . '/floating-images' );
			$this->set_base( 'techlink_core_floating_images' );
			$this->set_name( esc_html__( 'Floating Images', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds floating images holder', 'techlink-core' ) );
			$this->set_category( esc_html__( 'TechLink Core', 'techlink-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'techlink-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'main_image',
				'title'      => esc_html__( 'Main Image', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'main_image_shadow',
				'title'      => esc_html__( 'Main Image Shadow', 'techlink-core' ),
				'dependency' => array(
					'hide' => array(
						'main_image' => array(
							'values'        => '',
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'main_image_width',
				'title'      => esc_html__( 'Main Image Width', 'techlink-core' ),
				'description'=> esc_html__( 'Main Image width in relation to shortcode holder width(%).', 'techlink-core' ),
				'dependency' => array(
					'hide' => array(
						'main_image' => array(
							'values'        => '',
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'image',
				'name'       => 'aux_image',
				'title'      => esc_html__( 'Aux Image', 'techlink-core' )
			) );
			$this->set_option( array(
				'field_type' => 'color',
				'name'       => 'aux_image_shadow',
				'title'      => esc_html__( 'Aux Image Shadow', 'techlink-core' ),
				'dependency' => array(
					'hide' => array(
						'aux_image' => array(
							'values'        => '',
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'aux_image_width',
				'title'      => esc_html__( 'Aux Image Width', 'techlink-core' ),
				'description'=> esc_html__( 'Aux Image width in relation to shortcode holder width(%).', 'techlink-core' ),
				'dependency' => array(
					'hide' => array(
						'aux_image' => array(
							'values'        => '',
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'aux_image_x_offset',
				'title'      => esc_html__( 'Aux Image X Offset', 'techlink-core' ),
				'description'=> esc_html__( 'Horizontal Offset based on Main Image width(%).', 'techlink-core' ),
				'dependency' => array(
					'hide' => array(
						'aux_image' => array(
							'values'        => '',
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'aux_image_y_offset',
				'title'      => esc_html__( 'Aux Image Y Offset', 'techlink-core' ),
				'description'=> esc_html__( 'Vertical Offset based on Main Image height(%).', 'techlink-core' ),
				'dependency' => array(
					'hide' => array(
						'aux_image' => array(
							'values'        => '',
							'default_value' => ''
						)
					)
				)
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'alignment',
				'title'      => esc_html__( 'Alignment', 'techlink-core' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'techlink-core' ),
					'left'   => esc_html__( 'Left', 'techlink-core' ),
					'center' => esc_html__( 'Center', 'techlink-core' ),
					'right'  => esc_html__( 'Right', 'techlink-core' )
				),
			) );
			$this->map_extra_options();
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes']              = $this->get_holder_classes( $atts );
			$atts['main_image_styles']           = $this->get_main_image_styles( $atts );
			$atts['aux_image_styles']            = $this->get_aux_image_styles( $atts );
			$atts['main_image_position_data']    = $this->get_main_image_position_data( $atts );
			$atts['aux_image_position_data']     = $this->get_aux_image_position_data( $atts );
			$atts['this_shortcode']              = $this;

			return techlink_core_get_template_part( 'shortcodes/floating-images', 'templates/floating-images', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-floating-images';
			$holder_classes[] = ! empty( $atts['alignment'] ) ? 'qodef-alignment--' . $atts['alignment'] : '';

			return implode( ' ', $holder_classes );
		}

		private function get_main_image_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['main_image_shadow'] ) ) {
				if ( ! empty( $atts['aux_image_x_offset'] ) ) {
					if ( qode_framework_filter_suffix( $atts['aux_image_x_offset'], '%' ) > 0 ) {
						$styles[] = 'box-shadow: -10px 10px 35px 5px ' . $atts['main_image_shadow'];
					} else {
						$styles[] = 'box-shadow: 10px 10px 35px 5px ' . $atts['main_image_shadow'];
					}
				} else {
					$styles[] = 'box-shadow: 0 10px 35px 5px ' . $atts['main_image_shadow'];
				}
			}

			return implode( ';', $styles );
		}

		private function get_aux_image_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['aux_image_shadow'] ) ) {
				$styles[] = 'box-shadow: 0 10px 35px 5px ' . $atts['aux_image_shadow'];
			}

			return implode( ';', $styles );
		}

		private function get_main_image_position_data( $atts ) {
			$data = array();

			if ( ! empty( $atts['main_image_width'] ) ) {
				$data['data-width'] = qode_framework_filter_suffix( $atts['main_image_width'], '%' ) . '%';
			}

			return $data;
		}

		private function get_aux_image_position_data( $atts ) {
			$data = array();

			if ( ! empty( $atts['aux_image_x_offset'] ) ) {
				$data['data-x'] = qode_framework_filter_suffix( $atts['aux_image_x_offset'], '%' ) . '%';
			}

			if ( ! empty( $atts['aux_image_y_offset'] ) ) {
				$data['data-y'] = qode_framework_filter_suffix( $atts['aux_image_y_offset'], '%' ) . '%';
			}

			if ( ! empty( $atts['aux_image_width'] ) ) {
				$data['data-width'] = qode_framework_filter_suffix( $atts['aux_image_width'], '%' ) . '%';
			}

			return $data;
		}
	}
}