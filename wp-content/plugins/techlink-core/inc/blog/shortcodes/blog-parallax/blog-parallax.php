<?php

if ( ! function_exists( 'techlink_core_add_blog_parallax_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes showcase for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function techlink_core_add_blog_parallax_shortcode( $shortcodes ) {
		$shortcodes[] = 'TechLinkCoreBlogParallaxShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'techlink_core_filter_register_shortcodes', 'techlink_core_add_blog_parallax_shortcode' );
}

if ( class_exists( 'TechLinkCoreListShortcode' ) ) {
	class TechLinkCoreBlogParallaxShortcode extends TechLinkCoreListShortcode {
		
		public function __construct() {
			$this->set_post_type( 'post' );
			$this->set_post_type_taxonomy( 'category' );
			$this->set_post_type_additional_taxonomies( array( 'post_tag' ) );

			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( TECHLINK_CORE_INC_URL_PATH . '/blog/shortcodes/blog-parallax' );
			$this->set_base( 'techlink_core_blog_parallax' );
			$this->set_name( esc_html__( 'Blog Parallax', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays parallax of blog posts', 'techlink-core' ) );
			$this->set_category( esc_html__( 'TechLink Core', 'techlink-core' ) );
			$this->set_scripts(
				apply_filters( 'techlink_core_filter_blog_parallax_register_scripts', array() )
			);

			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'techlink-core' )
			) );
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'techlink_core_blog_parallax', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
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
			
			return techlink_core_get_template_part( 'blog/shortcodes/blog-parallax', 'templates/content', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-blog qodef-blog-parallax';

			return implode( ' ', $holder_classes );
		}
	}
}