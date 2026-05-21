<?php

if ( ! function_exists( 'techlink_core_add_blog_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function techlink_core_add_blog_list_widget( $widgets ) {
		$widgets[] = 'TechLinkCoreBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'techlink_core_filter_register_widgets', 'techlink_core_add_blog_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class TechLinkCoreBlogListWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Title', 'techlink-core' )
				)
			);
			$widget_mapped = $this->import_shortcode_options( array(
				'shortcode_base' => 'techlink_core_blog_list'
			) );
			
			if ( $widget_mapped ) {
				$this->set_base( 'techlink_core_blog_list' );
				$this->set_name( esc_html__( 'TechLink Blog List', 'techlink-core' ) );
				$this->set_description( esc_html__( 'Display a list of blog posts', 'techlink-core' ) );
			}
		}
		
		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );
			
			echo do_shortcode( "[techlink_core_blog_list $params]" ); // XSS OK
		}
	}
}
