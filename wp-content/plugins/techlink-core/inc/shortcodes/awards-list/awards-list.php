<?php

if ( ! function_exists( 'techlink_core_add_awards_list_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function techlink_core_add_awards_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'TechLinkCoreAwardsListShortcode';

		return $shortcodes;
	}

	add_filter( 'techlink_core_filter_register_shortcodes', 'techlink_core_add_awards_list_shortcode' );
}

if ( class_exists( 'TechLinkCoreShortcode' ) ) {
	class TechLinkCoreAwardsListShortcode extends TechLinkCoreShortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( TECHLINK_CORE_SHORTCODES_URL_PATH . '/awards-list' );
			$this->set_base( 'techlink_core_awards_list' );
			$this->set_name( esc_html__( 'Awards List', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds awards list holder', 'techlink-core' ) );
			$this->set_category( esc_html__( 'TechLink Core', 'techlink-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'techlink-core' ),
			) );
			$this->set_option( array(
				'field_type' => 'select',
				'name'       => 'layout',
				'title'      => esc_html__( 'Layout', 'techlink-core' ),
				'options'       => array(
					''          => esc_html__( 'Default', 'techlink-core' ),
					'2-columns' => esc_html__( '2-columns', 'techlink-core' )
				),
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
						'name'          => 'item_description',
						'title'         => esc_html__( 'Description', 'techlink-core' )
					),
					array(
						'field_type'    => 'text',
						'name'          => 'item_date',
						'title'         => esc_html__( 'Date', 'techlink-core' )
					),
					array(
						'field_type'    => 'text',
						'name'          => 'item_location',
						'title'         => esc_html__( 'Location', 'techlink-core' )
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

			return techlink_core_get_template_part( 'shortcodes/awards-list', 'templates/awards-list', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-awards-list';

			$holder_classes[] = ! empty( $atts['layout'] ) ?  'qodef-layout--' . $atts['layout'] : '';

			return implode( ' ', $holder_classes );
		}
	}
}