<?php

class TechLinkCoreElementorSectionHandler {
	private static $instance;
	public $sections = array();

	public function __construct() {
		add_action( 'elementor/element/section/_section_responsive/after_section_end', array(
			$this,
			'render_parallax_options'
		), 10, 2 );
		add_action( 'elementor/element/section/_section_responsive/after_section_end', array(
			$this,
			'render_offset_options'
		), 10, 2 );
		add_action( 'elementor/element/section/_section_responsive/after_section_end', array(
			$this,
			'render_grid_options'
		), 10, 2 );
		add_action( 'elementor/frontend/section/before_render', array( $this, 'section_before_render' ) );
		add_action( 'elementor/frontend/element/before_render', array( $this, 'section_before_render' ) );
		add_action( 'elementor/frontend/before_enqueue_styles', array( $this, 'enqueue_styles' ), 9 );
		add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'enqueue_scripts' ), 9 );
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function render_parallax_options( $section, $args ) {
		$section->start_controls_section(
			'qodef_parallax',
			[
				'label' => esc_html__( 'TechLink Parallax', 'techlink-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'qodef_parallax_type',
			[
				'label'       => esc_html__( 'Enable Parallax', 'techlink-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'no',
				'options'     => [
					'no'       => esc_html__( 'No', 'techlink-core' ),
					'parallax' => esc_html__( 'Yes', 'techlink-core' ),
				],
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_parallax_image',
			[
				'label'       => esc_html__( 'Parallax Background Image', 'techlink-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'condition'   => [
					'qodef_parallax_type' => 'parallax'
				],
				'render_type' => 'template',
			]
		);

		$section->end_controls_section();
	}

	public function render_offset_options( $section, $args ) {
		$section->start_controls_section(
			'qodef_offset',
			[
				'label' => esc_html__( 'TechLink Offset Image', 'techlink-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'qodef_offset_type',
			[
				'label'       => esc_html__( 'Enable Offset Image', 'techlink-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'no',
				'options'     => [
					'no'     => esc_html__( 'No', 'techlink-core' ),
					'offset' => esc_html__( 'Yes', 'techlink-core' ),
				],
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_offset_image',
			[
				'label'       => esc_html__( 'Offset Image', 'techlink-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'condition'   => [
					'qodef_offset_type' => 'offset'
				],
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_offset_top',
			[
				'label'       => esc_html__( 'Offset Image Top Position', 'techlink-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '50%',
				'condition'   => [
					'qodef_offset_type' => 'offset'
				],
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_offset_left',
			[
				'label'       => esc_html__( 'Offset Image Left Position', 'techlink-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '50%',
				'condition'   => [
					'qodef_offset_type' => 'offset'
				],
				'render_type' => 'template',
			]
		);

		$section->end_controls_section();
	}

	public function render_grid_options( $section, $args ) {
		$section->start_controls_section(
			'qodef_grid_row',
			[
				'label' => esc_html__( 'TechLink Grid', 'techlink-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'qodef_enable_grid_row',
			[
				'label'        => esc_html__( 'Make this row "In Grid"', 'techlink-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options'      => [
					'no'   => esc_html__( 'No', 'techlink-core' ),
					'grid' => esc_html__( 'Yes', 'techlink-core' ),
				],
				'prefix_class' => 'qodef-elementor-content-'
			]
		);

		$section->add_control(
			'qodef_grid_row_behavior',
			[
				'label'        => esc_html__( 'Grid Row Behavior', 'techlink-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => '',
				'options'      => [
					''      => esc_html__( 'Default', 'techlink-core' ),
					'right' => esc_html__( 'Extend Grid Right', 'techlink-core' ),
					'left'  => esc_html__( 'Extend Grid Left', 'techlink-core' ),
				],
				'condition'    => [
					'qodef_enable_grid_row' => 'grid',
				],
				'prefix_class' => 'qodef-extended-grid qodef-extended-grid--'
			]
		);

		$section->add_control(
			'qodef_reset_grid_row_behavior',
			[
				'label'        => esc_html__( 'Reset Grid Row Behavior', 'techlink-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'never',
				'options'      => [
					'never' => esc_html__( 'Never', 'techlink-core' ),
					'yes'   => esc_html__( 'Below 1024px', 'techlink-core' ),
				],
				'condition'    => [
					'qodef_enable_grid_row' => 'grid',
				],
				'prefix_class' => 'qodef-reset-grid qodef-reset-grid--'
			]
		);

		$section->end_controls_section();
	}

	public function section_before_render( $widget ) {
		$data     = $widget->get_data();
		$type     = isset( $data['elType'] ) ? $data['elType'] : 'section';
		$settings = $data['settings'];

		if ( 'section' === $type ) {
			if ( isset( $settings['qodef_parallax_type'] ) && $settings['qodef_parallax_type'] == 'parallax' ) {
				$parallax_type  = $widget->get_settings_for_display( 'qodef_parallax_type' );
				$parallax_image = $widget->get_settings_for_display( 'qodef_parallax_image' );

				if ( ! in_array( $data['id'], $this->sections ) ) {
					$this->sections[ $data['id'] ][] = array(
						'parallax_type'  => $parallax_type,
						'parallax_image' => $parallax_image
					);
				}
			}

			if ( isset( $settings['qodef_offset_type'] ) && $settings['qodef_offset_type'] == 'offset' ) {
				$offset_type  = $widget->get_settings_for_display( 'qodef_offset_type' );
				$offset_image = $widget->get_settings_for_display( 'qodef_offset_image' );
				$offset_top   = $widget->get_settings_for_display( 'qodef_offset_top' );
				$offset_left  = $widget->get_settings_for_display( 'qodef_offset_left' );

				if ( ! in_array( $data['id'], $this->sections ) ) {
					$this->sections[ $data['id'] ][] = array(
						'offset_type'  => $offset_type,
						'offset_image' => $offset_image,
						'offset_top'   => $offset_top,
						'offset_left'  => $offset_left,
					);
				}
			}
		}
	}

	public function enqueue_styles() {
		wp_enqueue_style( 'techlink-core-elementor', TECHLINK_CORE_PLUGINS_URL_PATH . '/elementor/assets/css/elementor.min.css' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( 'techlink-core-elementor', TECHLINK_CORE_PLUGINS_URL_PATH . '/elementor/assets/js/elementor.js', array(
			'jquery',
			'elementor-frontend'
		) );

		$elementor_global_vars = array(
			'elementorSectionHandler' => $this->sections,
		);

		wp_localize_script( 'techlink-core-elementor', 'qodefElementorGlobal', array(
			'vars' => $elementor_global_vars,
		) );
	}
}

if ( ! function_exists( 'techlink_core_init_elementor_section_handler' ) ) {
	/**
	 * Function that initialize main page builder handler
	 */
	function techlink_core_init_elementor_section_handler() {
		TechLinkCoreElementorSectionHandler::get_instance();
	}

	add_action( 'init', 'techlink_core_init_elementor_section_handler', 1 );
}
