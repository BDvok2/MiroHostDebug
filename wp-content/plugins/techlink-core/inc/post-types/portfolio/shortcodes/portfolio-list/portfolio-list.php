<?php

if ( ! function_exists( 'techlink_core_add_portfolio_list_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function techlink_core_add_portfolio_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'TechLinkCorePortfolioListShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'techlink_core_filter_register_shortcodes', 'techlink_core_add_portfolio_list_shortcode' );
}

if ( class_exists( 'TechLinkCoreListShortcode' ) ) {
	class TechLinkCorePortfolioListShortcode extends TechLinkCoreListShortcode {
		
		public function __construct() {
			$this->set_post_type( 'portfolio-item' );
			$this->set_post_type_taxonomy( 'portfolio-category' );
			$this->set_post_type_additional_taxonomies( array( 'portfolio-tag' ) );
			$this->set_layouts( apply_filters( 'techlink_core_filter_portfolio_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'techlink_core_filter_portfolio_list_extra_options', array() ) );
			$this->set_hover_animation_options( apply_filters( 'techlink_core_filter_portfolio_list_hover_animation_options', array() ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( TECHLINK_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-list' );
			$this->set_base( 'techlink_core_portfolio_list' );
			$this->set_name( esc_html__( 'Portfolio List', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of portfolios', 'techlink-core' ) );
			$this->set_category( esc_html__( 'TechLink Core', 'techlink-core' ) );
			$this->set_scripts(
				apply_filters('techlink_core_filter_portfolio_list_register_assets', array())
			);

			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'techlink-core' )
			) );
			$this->map_list_options();
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->map_layout_options( array(
				'layouts'          => $this->get_layouts(),
				'hover_animations' => $this->get_hover_animation_options()
			) );
			if ( empty( $exclude_option ) || ( ! empty( $exclude_option ) && ! in_array( 'custom_padding', $exclude_option ) ) ) {
				$this->set_option( array(
					'field_type'    => 'select',
					'name'          => 'custom_padding',
					'title'         => esc_html__( 'Use Item Custom Padding', 'techlink-core' ),
					'group'         => esc_html__( 'Layout', 'techlink-core' ),
					'default_value' => 'no',
					'options'       => techlink_core_get_select_type_options_pool( 'no_yes', false ),
				) );
			}
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'featured_images_only',
				'title'         => esc_html__( 'Show Featured Images Only', 'techlink-core' ),
				'group'         => esc_html__( 'Layout', 'techlink-core' ),
				'options'       => techlink_core_get_select_type_options_pool( 'no_yes', false ),
				'default_value' => 'no',
			) );
			$this->map_additional_options();
			$this->map_extra_options();
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'techlink_core_portfolio_list', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function load_assets() {
			parent::load_assets();
			
			do_action( 'techlink_core_action_portfolio_list_load_assets', $this->get_atts() );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();
			
			$atts['post_type']       = $this->get_post_type();
			$atts['taxonomy_filter'] = $this->get_post_type_taxonomy();
			
			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );
			
			$atts['query_result']   = new \WP_Query( techlink_core_get_query_params( $atts ) );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['slider_attr']    = $this->get_slider_data( $atts );
			$atts['data_attr']      = techlink_core_get_pagination_data( TECHLINK_CORE_REL_PATH, 'post-types/portfolio/shortcodes', 'portfolio-list', 'portfolio', $atts );
			
			$atts['this_shortcode'] = $this;
			
			return techlink_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'templates/content', $atts['behavior'], $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-portfolio-list';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
			
			$list_classes            = $this->get_list_classes( $atts );
			$hover_animation_classes = $this->get_hover_animation_classes( $atts );
			$holder_classes          = array_merge( $holder_classes, $list_classes, $hover_animation_classes );
			
			return implode( ' ', $holder_classes );
		}
		
		public function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();
			
			$list_item_classes = $this->get_list_item_classes( $atts );
			
			$item_classes = array_merge( $item_classes, $list_item_classes );
			
			return implode( ' ', $item_classes );
		}
		
		public function get_title_styles( $atts ) {
			$color  = get_post_meta( get_the_ID(), 'qodef_portfolio_item_title_color', true );
			$styles = array();
			
			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}

			if ( ! empty( $color ) && 'info-on-hover' == $atts['layout'] ) {
				$styles[] = 'color: ' . $color;
			}
			
			return $styles;
		}
		
		public function get_list_item_style( $atts ) {
			$styles = array();
			
			if ( isset( $atts['custom_padding'] ) && $atts['custom_padding'] == 'yes' ) {
				$styles[] = 'padding: ' . get_post_meta( get_the_ID(), "qodef_portfolio_item_padding", true );
			}
			
			return $styles;
		}

		public function get_list_item_overlay_style( $atts ) {
		    $color  = get_post_meta( get_the_ID(), 'qodef_portfolio_item_overlay_color', true );
		    $styles = array();

            if ( ! empty( $color ) && 'info-on-hover' == $atts['layout'] ) {
                $styles[] = 'background-color: ' . $color;
            }

            return $styles;
        }

		public function get_list_item_category_style( $atts ) {
			$color  = get_post_meta( get_the_ID(), 'qodef_portfolio_item_category_color', true );
			$styles = array();

			if ( ! empty( $color ) && 'info-on-hover' == $atts['layout'] ) {
				$styles[] = 'color: ' . $color;
			}

			return $styles;
		}
	}
}
