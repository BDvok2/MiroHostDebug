<?php

if ( ! function_exists( 'techlink_core_add_weather_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function techlink_core_add_weather_widget( $widgets ) {
		$widgets[] = 'TechLinkCoreWeatherWidget';
		
		return $widgets;
	}
	
	add_filter( 'techlink_core_filter_register_widgets', 'techlink_core_add_weather_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class TechLinkCoreWeatherWidget extends QodeFrameworkWidget {
		
		public function map_widget() {
			$this->set_base( 'techlink_core_weather' );
			$this->set_name( esc_html__( 'TechLink Weather', 'techlink-core' ) );
			$this->set_description( esc_html__( 'Displays weather forecast', 'techlink-core' ) );
			
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Widget Title', 'techlink-core' ),
				)
			);
			
			$this->set_widget_option(
				array(
					'field_type' => 'select',
					'name'       => 'layout',
					'title'      => esc_html__( 'Layout', 'techlink-core' ),
					'options'    => array(
						'standard' => esc_html__( 'Standard', 'techlink-core' ),
						'simple'   => esc_html__( 'Simple', 'techlink-core' ),
					)
				)
			);
			
			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'api_key',
					'title'       => esc_html__( 'API Key', 'techlink-core' ),
					'description' => sprintf( '%s%s%s',
						'<a href="https://openweathermap.org/appid#get" target="_blank">',
						esc_html__( 'How to get API key', 'techlink-core' ),
						'</a>'
					),
				)
			);
			
			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'location',
					'title'       => esc_html__( 'Location', 'techlink-core' ),
					'description' => sprintf( '%s%s%s',
						'<a href="https://openweathermap.org/find" target="_blank">',
						esc_html__( 'Find Your Location (i.e: London, UK or New York City)', 'techlink-core' ),
						'</a>'
					),
				)
			);
			
			$this->set_widget_option(
				array(
					'field_type' => 'select',
					'name'       => 'units',
					'title'      => esc_html__( 'Temperature Unit', 'techlink-core' ),
					'options'    => array(
						'metric'   => esc_html__( 'Metric', 'techlink-core' ),
						'imperial' => esc_html__( 'Imperial', 'techlink-core' ),
					),
				)
			);
			
			$this->set_widget_option(
				array(
					'field_type' => 'select',
					'name'       => 'time_zone',
					'title'      => esc_html__( 'Time Zone', 'techlink-core' ),
					'options'    => array(
						'0' => esc_html__( 'UTC', 'techlink-core' ),
						'1' => esc_html__( 'GMT', 'techlink-core' ),
					),
				)
			);
			
			$this->set_widget_option(
				array(
					'field_type' => 'select',
					'name'       => 'days_to_show',
					'title'      => esc_html__( 'Days to Show', 'techlink-core' ),
					'options'    => array(
						'1' => esc_html__( 'Current Day', 'techlink-core' ),
						'5' => esc_html__( '5 Days', 'techlink-core' ),
					),
				)
			);
		}
		
		public function render( $atts ) {
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['weather_data']   = techlink_core_weather_widget_logic( $atts );
			$atts['today_params']   = $this->get_layout_params( $atts );
			
			techlink_core_template_part( 'widgets/weather', 'templates/holder', '', $atts );
		}
		
		public function get_holder_classes( $atts ) {
			$classes = array();
			
			$classes[] = 'qodef-weather-widget qodef-m';
			$classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$classes[] = ! empty( $atts['days_to_show'] ) ? 'qodef-show--' . $atts['days_to_show'] : '';
			
			return implode( ' ', $classes );
		}
		
		private function get_layout_params( $atts ) {
			$today_params = array();
			
			if ( $atts['units'] == 'metric' ) {
				$today_params['temp_unit'] = esc_html__( 'C', 'techlink-core' );
				$today_params['wind_unit'] = esc_html__( 'm/s', 'techlink-core' );
			} else {
				$today_params['temp_unit'] = esc_html__( 'F', 'techlink-core' );
				$today_params['wind_unit'] = esc_html__( 'fps', 'techlink-core' );
			}
			
			$today_params['dt_today'] = date( get_option( 'date_format' ), current_time( 'timestamp', $atts['time_zone'] ) );
			
			// todays temps
			$today = $atts['weather_data']['now'];
			
			if ( empty( $today ) ) {
				return array();
			}
			
			$today_params['today_temp']              = round( $today->main->temp );
			$today_params['today_high']              = round( $today->main->temp_max );
			$today_params['today_low']               = round( $today->main->temp_min );
			$today_params['today_description']       = $today->weather[0]->description;
			$today_params['today_description_class'] = strtolower( sanitize_title( $today->weather[0]->main ) );
			$today_params['today_humidity']          = $today->main->humidity;
			$today_params['today_wind_speed']        = $today->wind->speed;
			$today_params['city']                    = $today->name;
			$today_params['day_number']              = 1;
			
			if ( $atts['days_to_show'] == 5 ) {
				$forecast = $atts['weather_data']['forecast'];
				
				$days_of_week = array(
					esc_html__( 'Sun', 'techlink-core' ),
					esc_html__( 'Mon', 'techlink-core' ),
					esc_html__( 'Tue', 'techlink-core' ),
					esc_html__( 'Wed', 'techlink-core' ),
					esc_html__( 'Thu', 'techlink-core' ),
					esc_html__( 'Fri', 'techlink-core' ),
					esc_html__( 'Sat', 'techlink-core' )
				);

				foreach ( (array) $forecast->list as $forecast ) {
					$rest = array();

					$rest['today_temp']              = round( $forecast->temp->day );
					$rest['day_of_week']             = $days_of_week[ date( 'w', $forecast->dt ) ];
					$rest['today_description_class'] = strtolower( sanitize_title( $forecast->weather[0]->main ) );
					$today_params['rest'][]          = $rest;
				}
			}
			
			return $today_params;
		}
	}
}
