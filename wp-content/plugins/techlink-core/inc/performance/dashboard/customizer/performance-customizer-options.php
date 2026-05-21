<?php

if ( ! function_exists( 'techlink_core_add_performance_customizer_options' ) ) {
	/**
	 * Function that add customizer options for this module
	 */
	function techlink_core_add_performance_customizer_options() {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'type' => 'customizer',
			)
		);
	
		if ( $page ) {
			
			$page->add_field_element(
				array(
					'field_type'  => 'panel',
					'name'        => 'techlink_core_performance_panel',
					'priority'    => 250,
					'title'       => esc_html__( 'Qode Performance', 'techlink-core' ),
				)
			);
			
			// Hook to include additional options after module options
			do_action( 'techlink_core_action_performance_customizer_options', $page );
		}
	}
	
	add_action( 'qode_framework_action_customizer_techlink_core_performance_panel', 'techlink_core_add_performance_customizer_options' );
}