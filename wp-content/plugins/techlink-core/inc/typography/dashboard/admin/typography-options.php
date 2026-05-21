<?php

if ( ! function_exists( 'techlink_core_add_typography_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function techlink_core_add_typography_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => TECHLINK_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'typography',
				'icon'        => 'fa fa-indent',
				'title'       => esc_html__( 'Typography', 'techlink-core' ),
				'description' => esc_html__( 'Global Typography Options', 'techlink-core' ),
				'layout'      => 'tabbed'
			)
		);

		if ( $page ) {

			// Hook to include additional options after module options
			do_action( 'techlink_core_action_after_typography_options_map', $page );
		}
	}

	add_action( 'techlink_core_action_default_options_init', 'techlink_core_add_typography_options', techlink_core_get_admin_options_map_position( 'typography' ) );
}