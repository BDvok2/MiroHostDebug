<?php

if ( ! class_exists( 'TechLinkCoreMaps' ) ) {
	class TechLinkCoreMaps {
		private static $instance;
		
		function __construct() {
			// Include Google map scripts
			add_action( 'wp_enqueue_scripts', array( $this, 'include_google_scripts' ) );
			
			// Include Google map scripts for framework
			add_action( 'qode_framework_before_dashboard_scripts', array( $this, 'include_google_scripts' ) );
			
			// Set google map api key dependency
			add_filter( 'techlink_core_filter_script_dependencies', array( $this, 'set_scripts_dependency' ) );
			add_filter( 'qode_framework_filter_address_field_type_api_key_is_set', array( $this, 'enable_maps_for_framework_fields' ) );
			
			// Load global maps variables
			add_action( 'wp_enqueue_scripts', array( $this, 'set_global_map_variables' ), 20 );
		}
		
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		public function include_google_scripts() {
			
			if ( techlink_core_get_google_maps_api_key( 'is_enabled' ) ) {
				$google_maps_extensions       = '';
				$google_maps_extensions_array = apply_filters( 'techlink_core_filter_google_maps_extensions', array() );
				
				if ( ! empty( $google_maps_extensions_array ) ) {
					$google_maps_extensions .= '&libraries=';
					$google_maps_extensions .= implode( ',', $google_maps_extensions_array );
				}
				
				wp_register_script( 'google-map-api', '//maps.googleapis.com/maps/api/js?key=' . esc_attr( techlink_core_get_google_maps_api_key() ) . $google_maps_extensions, array(), false, true );
				
				wp_register_script( 'techlink-core-map-custom-marker', TECHLINK_CORE_INC_URL_PATH . '/maps/assets/js/custom-marker.js', array(
					'google-map-api',
					'underscore',
					'jquery'
				), false, true );
				
				wp_register_script( 'markerclusterer', TECHLINK_CORE_INC_URL_PATH . '/maps/assets/js/markerclusterer.js', array(
					'google-map-api',
					'jquery'
				), false, true );
				
				wp_register_script( 'techlink-core-google-map', TECHLINK_CORE_INC_URL_PATH . '/maps/assets/js/google-map.js', array(
					'google-map-api',
					'techlink-core-map-custom-marker',
					'markerclusterer',
					'jquery'
				), false, true );
				
				wp_register_script( 'nouislider', TECHLINK_CORE_INC_URL_PATH . '/maps/assets/js/nouislider.min.js', array(), false, true );
			}
		}
	
		function set_scripts_dependency( $dependencies ) {
			
			if ( techlink_core_get_google_maps_api_key( 'is_enabled' ) ) {
				$dependencies[] = 'techlink-core-google-map';
			}
			
			return $dependencies;
		}
		
		function enable_maps_for_framework_fields( $is_enabled ) {
			
			if ( techlink_core_get_google_maps_api_key( 'is_enabled' ) ) {
				return true;
			}
			
			return $is_enabled;
		}
		
		public function set_global_map_variables() {
			
			if ( techlink_core_get_google_maps_api_key( 'is_enabled' ) ) {
				$map_zoom  = techlink_core_get_post_value_through_levels( 'qodef_map_zoom' );
				$map_style = json_decode( techlink_core_get_post_value_through_levels( 'qodef_map_style' ) );
				
				$js_map_variables['mapStyle']          = ! empty ( $map_style ) ? $map_style : '';
				$js_map_variables['mapZoom']           = ! empty ( $map_zoom ) ? $map_zoom : 12;
				$js_map_variables['mapScrollable']     = techlink_core_get_post_value_through_levels( 'qodef_enable_map_scroll' ) == 'yes';
				$js_map_variables['mapDraggable']      = techlink_core_get_post_value_through_levels( 'qodef_enable_map_drag' ) == 'yes';
				$js_map_variables['streetViewControl'] = techlink_core_get_post_value_through_levels( 'qodef_enable_map_street_view_control' ) == 'yes';
				$js_map_variables['zoomControl']       = techlink_core_get_post_value_through_levels( 'qodef_enable_map_zoom_control' ) == 'yes';
				$js_map_variables['mapTypeControl']    = techlink_core_get_post_value_through_levels( 'qodef_enable_map_type_control' ) == 'yes';
				$js_map_variables['fullscreenControl'] = techlink_core_get_post_value_through_levels( 'qodef_enable_map_full_screen_control' ) == 'yes';
				$js_map_variables['geolocationTitle']  = esc_html__( 'Your location is here', 'techlink-core' );
				
				$js_map_variables = apply_filters( 'techlink_core_filter_js_map_variables', $js_map_variables );
				
				wp_localize_script( 'techlink-core-google-map', 'qodefMapsVariables', array(
					'global'   => $js_map_variables,
					'multiple' => array(),
				) );
			}
		}
	}
}

TechLinkCoreMaps::get_instance();