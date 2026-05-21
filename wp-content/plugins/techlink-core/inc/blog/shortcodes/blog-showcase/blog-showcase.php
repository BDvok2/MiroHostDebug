<?php

if ( ! function_exists( 'techlink_core_add_blog_showcase_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes showcase for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function techlink_core_add_blog_showcase_shortcode( $shortcodes ) {
		$shortcodes[] = 'TechLinkCoreBlogShowcaseShortcode';
		
		return $shortcodes;
	}
	
	add_filter( 'techlink_core_filter_register_shortcodes', 'techlink_core_add_blog_showcase_shortcode' );
}

if ( class_exists( 'TechLinkCoreListShortcode' ) ) {
	class TechLinkCoreBlogShowcaseShortcode extends TechLinkCoreListShortcode {
		
		public function __construct() {
			$this->set_post_type( 'post' );
			$this->set_post_type_taxonomy( 'category' );
			$this->set_post_type_additional_taxonomies( array( 'post_tag' ) );

			parent::__construct();
		}
		
		public function map_shortcode() {
			$this->set_shortcode_path( TECHLINK_CORE_INC_URL_PATH . '/blog/shortcodes/blog-showcase' );
			$this->set_base( 'techlink_core_blog_showcase' );
			$this->set_name( esc_html__( 'Blog Showcase', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays showcase of blog posts', 'techlink-core' ) );
			$this->set_category( esc_html__( 'TechLink Core', 'techlink-core' ) );
			$this->set_scripts(
				apply_filters( 'techlink_core_filter_blog_showcase_register_scripts', array() )
			);

			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'custom_class',
				'title'      => esc_html__( 'Custom Class', 'techlink-core' )
			) );
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->map_layout_options( array(
				'layouts'          => $this->get_layouts(),
				'hover_animations' => $this->get_hover_animation_options()
			) );
			$this->set_option( array(
				'field_type' => 'text',
				'name'       => 'excerpt_length',
				'title'      => esc_html__( 'Excerpt Length', 'techlink-core' ),
				'group'      => esc_html__( 'Layout', 'techlink-core' )
			) );
			$this->map_additional_options();
		}
		
		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'techlink_core_blog_showcase', $params );
			$html = str_replace( "\n", '', $html );
			
			return $html;
		}
		
		public function load_assets() {
			parent::load_assets();
			
			$is_allowed = apply_filters( 'techlink_core_filter_load_blog_showcase_assets', false, $this->get_atts() );

			if ( $is_allowed ) {
				wp_enqueue_style( 'wp-mediaelement' );
				wp_enqueue_script( 'wp-mediaelement' );
				wp_enqueue_script( 'mediaelement-vimeo' );
			}
		}
		
		public function render( $options, $content = null ) {
			parent::render( $options );
			
			$atts = $this->get_atts();
			
			$atts['post_type']       = $this->get_post_type();

			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );
			
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['query_result']   = new \WP_Query( techlink_core_get_query_params( $atts ) );
			$atts['data_attr']      = techlink_core_get_pagination_data( TECHLINK_CORE_REL_PATH, 'blog/shortcodes', 'blog-showcase', 'post', $atts );

			$atts['this_shortcode'] = $this;
			
			return techlink_core_get_template_part( 'blog/shortcodes/blog-showcase', 'templates/content', '', $atts );
		}
		
		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			
			$holder_classes[] = 'qodef-blog qodef-blog-showcase';

			if ( ! empty( $atts['pagination_type'] ) ) {
				if ( $atts['pagination_type'] == 'no-pagination' ) {
					$holder_classes[] = 'qodef--no-bottom-space';
					$holder_classes[] = 'qodef-pagination--off';
				} else {
					$holder_classes[] = 'qodef-pagination--on';
					$holder_classes[] = 'qodef-pagination-type--' . $atts['pagination_type'];
				}
			}

			return implode( ' ', $holder_classes );
		}

		public function get_content_styles( $atts ) {
			$styles = array();
			
			if ( ! empty( $atts['content_padding'] ) ) {
				$styles[] = 'margin-bottom: ' . $atts['content_padding'];
			}
			
			return $styles;
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
