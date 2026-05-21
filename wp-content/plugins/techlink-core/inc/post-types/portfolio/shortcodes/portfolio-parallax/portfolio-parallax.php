<?php

if ( ! function_exists( 'techlink_core_add_portfolio_parallax_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function techlink_core_add_portfolio_parallax_shortcode( $shortcodes ) {
		$shortcodes[] = 'TechLinkCorePortfolioParallaxShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'techlink_core_filter_register_shortcodes', 'techlink_core_add_portfolio_parallax_shortcode' );
}

if ( class_exists( 'TechLinkCoreListShortcode' ) ) {
	class TechLinkCorePortfolioParallaxShortcode extends TechLinkCoreListShortcode {
		
		public function __construct() {
			$this->set_post_type( 'portfolio-item' );
			$this->set_post_type_taxonomy( 'portfolio-category' );
			$this->set_post_type_additional_taxonomies( array( 'portfolio-tag' ) );
			
			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( TECHLINK_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-parallax' );
			$this->set_base( 'techlink_core_portfolio_parallax' );
			$this->set_name( esc_html__( 'Portfolio Parallax', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays parallax of portfolios', 'techlink-core' ) );
			$this->set_category( esc_html__( 'TechLink Core', 'techlink-core' ) );
			$this->set_scripts(
				apply_filters('techlink_core_filter_portfolio_parallax_register_assets', array())
			);

			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'techlink-core' )
			) );
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'techlink_core_portfolio_parallax', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function load_assets() {
			parent::load_assets();
			
			do_action( 'techlink_core_action_portfolio_parallax_load_assets', $this->get_atts() );
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();
			
			$atts['post_type']       = $this->get_post_type();

			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['query_result']   = new \WP_Query( techlink_core_get_query_params( $atts ) );

			$atts['this_shortcode'] = $this;
			
			return techlink_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-parallax', 'templates/content', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-portfolio-parallax';

			return implode( ' ', $holder_classes );
		}
	}
}
