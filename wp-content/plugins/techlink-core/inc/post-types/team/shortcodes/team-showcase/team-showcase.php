<?php

if ( ! function_exists( 'techlink_core_add_team_showcase_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function techlink_core_add_team_showcase_shortcode( $shortcodes ) {
		$shortcodes[] = 'TechLinkCoreTeamShowcaseShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'techlink_core_filter_register_shortcodes', 'techlink_core_add_team_showcase_shortcode' );
}

if ( class_exists( 'TechLinkCoreListShortcode' ) ) {
	class TechLinkCoreTeamShowcaseShortcode extends TechLinkCoreListShortcode {
		
		public function __construct() {
			$this->set_post_type( 'team' );
			$this->set_post_type_taxonomy( 'team-category' );

			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( TECHLINK_CORE_CPT_URL_PATH . '/team/shortcodes/team-showcase' );
			$this->set_base( 'techlink_core_team_showcase' );
			$this->set_name( esc_html__( 'Team Showcase', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays showcase of teams', 'techlink-core' ) );
			$this->set_category( esc_html__( 'TechLink Core', 'techlink-core' ) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'techlink-core' )
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
                'name'          => 'float_animation',
                'title'         => esc_html__( 'Float Animation', 'techlink-core' ),
                'options'       => techlink_core_get_select_type_options_pool( 'no_yes', false ),
                'default_value' => 'no',
                'group'         => esc_html__( 'Animation Options', 'techlink-core' )
            ) );
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->map_layout_options( array( 'layouts' => $this->get_layouts()));
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'techlink_core_team_showcase', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();

			$atts['post_type'] = $this->get_post_type();

			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['query_result']   = new \WP_Query( techlink_core_get_query_params( $atts ) );
			$atts['has_single']     = techlink_core_team_has_single();
			
			$atts['this_shortcode'] = $this;
			
			return techlink_core_get_template_part( 'post-types/team/shortcodes/team-showcase', 'templates/content', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-team-showcase';
            $holder_classes[] = ! empty ( $atts['appear_animation'] ) && 'yes' === $atts['appear_animation'] ? 'qodef--has-appear' : '';
            $holder_classes[] = ! empty ( $atts['float_animation'] ) && 'yes' === $atts['float_animation'] ? 'qodef--has-float' : '';
			
			return implode( ' ', $holder_classes );
		}
		
		public function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();

			return implode( ' ', $item_classes );
		}
		
		public function get_title_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}
			
			return $styles;
		}
	}
}